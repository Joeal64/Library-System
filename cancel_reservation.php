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

    // Cancel the reservation
    $delete_query = "DELETE FROM reserved_books WHERE username = '$username' AND isbn = '$isbn'";
    if ($conn->query($delete_query) === TRUE) {
        // Update book availability
        $update_query = "UPDATE books SET available = 1 WHERE isbn = '$isbn'";
        $conn->query($update_query);
        $message = "Reservation canceled successfully.";
    } else {
        $message = "Error: " . $conn->error;
    }
} else {
    $message = "Invalid request.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancel Reservation</title>
</head>
<body>
    <div class="message">
        <?php echo $message; ?>
    </div>
    <a href="view_reserved_books.php">Back to Reserved Books</a>
</body>
</html>

<?php include 'footer.php'; ?>