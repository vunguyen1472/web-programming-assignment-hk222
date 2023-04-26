<?php
session_start();
if (isset($_POST['description'])) {
  $_SESSION['description'] = $_POST['description'];
}
