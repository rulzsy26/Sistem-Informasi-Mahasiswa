<!DOCTYPE html>
<html lang="en">

<head>
    <script src="<?php echo base_url('assets/chart/Chart.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <style>
        .flex-row {
            display: flex;
            gap: 20px;
            /* Jarak antara elemen */
        }

        .chart-container,
        .calendar-container {
            flex: 1;
            /* Membagi ruang secara merata */
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .calendar-container {
            background: rgb(255, 255, 255);
        }

        .chart-container canvas {
            width: 100% !important;
            height: 350px !important;
            position-anchor: auto;
            /* Sesuaikan tinggi grafik */
        }

        .announcement-container h3 {
            margin-bottom: 20px;
            color: #333;
        }

        .list-group-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Menambahkan gaya untuk tombol dengan ikon */
        .action-buttons a {
            font-size: 20px;
            color: #333;
            margin-left: 10px;
            text-decoration: none;
        }

        .action-buttons a:hover {
            color: #007bff;
        }

        /* Warna ikon saat mouse hover */
        .btn-edit i {
            color: #ffc107;
        }

        .btn-delete i {
            color: #dc3545;
        }

        /* Gaya khusus untuk ikon */
        .btn-edit i,
        .btn-delete i {
            transition: color 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container mt-5">
                <h2 class="mb-4">Dashboard</h2>
                <div class="row">
                    <!-- Jumlah Mahasiswa -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card bg-info text-white" style="min-height: 150px;">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-body-icon" style="font-size: 50px; opacity: 0.7; margin-right: 15px;">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-2">Jumlah Mahasiswa</h5>
                                    <div class="display-4"><?= number_format($jumlah_mhs ?: 0, 0, ',', '.') ?></div>
                                    <a href="<?php echo site_url('dashboard/index/'); ?>" class="text-white">
                                        Lihat Detail <i class="fas fa-angle-double-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Dosen -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card bg-primary text-white" style="min-height: 150px;">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-body-icon" style="font-size: 50px; opacity: 0.7; margin-right: 15px;">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-2">Jumlah Dosen</h5>
                                    <div class="display-4"><?= number_format($jumlah_dosen ?: 0, 0, ',', '.') ?></div>
                                    <a href="<?php echo site_url('dosen/index'); ?>" class="text-white">
                                        Lihat Detail <i class="fas fa-angle-double-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Mata Kuliah -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card bg-danger text-white" style="min-height: 150px;">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-body-icon" style="font-size: 50px; opacity: 0.7; margin-right: 15px;">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-2">Jumlah Mata Kuliah</h5>
                                    <div class="display-4"><?= number_format($jumlah_matkul ?: 0, 0, ',', '.') ?></div>
                                    <a href="<?php echo site_url('matkul/index'); ?>" class="text-white">
                                        Lihat Detail <i class="fas fa-angle-double-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-row">
                    <div class="chart-container">
                        <h4>Grafik Data Akademik</h4>
                        <canvas id="grafikMainpage" width="300" height="150"></canvas>
                    </div>
                    <!-- Kalender -->
                    <div class="calendar-container">
                        <h4>Kalender</h4>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Data untuk grafik
        var labels = ['Mahasiswa', 'Dosen', 'Mata Kuliah'];
        var data = [
            <?= isset($jumlah_mhs) ? $jumlah_mhs : 0 ?>,
            <?= isset($jumlah_dosen) ? $jumlah_dosen : 0 ?>,
            <?= isset($jumlah_matkul) ? $jumlah_matkul : 0 ?>
        ];

        var ctx = document.getElementById('grafikMainpage').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Data Akademik',
                    data: data,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(220, 53, 69, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes:
                        [{
                            ticks:
                            {
                                beginAtZero:
                                    true
                            }
                        }]
                },
            }
        });

        // Inisialisasi FullCalendar
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: [
                    {
                        title: 'Ujian Akhir Semester',
                        start: '2025-01-13',
                        end: '2025-01-17'
                    },
                    {
                        title: 'Libur Semester',
                        start: '2025-01-20',
                        end: '2025-03-10'
                    }
                ] // Tambahkan event jika ada
            });
            calendar.render();
        });
    </script>
</body>

</html>