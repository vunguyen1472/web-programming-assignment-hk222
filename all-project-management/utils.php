<?php
    function get_project_info($id){
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return NULL;
        }
        else{
            $id = intval($id);
            $statement = $conn->prepare('SELECT `supervisor_id`, `name`, `description`, `deadline`, `status`, `created` FROM `project` WHERE `id` = ?');
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            $conn->close();
            return $row;
        }
    }

    function get_department_list(){
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return NULL;
        }
        else{
            $statement = $conn->prepare('SELECT * FROM `department`');
            $statement->execute();
            $result = $statement->get_result();
            $conn->close();
            return $result;
        }
    }
    

    function get_project_list(){
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return NULL;
        }
        else{
            $sql = 'SELECT `id`, `supervisor_id`, `name`, `description`, `deadline`, `status`, `created` FROM `project` WHERE 1';
            $list = $conn->query($sql);
            $conn->close();
            return $list;
        }
    }
    function get_department_from_id($id){
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return NULL;
        }
        else{
            $id = intval($id);
            $statement = $conn->prepare('SELECT `name` FROM `department` WHERE `department`.`supervisor_id` = ?');
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            $conn->close();
            return $row['name'];
        }
    }
    function get_progress($id){
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "enterprise_management";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return NULL;
        }
        else{
            $id = intval($id);
            $statement = $conn->prepare('SELECT * FROM `task` WHERE `task`.`project_id` = ?');
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $n_task = $result->num_rows;

            if ($n_task == 0){
                $conn->close();
                return 0;
            }
            $statement = $conn->prepare('SELECT * FROM `task` WHERE `task`.`project_id` = ? AND `task`.`status` = ?');
            $status = "Done";
            $statement->bind_param("is", $id, $status);
            $statement->execute();
            $result = $statement->get_result();
            $n_complete_task = $result->num_rows;
            $progress = round($n_complete_task / $n_task * 100, 0, PHP_ROUND_HALF_UP);
            $conn->close();
            return $progress;
        }
    }
?>