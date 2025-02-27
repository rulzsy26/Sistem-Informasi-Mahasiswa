<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Mata Kuliah</title>
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
        <h2 class="text-center mb-4">Data Mata Kuliah</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">KODE MATA KULIAH</th>
                    <th class="text-center">NAMA MATA KULIAH</th>
                    <th class="text-center">SKS</th>
                    <th class="text-center">SEMESTER</th>
                    <th class="text-center">JURUSAN</th>
                    <th class="text-center" colspan="2">JADWAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($matkul as $mk): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $mk['kode_matkul']; ?></td>
                        <td><?php echo $mk['nama_matkul']; ?></td>
                        <td><?php echo $mk['sks']; ?></td>
                        <td><?php echo $mk['semester']; ?></td>
                        <td><?php echo $mk['jurusan']; ?></td>
                        <td><?php echo $mk['hari']; ?></td>
                        <td><?php echo $mk['waktu']; ?></td>
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