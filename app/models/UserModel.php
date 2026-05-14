<?php
// File: app/models/UserModel.php

// 1. FUNGSI REGISTER AMAN (Password Hashing + Prepared Statement)
function registerUser($conn, $username, $password, $nama_lengkap, $role)
{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, password, nama_lengkap, role, status) VALUES (?, ?, ?, ?, 'pending')";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $hashed_password, $nama_lengkap, $role);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// 2. FUNGSI LOGIN AMAN (Password Verify + Prepared Statement)
function loginUser($conn, $username, $password_input)
{
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Cek kecocokan password input dengan hash di database
        if (password_verify($password_input, $row['password'])) {
            return $row; // Berhasil login
        }
    }
    return false; // Gagal login (username/password salah)
}
// Tambahkan fungsi ini di app/models/UserModel.php

// Fungsi untuk mengecek apakah username sudah terdaftar
function cekUsernameAda($conn, $username)
{
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    // "s" artinya 1 data string (username)
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Kalau datanya ketemu, berarti username sudah dipakai (return true)
    if (mysqli_fetch_assoc($result)) {
        return true;
    }
    // Kalau tidak ketemu, berarti aman (return false)
    return false;
}
?>