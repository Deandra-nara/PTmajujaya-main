<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashboard' ?> - PT. Maju Jaya </title>

    <!-- Google Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">

    <style>
        body {
            font-family: 'Outfit', sans-serif !important;
        }
        .main-sidebar {
            background-color: #0f172a !important; /* Navy Slate Dark Sidebar */
        }
        .brand-link {
            border-bottom: 1px solid rgba(255,255,255,0.1) !important;
            background: #090d16 !important;
        }
        .nav-sidebar .nav-link.active {
            background-color: #3b82f6 !important; /* Blue active link */
            color: #ffffff !important;
        }
        .content-wrapper {
            background-color: #f8fafc !important; /* Clean soft white background */
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link font-weight-bold text-dark">PT. Maju Jaya Management System</span>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- User Profile Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle font-weight-bold" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle mr-1"></i>
                    <?= $this->session->userdata('name') ?> (<?= ucfirst($this->session->userdata('role')) ?>)
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Sesi Pengguna</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> <?= $this->session->userdata('name') ?>
                        <span class="float-right text-muted text-sm"><?= ucfirst($this->session->userdata('role')) ?></span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= site_url('auth/logout') ?>" class="dropdown-item dropdown-footer text-danger font-weight-bold">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->