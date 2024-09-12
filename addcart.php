<?php
session_start();
if (!isset($_SESSION['username'])) {
    die("Unauthorized access.");
}

// Database connection
$host = 'localhost';
$db = 'bookstore';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Add to cart logic (if applicable)
    // This example assumes adding to a session cart
    $_SESSION['cart'][$product_id] = $quantity;

    echo "Product added to cart!";
}

$conn->close();
?>
