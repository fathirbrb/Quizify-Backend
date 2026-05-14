<!-- File: app/views/register_view.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar - Quizify</title>
    <link rel="stylesheet" href="/quizify/public/css/style.css">
    <style>
        select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .link-login {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #2196F3;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Daftar Akun Baru</h2>

        <?php if (isset($pesan_error)): ?>
            <div class="error-msg">
                <?php echo $pesan_error; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($pesan_sukses)): ?>
            <div class="success-msg">
                <?php echo $pesan_sukses; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <select name="role" required>
                <option value="">-- Pilih Peran --</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
            </select>

            <button type="submit" name="submit_register">Daftar Sekarang</button>
        </form>

        <a href="AuthController.php" class="link-login">Sudah punya akun? Masuk di sini</a>
    </div>
</body>

</html>