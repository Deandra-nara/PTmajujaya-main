<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Produk';
        $data['produk'] = $this->db->get('produk')->result();
        $this->render_layout('produk/index', $data);
    }

    public function tambah() {

        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required|is_unique[produk.kode_produk]');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == TRUE) {

            $data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('produk', $data);

            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
            redirect('produk');
        }

        $data['title'] = 'Tambah Produk';
        $this->render_layout('produk/tambah', $data);
    }

    public function edit($id) {

        $data['p'] = $this->db->get_where('produk', [
            'id_produk' => $id
        ])->row();

        if (!$data['p']) {
            show_404();
        }

        $kode_rule = 'required';
        if ($this->input->post('kode_produk') !== $data['p']->kode_produk) {
            $kode_rule .= '|is_unique[produk.kode_produk]';
        }

        $this->form_validation->set_rules('kode_produk', 'Kode Produk', $kode_rule);
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == TRUE) {

            $update_data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            ];

            $this->db->where('id_produk', $id);
            $this->db->update('produk', $update_data);

            $this->session->set_flashdata('success', 'Data produk berhasil diperbarui.');
            redirect('produk');
        }

        $data['title'] = 'Edit Produk';
        $this->render_layout('produk/edit', $data);
    }

    public function hapus($id) {

        // Cek apakah produk sudah digunakan pada detail order
        $cek = $this->db->get_where('sales_order_detail', [
            'id_produk' => $id
        ])->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata(
                'error',
                'Produk tidak dapat dihapus karena sudah digunakan pada transaksi.'
            );
            redirect('produk');
        }

        $this->db->where('id_produk', $id);
        $this->db->delete('produk');

        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('produk');
    }
}