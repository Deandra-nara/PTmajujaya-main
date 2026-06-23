<?php 
$uri = $this->uri->segment(1); 
$method = $this->uri->segment(2);
$role = $this->session->userdata('role');
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('dashboard') ?>" class="brand-link">
        <i class="fas fa-laptop brand-image mt-1 text-primary elevation-3" style="font-size: 1.5rem; opacity: .8"></i>
        <span class="brand-text font-weight-bold text-white">PT. Maju Jaya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div class="img-circle bg-primary d-flex align-items-center justify-content-center text-white font-weight-bold" style="width: 35px; height: 35px; font-size: 1.1rem;">
                    <?= strtoupper(substr($this->session->userdata('name') ?? 'U', 0, 1)) ?>
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold text-white"><?= $this->session->userdata('name') ?></a>
                <span class="text-muted text-xs text-uppercase"><?= $role ?></span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                

                <!-- Dashboard -->
<li class="nav-item">
    <a href="<?= site_url('dashboard') ?>" class="nav-link <?= ($uri == 'dashboard' || $uri == '') ? 'active' : '' ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<?php if ($role == 'admin'): ?>

    <!-- MASTER DATA -->
    <li class="nav-header">MASTER DATA</li>

    <li class="nav-item">
        <a href="<?= site_url('produk') ?>" class="nav-link <?= $uri == 'produk' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-box"></i>
            <p>Data Produk</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= site_url('pelanggan') ?>" class="nav-link <?= $uri == 'pelanggan' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Data Pelanggan</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= site_url('sales') ?>" class="nav-link <?= $uri == 'sales' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user-cog"></i>
            <p> Data sales</p>
        </a>
    </li>

<?php endif; ?>


<?php if (in_array($role, ['admin','sales'])): ?>

    <!-- TRANSAKSI -->
    <li class="nav-header">TRANSAKSI</li>

    <li class="nav-item">
        <a href="<?= site_url('sales_order') ?>" class="nav-link <?= $uri == 'sales_order' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Order</p>
        </a>
    </li>

<?php endif; ?>


<?php if (in_array($role, ['admin','manager'])): ?>

    <!-- LAPORAN -->
    <li class="nav-item">
    <a href="<?= site_url('laporan') ?>"
       class="nav-link">

       <i class="nav-icon fas fa-file-invoice"></i>

       <p>Laporan Penjualan</p>
    </a>
</li>
<?php endif; ?>


<!-- Logout -->
<li class="nav-header">SISTEM</li>

<li class="nav-item">
    <a href="<?= site_url('auth/logout') ?>" class="nav-link text-danger">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.8rem;"><?= $title ?? 'Dashboard' ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">