<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php'; 
include 'header.php'; 
$message = ""; 

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $username = $_SESSION['username'];

    // Check if the book is already reserved
    $check_query = "SELECT * FROM reserved_books WHERE isbn = '$isbn'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $message = "This book is already reserved.";
    } else {
        // Reserve the book
        $reserve_query = "INSERT INTO reserved_books (username, isbn) VALUES ('$username', '$isbn')";
        if ($conn->query($reserve_query) === TRUE) {
            // Update book availability
            $update_query = "UPDATE books SET available = 0 WHERE isbn = '$isbn'";
            $conn->query($update_query);
            $message = "Book reserved successfully.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
} else {
    $message = "Invalid request.";
}
?>

<div class="message">
    <?php echo $message; ?>
</div>
<a href="search_books.php" class="back-link">Back to Search</a>

<?php include 'footer.php'; ?>