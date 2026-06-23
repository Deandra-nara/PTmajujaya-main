<?php
$role = $this->session->userdata('role');
?>

<!-- Alert Warnings (e.g. Access Restrictions) -->
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-warning alert-dismissible fade show shadow-xs border-0 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-triangle mr-3 text-lg"></i>
            <div>
                <strong>Akses Dibatasi!</strong> <?= $this->session->flashdata('error') ?>
            </div>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="row">
    <!-- Welcome Card -->
    <div class="col-12">
        <div class="card card-primary card-outline shadow-xs border-0 mb-4" style="border-radius: 6px;">
            <div class="card-body py-3">
                <h5 class="font-weight-bold text-dark mb-1">Selamat Datang Kembali, <?= $this->session->userdata('name') ?>! 👋</h5>
                <p class="text-muted mb-0 text-sm">Sistem Informasi penjualan barang electronik. Anda masuk sebagai <strong class="text-primary text-uppercase"><?= $role ?></strong>.</p>
            </div>
        </div>
    </div>
</div>

<!-- Info Cards Row -->
<div class="row">
    <!-- Total produk -->
    <div class="col-lg-2 col-md-4 col-6">
        <div class="small-box bg-info shadow-xs">
            <div class="inner">
                <h3><?= $total_produk?></h3>
                <p class="font-weight-bold text-xs mb-0">Total produk</p>
            </div>
            <div class="icon">
                <i class="fas fa-laptop"></i>
            </div>
            <?php if ($role == 'admin'): ?>
                <a href="<?= site_url('produk') ?>" class="small-box-footer text-xs">Kelola <i class="fas fa-arrow-circle-right"></i></a>
            <?php else: ?>
                <div class="small-box-footer py-1 text-xs">Protected</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Total Pelanggan -->
    <div class="col-lg-2 col-md-4 col-6">
        <div class="small-box bg-primary shadow-xs">
            <div class="inner">
                <h3><?= $total_pelanggan ?></h3>
                <p class="font-weight-bold text-xs mb-0">Total Pelanggan</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <?php if ($role == 'admin'): ?>
                <a href="<?= site_url('pelanggan') ?>" class="small-box-footer text-xs">Kelola <i class="fas fa-arrow-circle-right"></i></a>
            <?php else: ?>
                <div class="small-box-footer py-1 text-xs">Protected</div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- sales -->
    <div class="col-lg-2 col-md-4 col-6">
        <div class="small-box bg-danger shadow-xs">
            <div class="inner">
                <h3><?= isset($total_sales) ? $total_sales : 0 ?></h3>
                <p class="font-weight-bold text-xs mb-0">Total sales</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-cog"></i>
            </div>
            <?php if ($role == 'admin'): ?>
                <a href="<?= site_url('sales') ?>" class="small-box-footer text-xs">Kelola <i class="fas fa-arrow-circle-right"></i></a>
            <?php else: ?>
                <div class="small-box-footer py-1 text-xs">Protected</div>
            <?php endif; ?>
        </div>
    </div>


    <!-- Sales Order -->
<div class="col-lg-2 col-md-4 col-6">
    <div class="small-box bg-warning shadow-xs">
        <div class="inner text-white">
            <h3 class="text-white"><?= isset($total_sales_order) ? $total_sales_order : 0 ?></h3>
            <p class="font-weight-bold text-xs mb-0 text-white"> Order</p>
        </div>
        <div class="icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <?php if ($role == 'admin'): ?>
            <a href="<?= site_url('sales_order') ?>" class="small-box-footer text-xs text-white">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        <?php else: ?>
            <div class="small-box-footer py-1 text-xs text-white">Protected</div>
        <?php endif; ?>
    </div>
</div>

<!-- Pendapatan Bulan Ini -->
<div class="col-lg-2 col-md-4 col-6">
    <div class="small-box bg-teal shadow-xs text-white">
        <div class="inner text-white">
            <h5 class="font-weight-bold text-white mb-1" style="font-size:1.15rem; margin-top:5px;">
    Rp<?= number_format(isset($pendapatan_bulan_ini) ? $pendapatan_bulan_ini : 0, 0, ',', '.') ?></h5>  <p class="font-weight-bold text-xs mb-0 text-white-50" style="margin-top: 15px;">Laporan Bulan Ini</p>
        </h5>
        </div>

        <div class="icon">
            <i class="fas fa-file-invoice"></i>
        </div>

        <a href="<?= site_url('laporan') ?>" class="small-box-footer text-xs text-white" style="color:rgba(255,255,255,0.8) !important;">
            Kelola <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

    <!-- Recent  -->
    <div class="col-md-6 col-12">
        <div class="card card-outline card-primary shadow-xs border-0">
            <div class="card-header bg-light d-flex align-items-center justify-content-between py-2">
                <h6 class="card-title font-weight-bold mb-0 text-dark"><i class="fas fa-receipt mr-2 text-primary"></i>orderan terbaru</h6>
                <?php if ($role == 'admin'): ?>
                    <a href="<?= site_url('sales_order/tambah') ?>" class="btn btn-xs btn-primary font-weight-bold ml-auto"><i class="fas fa-plus mr-1"></i> order baru</a>
                <?php endif; ?>
            </div>
            <div class="card-body p-0 table-responsive" style="max-height: 350px;">
                <table class="table table-hover table-striped text-xs text-nowrap mb-0">
                   <thead>
<tr>
    <th>No Order</th>
    <th>Pelanggan</th>
    <th>Sales</th>
    <th>Tanggal</th>
    <th>Status</th>
</tr>
</thead>

<tbody>
<?php if(empty($recent_orders)): ?>
<tr>
    <td colspan="5" class="text-center">
        Belum ada sales order.
    </td>
</tr>
<?php else: ?>
    <?php foreach($recent_orders as $r): ?>
    <tr>
        <td><?= $r->no_order ?></td>
        <td><?= $r->nama_pelanggan ?></td>
        <td><?= $r->nama ?></td>
        <td><?= date('d/m/Y',strtotime($r->tanggal_order)) ?></td>
        <td><?= ucfirst($r->status) ?></td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-secondary shadow-xs border-0">
            <div class="card-header bg-light py-2">
                <h6 class="card-title font-weight-bold text-dark mb-0"><i class="fas fa-info-circle text-secondary mr-2"></i>Status Sistem Manajemen Kantor Pelayanan</h6>
            </div>
            <div class="card-body py-3">
                <p class="mb-0 text-sm">
                    Sistem ini aktif dan terhubung ke basis data utama PT. Maju Jaya. Gunakan sidebar sebelah kiri untuk melakukan manajemen produk, pelanggan, sales, sales order, dan laporan penjualan.
                </p>
            </div>
        </div>
    </div>
</div>