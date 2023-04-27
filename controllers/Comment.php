<?php
include_once './database/DB.php';
class Comment
{
	private $db;
	private $name;
	private $comment;
	private $task_idx;
	private $table = "comments";

	public function __construct()
	{
		$this->db = new DB();
	}

	public function setData($name, $comment, $task_idx)
	{
		$this->name    = $name;
		$this->comment = $comment;
		$this->task_idx = $task_idx;
	}

	public function create()
	{
		$query = "INSERT INTO $this->table(user_id,task_id, content, time) VALUES('$this->name', '$this->task_idx','$this->comment', now())";
		$insert_comment = $this->db->insert($query);
		return $insert_comment;
	}

	public function index()
	{
		$query = "SELECT * FROM $this->table ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function dateFormat($data)
	{
		date_default_timezone_set('Asia/Saigon');
		$date = date('M j, h:i:s a', time());
		return $date;
	}
}
