<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css\task-management.css">
</head>

<body>
    <div class='task-description'>
        <?php
        // Check if task id is set in the URL
        if (isset($_SESSION['description_done'])) {
            // Connect to your database
            $conn = mysqli_connect("localhost", "root", "", "dashboard");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve task data based on the task id

            $taskId = $_SESSION['description_done'];
            $sql = "SELECT * FROM task WHERE description = '$taskId'"; // Add quotes around $taskId
            $result = mysqli_query($conn, $sql);


            // Check if task is found
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<h2>" . $row['name'] . "</h2>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p><strong>Deadline:</strong> " . date("M j, Y", strtotime($row['deadline'])) . "</p>";
            } else {
                echo "<p>Task not found.</p>";
            }

            // Close database connection
            mysqli_close($conn);
        } else {
            echo "<p>No task selected.</p>";
        }
        ?>
    </div>

    <a href="homepage.php?page=dashboard">Back to Dashboard</a>
</body>

</html>