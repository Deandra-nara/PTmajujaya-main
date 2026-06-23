
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!in_array($this->session->userdata('role'), ['admin','sales'])) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') == 'sales') {

            $this->db->where(
                'sales_order.id_user',
                $this->session->userdata('id_user')
            );
        }

        $this->db->select('sales_order.*, pelanggan.nama_pelanggan, users.nama');
        $this->db->from('sales_order');
        $this->db->join('pelanggan','pelanggan.id_pelanggan=sales_order.id_pelanggan');
        $this->db->join('users','users.id_user=sales_order.id_user');
        $data['sales_order'] = $this->db->get()->result();

        $data['title'] = 'Sales Order';

        $this->render_layout('sales_order/index',$data);
    }

    public function tambah()
    {
        if($this->input->post()){

            $produk = $this->db->get_where(
                'produk',
                ['id_produk'=>$this->input->post('id_produk')]
            )->row();

            $qty = (int)$this->input->post('qty');

            if($qty > $produk->stok){

                $this->session->set_flashdata(
                    'error',
                    'Stok tidak mencukupi'
                );

                redirect('sales_order/tambah');
            }

            $subtotal = $produk->harga * $qty;

            $order = [
                'no_order'      => 'SO'.date('YmdHis'),
                'tanggal_order' => date('Y-m-d H:i:s'),
                'id_pelanggan'  => $this->input->post('id_pelanggan'),
                'id_user'       => $this->session->userdata('id_user'),
                'total_harga'   => $subtotal,
                'status'        => 'draft'
            ];

            $this->db->insert('sales_order',$order);

            $id_order = $this->db->insert_id();

            $detail = [
                'id_order'  => $id_order,
                'id_produk' => $produk->id_produk,
                'qty'       => $qty,
                'harga'     => $produk->harga,
                'subtotal'  => $subtotal
            ];

            $this->db->insert(
                'sales_order_detail',
                $detail
            );

            $this->db->where(
                'id_produk',
                $produk->id_produk
            );

            $this->db->update('produk',[
                'stok' => $produk->stok - $qty
            ]);

            $this->session->set_flashdata(
                'success',
                'Sales Order berhasil dibuat'
            );

            redirect('sales_order');
        }

        $data['pelanggan'] = $this->db->get('pelanggan')->result();
        $data['produk'] = $this->db->get('produk')->result();
        $data['title'] = 'Tambah Sales Order';

        $this->render_layout('sales_order/tambah',$data);
    }

    public function detail($id)
    {
        $data['order'] = $this->db
            ->select('sales_order.*, pelanggan.nama_pelanggan, users.nama')
            ->from('sales_order')
            ->join('pelanggan','pelanggan.id_pelanggan=sales_order.id_pelanggan')
            ->join('users','users.id_user=sales_order.id_user')
            ->where('id_order',$id)
            ->get()
            ->row();

        $data['detail'] = $this->db
        ->select('sales_order_detail.*, produk.nama_produk, produk.kode_produk')
        ->from('sales_order_detail')
        ->join('produk','produk.id_produk=sales_order_detail.id_produk')
        ->where('id_order',$id)
        ->get()
        ->result();

        $data['title'] = 'Detail Sales Order';

        $this->render_layout('sales_order/detail',$data);
    }

   public function hapus($id)
{
    $this->db->delete(
        'sales_order_detail',
        ['id_order'=>$id]
    );

    $this->db->delete(
        'sales_order',
        ['id_order'=>$id]
    );

    $this->session->set_flashdata(
        'success',
        'Sales Order berhasil dihapus'
    );

    redirect('sales_order');
}

public function ubah_status($id_order, $status)
{
    $status_valid = ['draft','dikirim','selesai','dibatalkan'];

    if(!in_array($status, $status_valid)){
        show_404();
    }

    $this->db->where('id_order', $id_order);
    $this->db->update('sales_order', [
        'status' => $status
    ]);

    $this->session->set_flashdata(
        'success',
        'Status berhasil diubah menjadi '.$status
    );

    redirect('sales_order');
}
}