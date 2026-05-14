<?php
// File: app/controllers/DosenController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/MatkulModel.php';

// Pastikan hanya Dosen yang bisa masuk!
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header("Location: AuthController.php");
    exit;
}

$dosen_id = $_SESSION['user_id'];

// Jika dosen menekan tombol "Buat Mata Kuliah"
if (isset($_POST['submit_matkul'])) {
    $kode_mk = strtoupper($_POST['kode_mk']); // Jadikan huruf besar semua otomatis
    $nama_mk = $_POST['nama_mk'];

    // Cek apakah kode MK sudah dipakai dosen lain
    if (cekKodeMkAda($conn, $kode_mk)) {
        $pesan_error = "Kode Mata Kuliah '$kode_mk' sudah dipakai. Silakan gunakan kode lain (misal: WEB-101).";
    } else {
        // Simpan matkul baru
        if (tambahMatkul($conn, $kode_mk, $nama_mk, $dosen_id)) {
            $pesan_sukses = "Mata Kuliah berhasil dibuat!";
        } else {
            $pesan_error = "Gagal membuat Mata Kuliah.";
        }
    }
}

// Ambil daftar mata kuliah milik dosen ini untuk ditampilkan di tabel
$daftar_matkul = getMatkulByDosen($conn, $dosen_id);

// Panggil View
require_once __DIR__ . '/../views/dosen/dashboard.php';
?>