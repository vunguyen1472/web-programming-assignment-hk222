<?php
    include("department-management\utils.php");
    $supervisor_id = $_SESSION['user_id'];
?>


<link rel="stylesheet" href="department-management\department-management.css">

<?php echo Utils::getDpName($supervisor_id) ?>
<div class="d-flex justify-content-between mt-4">
    <div id="project-list-container" class="p-3 shadow">
        <h5>Projects: </h5>
        <ul id="project-list" class="px-0 py-3">
            <?php 
                Utils::getDpProjects($supervisor_id);
            ?>
        </ul>
    </div>
    <div id="staff-list-container" class="p-3 shadow">
        <div class="d-flex justify-content-between">
            <h5>Members: </h5>
            <div class="d-flex justify-content-center">
                <select class="form-select form-select-sm me-3" id="add-staff-select">
                    <option selected>Choose new member here</option>
                    <?php
                        Utils::getStaffs($supervisor_id);
                    ?>
                </select>
                <button class="btn btn-primary py-1 px-3" onClick="addStaff()">Add</button>
            </div>
        </div>
        <ul id="staff-list" class="px-0 py-3">
            <?php 
                Utils::getDpStaffs($supervisor_id);
            ?>
        </ul>
    </div>
</div>

<script>
    function removeStaff(user_id){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            // this is the response to the first request
            document.getElementById("staff-list").innerHTML = this.responseText;

            // send the second request
            const xhttp2 = new XMLHttpRequest();
            xhttp2.onload = function() {
                // this is the response to the second request
                document.getElementById("add-staff-select").innerHTML = this.responseText;
            }
            xhttp2.open("GET", "department-management\\remove-staff.php");
            xhttp2.send();
        }

        xhttp.open("GET", "department-management\\remove-staff.php?staff_id=" + user_id);
        xhttp.send();
    }

    function addStaff() {
        var staff_id = document.getElementById("add-staff-select").value;
        
        if (staff_id == "Choose new member here"){
            return;
        }
       
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            // this is the response to the first request
            document.getElementById("add-staff-select").innerHTML = this.responseText;

            // send the second request
            const xhttp2 = new XMLHttpRequest();
            xhttp2.onload = function() {
                // this is the response to the second request
                document.getElementById("staff-list").innerHTML = this.responseText;
            }
            xhttp2.open("GET", "department-management\\add-staff.php");
            xhttp2.send();
        }

        xhttp.open("GET", "department-management\\add-staff.php?staff_id=" + staff_id);
        xhttp.send();

    }
</script>