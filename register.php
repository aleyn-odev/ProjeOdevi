<?php
require 'veritabani.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    if (isset($_POST['signUp'])) {
        $required_fields = ['fName', 'lName', 'email', 'password'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                header("Location: index2.php?error=emptyfields");
                exit();
            }
        }

        $fName = trim($_POST['fName']);
        $lName = trim($_POST['lName']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $role = isset($_POST['role']) ? $_POST['role'] : 'student';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: index2.php?error=invalidemail");
            exit();
        }

        if (strlen($password) < 6) {
            header("Location: index2.php?error=shortpassword");
            exit();
        }

        try {
            $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $check_email->bind_param("s", $email);
            $check_email->execute();
            $check_email->store_result();

            if ($check_email->num_rows > 0) {
                header("Location: index2.php?error=emailtaken");
                exit();
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
                header("Location: index2.php?error=dberror");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            header("Location: index2.php?error=dberror");
            exit();
        } catch (Exception $e) {
            header("Location: index2.php?error=unknown");
            exit();
        }
    }

    
    if (isset($_POST['signIn'])) {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: index2.php?error=invalidemail");
            exit();
        }

        try {
            $stmt = $conn->prepare("SELECT id, F_name, password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($user_id, $user_name, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $user_name;

                    header("Location: welcome.php");
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
    }

} else {
    header("Location: index.html");
    exit();
}
?>