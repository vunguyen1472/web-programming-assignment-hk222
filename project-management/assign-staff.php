<?php
    include("utils.php");
    // echo $_GET["staff_id"] . " " . $_GET["task_id"];
    Utils::assignStaff($_GET["staff_id"], $_GET["task_id"]);

    $task_id = $_GET["task_id"];
    $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

    $sql = "SELECT `project`.`name`
            FROM `task`
            JOIN `project`
            ON `task`.`project_id` = `project`.`id`
            WHERE `task`.`id` = '$task_id';"
    ;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $conn->close();

    Utils::getPrjTasks($row["name"]);
?>