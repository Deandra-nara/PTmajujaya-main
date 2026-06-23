
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $this->load->view('auth/login');
    }

    public function login() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', [
            'username' => $username,
            'password' => $password
        ])->row();

        if ($user) {

            $this->session->set_userdata([
                'id_user'   => $user->id_user,
                'nama'      => $user->nama,
                'role'      => $user->role,
                'logged_in' => TRUE
            ]);

            redirect('dashboard');
        }

        $this->session->set_flashdata(
            'error',
            'Username atau Password salah'
        );

        redirect('auth');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
