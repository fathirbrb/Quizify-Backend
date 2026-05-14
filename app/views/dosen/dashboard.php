<!-- File: app/views/dosen/dashboard.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Dosen - Quizify</title>
    <link rel="stylesheet" href="/quizify/public/css/style.css">
    <style>
        .container {
            padding: 40px;
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-tambah {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-kelola {
            background-color: #2196F3;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-logout {
            background-color: #555;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            float: right;
        }

        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- FORM BUAT MATA KULIAH BARU -->
        <div class="card" style="border-top: 5px solid #4CAF50;">
            <a href="LogoutController.php" class="btn-logout">Logout</a>
            <h2>Halo, <?php echo $_SESSION['nama_lengkap']; ?>! (Dosen)</h2>
            <hr>

            <h3>Buat Mata Kuliah Baru</h3>
            <?php if (isset($pesan_error)): ?>
                <div class="error-msg"><?php echo $pesan_error; ?></div> <?php endif; ?>
            <?php if (isset($pesan_sukses)): ?>
                <div class="success-msg"><?php echo $pesan_sukses; ?></div> <?php endif; ?>

            <form action="" method="POST">
                <input type="text" name="nama_mk" placeholder="Nama Mata Kuliah (Contoh: Pemrograman Web)" required>
                <input type="text" name="kode_mk" placeholder="Kode Unik (Contoh: WEB101)" required>
                <button type="submit" name="submit_matkul" class="btn-tambah">+ Buat Mata Kuliah</button>
            </form>
        </div>

        <!-- TABEL DAFTAR MATA KULIAH -->
        <div class="card">
            <h3>Mata Kuliah Anda</h3>
            <p>Bagikan "Kode MK" kepada mahasiswa agar mereka bisa masuk ke kelas Anda.</p>
            <table>
                <tr>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Waktu Dibuat</th>
                    <th>Aksi</th>
                </tr>

                <?php if (empty($daftar_matkul)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Anda belum membuat Mata Kuliah.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftar_matkul as $mk): ?>
                        <tr>
                            <td><strong><?php echo $mk['kode_mk']; ?></strong></td>
                            <td><?php echo $mk['nama_mk']; ?></td>
                            <td><?php echo $mk['waktu_dibuat']; ?></td>
                            <td>
                                <a href="KelolaKuisController.php?matkul_id=<?php echo $mk['id']; ?>" class="btn-kelola">Masuk &
                                    Kelola Kuis</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>