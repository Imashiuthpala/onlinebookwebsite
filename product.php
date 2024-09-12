<?php
include 'db.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['name']) && isset($data['price']) && isset($data['stock'])) {
            $name = htmlspecialchars($data['name']);
            $description = htmlspecialchars($data['description'] ?? '');
            $price = htmlspecialchars($data['price']);
            $stock = htmlspecialchars($data['stock']);
            $image = htmlspecialchars($data['image'] ?? '');

            try {
                $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$name, $description, $price, $stock, $image]);
                echo json_encode(['status' => 'success']);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add product.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
        }
        break;

    case 'update':
        // Similar logic for updating product details
        break;

    case 'delete':
        // Logic for deleting a product
        break;

    case 'get':
        // Logic for fetching product details
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
}
?>
