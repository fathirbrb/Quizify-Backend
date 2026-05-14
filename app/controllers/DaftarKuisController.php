<?php
// File: app/controllers/DaftarKuisController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/QuizModel.php';
require_once __DIR__ . '/../models/NilaiModel.php';

// Pastikan yang masuk adalah Mahasiswa!
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: AuthController.php");
    exit;
}

$mahasiswa_id = $_SESSION['user_id'];

// Cek apakah ID Matkul dikirim lewat URL
if (!isset($_GET['matkul_id'])) {
    header("Location: MahasiswaController.php");
    exit;
}

$matkul_id = $_GET['matkul_id'];

// Ambil info nama matkul untuk judul halaman
$info_matkul = getMatkulById($conn, $matkul_id);

// Ambil daftar ujian yang ada di matkul ini
$daftar_kuis = getKuisByMatkul($conn, $matkul_id);

// Panggil Layar (View)
require_once __DIR__ . '/../views/mahasiswa/daftar_kuis.php';
?>