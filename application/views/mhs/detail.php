<div class="content-wrapper">
    <section class="content">
        <h4>
            <strong>DETAIL DATA MAHASISWA</strong>
        </h4>
        <table class="table">
            <tr>
                <th>Nama Lengkap</th>
                <td><?php echo htmlspecialchars($mahasiswa->nama_mhs); ?></td>
            </tr>
            <tr>
                <th>NIM</th>
                <td><?php echo htmlspecialchars($mahasiswa->nim); ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?php echo htmlspecialchars($mahasiswa->alamat); ?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td><?php echo htmlspecialchars($mahasiswa->tgl_lahir); ?></td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td><?php echo htmlspecialchars($mahasiswa->jurusan); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($mahasiswa->email); ?></td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td><?php echo htmlspecialchars($mahasiswa->no_telp); ?></td>
            </tr>
            <tr>
                <th>Foto</th>
                <td>
                    <?php if (!empty($mahasiswa->foto)): ?>
                        <img src="<?php echo base_url('assets/gambar/' . htmlspecialchars($mahasiswa->foto)); ?>" width="90"
                            height="110" alt="Foto Mahasiswa" class="img-thumbnail">
                    <?php else: ?>
                        <span>No Image Available</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-danger">Kembali</a>
    </section>
</div>