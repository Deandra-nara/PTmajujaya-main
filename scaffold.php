<?php

$dir = __DIR__;
$appDir = $dir . '/application';

// Helper function to create file and directory if not exists
function createFile($path, $content) {
    global $appDir;
    $fullPath = $appDir . '/' . $path;
    $dirPath = dirname($fullPath);
    if (!is_dir($dirPath)) {
        mkdir($dirPath, 0777, true);
    }
    file_put_contents($fullPath, $content);
    echo "Created: $path\n";
}

// 1. Controllers

$authController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function index() {
        if ($this->session->userdata('logged_in')) redirect('dashboard');
        $this->load->view('auth/login');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $admin = $this->db->get_where('admin', ['username' => $username, 'password' => $password])->row();
        if ($admin) {
            $this->session->set_userdata(['id' => $admin->id_admin, 'name' => $admin->nama_admin, 'role' => 'admin', 'logged_in' => TRUE]);
            redirect('dashboard');
        }

        $manager = $this->db->get_where('manager', ['username' => $username, 'password' => $password])->row();
        if ($manager) {
            $this->session->set_userdata(['id' => $manager->id_manager, 'name' => $manager->nama_manager, 'role' => 'manager', 'logged_in' => TRUE]);
            redirect('dashboard');
        }

        $this->session->set_flashdata('error', 'Invalid username or password');
        redirect('auth');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
EOD;

$dashboardController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) redirect('auth');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['total_kendaraan'] = $this->db->count_all('kendaraan');
        $data['total_pelanggan'] = $this->db->count_all('pelanggan');
        $data['total_penyewaan'] = $this->db->count_all('penyewaan');
        
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('layouts/footer');
    }
}
EOD;

$kendaraanController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') redirect('dashboard');
    }

    public function index() {
        $data['title'] = 'Kendaraan';
        $data['kendaraan'] = $this->db->get('kendaraan')->result();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('kendaraan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        if ($this->input->post()) {
            $data = [
                'merk' => $this->input->post('merk'),
                'tipe' => $this->input->post('tipe'),
                'plat_nomor' => $this->input->post('plat_nomor'),
                'tahun' => $this->input->post('tahun'),
                'warna' => $this->input->post('warna'),
                'harga_sewa_jam' => $this->input->post('harga_sewa_jam'),
                'harga_sewa_harian' => $this->input->post('harga_sewa_harian'),
                'status_kendaraan' => $this->input->post('status_kendaraan')
            ];
            $this->db->insert('kendaraan', $data);
            redirect('kendaraan');
        }
        $data['title'] = 'Tambah Kendaraan';
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('kendaraan/tambah', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = [
                'merk' => $this->input->post('merk'),
                'tipe' => $this->input->post('tipe'),
                'plat_nomor' => $this->input->post('plat_nomor'),
                'tahun' => $this->input->post('tahun'),
                'warna' => $this->input->post('warna'),
                'harga_sewa_jam' => $this->input->post('harga_sewa_jam'),
                'harga_sewa_harian' => $this->input->post('harga_sewa_harian'),
                'status_kendaraan' => $this->input->post('status_kendaraan')
            ];
            $this->db->where('id_kendaraan', $id);
            $this->db->update('kendaraan', $data);
            redirect('kendaraan');
        }
        $data['title'] = 'Edit Kendaraan';
        $data['k'] = $this->db->get_where('kendaraan', ['id_kendaraan' => $id])->row();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('kendaraan/edit', $data);
        $this->load->view('layouts/footer');
    }

    public function hapus($id) {
        $this->db->where('id_kendaraan', $id);
        $this->db->delete('kendaraan');
        redirect('kendaraan');
    }
}
EOD;

