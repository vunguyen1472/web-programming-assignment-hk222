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
                echo "<form class='d-flex flex-column'>";
                    echo "<label for='feedback-input'>Content: </label>";
                    echo "<textarea id='feedback-content' rows='5' class='mt-2 p-2' disabled>" . $submission_data["content"] . "</textarea>";
                echo "</form>";
            echo "</div>";
            echo "<form class='d-flex flex-column mt-4'>";
                echo "<div class='d-flex flex-column'>";
                    echo "<label for='feedback-input'>Feedback: </label>";
                    echo "<textarea id='feedback-input' rows='5' class='mt-2 p-2'></textarea>";
                echo "</div>";
                echo "<div class='mt-4'>";
                    echo "<label for='datetime-input'>New deadline for re-submission: </label>";
                    echo "<input type='datetime-local' id='datetime-input' placeholder='Enter your feedback for the submission' class='ms-3'>";
                echo "</div>";
            echo "</form>";

            echo "<div class='d-flex'>";
                echo "<button class='btn btn-primary mt-4' onClick='handleApproveSubmission()'>Approved</button>";
                echo "<button class='btn btn-danger mt-4 ms-3' onClick='handleRejectSubmission()'>Rejected</button>";
            echo "</div>";  
        }
        else {
            echo "<p class='text-danger'>[!] There has not been any submission yet</p>";
        }
    ?>
</div>




<div class="py-4" style="min-height: 10rem">
    <h5>Comments</h5>
</div> 
