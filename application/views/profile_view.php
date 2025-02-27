<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <!-- Tambahkan CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Profil Pengguna</h2>

        <!-- Notifikasi jika berhasil update profil -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form Profil -->
        <?php echo form_open_multipart('profile/update'); ?>

        <div class="card">
            <div class="card-body">
                <!-- Foto Profil - Pindahkan ke atas -->
                <div class="text-center mb-4">
                    <?php if ($user->foto): ?>
                        <img src="<?php echo base_url('assets/Gambar/' . $user->foto . '?' . time()); ?>" alt="Foto Profil"
                            class="img-fluid border"
                            style="border-radius: 8px; width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <p class="text-muted">Tidak ada foto profil yang diunggah.</p>
                    <?php endif; ?>
                </div>


                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control"
                        value="<?php echo set_value('username', $user->username); ?>" required>
                </div>

                <!-- Foto Profil -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Unggah Foto Profil Baru:</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Profil</button>
                </div>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>

    <!-- Tambahkan CDN Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>