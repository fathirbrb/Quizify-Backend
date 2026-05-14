<?php
// File: app/models/SoalModel.php

// Ambil info kuis (untuk nampilin judul ujian dan id matkul buat tombol kembali)
function getKuisById($conn, $kuis_id)
{
    $query = "SELECT * FROM kuis WHERE id = '$kuis_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Simpan soal baru ke database
function tambahSoal($conn, $kuis_id, $pertanyaan, $a, $b, $c, $d, $jawaban_benar)
{
    // Kita escape string-nya biar kalau dosen ngetik tanda kutip ('), aplikasinya nggak error
    $pertanyaan = mysqli_real_escape_string($conn, $pertanyaan);
    $a = mysqli_real_escape_string($conn, $a);
    $b = mysqli_real_escape_string($conn, $b);
    $c = mysqli_real_escape_string($conn, $c);
    $d = mysqli_real_escape_string($conn, $d);

    $query = "INSERT INTO soal (kuis_id, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar) 
              VALUES ('$kuis_id', '$pertanyaan', '$a', '$b', '$c', '$d', '$jawaban_benar')";
    return mysqli_query($conn, $query);
}

// Ambil semua soal di kuis ini
function getSoalByKuis($conn, $kuis_id)
{
    $query = "SELECT * FROM soal WHERE kuis_id = '$kuis_id'";
    $result = mysqli_query($conn, $query);

    $soal = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $soal[] = $row;
    }
    return $soal;
}
?>