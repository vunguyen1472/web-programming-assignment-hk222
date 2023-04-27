<?php
// update_status.php

// Get the values from POST parameters
$innerText = $_POST['innerText'];
$innerp = $_POST['innerp'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "enterprise_management");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update the status in the task table using innerText and innerp values
$sql = "UPDATE task SET status = ? WHERE description = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $innerText, $innerp);
$result = mysqli_stmt_execute($stmt);

// Check if the update was successful
if ($result) {
    // Update successful
    echo "Status updated successfully.";
} else {
    // Update failed
    echo "Error updating status: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
