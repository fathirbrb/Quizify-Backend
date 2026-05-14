<?php
// File: app/controllers/KelolaKuisController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/QuizModel.php';

// Pastikan yang masuk adalah Dosen!
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header("Location: AuthController.php");
    exit;
}

$dosen_id = $_SESSION['user_id'];

// Cek apakah ada ID Matkul di URL (Jangan sampai dosen nyasar)
if (!isset($_GET['matkul_id'])) {
    header("Location: DosenController.php"); // Tendang balik ke dashboard kalau ga bawa ID
    exit;
}

$matkul_id = $_GET['matkul_id'];

// Ambil info detail matkul ini
$info_matkul = getMatkulById($conn, $matkul_id);

if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
    $pesan_sukses = "Ujian/Kuis berhasil ditambahkan ke kelas ini!";
}

// Jika Dosen menekan tombol "Buat Ujian/Kuis"
if (isset($_POST['submit_kuis'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    if (tambahKuis($conn, $matkul_id, $dosen_id, $judul, $deskripsi)) {
        // TENDANG (Redirect) kembali ke halaman ini agar POST-nya hilang!
        header("Location: KelolaKuisController.php?matkul_id=" . $matkul_id . "&status=sukses");
        exit;
    } else {
        $pesan_error = "Gagal menambahkan ujian.";
    }
}

// Ambil semua daftar kuis di matkul ini
$daftar_kuis = getKuisByMatkul($conn, $matkul_id);

// Panggil Layar (View)
require_once __DIR__ . '/../views/dosen/kelola_kuis.php';
?>