<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php'; 
include 'header.php'; 

// Fetch categories for the dropdown menu
$categories_query = "SELECT category_code, category_name FROM categories";
$categories_result = $conn->query($categories_query);
?>

<h2>Search Books</h2>
<form method="get" action="search_books.php">
    <label for="title">Book Title:</label><br>
    <input type="text" id="title" name="title"><br><br>
    
    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author"><br><br>
    
    <label for="category">Category:</label><br>
    <select id="category" name="category">
        <option value="">Select Category</option>
        <?php while ($row = $categories_result->fetch_assoc()): ?>
            <option value="<?php echo $row['category_code']; ?>"><?php echo $row['category_name']; ?></option>
        <?php endwhile; ?>
    </select><br><br>
    
    <input type="submit" value="Search">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';
    $category = $_GET['category'] ?? '';

    // Build the search query
    $query = "SELECT books.*, categories.category_name FROM books 
              JOIN categories ON books.category_code = categories.category_code 
              WHERE 1=1";
    if (!empty($title)) {
        $query .= " AND books.title LIKE '%$title%'";
    }
    if (!empty($author)) {
        $query .= " AND books.author LIKE '%$author%'";
    }
    if (!empty($category)) {
        $query .= " AND books.category_code = '$category'";
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Search Results</h2>";
        echo "<table border='0'>";
        echo "<tr><th>Title</th><th>Author</th><th>Category</th><th>Available</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['author'] . "</td>";
            echo "<td>" . $row['category_name'] . "</td>";
            echo "<td>" . ($row['available'] ? 'Yes' : 'No') . "</td>";
            echo "<td>";
            if ($row['available']) {
                echo "<a href='reserve_book.php?isbn=" . $row['isbn'] . "'>Reserve</a>";
            } else {
                echo "Not Available";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No books found.</p>";
    }
}
?>

<?php include 'footer.php';  ?>