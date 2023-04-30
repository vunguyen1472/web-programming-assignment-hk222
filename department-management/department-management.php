<?php
    include("department-management\utils.php");
    $supervisor_id = $_SESSION['user_id'];
?>


<link rel="stylesheet" href="department-management\department-management.css">

<h3><?php echo Utils::getDpName($supervisor_id) ?></h3>
<p class="mt-3">Some description of department: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam explicabo accusantium necessitatibus excepturi sapiente ad quae vitae maiores obcaecati fugiat ipsam assumenda in similique tempore tempora, dolores velit cumque. Ipsam?</p>
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
            <button class="btn btn-primary" onClick="addMember()">Add members</button>
        </div>
        <ul id="staff-list" class="px-0 py-3">
            <?php 
                Utils::getDpStaffs($supervisor_id);
            ?>
        </ul>
        <div>
            <span id="demo"></span>
        </div>
    </div>
</div>

<script>
    function removeStaff(user_id){
        
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("staff-list").innerHTML = this.responseText;
        }
        xhttp.open("GET", "department-management\\remove-staff.php?staff_id=" + user_id);
        xhttp.send();
    }

    function addMember() {
        alert("add staff");
    }
</script>