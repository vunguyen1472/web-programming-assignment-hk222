<?php 
    /* RETURN CODE
        id_old-role_new-role: SUCCESS
        1: FAILED_REQUEST
        2: ERROR DB CONNECTTION */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";
        $update_value = $_POST["role"];
        $user_id = intval($_POST["id"]);

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo "2";
        }
        else{
            $statement = $conn->prepare('SELECT `type` FROM `user` WHERE `id` = ?');
            $statement->bind_param("i", $user_id);
            $statement->execute();
            $result = $statement->get_result();

            $statement = $conn->prepare('UPDATE `user` SET `type`= ? WHERE `id` = ?');
            $statement->bind_param('si', $update_value, $user_id);
            $statement->execute();
            
            $conn->close();
            $row = $result->fetch_assoc();
            $old_role = $row["type"];
            echo "" . $user_id . "_" . $old_role . "_" . $update_value . "";
        }
    }
    else{
        echo "1";
    }
?>