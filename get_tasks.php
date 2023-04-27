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

    function printTask($task_name, $task_id) {
        echo "<li><a href='homepage.php?page=task-management&task-id=" . $task_id . "'>" . $task_name . "</a></li>";
    }

    $project_name = $_GET['project_name'];

    // query the database for the tasks for the selected project
    $conn = getConnection();
    $sql = $conn->prepare("SELECT t.*
                            FROM task t
                            INNER JOIN project p ON t.project_id = p.id
                            WHERE p.name = ?"
    );
    $sql->bind_param("s", $project_name);
    $sql->execute();
    $result = $sql->get_result();

    // generate HTML for the tasks list
    while ($row = $result->fetch_assoc()) {
        printTask($row["name"], $row["id"]);
    }
?>