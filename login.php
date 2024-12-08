<?php
session_start();
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $username;
        header("Location: search_books.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
            border-bottom: #77aaff 3px solid;
        }
        header h1 {
            text-align: center;
        }
        form {
            margin: 50px 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .message {
            background: #e4e4e4;
            color: #333;
            padding: 10px;
            margin: 20px 0;
            border: #ccc 1px solid;
        }
        a {
            color: #77aaff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Library System</h1>
    </header>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error_message)): ?>
            <div class="message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>
