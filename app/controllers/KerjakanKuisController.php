<?php
// File: app/controllers/KerjakanKuisController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/SoalModel.php'; // Ambil fungsi getSoalByKuis & getKuisById
require_once __DIR__ . '/../models/NilaiModel.php'; // Ambil fungsi simpanNilai

// 1. Pastikan Mahasiswa yang masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: AuthController.php");
    exit;
}

$mahasiswa_id = $_SESSION['user_id'];

// 2. Cek apakah ada ID Kuis di URL
if (!isset($_GET['kuis_id'])) {
    header("Location: MahasiswaController.php");
    exit;
}

$kuis_id = $_GET['kuis_id'];

// 3. Ambil detail Kuis (untuk tahu ini matkul apa dan apa judulnya)
$info_kuis = getKuisById($conn, $kuis_id);
if (!$info_kuis) {
    header("Location: MahasiswaController.php");
    exit;
}

// 4. CEK KEAMANAN PENTING: Apakah mahasiswa ini sudah pernah ngerjain?
// Kalau sudah, langsung tendang balik ke halaman sebelumnya (Biar gak bisa ujian 2 kali!)
if (cekSudahMengerjakan($conn, $mahasiswa_id, $kuis_id)) {
    header("Location: DaftarKuisController.php?matkul_id=" . $info_kuis['matkul_id']);
    exit;
}

// 5. Ambil semua soal dari database
$daftar_soal = getSoalByKuis($conn, $kuis_id);

// --- LOGIKA PENILAIAN (KOREKSI OTOMATIS) ---
if (isset($_POST['submit_jawaban'])) {
    // Array jawaban dari form HTML (Isinya: [id_soal => 'A', id_soal2 => 'C', dst])
    $jawaban_mahasiswa = $_POST['jawaban'] ?? [];

    $jumlah_soal = count($daftar_soal);
    $jawaban_benar = 0;

    // Pastikan dosen sudah bikin soalnya, biar gak dibagi 0 (Error)
    if ($jumlah_soal > 0) {
        // Koreksi satu per satu
        foreach ($daftar_soal as $soal) {
            $id_soal = $soal['id'];
            $kunci_jawaban = $soal['jawaban_benar'];

            // Kalau mahasiswa menjawab soal ini dan jawabannya sama dengan kunci
            if (isset($jawaban_mahasiswa[$id_soal]) && $jawaban_mahasiswa[$id_soal] == $kunci_jawaban) {
                $jawaban_benar++;
            }
        }

        // Hitung Skor (Rumus: (Benar / Total Soal) * 100)
        $skor = round(($jawaban_benar / $jumlah_soal) * 100);
    } else {
        $skor = 0;
    }

    // Masukkan ke raport (Tabel Nilai)!
    simpanNilai($conn, $mahasiswa_id, $kuis_id, $skor);

    // Tendang balik ke Daftar Kuis (Pakai Jurus PRG)
    header("Location: DaftarKuisController.php?matkul_id=" . $info_kuis['matkul_id']);
    exit;
}

// Panggil Layar
require_once __DIR__ . '/../views/mahasiswa/kerjakan_kuis.php';
?>