<?php
// File: app/models/NilaiModel.php

// Cek apakah mahasiswa sudah pernah submit ujian ini
function cekSudahMengerjakan($conn, $mahasiswa_id, $kuis_id)
{
    $query = "SELECT * FROM nilai WHERE mahasiswa_id = '$mahasiswa_id' AND kuis_id = '$kuis_id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Kembalikan data nilainya
    }
    return false;
}

// Simpan nilai akhir setelah selesai ujian
function simpanNilai($conn, $mahasiswa_id, $kuis_id, $skor)
{
    $query = "INSERT INTO nilai (mahasiswa_id, kuis_id, skor) VALUES ('$mahasiswa_id', '$kuis_id', '$skor')";
    return mysqli_query($conn, $query);
}
?>