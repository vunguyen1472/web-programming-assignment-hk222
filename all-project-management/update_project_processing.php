<?php 
    /* RETURN CODE
        0: SUCCESS
        1: FAILED_REQUEST
        2: ERROR DB CONNECTTION */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $project_name = filter_var($_POST["projectname"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $deadline = strftime('%Y-%m-%dT%H:%M:%S', strtotime($_POST["deadline"]));
        $deadline[10] = ' ';
        $supervisor_id = '';
        if ($_POST["assignto"] != "-1")
            $supervisor_id = intval($_POST["assignto"]);
        $description = filter_var($_POST["message"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $status = $_POST["status"];
        if($supervisor_id != '' && $status == "Not assigned"){
            $status = "In progress";
        }
        
        $project_id = intval($_POST["project_id"]);
        
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo "2";
        }
        else{
            $statement = $conn->prepare('UPDATE `project` SET `supervisor_id`= ?,`name`=?,`description`=?,`deadline`=?,`status`=? WHERE `id` = ?');
            $statement->bind_param("issssi", $supervisor_id, $project_name, $description, $deadline,$status, $project_id);
            $statement->execute();
            
            $conn->close();
            echo "0";
        }
    }
    else{
        echo "1";
    }
?>