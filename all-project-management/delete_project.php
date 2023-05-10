<?php 
    /* RETURN CODE
        0: SUCCESS
        1: FAILED_REQUEST
        2: ERROR DB CONNECTTION */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";
        $id = intval($_POST["id"]);

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo "2";
        }
        else{
            $statement = $conn->prepare('DELETE FROM `project` WHERE `id` = ?');
            $statement->bind_param("i", $id);
            $statement->execute();
            
            $conn->close();
            echo "0";
        }
    }
    else{
        echo "1";
    }
?>