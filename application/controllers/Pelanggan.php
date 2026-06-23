
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {

        $data['title'] = 'Data Pelanggan';
        $data['pelanggan'] = $this->db->get('pelanggan')->result();

        $this->render_layout('pelanggan/index', $data);
    }

    public function tambah() {

        $this->form_validation->set_rules(
            'nama_pelanggan',
            'Nama Pelanggan',
            'required'
        );

        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required'
        );

        $this->form_validation->set_rules(
            'no_telp',
            'No Telepon',
            'required'
        );

        if ($this->form_validation->run() == TRUE) {

            $data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat'         => $this->input->post('alamat'),
                'no_telp'        => $this->input->post('no_telp'),
                'created_at'     => date('Y-m-d H:i:s')
            ];

            $this->db->insert('pelanggan', $data);

            $this->session->set_flashdata(
                'success',
                'Pelanggan berhasil ditambahkan.'
            );

            redirect('pelanggan');
        }

        $data['title'] = 'Tambah Pelanggan';
        $this->render_layout('pelanggan/tambah', $data);
    }

    public function edit($id) {

        $data['p'] = $this->db->get_where(
            'pelanggan',
            ['id_pelanggan' => $id]
        )->row();

        if (!$data['p']) {
            show_404();
        }

        $this->form_validation->set_rules(
            'nama_pelanggan',
            'Nama Pelanggan',
            'required'
        );

        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required'
        );

        $this->form_validation->set_rules(
            'no_telp',
            'No Telepon',
            'required'
        );

        if ($this->form_validation->run() == TRUE) {

            $update = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat'         => $this->input->post('alamat'),
                'no_telp'        => $this->input->post('no_telp')
            ];

            $this->db->where('id_pelanggan', $id);
            $this->db->update('pelanggan', $update);

            $this->session->set_flashdata(
                'success',
                'Data pelanggan berhasil diperbarui.'
            );

            redirect('pelanggan');
        }

        $data['title'] = 'Edit Pelanggan';
        $this->render_layout('pelanggan/edit', $data);
    }

    public function hapus($id) {

        $cek = $this->db->get_where(
            'sales_order',
            ['id_pelanggan' => $id]
        )->num_rows();

        if ($cek > 0) {

            $this->session->set_flashdata(
                'error',
                'Pelanggan tidak dapat dihapus karena sudah memiliki transaksi.'
            );

            redirect('pelanggan');
        }

        $this->db->where('id_pelanggan', $id);
        $this->db->delete('pelanggan');

        $this->session->set_flashdata(
            'success',
            'Pelanggan berhasil dihapus.'
        );

        redirect('pelanggan');
    }
}
