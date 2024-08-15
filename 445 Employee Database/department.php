<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PayRoll Project</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
        <style>
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
                <p class="lead" style="font-size: 40px; font-weight: bold; font-family: Arial, sans-serif;">Select Department</p>
                <select class="form-control" id="department_select" name="department_name">
                    <option value="">Select Department</option>
                    <option value="list_all_departments">List All Departments</option>
                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if (mysqli_connect_errno()) {
                        die(mysqli_connect_error());
                    }
                    $selected_department = isset($_POST['department_name']) ? $_POST['department_name'] : '';
                    $sql = "SELECT DISTINCT DepartmentName FROM department";
                    if ($result = mysqli_query($connection, $sql)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = ($selected_department === $row['DepartmentName']) ? 'selected' : '';
                            echo '<option value="' . $row['DepartmentName'] . '" ' . $selected . '>' . $row['DepartmentName'] . '</option>';
                        }
                        mysqli_free_result($result);
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr class="my-4">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['department_name'])) {
            $selected_department = $_POST['department_name'];
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if (mysqli_connect_errno()) {
                die(mysqli_connect_error());
            }

            if ($selected_department === 'list_all_departments') {
                $sql = "SELECT d.DepartmentName, COUNT(e.EmployeeID) AS TotalEmployees
                        FROM department d
                        LEFT JOIN employees e ON d.DepartmentName = e.DepartmentName
                        GROUP BY d.DepartmentName";
            } elseif (!empty($selected_department)) {
                $stmt = $connection->prepare("SELECT * FROM employees WHERE DepartmentName = ?");
                $stmt->bind_param("s", $selected_department);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Employee ID</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Department</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['EmployeeID']; ?></td>
                            <td><?php echo $row['LastName']; ?></td>
                            <td><?php echo $row['FirstName']; ?></td>
                            <td><?php echo $row['PositionName']; ?></td>
                            <td><?php echo $row['DepartmentName']; ?></td>
                        </tr>
                        <?php
                    }
                    $result->free();
                    $stmt->close();
                    ?>
                    </tbody>
                </table>
                <?php
            }

            if ($selected_department === 'list_all_departments') {
                if ($result = mysqli_query($connection, $sql)) {
                    ?>
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">Department Name</th>
                                <th scope="col">Total Employees</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['DepartmentName']; ?></td>
                                <td><?php echo $row['TotalEmployees']; ?></td>
                            </tr>
                            <?php
                        }
                        mysqli_free_result($result);
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
            }

            $connection->close();
        }
        ?>
    </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>