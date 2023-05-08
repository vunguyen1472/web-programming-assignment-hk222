<?php
include_once 'controllers/Comment.php';
$com = new Comment();
if (isset($_POST['submit'])) {
	$name    = $_POST['name'];
	$comment = $_POST['comment'];
	$task_id = $_POST['task_id'];
	if (empty($name) || empty($comment) || empty($task_id)) {
		echo "<span style='color:red;font-size:20px'>Field must not be empty !</span>";
	} else {
		$com->setData($name, $comment, $task_id);
		if ($com->create()) {
			header('Location: index.php?page=' . urlencode('task_description'));
		}
	}
}
