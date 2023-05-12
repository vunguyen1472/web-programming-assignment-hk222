<!DOCTYPE html>
<html>

<head>
    <title>File Submission Form</title>
</head>

<body>

    <form method="POST" action="upload.php" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Submit">
    </form>
    <button class='btn btn-danger' onClick='removeSubmission()'>Remove</button>
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
        echo "<p>Attachment: <a href='uploads/$file' target='_blank'>$file</a></p>";
    }

    mysqli_close($conn);
    ?>

<?php   
    include("task-assignment/utils.php");
        $submission = Utils::getTaskSubmission($task_id);
        if ($submission_data = $submission->fetch_assoc()){
            echo "<form class='d-flex flex-column mt-4'>";
                echo "<div class='d-flex flex-column'>";
                    echo "<label for='feedback-input'>Feedback: </label>";
                    echo "<textarea id='feedback-input' rows='5' class='mt-2 p-2' disabled>" . $submission_data["feedback_content"] . "</textarea>";
                echo "</div>";
                if ($submission_data["status"] == 'waiting'){
                    echo "<div class='mt-4'>";
                        echo "<label for='deadline-input'>New deadline for re-submission: </label>";
                        echo "<input type='datetime-local' id='deadline-input' placeholder='Enter your feedback for the submission' class='ms-3'>";
                    echo "</div>";
                    
                    echo "<div class='d-flex align-items-center mt-4'>";
                        echo "<button class='btn btn-primary' onClick='handleApproveSubmission()'>Approved</button>";
                        echo "<button class='btn btn-danger ms-3' onClick='handleRejectSubmission()'>Rejected</button>";
                    echo "</div>"; 
                }   
            echo "</form>";
            
            
        }
        else {
            echo "<p class='text-danger'>[!] There has not been any submission yet</p>";
        }
    ?>



</body>

</html>

<script>
    function removeSubmission(){
        let task_id = <?php echo $task_id?>;
        console.log(task_id);
        
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            console.log(this.responseText);
            location.reload();
        }

        xhttp.open("GET", "remove-submission.php?task-id=" + task_id);
        xhttp.send();
    }
</script>