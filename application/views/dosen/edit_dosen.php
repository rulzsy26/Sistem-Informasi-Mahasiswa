<div class="content-wrapper">
    <section class="content">
        <div class="container mt-5">
            <h2>Edit Data Dosen</h2>
            <form action="<?php echo site_url('dosen/update/' . $dosen['id_dosen']); ?>" method="post"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_dosen" class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" name="nama_dosen"
                        value="<?php echo $dosen['nama_dosen']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nik_nidn" class="form-label">NIK / NIDN</label>
                    <input type="text" class="form-control" name="nik_nidn" value="<?php echo $dosen['nik_nidn']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control" name="prodi" value="<?php echo $dosen['prodi']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $dosen['email']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" name="no_telp" value="<?php echo $dosen['no_telp']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" name="foto">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>
                <a href="<?php echo site_url('dosen'); ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </form>
        </div>
    </section>
</div>