<!-- File: app/views/dosen/kelola_soal.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Soal - Quizify</title>
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
            vertical-align: top;
        }

        th {
            background-color: #f4f4f4;
        }

        input[type="text"],
        textarea,
        select {
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

        .kunci-jawaban {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card" style="border-top: 5px solid #FF9800;">
            <a href="KelolaKuisController.php?matkul_id=<?php echo $info_kuis['matkul_id']; ?>"
                class="btn-kembali">Kembali ke Daftar Ujian</a>
            <h2>Ujian: <?php echo $info_kuis['judul']; ?></h2>
            <hr>

            <h3>Tambahkan Soal Baru</h3>
            <?php if (isset($pesan_sukses)): ?>
                <div class="success-msg"><?php echo $pesan_sukses; ?></div> <?php endif; ?>

            <form action="" method="POST">
                <textarea name="pertanyaan" placeholder="Ketik pertanyaan di sini..." rows="3" required></textarea>

                <input type="text" name="opsi_a" placeholder="Opsi A" required>
                <input type="text" name="opsi_b" placeholder="Opsi B" required>
                <input type="text" name="opsi_c" placeholder="Opsi C" required>
                <input type="text" name="opsi_d" placeholder="Opsi D" required>

                <label for="jawaban_benar">Pilih Kunci Jawaban:</label>
                <select name="jawaban_benar" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>

                <button type="submit" name="submit_soal" class="btn-tambah">+ Simpan Soal</button>
            </form>
        </div>

        <div class="card">
            <h3>Daftar Soal (Total: <?php echo count($daftar_soal); ?> Soal)</h3>
            <table>
                <tr>
                    <th width="5%">No</th>
                    <th width="45%">Pertanyaan</th>
                    <th width="50%">Pilihan Jawaban</th>
                </tr>

                <?php if (empty($daftar_soal)): ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Belum ada soal untuk ujian ini.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1;
                    foreach ($daftar_soal as $soal): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo nl2br($soal['pertanyaan']); ?></td>
                            <td>
                                A. <?php echo $soal['opsi_a']; ?>
                                <?php if ($soal['jawaban_benar'] == 'A')
                                    echo '<span class="kunci-jawaban"> (Benar)</span>'; ?><br>
                                B. <?php echo $soal['opsi_b']; ?>
                                <?php if ($soal['jawaban_benar'] == 'B')
                                    echo '<span class="kunci-jawaban"> (Benar)</span>'; ?><br>
                                C. <?php echo $soal['opsi_c']; ?>
                                <?php if ($soal['jawaban_benar'] == 'C')
                                    echo '<span class="kunci-jawaban"> (Benar)</span>'; ?><br>
                                D. <?php echo $soal['opsi_d']; ?>
                                <?php if ($soal['jawaban_benar'] == 'D')
                                    echo '<span class="kunci-jawaban"> (Benar)</span>'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>