<?php 
    session_start();
    include("utils.php");
    Utils::removeStaff($_GET["staff_id"]);
    Utils::getDpStaffs($_SESSION['user_id']);
?>