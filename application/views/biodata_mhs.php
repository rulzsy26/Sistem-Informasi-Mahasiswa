<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Tambahkan Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJX3+7o2L5n5k1f1qz8Ytv2E3pn1hfF3tbDh9NfoWZ6rFx6Z9+SoFe44Q6Kp" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Mahasiswa</h1>

        <?php if ($mahasiswa): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= $mahasiswa['nama_mhs']; ?> (NIM: <?= $mahasiswa['nim']; ?>)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Alamat:</strong> <?= $mahasiswa['alamat']; ?></p>
                            <p><strong>Tanggal Lahir:</strong> <?= $mahasiswa['tgl_lahir']; ?></p>
                            <p><strong>Jurusan:</strong> <?= $mahasiswa['jurusan']; ?></p>
                            <p><strong>Email:</strong> <?= $mahasiswa['email']; ?></p>
                            <p><strong>No. Telepon:</strong> <?= $mahasiswa['no_telp']; ?></p>
                            <p><strong>Semester:</strong> <?= $mahasiswa['semester']; ?></p>
                        </div>
                        <div class="col-md-6 text-center">
                            <p><strong>Foto:</strong></p>
                            <?php if ($mahasiswa['foto']): ?>
                                <!-- Menampilkan foto jika ada -->
                                <img src="<?= base_url('assets/Gambar/' . $mahasiswa['foto']); ?>" alt="Foto Mahasiswa"
                                    class="img-fluid rounded-circle" width="200">
                            <?php else: ?>
                                <!-- Menampilkan foto default jika tidak ada foto -->
                                <img src="<?= base_url('assets/Gambar/default.png'); ?>" alt="Foto Default"
                                    class="img-fluid rounded-circle" width="200">
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning mt-4" role="alert">
                Data mahasiswa tidak ditemukan.
            </div>
        <?php endif; ?>
    </div>

    <!-- Tambahkan Bootstrap JS CDN (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0aJg7dHnbI8rhpycVjjptk7wUZZK9TaaI25kYpc7bdV0xzUo"
        crossorigin="anonymous"></script>
</body>

</html>