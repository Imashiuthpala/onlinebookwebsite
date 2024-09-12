<?php
include 'db.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['question']) && isset($data['answer'])) {
            $question = htmlspecialchars($data['question']);
            $answer = htmlspecialchars($data['answer']);

            try {
                $stmt = $pdo->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");
                $stmt->execute([$question, $answer]);
                echo json_encode(['status' => 'success']);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add FAQ.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
        }
        break;

    case 'update':
        // Similar logic for updating FAQ details
        break;

    case 'delete':
        // Logic for deleting an FAQ
        break;

    case 'get':
        // Logic for fetching FAQ details
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
}
?>
