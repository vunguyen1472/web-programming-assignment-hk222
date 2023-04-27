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

    function getDepartmentName($supervisor_id){
        $conn = getConnection();

        $sql = "SELECT `name` FROM `department` WHERE `supervisor_id` = " . $supervisor_id;
        $result = $conn->query($sql);

        $row = mysqli_fetch_assoc($result);

        $conn->close();

        return $row["name"];
    }

    function getDepartmentID($supervisor_id){
        $conn = getConnection();

        $sql = "SELECT `id` FROM `department` WHERE `supervisor_id` = " . $supervisor_id;
        $result = $conn->query($sql);

        $row = mysqli_fetch_assoc($result);

        $conn->close();

        return $row["id"];
    }

    function printDepartmentProjects($supervisor_id){
        $conn = getConnection();

        $sql = "SELECT `name`, `description`, `end_date` FROM `project` WHERE `supervisor_id` =" . $supervisor_id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // echo "Name: " . $row["name"]. " - Description: " . $row["description"]. " - Deadline: " . $row["end_date"]. "<br>";
                echo "<li class='mb-3'>";
                echo "<a href=''>". $row["name"] . "</a>" . "<span> | " . $row["end_date"] . "</span>";
                echo "<p>" . $row["description"] . "</p>";
                echo "</li>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    }

    function printDepartmentStaffs($department_id){
        $conn = getConnection();

        $sql = "SELECT u.id, u.name, u.status FROM department_staff ds
        JOIN user u ON ds.staff_id = u.id
        WHERE ds.department_id =" . $department_id . " ;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<li class='mb-3'>";
                echo "<button class='btn btn-danger me-3' onClick='removeStaff()'></button>";
                echo "<a href=''>". $row["name"] . "</a> - <span> ID: " . $row["id"]. "</span> - ";
                if ($row["status"] == '1'){
                    echo "<span class='text-success'>Available</span>";
                }
                else {
                    echo "<span class='text-secondary'>Unavailable</span>";
                }
                echo "</li>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    }

    function getAvailableStaffs(){
        $conn = getConnection();

        $sql = "SELECT u.* FROM `user` u
                LEFT JOIN `department_staff` ds ON u.`id` = ds.`staff_id`
                WHERE u.`type` = '3' AND u.`status` = '1' AND ds.`department_id` IS NULL
        ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // echo something
            }
        } else {
            echo "[!] There are no available staffs on the system";
        }

        $conn->close();
    }
    
    $dp = getDepartmentName($_SESSION['user_id']);
?>

<link rel="stylesheet" href="css\department-management.css">

<h3><?php echo $dp ?></h3>
<p class="mt-3">Some description of department: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam explicabo accusantium necessitatibus excepturi sapiente ad quae vitae maiores obcaecati fugiat ipsam assumenda in similique tempore tempora, dolores velit cumque. Ipsam?</p>
<div class="d-flex justify-content-between mt-4">
    <div id="project-list-container" class="p-3 shadow">
        <h5>Projects: </h5>
        <ul id="project-list" class="px-0 py-3">
            <?php 
                printDepartmentProjects($_SESSION['user_id']);
            ?>
        </ul>
    </div>
    <div id="staff-list-container" class="p-3 shadow">
        <div class="d-flex justify-content-between">
            <h5>Members: </h5>
            <button class="btn btn-primary" onClick="addMember()">Add members</button>
        </div>
        <ul id="staff-list" class="px-0 py-3">
            <?php 
                $department_id = getDepartmentID($_SESSION['user_id']);
                printDepartmentStaffs($department_id);
            ?>
        </ul>
    </div>
</div>

<script>
    function removeStaff(){
        alert("remove staff");
    }

    function addMember() {
        alert("add staff");
    }
</script>