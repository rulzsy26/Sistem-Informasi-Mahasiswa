<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <style>
        .welcome-text {
            font-size: 30px;
            font-weight: bold;
            color: #333;
            text-align: left;
            margin-bottom: 20px;
        }

        .calendar-container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #calendar {
            width: 100%;
            /* Menentukan lebar kalender */
            height: 400px;
            /* Menentukan tinggi kalender */
            margin: 0 auto;
            /* Memposisikan kalender di tengah */
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
    </style>
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container mt-5">
                <!-- Pesan Selamat Datang -->
                <?php if ($this->session->userdata('logged_in')): ?>
                    <h1 class="welcome-text">
                        Selamat datang, <?= htmlspecialchars($this->session->userdata('username')); ?>!
                    </h1>
                <?php endif; ?>

                <div class="announcement-container mt-4">
                    <ul class="list-group">
                        <?php if (!empty($pengumuman)): ?>
                            <?php foreach ($pengumuman as $item): ?>
                                <li class="list-group-item">
                                    <strong><?= htmlspecialchars($item['judul']); ?></strong>
                                    <p class="mb-0"><?= htmlspecialchars($item['deskripsi']); ?></p>
                                    <small class="text-muted">Diumumkan pada: <?= htmlspecialchars($item['tanggal']); ?></small>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">Tidak ada pengumuman untuk saat ini.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Kalender Akademik -->
                <div class="calendar-container">
                    <h4 class="mb-4">Kalender Akademik</h4>
                    <div id="calendar"></div>
                </div>
            </div>
        </section>
    </div>

    <script>
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
                        end: '2025-01-18'
                    },
                    {
                        title: 'Libur Semester',
                        start: '2025-01-20',
                        end: '2025-03-08'
                    },
                    {
                        title: 'Mulai Perkuliahan',
                        start: '2025-03-10',
                        end: '2025-03-10'
                    }
                ] // Tambahkan event jika ada
            });
            calendar.render();
        });
    </script>
</body>

</html>