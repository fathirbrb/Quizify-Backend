<?php
// File: app/models/KrsModel.php

// 1. Cari Matkul berdasarkan Kode unik
function cariMatkulByKode($conn, $kode_mk)
{
    $query = "SELECT * FROM mata_kuliah WHERE kode_mk = '$kode_mk'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// 2. Cek apakah mahasiswa sudah gabung di kelas ini (Biar nggak dobel)
function cekSudahGabung($conn, $mahasiswa_id, $matkul_id)
{
    $query = "SELECT * FROM krs WHERE mahasiswa_id = '$mahasiswa_id' AND matkul_id = '$matkul_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// 3. Masukkan mahasiswa ke kelas (KRS)
function gabungKelas($conn, $mahasiswa_id, $matkul_id)
{
    $query = "INSERT INTO krs (mahasiswa_id, matkul_id) VALUES ('$mahasiswa_id', '$matkul_id')";
    return mysqli_query($conn, $query);
}

// 4. Ambil daftar kelas yang diikuti mahasiswa (JOIN 3 Tabel sekaligus!)
function getKelasMahasiswa($conn, $mahasiswa_id)
{
    $query = "SELECT mata_kuliah.*, users.nama_lengkap AS nama_dosen 
              FROM krs 
              JOIN mata_kuliah ON krs.matkul_id = mata_kuliah.id
              JOIN users ON mata_kuliah.dosen_id = users.id
              WHERE krs.mahasiswa_id = '$mahasiswa_id' 
              ORDER BY krs.waktu_daftar DESC";
    $result = mysqli_query($conn, $query);

    $kelas = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kelas[] = $row;
    }
    return $kelas;
}
?>