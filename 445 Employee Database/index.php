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

        <div class="jumbotron text-center">
            <h1 class="display-3">Welcome To Payroll</h1>
            <hr class="my-4">
            <p style="font-size: 30px;">Our project aims to create a payroll management system to address the payroll processing needs of small to medium-sized businesses. The main problem this system addresses is the time-consuming and error-prone nature of manual payroll processing. Manual payroll processing often leads to mistakes in calculating wages, taxes, and deductions, which can result in financial mistakes and hurt employees. Our proposed idea is important because it streamlines and automates the payroll process, reducing the likelihood of errors and ensuring accurate and timely payments to employees. The system will also provide valuable information and insights for management to make informed labor costs and budgeting decisions.</p>

            <p style="font-size: 30px;">The goals and motivations for working on this idea include improving efficiency, accuracy, and compliance with payroll regulations. The objectives of the proposed project include: Developing a user-friendly interface for inputting employee information, hours worked, and other payroll-related data. Implementing algorithms to calculate wages, taxes, and deductions accurately. Integrating with tax and regulatory authorities for compliance purposes generating payroll reports and providing analytics to support decision-making. Overall, we aim to accomplish the automation of payroll processing, resulting in time and cost savings for businesses while ensuring accuracy and compliance.</p>
            <p class="lead">
            <p style="font-size: 15px;"> Thanks For Visiting </p>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>