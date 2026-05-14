<!-- File: app/views/login_view.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Quizify</title>
    <!-- Memanggil External CSS dari folder public -->
    <link rel="stylesheet" href="/quizify/public/css/style.css">
</head>

<body>
    <div class="login-box">
        <h2>Masuk ke Quizify</h2>

        <?php if (isset($pesan_error)): ?>
            <div class="error-msg">
                <?php echo $pesan_error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit_login">Masuk</button>
        </form>

        <!-- Tambahkan baris ini -->
        <a href="RegisterController.php"
            style="display: block; margin-top: 15px; text-decoration: none; color: #2196F3;">Belum punya akun? Daftar di
            sini</a>
    </div>
</body>

</html>