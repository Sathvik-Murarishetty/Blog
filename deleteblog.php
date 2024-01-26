<?php
// Include your database connection code here
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "blog";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the blog ID is provided
if (isset($_POST['id'])) {
    $blogId = $_POST['id'];

    // Delete the blog from the database
    $sql = "DELETE FROM blogs WHERE id = $blogId";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error executing query: " . $conn->error;
    } else {
        echo "Blog deleted successfully.";
    }
} else {
    echo "Blog ID not provided.";
}

// Close the database connection
$conn->close();
