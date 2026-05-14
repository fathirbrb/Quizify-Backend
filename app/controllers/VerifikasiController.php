<?php
// File: app/controllers/VerifikasiController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/AdminModel.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: AuthController.php");
    exit;
}

// Cek apakah ada aksi dan ID yang dikirim lewat URL
if (isset($_GET['id']) && isset($_GET['aksi'])) {
    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi == 'terima') {
        updateUserStatus($conn, $id, 'aktif');
    } else if ($aksi == 'tolak') {
        hapusUser($conn, $id);
    }
}

// Setelah selesai diproses, kembalikan ke halaman Admin
header("Location: AdminController.php");
exit;
?>