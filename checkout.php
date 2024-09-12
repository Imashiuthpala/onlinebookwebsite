<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];

$pdo->beginTransaction();

$stmt = $pdo->prepare('INSERT INTO orders (user_id) VALUES (?)');
$stmt->execute([$user_id]);
$order_id = $pdo->lastInsertId();

foreach ($cart as $item) {
    $stmt = $pdo->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
    $stmt->execute([$order_id, $item['id'], $item['quantity'], $item['price']]);
}

$pdo->commit();

unset($_SESSION['cart']);

header('Location: order_confirmation.php');
exit();
?>
