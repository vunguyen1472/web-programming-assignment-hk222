<!DOCTYPE html>
<html>

<head>
    <title>File Submission Form</title>
</head>

<body>

    <?php
    // Connect to the database
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "enterprise_management";
    $conn = mysqli_connect($host, $user, $password, $database);

    // Check for errors
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $task_id = $_SESSION['taskID'];
    // Retrieve the submitted attachment file
    $sql = "SELECT content FROM submission WHERE task_id = $task_id ORDER BY submitted_date DESC LIMIT 1";

    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file = $row['content'];
        echo "<p>Attachment: <a href='http://localhost/assignment/uploads/$file' target='_blank'>$file</a></p>";
    }

    mysqli_close($conn);
    ?>

</body>

</html>