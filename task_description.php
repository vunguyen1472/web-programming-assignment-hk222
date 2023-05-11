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
        if (isset($_SESSION['taskID'])) {
            // Connect to your database
            $conn = mysqli_connect("localhost", "root", "", "enterprise_management");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve task data based on the task id

            $taskId = $_SESSION['taskID'];
            // echo "console.log('$taskId')";
            $sql = "SELECT * FROM task WHERE id = $taskId"; // Add quotes around $taskId
            $result = mysqli_query($conn, $sql);


            // Check if task is found
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<h2>" . $row['description'] . "</h2>";
                echo "<div class='border-bottom pt-2 pb-4 d-flex'>";
                echo "<div class='me-5'>";
                echo "<i class='fa-regular fa-clock me-2'></i>";
                echo "<span>" . date("d M, Y", strtotime($row['deadline'])) . "</span>";
                echo "</div>";
                echo "<div class='me-5'>";
                echo "<i class='fa-regular fa-user me-2'></i>";
                echo "</div>";
                echo "<div class='me-5'>";
                echo "<i class='fa-regular fa-hourglass me-2'></i>";
                echo "<span class='fw-bold text-primary'>" . $row['status'] . "</span>";
                echo "</div>";
                echo "</div>";

                echo "<p>" . $row['name'] . "</p>";
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
    <p class="border-bottom py-4 mb-0">
        Description: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ut doloremque amet voluptates reiciendis facere, magni, commodi numquam atque pariatur ab rerum nulla qui repellat perferendis cupiditate alias repellendus voluptatem?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis asperiores suscipit explicabo itaque perferendis magni nisi nemo. Labore aperiam, enim delectus doloremque, eius et iure nam ex perspiciatis incidunt totam!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, quas quasi vero dicta quidem quisquam libero qui ipsam aut facere tenetur illum veritatis perspiciatis? Sed aliquam molestiae temporibus ab quasi.
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem reprehenderit quaerat sunt rem, fugit adipisci et veritatis saepe impedit tenetur totam. Quod illum autem quas delectus reiciendis consectetur eligendi deserunt.
    </p>
    </ul>
    <?php include("submission.php"); ?>
    <div class="py-4" style="min-height: 10rem">
        <h5>Comments</h5>
        <?php include("comment_index.php"); ?>
    </div>
    <a href="homepage.php?page=dashboard">Back to Dashboard</a>
</body>

</html>