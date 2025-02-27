<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Dosen</title>
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
        <h2 class="text-center mb-4">Data Dosen</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NAMA DOSEN</th>
                    <th class="text-center">NIK/NIDN</th>
                    <th class="text-center">PRODI</th>
                    <th class="text-center">EMAIL</th>
                    <th class="text-center">NO. TELEPON</th>
                    <th class="text-center">FOTO</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($dosen as $dsn): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $dsn['nama_dosen']; ?></td>
                        <td><?php echo $dsn['nik_nidn']; ?></td>
                        <td><?php echo $dsn['prodi']; ?></td>
                        <td><?php echo $dsn['email']; ?></td>
                        <td><?php echo $dsn['no_telp']; ?></td>
                        <td>
                            <?php if (!empty($dsn['foto'])): ?>
                                <img src="<?php echo base_url('assets/Gambar/' . $dsn['foto']); ?>" width="50" height="50"
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