$pelangganController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') redirect('dashboard');
    }

    public function index() {
        $data['title'] = 'Pelanggan';
        $data['pelanggan'] = $this->db->get('pelanggan')->result();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('pelanggan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        if ($this->input->post()) {
            $data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'no_ktp' => $this->input->post('no_ktp'),
                'status_member' => $this->input->post('status_member')
            ];
            $this->db->insert('pelanggan', $data);
            redirect('pelanggan');
        }
        $data['title'] = 'Tambah Pelanggan';
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('pelanggan/tambah', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'no_ktp' => $this->input->post('no_ktp'),
                'status_member' => $this->input->post('status_member')
            ];
            $this->db->where('id_pelanggan', $id);
            $this->db->update('pelanggan', $data);
            redirect('pelanggan');
        }
        $data['title'] = 'Edit Pelanggan';
        $data['p'] = $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->row();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('pelanggan/edit', $data);
        $this->load->view('layouts/footer');
    }

    public function hapus($id) {
        $this->db->where('id_pelanggan', $id);
        $this->db->delete('pelanggan');
        redirect('pelanggan');
    }
}
EOD;

$supirController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supir extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') redirect('dashboard');
    }

    public function index() {
        $data['title'] = 'Supir';
        $data['supir'] = $this->db->get('supir')->result();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('supir/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        if ($this->input->post()) {
            $data = [
                'nama_supir' => $this->input->post('nama_supir'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'no_sim' => $this->input->post('no_sim'),
                'tarif_supir' => $this->input->post('tarif_supir'),
                'status_supir' => $this->input->post('status_supir')
            ];
            $this->db->insert('supir', $data);
            redirect('supir');
        }
        $data['title'] = 'Tambah Supir';
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('supir/tambah', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = [
                'nama_supir' => $this->input->post('nama_supir'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'no_sim' => $this->input->post('no_sim'),
                'tarif_supir' => $this->input->post('tarif_supir'),
                'status_supir' => $this->input->post('status_supir')
            ];
            $this->db->where('id_supir', $id);
            $this->db->update('supir', $data);
            redirect('supir');
        }
        $data['title'] = 'Edit Supir';
        $data['s'] = $this->db->get_where('supir', ['id_supir' => $id])->row();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('supir/edit', $data);
        $this->load->view('layouts/footer');
    }

    public function hapus($id) {
        $this->db->where('id_supir', $id);
        $this->db->delete('supir');
        redirect('supir');
    }
}
EOD;

$penyewaanController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewaan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') redirect('dashboard');
    }

    public function index() {
        $data['title'] = 'Penyewaan';
        $this->db->select('penyewaan.*, pelanggan.nama_pelanggan');
        $this->db->from('penyewaan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penyewaan.id_pelanggan');
        $data['penyewaan'] = $this->db->get()->result();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('penyewaan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        if ($this->input->post()) {
            $data = [
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_admin' => $this->session->userdata('id'),
                'tanggal_sewa' => $this->input->post('tanggal_sewa'),
                'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                'durasi_sewa' => $this->input->post('durasi_sewa'),
                'status_penyewaan' => 'berjalan',
                'total_biaya' => $this->input->post('total_biaya')
            ];
            $this->db->insert('penyewaan', $data);
            $id_penyewaan = $this->db->insert_id();

            // Insert details
            $id_kendaraan = $this->input->post('id_kendaraan');
            $id_supir = $this->input->post('id_supir');

            $detail = [
                'id_penyewaan' => $id_penyewaan,
                'id_kendaraan' => $id_kendaraan,
                'id_supir' => $id_supir ? $id_supir : NULL,
            ];
            $this->db->insert('detail_penyewaan', $detail);

            // Update status
            $this->db->where('id_kendaraan', $id_kendaraan);
            $this->db->update('kendaraan', ['status_kendaraan' => 'rented']);

            if ($id_supir) {
                $this->db->where('id_supir', $id_supir);
                $this->db->update('supir', ['status_supir' => 'on_trip']);
            }

            redirect('penyewaan');
        }
        $data['title'] = 'Tambah Penyewaan';
        $data['pelanggan'] = $this->db->get('pelanggan')->result();
        $data['kendaraan'] = $this->db->get_where('kendaraan', ['status_kendaraan' => 'available'])->result();
        $data['supir'] = $this->db->get_where('supir', ['status_supir' => 'available'])->result();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('penyewaan/tambah', $data);
        $this->load->view('layouts/footer');
    }
}
EOD;

