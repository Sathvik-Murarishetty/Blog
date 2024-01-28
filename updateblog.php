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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blogId = $_POST['id'];
    $title = $_POST['title'];
    $image_url = $_POST['image_url'];
    $content = $_POST['content'];
    $summary = $_POST['summary'];

    // Validate input if necessary

    $sql = "UPDATE blogs SET title='$title', image_url='$image_url', content='$content', summary='$summary' WHERE id=$blogId";

    if ($conn->query($sql) === TRUE) {
        // Successful update
        header("Location: blogdetail.php?id=$blogId"); // Redirect to the updated blog detail page
        exit();
    } else {
        echo "Error updating blog: " . $conn->error;
    }
}

$conn->close();
