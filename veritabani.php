<?php
$servername = "localhost";
$username = "root"; // XAMPP için genellikle 'root'
$password = "";     // XAMPP varsayılan şifresi boştur
$database = "tixgo_db"; // senin oluşturduğun veritabanı adı

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>