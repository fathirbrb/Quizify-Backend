<?php
// File: app/models/AdminModel.php

// Fungsi mengambil daftar user yang masih 'pending'
function getPendingUsers($conn)
{
    $query = "SELECT * FROM users WHERE status = 'pending' ORDER BY waktu_dibuat ASC";
    $result = mysqli_query($conn, $query);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

// Fungsi mengubah status user (misal: jadi 'aktif')
function updateUserStatus($conn, $id, $status)
{
    $query = "UPDATE users SET status = '$status' WHERE id = '$id'";
    return mysqli_query($conn, $query);
}

// Fungsi menghapus user (kalau ditolak)
function hapusUser($conn, $id)
{
    $query = "DELETE FROM users WHERE id = '$id'";
    return mysqli_query($conn, $query);
}
?>