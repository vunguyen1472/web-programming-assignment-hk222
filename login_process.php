<?php
    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

    $id = $_POST['id'];
    $password = $_POST['password'];

    // Get information of user from table user in database
    $sql = "SELECT * FROM user WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Compare data (id, password)
    if ($password === $row['password']) {
        $_SESSION['login-status'] = "Success";
        $_SESSION['user_id'] = $row['id'];
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['login-status'] = "Incorrect Username/Password";
        header("Location: index.php?page=login");
        exit();
    }
?>