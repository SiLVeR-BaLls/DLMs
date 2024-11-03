<?php
session_start();
include 'display_cart.php';

$book_id = isset($_POST['book_id']) ? intval($_POST['book_id']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'add' && !in_array($book_id, $_SESSION['borrow_cart'])) {
    $_SESSION['borrow_cart'][] = $book_id;
} elseif ($action === 'remove') {
    $_SESSION['borrow_cart'] = array_diff($_SESSION['borrow_cart'], [$book_id]);
}

// Display updated cart
include 'display_cart.php';
