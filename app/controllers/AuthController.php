<?php
// File: app/controllers/AuthController.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

if (isset($_POST['submit_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Minta tolong Model mengecek ke database
    $user = loginUser($conn, $username, $password);

    if ($user) {
        // --- LOGIKA BARU: CEK STATUS VERIFIKASI ---
        if ($user['status'] == 'pending') {
            $pesan_error = "Mohon bersabar. Akun Anda masih berstatus PENDING dan sedang menunggu persetujuan Admin.";
        } else {
            // JIKA STATUSNYA 'aktif', Izinkan Masuk!
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

            // Gunakan Relative Path (Langsung panggil nama filenya)
            if ($user['role'] == 'admin') {
                header("Location: AdminController.php");
                exit;
            } else if ($user['role'] == 'dosen') {
                header("Location: DosenController.php");
                exit;
            } else if ($user['role'] == 'mahasiswa') {
                header("Location: MahasiswaController.php");
                exit;
            }
        }
    } else {
        $pesan_error = "Maaf, Username atau Password kamu salah!";
    }
}

// Panggil View (Halaman UI Login)
require_once __DIR__ . '/../views/login_view.php';
?>