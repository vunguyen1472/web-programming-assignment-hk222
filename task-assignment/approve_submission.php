<?php
    function approve_default($task_id, $feedback){
        $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
        $sql = "UPDATE submission s
                INNER JOIN task t ON s.task_id = t.id
                SET s.feedback_content = '$feedback', s.status = 'approved', t.status = 'done'
                WHERE s.task_id = '$task_id';"
        ;
        $result = $conn->query($sql);
        
        $conn->close();

    }

    function approve_with_feedback($task_id, $feedback, $deadline){
        $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
        $sql = "UPDATE submission s
                INNER JOIN task t ON s.task_id = t.id
                SET s.feedback_content = '$feedback', s.status = 'approved', t.status = 'in progress', t.deadline = '$deadline'
                WHERE s.task_id = '$task_id';"
        ;
        $result = $conn->query($sql);
        
        $conn->close();
    }

    $task_id = $_GET["task_id"];
    $feedback = $_GET["feedback"];
    $deadline = $_GET["new_deadline"];
    // $deadline = date('Y-m-d H:i:s', strtotime($_GET["new_deadline"]));

    if ($deadline == ''){
        echo approve_default($task_id, $feedback);
    }
    else {
        $deadline = date('Y-m-d H:i:s', strtotime($_GET["new_deadline"]));
        
        approve_with_feedback($task_id, $feedback, $deadline);
    }
?>