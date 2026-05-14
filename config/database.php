<?php
// File: config/database.php
$host = "localhost";
$user = "root";
$pass = ""; // Kosongkan jika pakai XAMPP Mac bawaan
$db = "quizify_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>