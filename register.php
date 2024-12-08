<?php
require 'db.php'; // Include database connection

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];

    
    if (strlen($mobile) != 10 || !is_numeric($mobile)) {
        $errors[] = "Mobile phone number must be numeric and 10 characters in length.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Password and confirmation password do not match.";
    }

    // Check if the username already exists
    $query = "SELECT id FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $errors[] = "Username already taken.";
    }

    // Check if the email already exists
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $errors[] = "Email already registered.";
    }

    if (empty($errors)) {
        
        $query = "INSERT INTO users (username, email, mobile, password, first_name, surname, address_line1, address_line2) VALUES ('$username', '$email', '$mobile', '$password', '$first_name', '$surname', '$address_line1', '$address_line2')";
        if ($conn->query($query) === TRUE) {
            echo "<div class='message'>Registration successful. You can now <a href='login.php'>login</a>.</div>";
        } else {
            echo "<div class='message error'>Error: " . $conn->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
            border-bottom: #77aaff 3px solid;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            margin: 20px 0;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
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
        .message.error {
            background: #fdd;
            color: #900;
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
        <h1>Library System - Registration</h1>
    </header>
    <div class="container">
        <div class="form-container">
            <h2>Register:</h2>
            <?php if (!empty($errors)): ?>
                <div class="message error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="register.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" name="mobile" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" required>
                
                <label for="address_line1">Address Line 1:</label>
                <input type="text" id="address_line1" name="address_line1" required>
                
                <label for="address_line2">Address Line 2:</label>
                <input type="text" id="address_line2" name="address_line2">
                
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>
