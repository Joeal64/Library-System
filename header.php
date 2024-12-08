<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>
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
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }
        .message {
            background: #e4e4e4;
            color: #333;
            padding: 10px;
            margin: 20px 0;
            border: #ccc 1px solid;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-link:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Library System</h1>
        <nav>
            <ul>
                <li><a href="search_books.php">Search Books</a></li>
                <li><a href="view_reserved_books.php">View Reserved Books</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <hr>