<?php
// Connect to the database
$host = "localhost";
$user = "root";
$password = "";
$database = "enterprise_management";
$conn = mysqli_connect($host, $user, $password, $database);
session_start();
// Check for errors
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Upload the file
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
if ($file_type != "docx") {
  die("Error: Only .docx files are allowed.");
}
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
  $file_name = htmlspecialchars(basename($_FILES["file"]["name"]));
  echo "The file $file_name has been uploaded.";
} else {
  echo "Sorry, there was an error uploading your file.";
}

// Get the current date and time
$submission_date = date("Y-m-d H:i:s");


// Store information about the upload in the database
$task_id = $_SESSION['taskID'];

// Check if a submission row with the taskID exists
$sql_check = "SELECT COUNT(*) as count FROM submission WHERE task_id = $task_id";
$result_check = mysqli_query($conn, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);
$count = $row_check['count'];

if ($count > 0) {
  // If a row exists, update the existing record
  $sql = "UPDATE submission SET content = '$file_name', submitted_date = '$submission_date' WHERE task_id = $task_id";
} else {
  // If a row doesn't exist, create a new record
  $sql = "INSERT INTO submission (task_id, content, submitted_date) VALUES ($task_id, '$file_name', '$submission_date')";
}

if (mysqli_query($conn, $sql)) {
  // Update the status column in the task table to "waiting"
  $sql_update_task = "UPDATE task AS t
                    JOIN submission AS s ON t.id = s.task_id
                    SET t.status = 'waiting', s.status = 'waiting'
                    WHERE t.id = $task_id";
  if (mysqli_query($conn, $sql_update_task)) {
    echo "Record created or updated successfully.";
  } else {
    echo "Error: " . $sql_update_task . "<br>" . mysqli_error($conn);
  }
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);


// Redirect back to the HTML form page with the file name as a query parameter
header("Location: http://localhost/assignment/index.php?page=task_description");
exit();
