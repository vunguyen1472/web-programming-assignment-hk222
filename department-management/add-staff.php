<?php
    session_start();
    include("utils.php");   

    if (isset($_GET["staff_id"])){
        Utils::addStaff($_GET["staff_id"], $_SESSION['user_id']);
        echo "<option selected>Choose new member here</option>";
        Utils::getStaffs($_SESSION['user_id']);
    }
    else {
        Utils::getDpStaffs($_SESSION['user_id']);
    }
?>