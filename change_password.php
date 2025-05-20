<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode("Giriş yapmanız gerekiyor.");
    exit();
}


$data = json_decode(file_get_contents("php://input"), true);


if (!isset($data['newPassword']) || strlen($data['newPassword']) < 8) {
    http_response_code(400);
    echo json_encode("Geçerli bir şifre girin.");
    exit();
}

$newPassword = $data['newPassword'];
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

require_once("veritabani.php");

$userId = $_SESSION['user_id'];


$stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bind_param("si", $hashedPassword, $userId);

if ($stmt->execute()) {
    echo json_encode("Şifre başarıyla güncellendi.");
} else {
    http_response_code(500);
    echo json_encode("Şifre güncellenemedi.");
}

$stmt->close();
$conn->close();
