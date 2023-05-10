<?php 
    /* RETURN CODE
        0: SUCCESS
        1: FAILED_REQUEST
        2: ERROR DB CONNECTTION */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $project_name = filter_var($_POST["projectname"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $deadline = strftime('%Y-%m-%dT%H:%M', strtotime($_POST["deadline"])). ':00';
        $deadline[10] = ' ';
        $supervisor_id = '';
        if ($_POST["assignto"] != "-1")
            $supervisor_id = intval($_POST["assignto"]);
        $description = filter_var($_POST["message"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $status = "Not assigned";
        if($supervisor_id != ''){
            $status = "In progress";
        }
        $date = date('Y-m-d H:i:s', time());
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
            $statement = NULL;
            if ($supervisor_id != ''){
                $statement = $conn->prepare('INSERT INTO `project` (`name`, `supervisor_id`, `description`, `deadline`, `status`, `created`)
            VALUES 
                (?, ?, ?, ?, ?, ?);');
                $statement->bind_param("sissss", $project_name, $supervisor_id, $description, $deadline, $status, $date);
            }
            else{
                $statement = $conn->prepare('INSERT INTO `project` (`name`, `description`, `deadline`, `status`, `created`)
            VALUES 
                (?, ?, ?, ?, ?);');
                $statement->bind_param("sisss", $project_name, $description, $deadline, $status, $date);
            }
            $statement->execute();
            
            $conn->close();
            echo "0";
        }
    }
    else{
        echo "1";
    }
?>