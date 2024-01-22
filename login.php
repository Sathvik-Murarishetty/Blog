<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "blog";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        $sql = "SELECT * FROM admininfo WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("Location: adminblog.php");
            exit;
        } else {
            echo "<script>alert('Invalid credentials. Please try again.');</script>";
        }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sparkle Spins Laundry Service</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(45deg, #4153AF, #F9E9EC);
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #4153AF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        input[type="submit"]:hover {
            background-color: #6F7FB7;
        }
    </style>
</head>

<body>

    <h1>BLOG LOGIN</h1>

    <div class="container">
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" value="Login">
        </form>
    </div>

</body>

</html>