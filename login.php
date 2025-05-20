<?php
require 'veritabani.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
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
                header("Location: menu.php"); 
                exit();
            } else {
                header("Location: index2.php?error=invalidcredentials");
                exit();
            }
        } else {
            header("Location: index2.php?error=invalidcredentials");
            exit();
        }
    } catch (Exception $e) {
        header("Location: index2.php?error=dberror");
        exit();
    }
} else {
    header("Location: index.html");
    exit();
}
?>