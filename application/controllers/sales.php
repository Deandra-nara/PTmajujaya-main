<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MY_Controller {

    public function index()
    {
        $data['title'] = 'Data Sales';
        $data['sales'] = $this->db->get('sales')->result();

        $this->render_layout('sales/index', $data);
    }

    public function tambah()
    {
        if($this->input->post()){

            $data = [
                'kode_sales' => $this->input->post('kode_sales'),
                'nama_sales' => $this->input->post('nama_sales')
            ];

            $this->db->insert('sales', $data);

            $this->session->set_flashdata(
                'success',
                'Data sales berhasil ditambahkan'
            );

            redirect('sales');
        }

        $data['title'] = 'Tambah Sales';

        $this->render_layout('sales/tambah', $data);
    }

    public function edit($id)
    {
        $sales = $this->db->get_where(
            'sales',
            ['id_sales'=>$id]
        )->row();

        if(!$sales){
            show_404();
        }

        if($this->input->post()){

            $data = [
                'kode_sales' => $this->input->post('kode_sales'),
                'nama_sales' => $this->input->post('nama_sales')
            ];

            $this->db->where('id_sales', $id);
            $this->db->update('sales', $data);

            $this->session->set_flashdata(
                'success',
                'Data sales berhasil diubah'
            );

            redirect('sales');
        }

        $data['sales'] = $sales;
        $data['title'] = 'Edit Sales';

        $this->render_layout('sales/edit', $data);
    }

    public function hapus($id)
    {
        $this->db->delete(
            'sales',
            ['id_sales'=>$id]
        );

        $this->session->set_flashdata(
            'success',
            'Data sales berhasil dihapus'
        );

        redirect('sales');
    }
}