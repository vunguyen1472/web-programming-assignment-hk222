<?php
include_once 'controllers/Comment.php';
$com = new Comment();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Comment System in PHP</title>
	<style>
		/* Set the font family and font size */
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
		}

		/* Style the table */
		table {
			border-collapse: collapse;
			width: 100%;
			max-width: 500px;
			margin: 0 auto;
			background-color: #f9f9f9;
			border: 1px solid #ddd;
			box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
			text-align: left;
		}

		/* Style the table header */
		th {
			background-color: #f2f2f2;
			border: 1px solid #ddd;
			padding: 10px;
			font-weight: bold;
		}

		/* Style the table cells */
		td {
			border: 1px solid #ddd;
			padding: 8px;
		}

		/* Style the input and textarea elements */
		input[type="text"],
		textarea {
			width: 100%;
			padding: 8px;
			border: 1px solid #ddd;
			border-radius: 4px;
			box-sizing: border-box;
			font-size: 14px;
		}

		/* Style the submit button */
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 4px;
			padding: 10px 20px;
			font-size: 14px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		.box {
			border: 6px solid #999;
			margin: 30px auto 0;
			padding: 20px;
			width: 1000px;
			height: 250px;
			overflow: scroll;
		}

		.box ul {
			margin: 0;
			padding: 0;
			list-style: none;
		}

		.box li {
			display: block;
			border-bottom: 1px dashed #ddd;
			margin-bottom: 5px;
			padding-bottom: 5px;
		}

		.box li:last-child {
			border-bottom: 0 dashed #ddd;
		}

		.box span {
			color: #888;
		}
	</style>
</head>

<body style="background-color:none;">
	<center>
		<h1>Comment System</h1>
	</center>
	<div class="box">
		
			<?php
			$task_idx = $_SESSION['taskID'];
			$result = $com->justid($task_idx);
			if ($result !== false){?>
			<ul>	
			<?php
				while ($data = $result->fetch_assoc()) {
			?>
				<li><b style="color:black"><?php echo $data['user_id']; ?><b> - <?php echo $com->dateFormat($data['time']); ?> <br>
							<h3><?php echo $data['content'] ?></h3>
				</li>
			<?php } ?>
		</ul>
		<?php
			}else {
				echo "No comment yet!, Post it with the underneath box!!";
			}?>
	</div><br><br>
	<center>
		<?php
		if (isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			echo "<span style='color:black;font-size:20px'>" . $msg . "</span>";
		}
		?>

		<!-- <div style="border-style: groove;width: 25%;height: 280px"> -->
		<form action="post_comment_supervisor.php" method="post"><br><br><br>
			<table>
				<tr>
					<td>Your Name:</td>
					<td><input style="width: 221px;height: 30px;" type="" name="name" placeholder="Please enter your name"></td>
				</tr>
				<input type ="hidden" name ="task_id" value = "<?php echo $_SESSION['taskID'];?>">
				<tr>
					<td>Comment:</td>
					<td>
						<textarea name="comment" rows="5" cols="30" placeholder="Please enter your comment"></textarea>
					</td>
				</tr>

				<tr>
					<td></td>
					<td><input style="width: 230px;height: 40px;" type="submit" name="submit" value="Post"></td>
				</tr>
			</table>
		</form>
		<!-- </div> -->
		<center>
</body>

</html>