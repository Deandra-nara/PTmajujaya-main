<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!in_array($this->session->userdata('role'),
            ['admin','manager']))
        {
            redirect('dashboard');
        }
    }

    public function index()
{
    $tanggal_awal  = $this->input->get('tanggal_awal');
    $tanggal_akhir = $this->input->get('tanggal_akhir');

    $where_tanggal = '';

    if($tanggal_awal && $tanggal_akhir){
        $where_tanggal = "
        AND DATE(so.tanggal_order)
        BETWEEN '$tanggal_awal'
        AND '$tanggal_akhir'
        ";
    }

    $data['laporan_sales'] = $this->db->query("
        SELECT
        u.nama,
        COUNT(so.id_order) AS jumlah_order,
        COALESCE(SUM(so.total_harga),0) AS total_penjualan
        FROM users u
        LEFT JOIN sales_order so
        ON so.id_user = u.id_user
        WHERE u.role='sales'
        $where_tanggal
        GROUP BY u.id_user
    ")->result();

    $data['laporan_produk'] = $this->db->query("
        SELECT
        p.kode_produk,
        p.nama_produk,
        COALESCE(SUM(d.qty),0) AS total_qty,
        COALESCE(SUM(d.subtotal),0) AS total_penjualan
        FROM produk p
        LEFT JOIN sales_order_detail d
        ON d.id_produk = p.id_produk
        LEFT JOIN sales_order so
        ON so.id_order = d.id_order
        WHERE 1=1
        $where_tanggal
        GROUP BY p.id_produk
    ")->result();

    $data['title'] = 'Laporan Penjualan';

    $this->render_layout('laporan/index',$data);
}
public function cetak()
{
    $tanggal_awal  = $this->input->get('tanggal_awal');
    $tanggal_akhir = $this->input->get('tanggal_akhir');

    $where_tanggal = '';

    if($tanggal_awal && $tanggal_akhir){
        $where_tanggal = "
        AND DATE(so.tanggal_order)
        BETWEEN '$tanggal_awal'
        AND '$tanggal_akhir'
        ";
    }

    $data['laporan_sales'] = $this->db->query("
        SELECT
        u.nama,
        COUNT(so.id_order) AS jumlah_order,
        COALESCE(SUM(so.total_harga),0) AS total_penjualan
        FROM users u
        LEFT JOIN sales_order so
        ON so.id_user = u.id_user
        WHERE u.role='sales'
        $where_tanggal
        GROUP BY u.id_user
    ")->result();

    $this->load->view('laporan/cetak',$data);
}

}