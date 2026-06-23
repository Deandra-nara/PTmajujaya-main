<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order_detail extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Menampilkan detail berdasarkan ID Order
    public function detail($id_order)
    {
        $data['title'] = 'Detail Sales Order';

        // Data header order
        $this->db->select('
            sales_order.*,
            pelanggan.nama_pelanggan,
            pelanggan.alamat,
            pelanggan.no_telp,
            users.nama AS nama_sales
        ');

        $this->db->from('sales_order');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = sales_order.id_pelanggan');
        $this->db->join('users', 'users.id_user = sales_order.id_user');
        $this->db->where('sales_order.id_order', $id_order);

        $data['order'] = $this->db->get()->row();

        // Jika order tidak ditemukan
        if (!$data['order']) {
            show_404();
        }

        // Detail produk
        $this->db->select('
            sales_order_detail.*,
            produk.kode_produk,
            produk.nama_produk
        ');

        $this->db->from('sales_order_detail');
        $this->db->join(
            'produk',
            'produk.id_produk = sales_order_detail.id_produk'
        );

        $this->db->where(
            'sales_order_detail.id_order',
            $id_order
        );

        $data['detail'] = $this->db->get()->result();

        $this->render_layout('sales_order_detail/detail', $data);
    }
}