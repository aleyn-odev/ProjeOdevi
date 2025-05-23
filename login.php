<?php
require 'veritabani.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT id, F_name, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['F_name'];
            header("Location: welcome.php"); 
            exit();
        } else {
            echo "Hatalı şifre!";
        }
    } else {
        echo "Kullanıcı bulunamadı!";
    }
}
?>
