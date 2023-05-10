<?php
    session_start();

    function reject($task_id, $feedback, $deadline){
        $conn = mysqli_connect('localhost', 'root', '', 'enterprise_management');
            
        $sql = "UPDATE submission s
                INNER JOIN task t ON s.task_id = t.id
                SET s.feedback_content = '$feedback', s.status = 'rejected', t.status = 'in progress', t.deadline = '$deadline'
                WHERE s.task_id = '$task_id';"
        ;
        $result = $conn->query($sql);
        
        $conn->close();
    }

    $task_id = $_GET["task_id"];
    $feedback = $_GET["feedback"];
    $deadline = date('Y-m-d H:i:s', strtotime($_GET["new_deadline"]));
    
    reject($task_id, $feedback, $deadline);
?>