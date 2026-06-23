<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $data['title'] = 'Dashboard';

        // Statistik
        $data['total_produk'] = $this->db->count_all('produk');

        $data['total_pelanggan'] = $this->db->count_all('pelanggan');

        $data['total_sales'] = $this->db->count_all('sales');

        $data['total_sales_order'] = $this->db->count_all('sales_order');

       $data['pendapatan_bulan_ini'] = $this->db->query("
    SELECT COALESCE(SUM(total_harga),0) AS total
    FROM sales_order
    WHERE MONTH(tanggal_order) = MONTH(CURDATE())
    AND YEAR(tanggal_order) = YEAR(CURDATE())
")->row()->total;

        // Total pendapatan dari order yang selesai
        $this->db->select_sum('total_harga');
        $this->db->where('status', 'selesai');
        $data['total_pendapatan'] = $this->db->get('sales_order')->row()->total_harga ?? 0;

        // Order terbaru (5 data)
        $this->db->select('sales_order.*, pelanggan.nama_pelanggan, users.nama');
        $this->db->from('sales_order');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = sales_order.id_pelanggan');
        $this->db->join('users', 'users.id_user = sales_order.id_user');
        $this->db->order_by('sales_order.id_order', 'DESC');
        $this->db->limit(5);

        $data['recent_orders'] = $this->db->get()->result();

        // Produk terlaris
        $this->db->select('produk.nama_produk, SUM(sales_order_detail.qty) as total_terjual');
        $this->db->from('sales_order_detail');
        $this->db->join('produk', 'produk.id_produk = sales_order_detail.id_produk');
        $this->db->group_by('produk.id_produk');
        $this->db->order_by('total_terjual', 'DESC');
        $this->db->limit(5);

        $data['produk_terlaris'] = $this->db->get()->result();

        // Tampilkan dashboard
        $this->render_layout('dashboard/index', $data);
    }
}
