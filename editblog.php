<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>

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

        .edit-form {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: 0 auto;
        }

        .edit-form label {
            display: block;
            margin-bottom: 10px;
        }

        .edit-form input,
        .edit-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .edit-form button {
            padding: 8px 15px;
            background-color: #6F7FB7;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
        }

        .edit-form button:hover {
            background-color: #4153AF;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <h1>Edit Blog</h1>
    </header>

    <!-- Main Section -->
    <main>
        <div class="edit-form">
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

                        // Display an edit form with current blog details
                        echo '<form action="updateblog.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                        echo '<label for="title">Title:</label>';
                        echo '<input type="text" id="title" name="title" value="' . $row['title'] . '" required>';
                        echo '<label for="image_url">Image URL:</label>';
                        echo '<input type="text" id="image_url" name="image_url" value="' . $row['image_url'] . '">';
                        echo '<label for="content">Content:</label>';
                        echo '<textarea id="content" name="content" rows="8" required>' . $row['content'] . '</textarea>';
                        echo '<label for="summary">Summary:</label>';
                        echo '<textarea id="summary" name="summary" rows="4">' . $row['summary'] . '</textarea>';
                        echo '<button type="submit">Update Blog</button>';
                        echo '</form>';

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
    </main>

</body>

</html>