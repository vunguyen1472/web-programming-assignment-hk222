<link rel="stylesheet" href="task-assignment/task-management.css">

<?php
    include("task-assignment\utils.php");
?>

<?php
    Utils::getTaskInfo($_GET["task-id"]);
?>

<div class='py-4 border-bottom'>
        <p class='fw-bold'>Submissions: </p>
    <?php
        $submission = Utils::getTaskSubmission($_GET["task-id"]);
        if ($submission_data = $submission->fetch_assoc()){
            echo "<div>";
                echo "<p> Deadline: " . $submission_data["submitted_date"] . "</p>";

                $text_color = ($submission_data["status"] == 'waiting') ? 'text-warning' : (($submission_data["status"] == 'approved') ? 'text-success' : 'text-danger');

                echo "<p> Status: <span class='$text_color'>" . $submission_data["status"] . "</span></p>";
                echo "<form class='d-flex flex-column'>";
                echo "<label for='feedback-input'>Content: </label>";
                    $_SESSION['taskID'] = $_GET['task-id'];
                    include("submission_supervisor.php");
                    echo "<textarea id='feedback-content' rows='5' class='mt-2 p-2' disabled>" . $submission_data["content"] . "</textarea>";
                echo "</form>";
            echo "</div>";
            echo "<form class='d-flex flex-column mt-4'>";
                echo "<div class='d-flex flex-column'>";
                    echo "<label for='feedback-input'>Feedback: </label>";
                    echo "<textarea id='feedback-input' rows='5' class='mt-2 p-2'>" . $submission_data["feedback_content"] . "</textarea>";
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
</div>

<div class="py-4" style="min-height: 10rem">

    <h5>Comments</h5>
    
    <?php
     include("comment_index_supervisor.php"); ?>
</div> 

<script>
    function handleApproveSubmission() {
        let feedback = document.getElementById("feedback-input").value;
        let new_deadline = document.getElementById("deadline-input").value;
        let task_id = <?php echo $_GET["task-id"]?>;

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            console.log(this.reponseText);
            location.reload();
        }

        xhttp.open("GET", "task-assignment/approve_submission.php?feedback=" + feedback + "&new_deadline=" + new_deadline + "&task_id=" + task_id);
        xhttp.send();
    }   

    function handleRejectSubmission() {
        let feedback = document.getElementById("feedback-input").value;
        let new_deadline = document.getElementById("deadline-input").value;
        let task_id = <?php echo $_GET["task-id"]?>;

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            console.log(this.reponseText);
            location.reload();
        }

        xhttp.open("GET", "task-assignment/reject_submission.php?feedback=" + feedback + "&new_deadline=" + new_deadline + "&task_id=" + task_id);
        xhttp.send();
    }
</script>
