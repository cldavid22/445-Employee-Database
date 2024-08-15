<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PayRoll Project</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
        <style>
            /* Custom CSS to adjust dropdown menu position */
            .dropdown-menu {
                left: auto !important;
                right: 0;
            }
        </style>
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Payroll</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="index.php">Home</a>
                                <a class="dropdown-item" href="employee.php">Employees</a>
                                <a class="dropdown-item" href="department.php">Department</a>
                                <a class="dropdown-item" href="finance.php">Finances</a>
                                <a class="dropdown-item" href="timecard.php">TimeCard</a>
                                <a class="dropdown-item" href="about.php">About</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END -- Add HTML code for the top menu section (navigation bar) -->
        <div class="jumbotron">
            <form method="post">
                <div class="form-group">
                    <p class="lead" style="font-size: 40px; font-weight: bold; font-family: Arial, sans-serif;">Select Employee Information</p>
                    <select class="form-control" id="employee_select" name="employee_info">
                        <option value="original" <?php if(isset($_POST['employee_info']) && $_POST['employee_info'] === 'original') echo 'selected'; ?>>Employee Information</option>
                        <option value="new" <?php if(isset($_POST['employee_info']) && $_POST['employee_info'] === 'new') echo 'selected'; ?>>Employee Agency Information</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="first_name">Search by First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr class="my-4">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                if (mysqli_connect_errno()) {
                    die(mysqli_connect_error());
                }
                $selected_option = $_POST['employee_info'];
                if ($selected_option === 'new') {
                    $sql = "SELECT e.FirstName, e.LastName, e.PositionName, d.DepartmentName
                    FROM employees e
                    JOIN department d ON e.DepartmentName = d.DepartmentName";
                } else {
                    $sql = "SELECT * FROM employees";
                }
                if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
                    $search_name = '%' . $_POST['first_name'] . '%';
                    if ($selected_option === 'new') {
                        $sql .= " WHERE e.FirstName LIKE '%$search_name%'";
                    } else {
                        $sql .= " WHERE FirstName LIKE '%$search_name%'";
                    }
                }

                $result = mysqli_query($connection, $sql);

                if ($result) {
            ?>
            <table class="table table-hover">
                <thead>
                    <tr class="table-success">
                        <?php if ($selected_option === 'new') { ?>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Department</th>
                        <?php } else { ?>
                        <th scope="col">Employee ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Hire Date</th>
                        <?php } ?>
                    </tr>
                </thead>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <?php if ($selected_option === 'new') { ?>
                    <td><?php echo $row['FirstName'] ?></td>
                    <td><?php echo $row['LastName'] ?></td>
                    <td><?php echo $row['PositionName'] ?></td>
                    <td><?php echo $row['DepartmentName'] ?></td>
                    <?php } else { ?>
                    <td><?php echo $row['EmployeeID'] ?></td>
                    <td><?php echo $row['FirstName'] ?></td>
                    <td><?php echo $row['LastName'] ?></td>
                    <td><?php echo $row['HireDate'] ?></td>
                    <?php } ?>
                </tr>
                <?php
                    }
                    mysqli_free_result($result);
                }
            }
                ?>
            </table>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>