<div class="content-wrapper">
    <section class="content">
        <div class="container mt-5">
            <h2>Edit Data Mata Kuliah</h2>
            <form action="<?php echo site_url('matkul/update/' . $matkul['id_matkul']); ?>" method="post">
                <div class="mb-3">
                    <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                    <input type="text" class="form-control" name="kode_matkul"
                        value="<?php echo $matkul['kode_matkul']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" name="nama_matkul"
                        value="<?php echo $matkul['nama_matkul']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="sks" class="form-label">SKS</label>
                    <input type="number" class="form-control" name="sks" value="<?php echo $matkul['sks']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" class="form-control" name="semester" value="<?php echo $matkul['semester']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" value="<?php echo $matkul['jurusan']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Hari</label>
                    <input type="text" class="form-control" name="hari" value="<?php echo $matkul['hari']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Waktu</label>
                    <input type="text" class="form-control" name="waktu" value="<?php echo $matkul['waktu']; ?>"
                        required>
                </div>
                <a href="<?php echo site_url('matkul'); ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </form>
        </div>
    </section>
</div>