<div class="content-wrapper">
  <section class="content">
    <div class="container mt-5">
      <h2>Edit Data Mahasiswa</h2>
      <form action="<?php echo site_url('dashboard/update/' . $mahasiswa['id_mhs']); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nama_mhs" class="form-label">Nama</label>
          <input type="text" class="form-control" name="nama_mhs" value="<?php echo $mahasiswa['nama_mhs']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="nim" class="form-label">NIM</label>
          <input type="number" class="form-control" name="nim" value="<?php echo $mahasiswa['nim']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" name="alamat" value="<?php echo $mahasiswa['alamat']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $mahasiswa['tgl_lahir']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="jurusan" class="form-label">Jurusan</label>
          <input type="text" class="form-control" name="jurusan" value="<?php echo $mahasiswa['jurusan']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" value="<?php echo $mahasiswa['email']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="no_telp" class="form-label">No. Telepon</label>
          <input type="text" class="form-control" name="no_telp" value="<?php echo $mahasiswa['no_telp']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" name="foto">
          <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
        </div>
        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-danger">Kembali</a>
        <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
    </div>
  </section>
</div>
