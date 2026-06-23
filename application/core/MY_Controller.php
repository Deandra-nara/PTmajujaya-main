<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $controller = strtolower($this->router->class);
        
        // 1. Session Protection: Redirect if not logged in (unless inside Auth controller)
        if ($controller !== 'auth') {
            if (!$this->session->userdata('logged_in')) {
                redirect('auth');
            }
            
            // 2. Role-based Route Restriction for Managers
            // Managers are only allowed to access dashboard, laporan, and auth/logout
            $role = $this->session->userdata('role');
            if ($role === 'manager') {
                $restricted_controllers = [
                    'kendaraan', 'pelanggan', 'supir',
                    'penyewaan', 'pembayaran', 'pengembalian'
                ];
                if (in_array($controller, $restricted_controllers)) {
                    $this->session->set_flashdata('error', 'Akses ditolak! Anda tidak memiliki izin untuk mengelola data master atau transaksi.');
                    redirect('dashboard');
                }
            }
        }
    }

    /**
     * Reusable standard layout rendering pattern.
     * Integrates header, sidebar, main content view, and footer dynamically.
     */
    protected function render_layout($view, $data = []) {
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view($view, $data);
        $this->load->view('layouts/footer');
    }
}
