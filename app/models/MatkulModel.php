<?php
// File: app/models/MatkulModel.php

// Cek apakah Kode MK sudah dipakai (karena kode harus unik)
function cekKodeMkAda($conn, $kode_mk)
{
    $query = "SELECT * FROM mata_kuliah WHERE kode_mk = '$kode_mk'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// Simpan Mata Kuliah baru ke database
function tambahMatkul($conn, $kode_mk, $nama_mk, $dosen_id)
{
    $query = "INSERT INTO mata_kuliah (kode_mk, nama_mk, dosen_id) VALUES ('$kode_mk', '$nama_mk', '$dosen_id')";
    return mysqli_query($conn, $query);
}

// Ambil semua Mata Kuliah milik Dosen yang sedang login
function getMatkulByDosen($conn, $dosen_id)
{
    $query = "SELECT * FROM mata_kuliah WHERE dosen_id = '$dosen_id' ORDER BY waktu_dibuat DESC";
    $result = mysqli_query($conn, $query);

    $matkul = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $matkul[] = $row;
    }
    return $matkul;
}
?>