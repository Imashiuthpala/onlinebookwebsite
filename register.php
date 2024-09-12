<?php
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['password']) && isset($data['email'])) {
    $username = htmlspecialchars($data['username']);
    $password = password_hash(htmlspecialchars($data['password']), PASSWORD_DEFAULT);
    $email = htmlspecialchars($data['email']);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $email]);
        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Username or email already exists.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
}
?>
