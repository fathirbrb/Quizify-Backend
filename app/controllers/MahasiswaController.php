<?php
// File: app/controllers/MahasiswaController.php
session_start();

header("Cache-Control: no-cache, must-revalidate"); // Jangan simpan cache
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Anggap halaman ini sudah kedaluwarsa sejak tahun 1997!

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/KrsModel.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: AuthController.php");
    exit;
}

$mahasiswa_id = $_SESSION['user_id'];

// Jika mahasiswa menekan tombol "Gabung Kelas"
if (isset($_POST['submit_enroll'])) {
    $kode_mk = strtoupper($_POST['kode_mk']);

    // 1. Cari matkulnya ada atau tidak di database
    $matkul = cariMatkulByKode($conn, $kode_mk);

    if ($matkul) {
        // 2. Cek apakah sudah pernah gabung sebelumnya
        if (cekSudahGabung($conn, $mahasiswa_id, $matkul['id'])) {
            $pesan_error = "Kamu sudah tergabung di kelas ini!";
        } else {
            // 3. Gabungkan!
            if (gabungKelas($conn, $mahasiswa_id, $matkul['id'])) {
                $pesan_sukses = "Berhasil bergabung ke kelas " . $matkul['nama_mk'] . "!";
            } else {
                $pesan_error = "Gagal bergabung ke kelas.";
            }
        }
    } else {
        $pesan_error = "Kode Kelas tidak ditemukan! Pastikan ngetiknya bener ya.";
    }
}

// Ambil daftar kelas yang sudah diikuti untuk ditampilkan di tabel
$daftar_kelas = getKelasMahasiswa($conn, $mahasiswa_id);

require_once __DIR__ . '/../views/mahasiswa/dashboard.php';
?>