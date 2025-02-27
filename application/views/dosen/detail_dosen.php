<div class="content-wrapper">
    <section class="content ml-3">
        <h4>
            <strong>DETAIL DATA DOSEN</strong>
        </h4>
        <table class="table">
            <tr>
                <th>Nama Lengkap</th>
                <td><?php echo htmlspecialchars($dosen->nama_dosen); ?></td>
            </tr>
            <tr>
                <th>NIK/NIDN</th>
                <td><?php echo htmlspecialchars($dosen->nik_nidn); ?></td>
            </tr>
            <tr>
                <th>Prodi</th>
                <td><?php echo htmlspecialchars($dosen->prodi); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($dosen->email); ?></td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td><?php echo htmlspecialchars($dosen->no_telp); ?></td>
            </tr>
            <tr>
                <th>Foto</th>
                <td>
                    <?php if (!empty($dosen->foto)): ?>
                        <img src="<?php echo base_url('assets/Gambar/' . htmlspecialchars($dosen->foto)); ?>" width="90"
                            height="110" alt="Foto Dosen" class="img-thumbnail">
                    <?php else: ?>
                        <span>No Image Available</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <a href="<?php echo site_url('dosen'); ?>" class="btn btn-danger">Kembali</a>
    </section>
</div>
