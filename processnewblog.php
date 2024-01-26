<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "blog";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $title = htmlspecialchars($_POST['title']);
    $image_url = htmlspecialchars($_POST['image_url']);
    $content = htmlspecialchars($_POST['content']);
    $summary = htmlspecialchars($_POST['summary']);

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO blogs (title, image_url, content, summary) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $title, $image_url, $content, $summary);

        if ($stmt->execute()) {
            $newBlogId = $stmt->insert_id;
            $stmt->close();

            header("Location: blogdetail.php?id=" . $newBlogId);
            exit();
        } else {
            echo "Error creating new blog: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
