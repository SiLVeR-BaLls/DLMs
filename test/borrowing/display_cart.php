<?php
include 'db_connect.php';

if (!empty($_SESSION['borrow_cart'])) {
    $cart_items = implode(",", array_map("intval", $_SESSION['borrow_cart']));
    $query = "SELECT id, title, author FROM books WHERE id IN ($cart_items)";
    $result = $conn->query($query);

    echo "<table border='1'>
            <tr><th>Title</th><th>Author</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>
                    <button onclick='removeFromCart({$row['id']})'>Remove</button>
                </td>
              </tr>";
    }
    echo "</table>";
    
    echo "<br><form action='confirm_borrow.php' method='POST'>
            <label for='user_id'>Enter User ID:</label>
            <input type='number' name='user_id' required>
            <input type='submit' value='Confirm Borrowing'>
          </form>";
} else {
    echo "Your cart is empty.";
}
