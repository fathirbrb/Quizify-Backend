<?php
// File: app/controllers/RegisterController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

if (isset($_POST['submit_register'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Mahasiswa atau Dosen

    // Cek apakah username sudah ada
    if (cekUsernameAda($conn, $username)) {
        $pesan_error = "Username sudah digunakan, silakan pilih yang lain!";
    } else {
        // Simpan ke database
        if (registerUser($conn, $username, $password, $nama_lengkap, $role)) {
            $pesan_sukses = "Pendaftaran berhasil! Akun Anda berstatus PENDING. Silakan tunggu Admin menerima Anda sebelum bisa Login.";
        } else {
            $pesan_error = "Terjadi kesalahan sistem saat mendaftar.";
        }
    }
}

// Panggil View
require_once __DIR__ . '/../views/register_view.php';
?>