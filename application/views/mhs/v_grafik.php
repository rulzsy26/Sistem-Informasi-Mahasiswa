<!DOCTYPE html>
<html lang="en">

<head>
    <title>Grafik dengan Chart.js</title>
    <script src="<?php echo base_url('assets/chart/Chart.js'); ?>"></script>
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container mt-5">
                <button onclick="window.history.back();" class="btn btn-secondary mb-3 no-print">Kembali</button>
                <h4 class="mb-4"><strong>Grafik Data Mahasiswa</strong></h4>
                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </section>
    </div>

    <?php
    $nama_jurusan = [];
    $jumlah = [];

    foreach ($hasil as $item) {
        $nama_jurusan[] = $item->jurusan;
        $jumlah[] = $item->total;
    }
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var namaJurusan = <?php echo json_encode($nama_jurusan); ?>;
        var jumlahData = <?php echo json_encode($jumlah); ?>;

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: namaJurusan,
                datasets: [{
                    label: 'Jumlah Mahasiswa per Jurusan',
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(56, 86, 255, 0.87)',
                        'rgba(60, 179, 113, 0.2)',
                        'rgba(175, 238, 239, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(56, 86, 255, 1)',
                        'rgba(60, 179, 113, 1)',
                        'rgba(175, 238, 239, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    data: jumlahData
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>