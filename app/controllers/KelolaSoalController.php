<?php
// File: app/controllers/KelolaSoalController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/SoalModel.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header("Location: AuthController.php");
    exit;
}

if (!isset($_GET['kuis_id'])) {
    header("Location: DosenController.php");
    exit;
}

$kuis_id = $_GET['kuis_id'];
$info_kuis = getKuisById($conn, $kuis_id);

// --- OBAT ANTI DUPLIKAT ---
if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
    $pesan_sukses = "Soal berhasil ditambahkan!";
}

if (isset($_POST['submit_soal'])) {
    $pertanyaan = $_POST['pertanyaan'];
    $opsi_a = $_POST['opsi_a'];
    $opsi_b = $_POST['opsi_b'];
    $opsi_c = $_POST['opsi_c'];
    $opsi_d = $_POST['opsi_d'];
    $jawaban_benar = $_POST['jawaban_benar'];

    if (tambahSoal($conn, $kuis_id, $pertanyaan, $opsi_a, $opsi_b, $opsi_c, $opsi_d, $jawaban_benar)) {
        // Redirect PRG
        header("Location: KelolaSoalController.php?kuis_id=" . $kuis_id . "&status=sukses");
        exit;
    } else {
        $pesan_error = "Gagal menambahkan soal.";
    }
}

// Ambil daftar soal
$daftar_soal = getSoalByKuis($conn, $kuis_id);

// Panggil Layar (View)
require_once __DIR__ . '/../views/dosen/kelola_soal.php';
?>
<?php
// File: app/controllers/KelolaSoalController.php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/SoalModel.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header("Location: AuthController.php");
    exit;
}

if (!isset($_GET['kuis_id'])) {
    header("Location: DosenController.php");
    exit;
}

$kuis_id = $_GET['kuis_id'];
$info_kuis = getKuisById($conn, $kuis_id);

// --- OBAT ANTI DUPLIKAT ---
if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
    $pesan_sukses = "Soal berhasil ditambahkan!";
}

if (isset($_POST['submit_soal'])) {
    $pertanyaan = $_POST['pertanyaan'];
    $opsi_a = $_POST['opsi_a'];
    $opsi_b = $_POST['opsi_b'];
    $opsi_c = $_POST['opsi_c'];
    $opsi_d = $_POST['opsi_d'];
    $jawaban_benar = $_POST['jawaban_benar'];

    if (tambahSoal($conn, $kuis_id, $pertanyaan, $opsi_a, $opsi_b, $opsi_c, $opsi_d, $jawaban_benar)) {
        // Redirect PRG
        header("Location: KelolaSoalController.php?kuis_id=" . $kuis_id . "&status=sukses");
        exit;
    } else {
        $pesan_error = "Gagal menambahkan soal.";
    }
}

// Ambil daftar soal
$daftar_soal = getSoalByKuis($conn, $kuis_id);

// Panggil Layar (View)
require_once __DIR__ . '/../views/dosen/kelola_soal.php';
?>