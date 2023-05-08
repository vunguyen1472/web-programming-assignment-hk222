<?php
    session_start();
    
    // Validation id format
    $id = $_POST['id'];
    // if (!(is_numeric($id) && intval($id) > 0)) {
    //     $_SESSION['error'] = "Invalid id format";
    //     header("Location: http://localhost/Assignment/homepage.php?page=login");
    // } 

    // // Validate password format
    $password = $_POST['password'];
    // if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
    //     $_SESSION['error'] = "Invalid pass format";
    //     header("Location: http://localhost/index.php?page=login");
    // }  

    // Connect to database
    // $conn = mysqli_connect('localhost', 'username', 'password', 'databasename');
    $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

    // Get information of user from table user in database
    $sql = "SELECT * FROM user WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Compare data (id, password)
    if ($password === $row['password']) {
        // Validate successfully, move to home page
        $_SESSION['login'] = "true";
        $_SESSION['id'] = $row['id'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['address'] = $row['address'];
        header("Location: http://localhost/Assignment/homepage.php?page=homepage");
        exit();
    } else {
        // Login error
        echo "Incorrect id or password!";
        $_SESSION['login'] = "false";
        $_SESSION['error'] = "Incorrect id or password!";
        header("Location: http://localhost/Assignment/homepage.php?page=login");
    }
?>