$pembayaranController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') redirect('dashboard');
    }

    public function index() {
        $data['title'] = 'Pembayaran';
        $this->db->select('pembayaran.*, penyewaan.total_biaya, pelanggan.nama_pelanggan');
        $this->db->from('pembayaran');
        $this->db->join('penyewaan', 'penyewaan.id_penyewaan = pembayaran.id_penyewaan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penyewaan.id_pelanggan');
        $data['pembayaran'] = $this->db->get()->result();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('pembayaran/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah($id_penyewaan = null) {
        if ($this->input->post()) {
            $data = [
                'id_penyewaan' => $this->input->post('id_penyewaan'),
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'metode_pembayaran' => $this->input->post('metode_pembayaran'),
                'jumlah_bayar' => $this->input->post('jumlah_bayar'),
                'status_pembayaran' => 'paid'
            ];
            $this->db->insert('pembayaran', $data);
            redirect('pembayaran');
        }
        $data['title'] = 'Proses Pembayaran';
        $data['penyewaan'] = $this->db->get_where('penyewaan', ['status_penyewaan' => 'berjalan'])->result();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('pembayaran/tambah', $data);
        $this->load->view('layouts/footer');
    }
}
EOD;

$pengembalianController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') redirect('dashboard');
    }

    public function index() {
        $data['title'] = 'Pengembalian';
        $this->db->select('pengembalian.*, penyewaan.id_penyewaan, pelanggan.nama_pelanggan');
        $this->db->from('pengembalian');
        $this->db->join('penyewaan', 'penyewaan.id_penyewaan = pengembalian.id_penyewaan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penyewaan.id_pelanggan');
        $data['pengembalian'] = $this->db->get()->result();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('pengembalian/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        if ($this->input->post()) {
            $id_penyewaan = $this->input->post('id_penyewaan');
            $data = [
                'id_penyewaan' => $id_penyewaan,
                'tanggal_pengembalian' => date('Y-m-d H:i:s'),
                'keterlambatan' => $this->input->post('keterlambatan'),
                'denda_keterlambatan' => $this->input->post('denda_keterlambatan'),
                'kondisi_kendaraan' => $this->input->post('kondisi_kendaraan'),
                'catatan_pengembalian' => $this->input->post('catatan_pengembalian')
            ];
            $this->db->insert('pengembalian', $data);

            // Update rental status
            $this->db->where('id_penyewaan', $id_penyewaan);
            $this->db->update('penyewaan', ['status_penyewaan' => 'selesai']);

            // Update vehicle and driver status
            $detail = $this->db->get_where('detail_penyewaan', ['id_penyewaan' => $id_penyewaan])->row();
            if ($detail) {
                $this->db->where('id_kendaraan', $detail->id_kendaraan);
                $this->db->update('kendaraan', ['status_kendaraan' => 'available']);

                if ($detail->id_supir) {
                    $this->db->where('id_supir', $detail->id_supir);
                    $this->db->update('supir', ['status_supir' => 'available']);
                }
            }
            redirect('pengembalian');
        }

        $data['title'] = 'Proses Pengembalian';
        $data['penyewaan'] = $this->db->get_where('penyewaan', ['status_penyewaan' => 'berjalan'])->result();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('pengembalian/tambah', $data);
        $this->load->view('layouts/footer');
    }
}
EOD;

$laporanController = <<<'EOD'
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) redirect('auth');
    }

    public function index() {
        $data['title'] = 'Laporan Operasional & Pendapatan';
        $data['total_penyewaan'] = $this->db->count_all('penyewaan');
        $data['total_pendapatan'] = $this->db->select_sum('jumlah_bayar')->get('pembayaran')->row()->jumlah_bayar;
        $data['total_denda'] = $this->db->select_sum('denda_keterlambatan')->get('pengembalian')->row()->denda_keterlambatan;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('laporan/index', $data);
        $this->load->view('layouts/footer');
    }
}
EOD;


