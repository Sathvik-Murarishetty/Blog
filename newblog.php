<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Blog Entry</title>

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

        .new-blog-form {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: 0 auto;
        }

        .new-blog-form label {
            display: block;
            margin-bottom: 10px;
        }

        .new-blog-form input,
        .new-blog-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .new-blog-form button {
            padding: 8px 15px;
            background-color: #6F7FB7;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
        }

        .new-blog-form button:hover {
            background-color: #4153AF;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <h1>New Blog Entry</h1>
    </header>

    <!-- Main Section -->
    <main>
        <div class="new-blog-form">
            <form action="processnewblog.php" method="post">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url">

                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="8" required></textarea>

                <label for="summary">Summary:</label>
                <textarea id="summary" name="summary" rows="4"></textarea>

                <button type="submit">Create Blog</button>
            </form>
        </div>
    </main>

</body>

</html>