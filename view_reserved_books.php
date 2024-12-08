<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php'; 
include 'header.php'; 

$username = $_SESSION['username'];
$message = ""; 

// Fetch reserved books
$query = "SELECT books.title, books.author, books.isbn, reserved_books.reservation_date 
          FROM reserved_books 
          JOIN books ON reserved_books.isbn = books.isbn 
          WHERE reserved_books.username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h2>Reserved Books</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Title</th><th>Author</th><th>Reservation Date</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['reservation_date'] . "</td>";
        echo "<td><a href='cancel_reservation.php?isbn=" . $row['isbn'] . "'>Cancel</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    $message = "No reserved books found.";
}
?>

<div class="message">
    <?php echo $message; ?>
</div>
<a href="search_books.php" class="back-link">Back to Search</a>

<?php include 'footer.php';  ?>