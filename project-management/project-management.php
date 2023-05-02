<?php
    include("utils.php");
?>

<?php
    echo "<h2>" . $_GET["project-name"] . "</h2>";
    echo Utils::getPrjDescription($_GET["project-name"]);
    echo Utils::getPrjDeadline($_GET["project-name"]);
?>



<div class="border p-4 mt-4 shadow">
    <h6 class="mb-4 ">Project tasks: </h6>

    <table class="table table-hover">
        <thead>
            <tr class="d-flex">
                <th class="col-3 py-3">Task's name</th>
                <th class="col-3 py-3">Deadline</th>
                <th class="col-4 py-3">Responsible staff</th>
                <th class="col-2 py-3">Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider" id="project-tasks">
            <?php
                Utils::getPrjTasks($_GET["project-name"]);
            ?>
        </tbody>
    </table>
</div>

<script>
    function assignStaff(staff_id, task_id){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            // this is the response to the first request
            document.getElementById("project-tasks").innerHTML = this.responseText;
            // alert(this.responseText);
        }

        xhttp.open("GET", "project-management\\assign-staff.php?staff_id=" + staff_id + "&task_id= " + task_id);
        xhttp.send();
    }

    
</script>