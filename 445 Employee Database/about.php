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
            .about-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>
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

        <div class="jumbotron text-center">
            <h1 class="display-3">About Us</h1>
            <hr class="my-4">
            <p style="font-size: 30px;">Christian David: cdavid22@uw.edu.</p>
            <p style="font-size: 30px;">Zakariye Luqman: zluqman@uw.edu.</p>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>