<?php
header("Content-Type: application/json");
require_once '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($phone)) {
        echo json_encode(["status" => "error", "message" => "Name, Email, and Phone are required."]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO leads (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $message]);
        echo json_encode(["status" => "success", "message" => "Lead submitted successfully."]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Database error."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
