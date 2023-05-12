<?php
    $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');

    $sql = "UPDATE submission
            SET content = NULL, submitted_date = NULL
            WHERE task_id =" . $_GET["task-id"] . ";";

    $sql .= "UPDATE task
            SET status = 'in progress'
            WHERE id =" . $_GET["task-id"] . ";";

    if(mysqli_multi_query($conn, $sql)){
        echo $_GET["task-id"] . " updated successfully";
    } else{
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
