<!-- File: app/views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Quizify</title>
    <link rel="stylesheet" href="/quizify/public/css/style.css">
    <style>
        .container {
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .btn-terima {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-tolak {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 5px;
        }

        .btn-logout {
            background-color: #555;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            float: right;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card" style="border-top: 5px solid #2196F3;">
            <a href="LogoutController.php" class="btn-logout">Logout</a>
            <h2>Selamat Datang, Admin!</h2>
            <p>Berikut adalah daftar pendaftar baru yang menunggu persetujuan Anda:</p>

            <table>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Waktu Daftar</th>
                    <th>Aksi</th>
                </tr>

                <?php if (empty($pending_users)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada pendaftar baru saat ini.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pending_users as $user): ?>
                        <tr>
                            <td><?php echo $user['nama_lengkap']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td style="text-transform: capitalize;"><?php echo $user['role']; ?></td>
                            <td><?php echo $user['waktu_dibuat']; ?></td>
                            <td>
                                <a href="VerifikasiController.php?id=<?php echo $user['id']; ?>&aksi=terima" class="btn-terima"
                                    onclick="return confirm('Yakin ingin menerima pendaftar ini?');">Terima</a>
                                <a href="VerifikasiController.php?id=<?php echo $user['id']; ?>&aksi=tolak" class="btn-tolak"
                                    onclick="return confirm('Yakin ingin menolak dan menghapus pendaftar ini?');">Tolak</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>