<!-- File: app/views/dosen/kelola_kuis.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Ujian - Quizify</title>
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

        input[type="text"],
        textarea {
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
            background-color: #FF9800;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-kembali {
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
    </style>
</head>

<body>

    <div class="container">

        <div class="card" style="border-top: 5px solid #FF9800;">
            <a href="DosenController.php" class="btn-kembali">Kembali ke Dashboard</a>
            <h2>Ruang Kelas:
                <?php echo $info_matkul['nama_mk']; ?> (
                <?php echo $info_matkul['kode_mk']; ?>)
            </h2>
            <hr>

            <h3>Buat Ujian / Kuis Baru</h3>
            <?php if (isset($pesan_sukses)): ?>
                <div class="success-msg">
                    <?php echo $pesan_sukses; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <input type="text" name="judul" placeholder="Judul (Contoh: UTS Semester Ganjil)" required>
                <textarea name="deskripsi" placeholder="Deskripsi atau Aturan Ujian (Opsional)" rows="3"></textarea>
                <button type="submit" name="submit_kuis" class="btn-tambah">+ Buat Ujian</button>
            </form>
        </div>

        <div class="card">
            <h3>Daftar Ujian di Kelas Ini</h3>
            <table>
                <tr>
                    <th>Judul Ujian</th>
                    <th>Deskripsi</th>
                    <th>Waktu Dibuat</th>
                    <th>Aksi</th>
                </tr>

                <?php if (empty($daftar_kuis)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum ada ujian di kelas ini.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftar_kuis as $kuis): ?>
                        <tr>
                            <td><strong>
                                    <?php echo $kuis['judul']; ?>
                                </strong></td>
                            <td>
                                <?php echo $kuis['deskripsi']; ?>
                            </td>
                            <td>
                                <?php echo $kuis['waktu_dibuat']; ?>
                            </td>
                            <td>
                                <!-- Tombol ini nanti untuk nambahin soal A B C D -->
                                <a href="KelolaSoalController.php?kuis_id=<?php echo $kuis['id']; ?>"
                                    class="btn-kelola">Buat/Edit Soal</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>