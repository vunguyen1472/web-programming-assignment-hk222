<?php 
    session_start();
    include("utils.php");

    if (isset($_GET["staff_id"])){
        Utils::removeStaff($_GET["staff_id"]);
        Utils::getDpStaffs($_SESSION['user_id']);
    }
    else {
        echo "<option selected>Choose new member here</option>";
        Utils::getStaffs($_SESSION['user_id']);
    }
?>