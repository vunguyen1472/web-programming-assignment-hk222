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
    function get_staff_info_list(){
        $conn = getConnection();
        $sql = "SELECT `id`, `name`, `type` FROM `user` WHERE 1;";
        $list = $conn->query($sql);
        $conn->close();
        return $list;
    }
?>