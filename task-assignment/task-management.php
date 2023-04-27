<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css\task-management.css">
</head>
<body>
    <?php 
        function getConnection() {
            $servername = "localhost";
            $username = "root";
            $password = NULL;
            $dbname = "enterprise_management";
    
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            return $conn;
        }

        function getTaskName($task_id){
            $conn = getConnection();

            $sql = "SELECT `name` FROM task WHERE id = " . $task_id;
            $result = $conn->query($sql);

            $row = mysqli_fetch_assoc($result);

            $conn->close();

            return $row["name"];
        }

        function getTaskDescription($task_id){
            $conn = getConnection();

            $sql = "SELECT `description` FROM task WHERE id = " . $task_id;
            $result = $conn->query($sql);

            $row = mysqli_fetch_assoc($result);

            $conn->close();

            return $row["description"];
        }

        echo "<h4>" . getTaskName($_GET['task-id']) . "</h4>";
    ?>
    <div class="border-bottom pt-2 pb-4 d-flex">
        <div class="me-5">
            <i class="fa-regular fa-clock me-2"></i>
            <span>14 Jul, 2002</span>
        </div>
        <div class="me-5">
            <i class="fa-regular fa-user me-2"></i>
            <span>Tom</span>
        </div>
        <div class="me-5">
            <i class="fa-regular fa-hourglass me-2"></i>
            <span class="fw-bold text-primary">In progress</span>
        </div>
    </div>
    <?php
        echo "<p class='border-bottom py-4 mb-0'>" . getTaskDescription($_GET['task-id']). "</p>";
    ?>

    <ul class="submission-list d-flex flex-wrap border-bottom px-0 mb-0">
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4">
            <i class="fa-regular fa-file me-4"></i>
            <div>
                <h6>Submission1.doc</h6>
                <span>14 Jul, 2002</span>
            </div>
        </li>
        <li class="submission d-flex m-4 align-items-center">
            <i class="fa-regular fa-file me-4"></i>
            <a href="">Add more submission</a>
        </li>
        
    </ul>
    <div class="py-4" style="min-height: 10rem">
        <h5>Comments</h5>
    </div>
</body>
</html>