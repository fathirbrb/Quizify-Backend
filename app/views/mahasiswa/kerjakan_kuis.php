<!-- File: app/views/mahasiswa/kerjakan_kuis.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kerjakan Ujian - Quizify</title>
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
            margin-bottom: 20px;
        }

        .soal-box {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ccc;
        }

        .pertanyaan {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .opsi {
            margin-bottom: 8px;
        }

        .opsi label {
            cursor: pointer;
            display: block;
            padding: 5px;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .opsi label:hover {
            background-color: #f1f1f1;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .btn-batal {
            background-color: #f44336;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
            float: right;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card" style="border-top: 5px solid #E91E63;">
            <a href="DaftarKuisController.php?matkul_id=<?php echo $info_kuis['matkul_id']; ?>" class="btn-batal"
                onclick="return confirm('Yakin ingin membatalkan ujian? Jawaban tidak akan disimpan.');">Batal Ujian</a>

            <h2>Ujian:
                <?php echo $info_kuis['judul']; ?>
            </h2>
            <p>
                <?php echo $info_kuis['deskripsi']; ?>
            </p>
            <hr>

            <?php if (empty($daftar_soal)): ?>
                <h3 style="text-align: center; color: red;">Hore! Dosen belum memasukkan soal untuk ujian ini! 🎉</h3>
            <?php else: ?>
                <!-- Form Ujian Dimulai -->
                <form action="" method="POST"
                    onsubmit="return confirm('Apakah kamu yakin dengan semua jawabanmu? Ujian ini tidak bisa diulang!');">

                    <?php $no = 1;
                    foreach ($daftar_soal as $soal): ?>
                        <div class="soal-box">
                            <div class="pertanyaan">
                                <?php echo $no++; ?>.
                                <?php echo nl2br($soal['pertanyaan']); ?>
                            </div>

                            <!-- Perhatikan penamaan name="jawaban[ID_SOAL]" Ini adalah Trik Array di PHP -->
                            <div class="opsi">
                                <label><input type="radio" name="jawaban[<?php echo $soal['id']; ?>]" value="A" required> A.
                                    <?php echo $soal['opsi_a']; ?>
                                </label>
                            </div>
                            <div class="opsi">
                                <label><input type="radio" name="jawaban[<?php echo $soal['id']; ?>]" value="B" required> B.
                                    <?php echo $soal['opsi_b']; ?>
                                </label>
                            </div>
                            <div class="opsi">
                                <label><input type="radio" name="jawaban[<?php echo $soal['id']; ?>]" value="C" required> C.
                                    <?php echo $soal['opsi_c']; ?>
                                </label>
                            </div>
                            <div class="opsi">
                                <label><input type="radio" name="jawaban[<?php echo $soal['id']; ?>]" value="D" required> D.
                                    <?php echo $soal['opsi_d']; ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" name="submit_jawaban" class="btn-submit">Selesai & Kumpulkan Jawaban</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>