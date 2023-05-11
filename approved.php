<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">

</head>

<body>
    <!-- Add a blank task box at the bottom of the column -->
    <div class='task blank-box' draggable='true'>
        <h6 style="display: none;">Ready</h6>
        <div class='task__tags'><span class='task__tag'>+</span><button class='task__options'><i class='fas fa-ellipsis-h'></i></button></div>

        <div class='task__stats'>

            <span class='task__ready'></span>
        </div>
    </div>
    <?php
    // Connect to your database
    $conn = mysqli_connect("localhost", "root", "", "enterprise_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];
    // Retrieve data from 'task' table with status 'approved'
    $sql = "SELECT * FROM task WHERE status = 'ready' and staff_id = $user_id";
    $result = mysqli_query($conn, $sql);

    // function saveDescription($description)
    // {
    //     $_SESSION['description'] = $description;
    // }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='task' draggable='true' >";
        echo '<h6 style="display:none;">' . $row['status'] . '</h6>';
        echo "<div class='task__tags'><span class='task__tag task__tag--" . $row['name'] . "'>" . $row['name'] . "</span><button class='task__options'><i class='fas fa-ellipsis-h'></i></button></div>";
        echo "<a href='index.php?page=task_description' style='color: black; text-decoration: none;' onclick='saveDescription(" . json_encode($row['description']) . "," . $row['id'] . ")'>";
        echo "<p>" . $row['description'] . "</p></a>";

        echo "<div class='task__stats'>";
        echo "<span><time datetime='" . $row['deadline'] . "'><i class='fas fa-flag'></i>" . date("M j, Y", strtotime($row['deadline'])) . "</time></span>";
        echo "<span><i class='fas fa-comment'></i>" . $row['name'] . "</span>";
        echo "</div>";
        echo "<div class='task__stats'>";
        echo "<span><i class='fas fa-paperclip'></i>" . $row['name'] . "</span>";
        echo "<span class='task__ready'></span>";
        echo "</div>";
        echo "</div>";
    }


    // Close database connection
    mysqli_close($conn);
    ?>

    <script>
        // JavaScript code to enable draggable functionality for the blank box
        var blankBox = document.querySelector('.blank-box');
        blankBox.addEventListener('dragstart', function(event) {
            event.dataTransfer.setData('text/plain', 'Blank box data'); // Customize data as needed
        });
    </script>

</body>

</html>