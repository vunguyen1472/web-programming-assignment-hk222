<?php
    class Utils {
        public static function getPrjDescription($prj_name){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
            $sql = "SELECT `description` FROM project WHERE `name` = '$prj_name'";
            $result = $conn->query($sql);
            
            $conn->close();
            
            if ($result->num_rows == 0) {
                // Do something here
            } else {
                $row = $result->fetch_assoc();
                return "<p class='mt-4'> <span class='fw-bold'>Description: </span>" . $row["description"] . "</p>";
            }
        }

        public static function getPrjDeadline($prj_name){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
            $sql = "SELECT `deadline` FROM project WHERE `name` = '$prj_name'";
            $result = $conn->query($sql);
            
            $conn->close();
            
            if ($result->num_rows == 0) {
                // Do something here
            } else {
                $row = $result->fetch_assoc();
                return "<p class='mt-4'> <span class='fw-bold'>Deadline: </span>" . $row["deadline"] . "</p>";
            }
        }

        public static function getDpStaffs($prj_name){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

            $sql = "SELECT u.id, u.name
                    FROM department_staff ds
                    JOIN user u ON u.id = ds.staff_id
                    JOIN department d ON d.id = ds.department_id
                    JOIN project p ON p.supervisor_id = d.supervisor_id
                    WHERE p.name = '$prj_name';
            ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value=" .  $row["id"] . ">" . $row["id"] . "</option>"; 
                }
            } else {
                echo "0 results";
            }

            $conn->close();
        }

        public static function getPrjTasks($prj_name){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

            $sql = "SELECT task.*
                    FROM task
                    JOIN project ON task.project_id = project.id
                    WHERE project.name = '$prj_name';
            ";
            $result = $conn->query($sql);

            $conn->close();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    echo "<tr class='d-flex'>";
                        echo "<td class='col-3 py-3'><a href='index.php?page=task-management&task-id=" . $row["id"]. "'>" . $row["name"] . "</a></td>";
                        echo "<td class='col-3 py-3'>" . $row["deadline"] . "</td>";
                        echo "<td class='col-4 py-3'><select class='form-select' style='width: 80%' onchange='assignStaff(this.value, " . $row['id']. ")'>";
                            if ($row['staff_id']){
                                echo "<option value=" .  $row["staff_id"] . " selected disabled hidden>" . $row["staff_id"] . "</option>"; 
                            }
                            else {
                                echo "<option selected disabled hidden>Assign staff for this task</option>"; 
                            }

                            if ($row["status"] == "Not assigned" || $row["status"] == "In progress"){
                                Utils::getDpStaffs($prj_name);
                            }
                            else {
                                echo "<option disabled>This task has been done</option>"; 
                            }
                        echo "</select></td>";
                        if ($row["status"] == "Not assigned"){
                            echo "<td class='col-2 py-3 text-secondary fw-bold' id='task-status'>Not assigned</td>";
                        }
                        else if ($row["status"] == "In progress"){
                            echo "<td class='col-2 py-3 text-primary fw-bold' id='task-status'>In progress</td>";
                        }
                        else if ($row["status"] == "approved" || $row["status"] == "Done"){
                            echo "<td class='col-2 py-3 text-success fw-bold' id='task-status'>Approved</td>";
                        }
                        else if ($row["status"] == "eed review"){
                            echo "<td class='col-2 py-3 text-warning-emphasis fw-bold' id='task-status'>" . $row["status"] . "</td>";
                        }
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }
        }

        public static function assignStaff($staff_id, $task_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

            $sql = "UPDATE `task` SET `staff_id` = '$staff_id', `status` = 'In progress' WHERE `id` = '$task_id';";
            $conn->query($sql);

            $conn->close();
        }
    }
?>

