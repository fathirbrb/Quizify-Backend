<!-- File: app/views/mahasiswa/daftar_kuis.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Ujian - Quizify</title>
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

        .btn-kerjakan {
            background-color: #2196F3;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-kembali {
            background-color: #555;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            float: right;
        }

        .skor-box {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card" style="border-top: 5px solid #2196F3;">
            <a href="MahasiswaController.php" class="btn-kembali">Kembali ke Dashboard</a>
            <h2>Kelas: <?php echo $info_matkul['nama_mk']; ?> (<?php echo $info_matkul['kode_mk']; ?>)</h2>
            <hr>

            <h3>Daftar Ujian Tersedia</h3>
            <table>
                <tr>
                    <th>Judul Ujian</th>
                    <th>Deskripsi</th>
                    <th>Status / Aksi</th>
                </tr>

                <?php if (empty($daftar_kuis)): ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Dosen belum membuat ujian untuk kelas ini.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftar_kuis as $kuis): ?>
                        <tr>
                            <td><strong><?php echo $kuis['judul']; ?></strong></td>
                            <td><?php echo $kuis['deskripsi']; ?></td>
                            <td>
                                <?php
                                // Cek apakah mahasiswa ini sudah punya nilai di ujian ini
                                $cek_nilai = cekSudahMengerjakan($conn, $_SESSION['user_id'], $kuis['id']);

                                if ($cek_nilai) {
                                    // Kalau sudah ngerjain, tampilkan nilainya!
                                    echo "<div class='skor-box'>Nilai Kamu: " . $cek_nilai['skor'] . "</div>";
                                } else {
                                    echo '<a href="KerjakanKuisController.php?kuis_id=' . $kuis['id'] . '" class="btn-kerjakan">Mulai Kerjakan!</a>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>