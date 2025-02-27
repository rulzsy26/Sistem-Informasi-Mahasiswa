<div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
            </ul>
            <?php if ($this->session->userdata('logged_in')): ?>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url('assets/Gambar/' . ($this->session->userdata('foto') ?? 'default.png')); ?>"
                            alt="User Image" class="rounded-circle me-2"
                            style="width: 30px; height: 30px; object-fit: cover;"
                            onerror="this.onerror=null; this.src='<?= base_url('assets/Gambar/default.png'); ?>';">
                        <span class="text-truncate"><?= htmlspecialchars($this->session->userdata('username')); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= site_url('profile'); ?>">Profil</a></li>

                        <li><a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <img src="<?= base_url('assets/Gambar/default.png'); ?>" alt="Default User Image"
                    style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                <span class="username">Guest</span>
            <?php endif; ?>

        </div>
    </nav>

    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="#" class="brand-link">
                <img src="https://4.bp.blogspot.com/-B7I4m3iJVZI/UJ7N-ccnZ5I/AAAAAAAAHG4/xbyMmBuaezo/s1600/LOGO+UNIVERSITAS+MERCU+BUANA.png"
                    alt="Logo Mercu Buana" class="brand-image opacity-75 shadow" style="width: 50px; height: 70px;">
                <span class="brand-text fw-light">SIA Mercu</span>
            </a>
        </div>

        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?php echo site_url('mainpguser/index'); ?>" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('bio_mhs/index'); ?>" class="nav-link">
                            <i class="nav-icon bi bi-person"></i>
                            <p>Biodata Mahasiswa</p>
                        </a>
                    </li>
                    <!-- Mahasiswa Menu Item -->
                    <li class="nav-item">
                        <a href="<?php echo site_url('matkul_user/index'); ?>" class="nav-link">
                            <i class="nav-icon bi bi-calendar-event"></i>
                            <p>Jadwal Mata Kuliah</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('auth/forgot_password'); ?>" class="nav-link">
                            <i class="nav-icon bi bi-lock"></i>
                            <p>Ganti Kata Kunci?</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('auth/logout'); ?>" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-in-right"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>