<?php
// Cek apakah role yang dipilih adalah 'user'
$selected_role = isset($_POST['role']) ? $_POST['role'] : 'user'; // Default 'user'

// Jika role adalah 'user', coba ambil data mahasiswa yang sudah ada
$nama_mhs = '';
if ($selected_role === 'user') {
    // Misalnya ID user sudah tersedia di session atau URL
    // Ambil ID user, misalnya dari session
    $id_user = $this->session->userdata('id_user');

    // Ambil data mahasiswa berdasarkan ID user
    $this->load->model('M_mhs'); // Pastikan model yang benar dimuat
    $data_mhs = $this->M_mhs->get_mahasiswa_by_user($id_user);

    if ($data_mhs) {
        $nama_mhs = $data_mhs['nama_mhs']; // Ambil nama mahasiswa dari data yang ditemukan
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Daftar Akun</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background: url("<?= base_url('assets/Gambar/vecteezy_blue-and-white-background-geometric-shape-shape_52375349.jpg'); ?>") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            max-width: 400px;
            width: 100%;
            padding: 40px 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }

        .register-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 500;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 50px;
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        .btn-register {
            background-color: #007bff;
            border-radius: 50px;
            color: #fff;
            font-weight: 500;
            padding: 12px 20px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }

        .register-footer {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 20px;
        }

        .register-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-title">Daftar Akun Baru</div>

        <!-- Pesan Error -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Form Register -->
        <form method="post" action="<?= site_url('auth/register'); ?>">
            <!-- Input Nama Mahasiswa (Hanya Jika Role Adalah User) -->
            <!-- Input Nama Mahasiswa (Hanya Jika Role Adalah User) -->
            <?php if ($selected_role === 'user'): ?>
                <div class="form-group mb-3">
                    <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama_mhs" id="nama_mhs" class="form-control"
                        placeholder="Masukkan Nama Mahasiswa" value="<?= $nama_mhs; ?>">
                </div>
            <?php endif; ?>

            <!-- Input Username dan Kata Kunci (Selalu Muncul) -->
            <div class="form-group mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Kata Kunci</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Masukkan Kata Kunci" required>
            </div>

            <!-- Input Role -->
            <div class="form-group mb-3">
                <label for="role" class="form-label">Peran</label>
                <select name="role" id="role" class="form-control">
                    <option value="user" <?= ($selected_role === 'user') ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= ($selected_role === 'admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-register">Daftar</button>
        </form>

        <div class="register-footer mt-3">
            <p>Sudah punya akun? <a href="<?= site_url('auth/login'); ?>">Masuk</a></p>
        </div>
    </div>
</body>

</html>