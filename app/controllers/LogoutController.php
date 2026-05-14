<?php
// File: app/controllers/LogoutController.php

// 1. Panggil session-nya dulu
session_start();

// 2. Kosongkan semua data (nama, role, id)
session_unset();

// 3. Hancurkan session-nya berkeping-keping!
session_destroy();

// 4. Tendang kembali ke halaman Login!
header("Location: AuthController.php");
exit;
?>