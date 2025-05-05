<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); 
    exit();
}
?>
<h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
