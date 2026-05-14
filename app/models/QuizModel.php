<?php
// File: app/models/QuizModel.php

// 1. Ambil info Mata Kuliah (buat ditampilin judulnya di atas halaman)
function getMatkulById($conn, $matkul_id)
{
    $query = "SELECT * FROM mata_kuliah WHERE id = '$matkul_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// 2. Tambah Kuis/Ujian Baru ke dalam Matkul tersebut
function tambahKuis($conn, $matkul_id, $dosen_id, $judul, $deskripsi)
{
    $query = "INSERT INTO kuis (matkul_id, dosen_id, judul, deskripsi) 
              VALUES ('$matkul_id', '$dosen_id', '$judul', '$deskripsi')";
    return mysqli_query($conn, $query);
}

// 3. Ambil daftar Kuis yang ada di dalam Matkul tersebut
function getKuisByMatkul($conn, $matkul_id)
{
    $query = "SELECT * FROM kuis WHERE matkul_id = '$matkul_id' ORDER BY waktu_dibuat DESC";
    $result = mysqli_query($conn, $query);

    $kuis = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kuis[] = $row;
    }
    return $kuis;
}
?>