<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Welcome - Blog Page</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            max-height: 50px;
        }

        .header-options {
            display: flex;
            gap: 10px;
        }

        .header-options form {
            display: flex;
        }

        .header-options input[type="text"] {
            padding: 5px;
            border: none;
            border-radius: 3px;
        }

        .header-options button {
            padding: 5px 10px;
            background-color: #6F7FB7;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
        }

        main {
            padding: 20px;
        }

        .main-image img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }

        .blog-entries {
            margin-top: 20px;
        }

        .blog-entry {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .pagination {
            display: flex;
            gap: 5px;
            margin-top: 20px;
        }

        .pagination a {
            padding: 5px 10px;
            background-color: #4153AF;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #6F7FB7;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <!-- Logo image on the top left -->
        <div class="logo">
            <img src="https://dreamambassadors.in/wp-content/uploads/2022/02/logo-with-caption.png" alt="Logo">
        </div>

        <!-- Search and Logout on the top right -->
        <div class="header-options">
            <a href="newblog.php" style="color: #fff; text-decoration: none;">Write a New Blog</a>
            <a href="login.php" style="color: #fff; text-decoration: none;">Logout</a>
        </div>
    </header>

    <!-- Main Section -->
    <main>

        <!-- Big image with width 100% -->
        <form action="" method="get">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
        <br>
        <div class="main-image">
            <img src="https://imgs.search.brave.com/guplbCh4sRqniVNiwdEtVBV3f6mWKOtiyyVFyi5z1ZU/rs:fit:500:0:0/g:ce/aHR0cHM6Ly93d3cu/cnlyb2IuY29tL3dw/LWNvbnRlbnQvdXBs/b2Fkcy8yMDE5LzA4/L1doYXQtaXMtdGhl/LURpZmZlcmVuY2Ut/QmV0d2Vlbi1hLUJs/b2ctYW5kLWEtV2Vi/c2l0ZS1CbG9nZ2lu/Zy1CZW5lZml0cy5q/cGc" alt="Main Image">
        </div>

        <!-- Blog Entries -->
        <div class="blog-entries">
            <!-- Fetch blogs from the database -->
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

            // Define $blogsPerPage
            $blogsPerPage = 5; // or whatever value you want

            // Determine the current page
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $blogsPerPage;

            // Fetch total number of blogs
            $countSql = "SELECT COUNT(*) as total FROM blogs";
            $countResult = $conn->query($countSql);
            $row = $countResult->fetch_assoc();
            $totalBlogs = $row['total'];

            // Fetch blogs from the database
            $sql = "SELECT * FROM blogs ORDER BY date_published DESC LIMIT " . $offset . ", " . $blogsPerPage;
            $result = $conn->query($sql);

            if (isset($_GET['search'])) {
                $search = $conn->real_escape_string($_GET['search']);

                // Fetch blogs from the database based on the search query
                $sql = "SELECT * FROM blogs WHERE title LIKE '%$search%' ORDER BY date_published DESC";
                $result = $conn->query($sql);

                if ($result === false) {
                    echo "Error executing query: " . $conn->error;
                } else {
                    echo '<h2>Search Results:</h2>';
                    while ($row = $result->fetch_assoc()) {
                        // Display each blog entry
                        echo '<div class="blog-entry">';
                        // Add an anchor tag to the heading with a link to blogdetail.php
                        echo '<h2><a href="blogdetail.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';

                        // Display the image if the image_url column is present
                        if (isset($row['image_url'])) {
                            echo '<img src="' . $row['image_url'] . '" alt="Blog Image">';
                        }

                        // Display the summary of the blog
                        echo '<p>' . $row['summary'] . '</p>';
                        echo '<p>Date Published: ' . $row['date_published'] . '</p>';
                        // Additional details or styling can be added
                        echo '</div>';
                    }
                }
            } else {
                while ($row = $result->fetch_assoc()) {
                    // Display each blog entry
                    echo '<div class="blog-entry">';
                    // Add an anchor tag to the heading with a link to blogdetail.php
                    echo '<h2><a href="blogdetail.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';

                    // Display the image if the image_url column is present
                    if (isset($row['image_url'])) {
                        echo '<img src="' . $row['image_url'] . '" alt="Blog Image">';
                    }

                    // Display the summary of the blog
                    echo '<p>' . $row['summary'] . '</p>';
                    echo '<p>Date Published: ' . $row['date_published'] . '</p>';
                    // Additional details or styling can be added
                    echo '</div>';
                }

                // Pagination links
                $totalPages = ceil($totalBlogs / $blogsPerPage);

                echo '<div class="pagination">';
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<a href="adminblog.php?page=' . $i . '">' . $i . '</a>';
                }
                echo '</div>';
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </main>

</body>

</html>