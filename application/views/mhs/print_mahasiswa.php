<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Hide the back button when printing */
        @media print {
            .no-print {
                display: none;
            }
        }

        /* Adjust table style for printing */
        @media print {
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 8px;
                text-align: center;
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <button onclick="window.history.back();" class="btn btn-secondary mb-3 no-print">Kembali</button>
        <h2 class="text-center mb-4">Data Mahasiswa</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NAMA</th>
                    <th class="text-center">NIM</th>
                    <th class="text-center">ALAMAT</th>
                    <th class="text-center">TANGGAL LAHIR</th>
                    <th class="text-center">JURUSAN</th>
                    <th class="text-center">NO. TELEPON</th>
                    <th class="text-center">EMAIL</th>
                    <th class="text-center">FOTO</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $mhs['nama_mhs']; ?></td>
                        <td><?php echo $mhs['nim']; ?></td>
                        <td><?php echo $mhs['alamat']; ?></td>
                        <td><?php echo $mhs['tgl_lahir']; ?></td>
                        <td><?php echo $mhs['jurusan']; ?></td>
                        <td><?php echo $mhs['no_telp']; ?></td>
                        <td><?php echo $mhs['email']; ?></td>
                        <td>
                            <?php if (!empty($mhs['foto'])): ?>
                                <img src="<?php echo base_url('assets/Gambar/' . $mhs['foto']); ?>" width="50" height="50"
                                    alt="Foto">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        window.print(); // Automatically trigger the print dialog
    </script>
</body>

</html>