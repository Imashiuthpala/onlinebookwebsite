<?php
include 'db.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['user_id']) && isset($data['total'])) {
            $user_id = htmlspecialchars($data['user_id']);
            $total = htmlspecialchars($data['total']);

            try {
                $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
                $stmt->execute([$user_id, $total]);
                $order_id = $pdo->lastInsertId();
                echo json_encode(['status' => 'success', 'order_id' => $order_id]);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create order.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
        }
        break;

    case 'get':
        // Logic for fetching order details
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
}
?>
