<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Kata Kunci</title>

    <!-- Link ke CSS yang sudah disesuaikan -->
    <style>
        body {
            background: url("<?= base_url('assets/Gambar/vecteezy_blue-and-white-background-geometric-shape-shape_52375349.jpg'); ?>") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Source Sans Pro', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 40px 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }

        .login-title {
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

        .btn-login {
            background-color: #007bff;
            border-radius: 50px;
            color: #fff;
            font-weight: 500;
            padding: 12px 20px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .login-footer {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 20px;
        }

        .login-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2 class="login-title">Lupa Kata Kunci</h2>

        <!-- Pesan Error atau Sukses -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>


        <!-- Form untuk mengubah password -->
        <form action="<?= site_url('auth/forgot_password'); ?>" method="post">
            <div class="form-group mb-3"> <!-- Menambahkan margin bawah -->
                <label for="username">Nama Pengguna</label>
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="Masukkan Username Anda" required>
            </div>

            <div class="form-group mb-3"> <!-- Menambahkan margin bawah -->
                <label for="old_password">Kata Kunci Lama</label>
                <input type="password" class="form-control" id="old_password" name="old_password"
                    placeholder="Masukkan Kata Kunci Lama" required>
            </div>

            <div class="form-group mb-3"> <!-- Menambahkan margin bawah -->
                <label for="new_password">Kata Kunci Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password"
                    placeholder="Masukkan Kata Kunci Baru" required>
            </div>

            <button type="submit" class="btn-login">Reset Kata Kunci</button>
        </form>


        <div class="login-footer">
            <p><a href="<?= site_url('auth/login'); ?>">Kembali ke Login</a></p>
        </div>
    </div>

</body>

</html>