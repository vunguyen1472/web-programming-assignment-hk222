<?php
    class Utils {   
        public static function getDpName ($supervisor_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
            $sql = "SELECT `name` FROM `department` WHERE `supervisor_id` = " . $supervisor_id;
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            $conn->close();

            return $row["name"];
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
                    echo "<a href=''>". $row["name"] . "</a>" . "<span> | " . $row["end_date"] . "</span>";
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

            $sql = "SELECT us.id, us.name, us.type, us.status
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
                    echo "<a href=''>". $row["name"] . "</a> - <span> ID: " . $row["id"]. "</span> - ";
                    if ($row["status"] == 'Available'){
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

        public static function getStaffs($supervisor_id){ // Get staffs that are not currently in the department
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

            $sql = "SELECT us.id, us.name, us.type, us.status
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
                    echo "<li class='mb-3 d-flex align-items-center'>";
                        echo "<a href=''>". $row["name"] . "</a> - <span> ID: " . $row["id"]. "</span>";
                        echo "<button class='btn btn-primary'>Add</button>";
                    echo "</li>";
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
    }
?>