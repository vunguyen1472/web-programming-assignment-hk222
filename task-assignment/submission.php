<style>
    #feedback-input {
        min-height: 5rem;
    }
</style>

<?php
    include("utils.php");
    $submission_info = Utils::getSubmissionInfo($_GET["submission_id"]);

    echo "<h2> Submission " . $submission_info["id"] . "</h2>";
    echo "<p class='mt-4'><span class='fw-bold'>Submitted date: </span>" . $submission_info["submitted_date"] . "</p>";
    echo "<form class='d-flex flex-column'>";
        echo "<label for='feedback-input' class='fw-bold'>Content: </label>";
        echo "<textarea id='feedback-content' rows='5' class='mt-2 p-2' disabled>" . $submission_info["content"] . "</textarea>";
    echo "</form>";
?>

<form class="d-flex flex-column mt-4">
    <div class="d-flex flex-column" >
        <label for="feedback-input">Feedback: </label>
        <textarea id="feedback-input" rows="5" class="mt-2 p-2"></textarea>
    </div>
    <div class="mt-4">
        <label for="datetime-input">New deadline for re-submission: </label>
        <input type="datetime-local" id="datetime-input" placeholder="Enter your feedback for the submission" class="ms-3">
    </div>
</form>

<div class="d-flex">
    <button class='btn btn-primary mt-4' onClick="handleApproveSubmission()">Approved</button>
    <button class='btn btn-danger mt-4 ms-3' onClick="handleRejectSubmission()">Rejected</button>
</div>    

<script>
    function handleApproveSubmission() {
        console.log("handleApprove");
    }   

    function handleRejectSubmission() {
        console.log("handleReject");
    }
</script>
