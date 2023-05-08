<?php
session_start();
if (isset($_POST['description'])) {
  $_SESSION['description'] = $_POST['description'];
}
if (isset($_POST['taskID'])) {
  $_SESSION['taskID'] = $_POST['taskID'];
}

