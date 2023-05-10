<?php
    class Utils {
        public static function getTaskInfo($task_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
            $sql = "SELECT * FROM task WHERE id = '$task_id';";
            $result = $conn->query($sql);
            
            $conn->close();
            
            if ($result->num_rows == 0) {
                // Do something here
            } else {
                $row = $result->fetch_assoc();

                echo "<h4>" . $row["name"] . "</h4>";

                echo "<div class='border-bottom pt-2 pb-4 d-flex'>";
                    echo "<div class='me-5'>";
                        echo "<i class='fa-regular fa-clock me-2'></i>";
                        echo "<span>" . $row["deadline"] . "</span>";
                    echo "</div>";
                    echo "<div class='me-5'>";
                        echo "<i class='fa-regular fa-user me-2'></i>";
                        echo "<span>" . $row["staff_id"] . "</span>";
                        echo "</div>";
                    echo "<div class='me-5'>";
                        echo "<i class='fa-regular fa-hourglass me-2'></i>";
                        echo "<span class='fw-bold text-primary'>" . $row["status"] . "</span>";
                    echo "</div>";  
                echo "</div>";
                
                echo "<p class='border-bottom py-4 mb-0'> <span class='fw-bold'>Description: </span>" . $row["description"] . "</p>";
            }
        }

        public static function getTaskSubmission($task_id){
            $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
            $sql = "SELECT * FROM submission WHERE task_id = '$task_id';";
            $result = $conn->query($sql);
            
            $conn->close();

            return $result;
        }
    }
?>