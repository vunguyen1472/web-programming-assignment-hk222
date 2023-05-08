<!-- getproducts.php code -->
<?php
$q = $_GET["q"];

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "enterprise_management");

// Query products table
$sql = "SELECT * FROM task WHERE description LIKE '$q%'";
$result = mysqli_query($conn, $sql);

// Create a dropdown list of products
if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li><a href='http://localhost/assignment/index.php?page=taskdetails&id=" . $row['id'] . "'>" . $row['name'] . "</a></li>";
    }
    echo "</ul>";
} else {
    echo "No task found";
}

// Close database connection
mysqli_close($conn);
?>