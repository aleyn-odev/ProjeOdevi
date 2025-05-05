<?php
require 'veritabani.php';
session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $required_fields = ['fName', 'lName', 'email', 'password'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            die("Hata: Lütfen tüm alanları doldurun!");
        }
    }

    
    $fName = trim($_POST['fName']);
    $lName = trim($_POST['lName']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : 'student';

   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Hata: Geçersiz email formatı!");
    }

    
    if (strlen($password) < 6) {
        die("Hata: Şifre en az 6 karakter olmalıdır!");
    }

    try {
        
        $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email->store_result();

        if ($check_email->num_rows > 0) {
            die("Hata: Bu email zaten kayıtlı!");
        }

        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       
        $stmt = $conn->prepare("INSERT INTO users (F_name, L_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fName, $lName, $email, $hashed_password, $role);

        if ($stmt->execute()) {
           
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $fName;
            
            header("Location: welcome.php");
            exit();
        } else {
            throw new Exception("Kayıt sırasında bir hata oluştu!");
        }
    } catch (mysqli_sql_exception $e) {
        
        die("Veritabanı hatası: " . $e->getMessage());
    } catch (Exception $e) {
        
        die("Hata: " . $e->getMessage());
    }
} else {
   
    header("Location: index.html");
    exit();
}
?>