createFile('controllers/Auth.php', $authController);
createFile('controllers/Dashboard.php', $dashboardController);
createFile('controllers/Kendaraan.php', $kendaraanController);
createFile('controllers/Pelanggan.php', $pelangganController);
createFile('controllers/Supir.php', $supirController);
createFile('controllers/Penyewaan.php', $penyewaanController);
createFile('controllers/Pembayaran.php', $pembayaranController);
createFile('controllers/Pengembalian.php', $pengembalianController);
createFile('controllers/Laporan.php', $laporanController);


// 2. Views - Layouts

$headerView = <<<'EOD'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Global RentCar' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #0b2e59; color: white; }
        .sidebar a { color: #cfd8dc; text-decoration: none; display: block; padding: 10px; }
        .sidebar a:hover { background-color: #1a4a87; color: white; }
        .main-content { padding: 20px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
EOD;

$sidebarView = <<<'EOD'
        <div class="col-md-2 sidebar p-0">
            <h4 class="text-center py-3 m-0 bg-primary text-white">Global RentCar</h4>
            <div class="p-3">
                <a href="<?= site_url('dashboard') ?>">Dashboard</a>
                <?php if($this->session->userdata('role') == 'admin'): ?>
                <a href="<?= site_url('kendaraan') ?>">Kendaraan</a>
                <a href="<?= site_url('pelanggan') ?>">Pelanggan</a>
                <a href="<?= site_url('supir') ?>">Supir</a>
                <a href="<?= site_url('penyewaan') ?>">Penyewaan</a>
                <a href="<?= site_url('pembayaran') ?>">Pembayaran</a>
                <a href="<?= site_url('pengembalian') ?>">Pengembalian</a>
                <?php endif; ?>
                <a href="<?= site_url('laporan') ?>">Laporan</a>
                <a href="<?= site_url('auth/logout') ?>" class="text-danger mt-4">Logout</a>
            </div>
        </div>
        <div class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><?= $title ?? 'Dashboard' ?></h2>
                <div>
                    Welcome, <strong><?= $this->session->userdata('name') ?></strong> (<?= ucfirst($this->session->userdata('role')) ?>)
                </div>
            </div>
EOD;

$footerView = <<<'EOD'
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
EOD;

createFile('views/layouts/header.php', $headerView);
createFile('views/layouts/sidebar.php', $sidebarView);
createFile('views/layouts/footer.php', $footerView);


// 3. Views - Auth

$loginView = <<<'EOD'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Global RentCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b2e59; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .card { width: 100%; max-width: 400px; padding: 20px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="card shadow">
        <h3 class="text-center mb-4">Global RentCar</h3>
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= site_url('auth/login') ?>" method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
EOD;

createFile('views/auth/login.php', $loginView);


// 4. Views - Dashboard

$dashboardIndex = <<<'EOD'
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Kendaraan</h5>
                <h2><?= $total_kendaraan ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Pelanggan</h5>
                <h2><?= $total_pelanggan ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Penyewaan</h5>
                <h2><?= $total_penyewaan ?></h2>
            </div>
        </div>
    </div>
</div>
EOD;

createFile('views/dashboard/index.php', $dashboardIndex);


// 5. Views - Kendaraan

$kendaraanIndex = <<<'EOD'
<a href="<?= site_url('kendaraan/tambah') ?>" class="btn btn-success mb-3">Tambah Kendaraan</a>
<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>Plat Nomor</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($kendaraan as $k): ?>
        <tr>
            <td><?= $k->id_kendaraan ?></td>
            <td><?= $k->merk ?></td>
            <td><?= $k->tipe ?></td>
            <td><?= $k->plat_nomor ?></td>
            <td><?= $k->status_kendaraan ?></td>
            <td>
                <a href="<?= site_url('kendaraan/edit/'.$k->id_kendaraan) ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="<?= site_url('kendaraan/hapus/'.$k->id_kendaraan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
EOD;

$kendaraanTambah = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Merk</label>
            <input type="text" name="merk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <input type="text" name="tipe" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Plat Nomor</label>
            <input type="text" name="plat_nomor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control">
        </div>
        <div class="mb-3">
            <label>Warna</label>
            <input type="text" name="warna" class="form-control">
        </div>
        <div class="mb-3">
            <label>Harga Sewa Per Jam</label>
            <input type="number" name="harga_sewa_jam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Sewa Per Hari</label>
            <input type="number" name="harga_sewa_harian" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_kendaraan" class="form-control">
                <option value="available">Available</option>
                <option value="rented">Rented</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('kendaraan') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

$kendaraanEdit = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Merk</label>
            <input type="text" name="merk" value="<?= $k->merk ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <input type="text" name="tipe" value="<?= $k->tipe ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Plat Nomor</label>
            <input type="text" name="plat_nomor" value="<?= $k->plat_nomor ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" value="<?= $k->tahun ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Warna</label>
            <input type="text" name="warna" value="<?= $k->warna ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Harga Sewa Per Jam</label>
            <input type="number" name="harga_sewa_jam" value="<?= $k->harga_sewa_jam ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Sewa Per Hari</label>
            <input type="number" name="harga_sewa_harian" value="<?= $k->harga_sewa_harian ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_kendaraan" class="form-control">
                <option value="available" <?= $k->status_kendaraan == 'available' ? 'selected' : '' ?>>Available</option>
                <option value="rented" <?= $k->status_kendaraan == 'rented' ? 'selected' : '' ?>>Rented</option>
                <option value="maintenance" <?= $k->status_kendaraan == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('kendaraan') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

createFile('views/kendaraan/index.php', $kendaraanIndex);
createFile('views/kendaraan/tambah.php', $kendaraanTambah);
createFile('views/kendaraan/edit.php', $kendaraanEdit);


// 6. Views - Pelanggan

$pelangganIndex = <<<'EOD'
<a href="<?= site_url('pelanggan/tambah') ?>" class="btn btn-success mb-3">Tambah Pelanggan</a>
<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>No KTP</th>
            <th>Status Member</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pelanggan as $p): ?>
        <tr>
            <td><?= $p->id_pelanggan ?></td>
            <td><?= $p->nama_pelanggan ?></td>
            <td><?= $p->no_hp ?></td>
            <td><?= $p->no_ktp ?></td>
            <td><?= $p->status_member ?></td>
            <td>
                <a href="<?= site_url('pelanggan/edit/'.$p->id_pelanggan) ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="<?= site_url('pelanggan/hapus/'.$p->id_pelanggan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
EOD;

$pelangganTambah = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>
        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status Member</label>
            <input type="text" name="status_member" class="form-control">
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('pelanggan') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

$pelangganEdit = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="<?= $p->nama_pelanggan ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= $p->alamat ?></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" value="<?= $p->no_hp ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" value="<?= $p->no_ktp ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status Member</label>
            <input type="text" name="status_member" value="<?= $p->status_member ?>" class="form-control">
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('pelanggan') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

createFile('views/pelanggan/index.php', $pelangganIndex);
createFile('views/pelanggan/tambah.php', $pelangganTambah);
createFile('views/pelanggan/edit.php', $pelangganEdit);


// 7. Views - Supir

$supirIndex = <<<'EOD'
<a href="<?= site_url('supir/tambah') ?>" class="btn btn-success mb-3">Tambah Supir</a>
<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Tarif</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($supir as $s): ?>
        <tr>
            <td><?= $s->id_supir ?></td>
            <td><?= $s->nama_supir ?></td>
            <td><?= $s->no_hp ?></td>
            <td><?= $s->tarif_supir ?></td>
            <td><?= $s->status_supir ?></td>
            <td>
                <a href="<?= site_url('supir/edit/'.$s->id_supir) ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="<?= site_url('supir/hapus/'.$s->id_supir) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
EOD;

$supirTambah = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Nama Supir</label>
            <input type="text" name="nama_supir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>
        <div class="mb-3">
            <label>No SIM</label>
            <input type="text" name="no_sim" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tarif Supir</label>
            <input type="number" name="tarif_supir" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_supir" class="form-control">
                <option value="available">Available</option>
                <option value="on_trip">On Trip</option>
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('supir') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

$supirEdit = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Nama Supir</label>
            <input type="text" name="nama_supir" value="<?= $s->nama_supir ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= $s->alamat ?></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" value="<?= $s->no_hp ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>No SIM</label>
            <input type="text" name="no_sim" value="<?= $s->no_sim ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tarif Supir</label>
            <input type="number" name="tarif_supir" value="<?= $s->tarif_supir ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_supir" class="form-control">
                <option value="available" <?= $s->status_supir == 'available' ? 'selected' : '' ?>>Available</option>
                <option value="on_trip" <?= $s->status_supir == 'on_trip' ? 'selected' : '' ?>>On Trip</option>
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('supir') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

createFile('views/supir/index.php', $supirIndex);
createFile('views/supir/tambah.php', $supirTambah);
createFile('views/supir/edit.php', $supirEdit);


// 8. Views - Penyewaan

$penyewaanIndex = <<<'EOD'
<a href="<?= site_url('penyewaan/tambah') ?>" class="btn btn-success mb-3">Tambah Penyewaan</a>
<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Tgl Sewa</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Total Biaya</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($penyewaan as $p): ?>
        <tr>
            <td><?= $p->id_penyewaan ?></td>
            <td><?= $p->nama_pelanggan ?></td>
            <td><?= $p->tanggal_sewa ?></td>
            <td><?= $p->tanggal_kembali ?></td>
            <td><span class="badge bg-<?= $p->status_penyewaan == 'selesai' ? 'success' : 'warning' ?>"><?= $p->status_penyewaan ?></span></td>
            <td>Rp <?= number_format($p->total_biaya, 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
EOD;

$penyewaanTambah = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Pelanggan</label>
            <select name="id_pelanggan" class="form-control" required>
                <?php foreach($pelanggan as $p): ?>
                    <option value="<?= $p->id_pelanggan ?>"><?= $p->nama_pelanggan ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Kendaraan (Tersedia)</label>
            <select name="id_kendaraan" class="form-control" required>
                <?php foreach($kendaraan as $k): ?>
                    <option value="<?= $k->id_kendaraan ?>"><?= $k->merk ?> - <?= $k->plat_nomor ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Supir (Opsional)</label>
            <select name="id_supir" class="form-control">
                <option value="">Tanpa Supir</option>
                <?php foreach($supir as $s): ?>
                    <option value="<?= $s->id_supir ?>"><?= $s->nama_supir ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Sewa</label>
            <input type="datetime-local" name="tanggal_sewa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="datetime-local" name="tanggal_kembali" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Durasi (Hari)</label>
            <input type="number" name="durasi_sewa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Total Biaya Est.</label>
            <input type="number" name="total_biaya" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan Penyewaan</button>
        <a href="<?= site_url('penyewaan') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

createFile('views/penyewaan/index.php', $penyewaanIndex);
createFile('views/penyewaan/tambah.php', $penyewaanTambah);


// 9. Views - Pembayaran

$pembayaranIndex = <<<'EOD'
<a href="<?= site_url('pembayaran/tambah') ?>" class="btn btn-success mb-3">Proses Pembayaran Baru</a>
<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr>
            <th>ID Bayar</th>
            <th>ID Sewa</th>
            <th>Pelanggan</th>
            <th>Tanggal Bayar</th>
            <th>Metode</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pembayaran as $p): ?>
        <tr>
            <td><?= $p->id_pembayaran ?></td>
            <td><?= $p->id_penyewaan ?></td>
            <td><?= $p->nama_pelanggan ?></td>
            <td><?= $p->tanggal_bayar ?></td>
            <td><?= $p->metode_pembayaran ?></td>
            <td>Rp <?= number_format($p->jumlah_bayar, 0, ',', '.') ?></td>
            <td><span class="badge bg-success"><?= $p->status_pembayaran ?></span></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
EOD;

$pembayaranTambah = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Transaksi Penyewaan (Yang Sedang Berjalan)</label>
            <select name="id_penyewaan" class="form-control" required>
                <?php foreach($penyewaan as $p): ?>
                    <option value="<?= $p->id_penyewaan ?>">ID: <?= $p->id_penyewaan ?> | Total: Rp <?= number_format($p->total_biaya, 0, ',', '.') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control">
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" class="form-control" required>
        </div>
        <button class="btn btn-primary">Proses Pembayaran</button>
        <a href="<?= site_url('pembayaran') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

createFile('views/pembayaran/index.php', $pembayaranIndex);
createFile('views/pembayaran/tambah.php', $pembayaranTambah);


// 10. Views - Pengembalian

$pengembalianIndex = <<<'EOD'
<a href="<?= site_url('pengembalian/tambah') ?>" class="btn btn-success mb-3">Proses Pengembalian Baru</a>
<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr>
            <th>ID Kembali</th>
            <th>ID Sewa</th>
            <th>Pelanggan</th>
            <th>Tgl Kembali</th>
            <th>Denda</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pengembalian as $p): ?>
        <tr>
            <td><?= $p->id_pengembalian ?></td>
            <td><?= $p->id_penyewaan ?></td>
            <td><?= $p->nama_pelanggan ?></td>
            <td><?= $p->tanggal_pengembalian ?></td>
            <td>Rp <?= number_format($p->denda_keterlambatan, 0, ',', '.') ?></td>
            <td><?= $p->kondisi_kendaraan ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
EOD;

$pengembalianTambah = <<<'EOD'
<div class="card p-4">
    <form action="" method="post">
        <div class="mb-3">
            <label>Transaksi Penyewaan</label>
            <select name="id_penyewaan" class="form-control" required>
                <?php foreach($penyewaan as $p): ?>
                    <option value="<?= $p->id_penyewaan ?>">ID: <?= $p->id_penyewaan ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Keterlambatan (Hari)</label>
            <input type="number" name="keterlambatan" class="form-control" value="0" required>
        </div>
        <div class="mb-3">
            <label>Denda Keterlambatan</label>
            <input type="number" name="denda_keterlambatan" class="form-control" value="0" required>
        </div>
        <div class="mb-3">
            <label>Kondisi Kendaraan</label>
            <input type="text" name="kondisi_kendaraan" class="form-control">
        </div>
        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan_pengembalian" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary">Proses Pengembalian</button>
        <a href="<?= site_url('pengembalian') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
EOD;

createFile('views/pengembalian/index.php', $pengembalianIndex);
createFile('views/pengembalian/tambah.php', $pengembalianTambah);


// 11. Views - Laporan

$laporanIndex = <<<'EOD'
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">Laporan Operasional</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Transaksi Penyewaan
                        <span class="badge bg-primary rounded-pill"><?= $total_penyewaan ?></span>
                    </li>
                </ul>
                <button class="btn btn-outline-primary mt-3 w-100" onclick="window.print()">Cetak Laporan</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4 shadow">
            <div class="card-header bg-success text-white">Laporan Pendapatan</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Pendapatan Penyewaan
                        <span class="badge bg-success rounded-pill">Rp <?= number_format((float)$total_pendapatan, 0, ',', '.') ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Pendapatan Denda
                        <span class="badge bg-warning rounded-pill">Rp <?= number_format((float)$total_denda, 0, ',', '.') ?></span>
                    </li>
                </ul>
                <button class="btn btn-outline-success mt-3 w-100" onclick="window.print()">Cetak Pendapatan</button>
            </div>
        </div>
    </div>
</div>
EOD;

createFile('views/laporan/index.php', $laporanIndex);

echo "Scaffolding completed!\n";
?>
