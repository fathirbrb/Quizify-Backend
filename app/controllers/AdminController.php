<?php
// File: app/controllers/AdminController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/AdminModel.php';

// Pastikan SATPAM berfungsi: Hanya Admin yang boleh masuk!
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: AuthController.php");
    exit;
}

// Ambil data pendaftar yang masih pending dari Model
$pending_users = getPendingUsers($conn);

// Tampilkan ke layar (View)
require_once __DIR__ . '/../views/admin/dashboard.php';
?>