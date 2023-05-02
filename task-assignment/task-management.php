
    <?php 
        // function getConnection() {
        //     $servername = "localhost";
        //     $username = "root";
        //     $password = NULL;
        //     $dbname = "enterprise_management";
    
        //     $conn = new mysqli($servername, $username, $password, $dbname);
            
        //     if ($conn->connect_error) {
        //         die("Connection failed: " . $conn->connect_error);
        //     }
    
        //     return $conn;
        // }

        // function getTaskName($task_id){
        //     $conn = getConnection();

        //     $sql = "SELECT `name` FROM task WHERE id = " . $task_id;
        //     $result = $conn->query($sql);

        //     $row = mysqli_fetch_assoc($result);

        //     $conn->close();

        //     return $row["name"];
        // }

        // function getTaskDescription($task_id){
        //     $conn = getConnection();

        //     $sql = "SELECT `description` FROM task WHERE id = " . $task_id;
        //     $result = $conn->query($sql);

        //     $row = mysqli_fetch_assoc($result);

        //     $conn->close();

        //     return $row["description"];
        // }

        
    ?>

<?php
    include("task-assignment\utils.php");
?>

<?php
    Utils::getTaskInfo($_GET["task-id"]);
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