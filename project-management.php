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

    function printDepartmentProjectNames(){
        $conn = getConnection();

        $sql = "SELECT `name` FROM `project` WHERE `supervisor_id` = 2052002";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    }

    function printProjectTasks($project_name) {
        $conn = getConnection();
        
        $sql = $conn->prepare("SELECT t.*
                                FROM task t
                                INNER JOIN project p ON t.project_id = p.id
                                WHERE p.name = ?
                    ");
        $sql->bind_param("s", $project_name);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "Task ID: " . $row["id"] . "<br>";
                echo "Task Name: " . $row["name"] . "<br>";
                echo "Task Description: " . $row["description"] . "<br>";
            }
        } else {
            echo "0 results" . $project_name;
        }

        $conn->close();
    }

    $selected_project = "";
?>

<div class="form-floating">
    <select class="form-select" id="project-select" onchange="handleProjectChange()">
        <option selected>Choose a project</option>
        <?php
            printDepartmentProjectNames();
        ?>
    </select>
    <label for="project-select">Choose a project here</label>
</div>

<ul id="project-tasks">

</ul>

<script>
    function handleProjectChange(){
        var selected_project = document.getElementById("project-select").value;

        // make an AJAX request to get the tasks for the selected project
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // update the tasks list with the response
                document.getElementById("project-tasks").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "get_tasks.php?project_name=" + selected_project, true);
        xhttp.send();
    }
</script>

