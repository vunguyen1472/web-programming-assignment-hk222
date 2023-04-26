<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\homepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Enterprise Managment</title>
</head>

<body>
    <div class="container">
        <header class="py-3 border-bottom">
            <nav class="navbar navbar-expand-lg d-flex align-items-end">
                <a href="" class="navbar-brand">
                    <img src="images/logo.png" alt="logo" id="header-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar--collapsed" aria-controls="#navbar--collapsed" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar--collapsed">
                    <ul class="navbar-nav fs-5">
                        <li class="nav-item px-3">
                            <a href="?page=home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item px-3">
                            <a href="?page=tasks-management" class="nav-link">Tasks management</a>
                        </li>
                        <li class="nav-item px-3">
                            <a href="?page=dashboard" class="nav-link">Dashboad</a>
                        </li>
                        <li class="nav-item px-3">
                            <a href="?page=role-management" class="nav-link">Role management</a>
                        </li>
                        <li class='nav-item px-3'>
                            <a href='?page=login' class='nav-link'>Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <main class="py-4">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : "home";

            if ($page == "login") {
                include("login.php");
            } else if ($page == "tasks-management") {
                include("tasks-management.php");
            } else if ($page == "task-management") {
                include("task-management.php");
            } else if ($page == "dashboard") {
                // echo '<style>div.container {margin: 0px;}</style>';
                include("dashboard.php");
            } else if ($page == "task_description") {
                // echo '<style>div.container {margin: 0px;}</style>';
                include("task_description.php");
            } else if ($page == "home") {
                echo "<p>This is home page</p>";
            }
            ?>
        </main>

        <footer class="d-flex flex-row column-gap-5 row-gap-3 border-top justify-content-between py-4">
            <a href="" class="navbar-brand text-start">
                <img src="images/logo.png" class="img-fluid" alt="logo" width="36" height="36">
            </a>
            <nav class="nav">
                <ul class="navbar-nav ms-5">
                    <h6 class="text-uppercase fw-bold">Section 1</h6>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-5">
                    <h6 class="text-uppercase fw-bold">Section 2</h6>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-5">
                    <h6 class="text-uppercase fw-bold">Section 2</h6>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">item 1</a>
                    </li>
                </ul>
            </nav>
        </footer>
    </div>
    <script>
        function saveDescription(description) {
            sessionStorage.setItem('description', description);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_description.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('description=' + encodeURIComponent(description));
        }
    </script>
</body>

</html>