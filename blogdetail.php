<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detail</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4153AF;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        .blog-detail {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }

        .blog-detail img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .button-container button {
            padding: 8px 15px;
            background-color: #6F7FB7;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #4153AF;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <h1>Blog Detail Page</h1>
    </header>

    <!-- Main Section -->
    <main>
        <div class="blog-detail">
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

            // Check if the blog ID is provided in the URL
            if (isset($_GET['id'])) {
                $blogId = $_GET['id'];

                // Fetch blog details from the database based on the provided ID
                $sql = "SELECT * FROM blogs WHERE id = $blogId";
                $result = $conn->query($sql);

                if ($result === false) {
                    echo "Error executing query: " . $conn->error;
                } else {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        // Display detailed information about the blog
                        echo '<h2>' . $row['title'] . '</h2>';
                        echo '<p>Date Published: ' . $row['date_published'] . '</p>';
                        echo '<img src="' . $row['image_url'] . '" alt="Blog Image">';
                        echo '<p>' . $row['content'] . '</p>';

                        // Add edit and delete buttons
                        echo '<div class="button-container">';
                        echo '<a href="editblog.php?id=' . $row['id'] . '"><button>Edit</button></a>';
                        echo '<button onclick="deleteBlog(' . $row['id'] . ')">Delete</button>';
                        echo '</div>';

                        // Additional details or styling can be added
                    } else {
                        echo "Blog not found.";
                    }
                }
            } else {
                echo "Blog ID not provided in the URL.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>

        <!-- Back Button -->
        <div style="margin-top: 20px;">
            <a href="adminblog.php"><button>Back</button></a>
        </div>

        <!-- JavaScript function for deleting a blog -->
        <script>
            function deleteBlog(blogId) {
                var confirmDelete = confirm("Are you sure you want to delete this blog?");
                if (confirmDelete) {
                    // Use AJAX to send an asynchronous request to deleteblog.php
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "deleteblog.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // Handle the response if needed
                            console.log(xhr.responseText);
                            // Reload the page or perform other actions as necessary
                            window.location.reload();
                        }
                    };
                    // Send the request with the blog ID
                    xhr.send("id=" + blogId);
                }
            }
        </script>
    </main>

</body>

</html>