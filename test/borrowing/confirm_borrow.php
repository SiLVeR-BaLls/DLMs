<?php
session_start();
include 'db_connect.php';
include 'navbar.php';

echo "<h2>Your Borrowing Cart</h2>";

if (isset($_SESSION['borrow_cart']) && !empty($_SESSION['borrow_cart'])) {
    $cart_items = implode(",", $_SESSION['borrow_cart']);
    
    // Fetch book details for each book in the cart
    $result = $conn->query("SELECT id, title, author FROM books WHERE id IN ($cart_items)");
    
    echo "<table border='1'><tr><th>Title</th><th>Author</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['title']}</td><td>{$row['author']}</td></tr>";
    }
    echo "</table>";

    echo "<br><form action='complete_borrow.php' method='POST'>
            <label for='user_id'>Enter User ID:</label>
            <input type='number' name='user_id' required>
            <input type='submit' value='Confirm Borrowing'>
          </form>";
} else {
    echo "Your cart is empty.";
}

echo "<br><a href='borrow_book.php'>Back to Book List</a>";
$conn->close();
?>
