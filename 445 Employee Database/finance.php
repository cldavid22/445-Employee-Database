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
                    <p class="lead" style="font-size: 40px; font-weight: bold; font-family: Arial, sans-serif;">Select Finance Type</p>
                    <select class="form-control" id="finance_select" name="finance_type">
                        <option value="">Select Finance Type</option>
                        <option value="salary">Salary</option>
                        <option value="hourly">Hourly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="threshold">Enter Threshold Value:</label>
                    <input type="number" class="form-control" id="threshold" name="threshold" placeholder="Enter a number">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr class="my-4">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finance_type'])) {
                $selected_finance_type = $_POST['finance_type'];
                $threshold = isset($_POST['threshold']) ? $_POST['threshold'] : null;
                $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                if (mysqli_connect_errno()) {
                    die(mysqli_connect_error());
                }

                if ($selected_finance_type === 'salary') {
                    $sql = "SELECT e.FirstName, e.LastName, e.PositionName, AVG(CAST(st.Salary AS FLOAT)) AS AverageSalary
                        FROM employees e
                        JOIN salarytype st ON e.EmployeeID = st.EmployeeID
                        GROUP BY e.FirstName, e.LastName, e.PositionName";
                    if ($threshold !== null) {
                        $sql .= " HAVING AVG(CAST(st.Salary AS FLOAT)) >= ?";
                    }
                } elseif ($selected_finance_type === 'hourly') {
                    $sql = "SELECT e.FirstName, e.LastName, e.PositionName, h.HourlyRate
                        FROM employees e
                        JOIN hourlytype h ON e.EmployeeID = h.EmployeeID";
                    if ($threshold !== null) {
                        $sql .= " WHERE h.HourlyRate >= ?";
                    }
                }

                $stmt = $connection->prepare($sql);
                if ($threshold !== null) {
                    $stmt->bind_param("d", $threshold);
                }
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
            ?>
            <table class="table table-hover">
                <thead>
                    <tr class="table-success">
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Position</th>
                        <?php if ($selected_finance_type === 'salary'): ?>
                        <th scope="col">Average Salary</th>
                        <?php elseif ($selected_finance_type === 'hourly'): ?>
                        <th scope="col">Hourly Rate</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['FirstName']; ?></td>
                        <td><?php echo $row['LastName']; ?></td>
                        <td><?php echo $row['PositionName']; ?></td>
                        <?php if ($selected_finance_type === 'salary'): ?>
                        <td><?php echo $row['AverageSalary']; ?></td>
                        <?php elseif ($selected_finance_type === 'hourly'): ?>
                        <td><?php echo $row['HourlyRate']; ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
                }

                $stmt->close();
                $connection->close();
            }
            ?>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>