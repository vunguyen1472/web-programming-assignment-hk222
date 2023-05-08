<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Fontawesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="css\index.css" rel="stylesheet">
    <title>Enterprise Managment</title>
</head>

<body>
    <div class="container">
        <header class="py-3">
            <nav class="navbar navbar-expand-lg d-flex align-items-end">
                <a href="" class="navbar-brand">
                    <img src="images/logo.png" alt="logo" id="header-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar--collapsed" aria-controls="#navbar--collapsed" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar--collapsed">
                    <ul class="navbar-nav fs-5">   
                        <?php // Get user's role 
                            $user_role = "";
                            if (isset($_SESSION["user_id"])){
                                $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
                                
                                $sql = "SELECT `type` FROM `user` WHERE `id` = " . $_SESSION["user_id"];
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);

                                $user_role = $row["type"];
                            }
                        ?>

                        <li class="nav-item mx-3">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <!-- <li class="nav-item mx-3">
                            <a href="?page=tasks-management" class="nav-link">Task Assignment</a>
                        </li> -->
                        <?php
                            if ($user_role == "staff"){
                                echo "<li class='nav-item px-3'>";
                                    echo "<a href='?page=dashboard' class='nav-link'>Dashboad</a>";
                                echo "</li>";
                            }

                            if ($user_role == "supervisor"){
                                echo "<li class='nav-item px-3'>";
                                    echo "<a href='?page=department-management' class='nav-link'>Department</a>";
                                echo "</li>";
                                // echo "<li class='nav-item px-3'>";
                                //     echo "<a href='?page=project-management' class='nav-link'>Projects</a>";
                                // echo "</li>";
                            }

                            if ($user_role == "director"){
                                echo "<li class='nav-item px-3'>";
                                    echo "<a href='' class='nav-link'>Role management</a>";
                                echo "</li>";
                            }

                            if  ($user_role == ""){
                                echo "<li class='nav-item px-3'><a href='?page=login' class='nav-link'>Login</a></li>";
                            }
                            else {
                                echo "<li class='nav-item px-3'>";
                                    echo "<a href='?page=logout' class='nav-link'>Logout</a>";
                                echo "</li>"; 
                                echo "<li class='nav-item px-3'>";
                                    echo "<a href='' class='nav-link'><i class='fa-regular fa-user'></i></a>";
                                echo "</li>"; 
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>


        <main class="py-4">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : "home";

            if ($page == "login") {
                include("./auth/login.php");
            } else if ($page == "logout") {
                include("./auth/logout.php");
            } else if ($page == "tasks-management") {
                include("task-assignment\\tasks-management.php");
            } else if ($page == "task-management") {
                include("task-assignment\\task-management.php");
            } else if ($page == "dashboard") {
                // echo '<style>div.container {margin: 0px;}</style>';
                include("dashboard.php");
            } else if ($page == 'department-management'){
                include("department-management\department-management.php");
            } else if ($page == 'project-management'){
                include("project-management\project-management.php");
            } else if ($page == "task_description") {
                // echo '<style>div.container {margin: 0px;}</style>';
                include("task_description.php");
            }  else if ($page == "home") {
                include("homepage.php");
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
        function saveDescription(description,taskID) {
            sessionStorage.setItem('description', description);
            sessionStorage.setItem('taskID', taskID);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_description.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('description=' + encodeURIComponent(description)  + '&taskID=' + encodeURIComponent(taskID) );
        }
    </script>
</body>

</html>




