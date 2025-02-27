<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
        <div class="login-title">Selamat Datang</div>

        <!-- Pesan Error -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post" action="<?= site_url('auth/login'); ?>">
            <div class="form-group mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control"
                    placeholder="Masukkan Username" required>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Kata Kunci</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Masukkan Kata Kunci" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="form-check-label">Ingat Saya</label>
                </div>
                <a href="<?= site_url('auth/forgot_password'); ?>">Lupa Kata Kunci?</a>
            </div>

            <button type="submit" class="btn btn-login">Masuk</button>
        </form>

        <div class="login-footer mt-3">
            <p>Belum punya akun? <a href="<?= site_url('auth/register'); ?>">Daftar Sekarang</a></p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>