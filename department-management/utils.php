<?php
    class Utils {   
        public static function getDpName ($supervisor_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
            $sql = "SELECT `name` FROM `department` WHERE `supervisor_id` = " . $supervisor_id;
            $result = $conn->query($sql);
            
            $conn->close();
            
            if ($result->num_rows == 0) {
                return "<h1> You have not been assigned to any department yet ! </h1>";
            } else {
                $row = $result->fetch_assoc();
                return "<h3>" . $row["name"] . "</h3>
                        <p class='mt-3'>Some description of department: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam explicabo accusantium necessitatibus excepturi sapiente ad quae vitae maiores obcaecati fugiat ipsam assumenda in similique tempore tempora, dolores velit cumque. Ipsam?</p>
                ";
            }
        }

        public static function getDpProjects($supervisor_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

            $sql = "SELECT `name`, `description`, `end_date` FROM `project` WHERE `supervisor_id` =" . $supervisor_id;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    // echo "Name: " . $row["name"]. " - Description: " . $row["description"]. " - Deadline: " . $row["end_date"]. "<br>";
                    echo "<li class='mb-3'>";
                    echo "<a href='?page=project-management&project-name=" . $row["name"] . "'>". $row["name"] . "</a>" . "<span> | " . $row["end_date"] . "</span>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "</li>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
        }

        public static function getDpStaffs($supervisor_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

            $sql = "SELECT us.id, us.name, us.type
                    FROM department dp
                    JOIN user su ON dp.supervisor_id = su.id
                    JOIN department_staff ds ON dp.id = ds.department_id
                    JOIN user us ON ds.staff_id = us.id
                    WHERE su.id = '$supervisor_id';
            ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<li class='mb-3'>";
                        echo "<button class='btn btn-danger me-3' onClick='removeStaff(" . $row["id"] . ")'></button>";
                        echo "<a href=''>". $row["name"] . "</a> - <span> ID: " . $row["id"]. "</span>";
                    echo "</li>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
        }

        public static function getStaffs($supervisor_id){ // Get staffs that are not currently in the department
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

            $sql = "SELECT us.id, us.name, us.type
                    FROM user us
                    WHERE us.type = 'staff'
                    AND us.id NOT IN (
                    SELECT ds.staff_id
                    FROM department_staff ds
                    JOIN department dp ON ds.department_id = dp.id
                    WHERE dp.supervisor_id = '$supervisor_id'
                    )
            ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value = " . $row["id"] . ">" . $row["name"] . " - " . $row["id"] . "</option>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
        }

        public static function removeStaff($staff_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            $sql = "DELETE FROM department_staff
                    WHERE staff_id = '$staff_id';
            ";
            $result = $conn->query($sql);
            $conn->close();
        }

        public static function addStaff($staff_id, $supervisor_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            $sql = "INSERT INTO department_staff (department_id, staff_id)
                    VALUES ((SELECT id FROM department WHERE supervisor_id = '$supervisor_id'), $staff_id);
            ;";
            $result = $conn->query($sql);
            $conn->close();
        }
    }
?>