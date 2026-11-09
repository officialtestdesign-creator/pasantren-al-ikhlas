<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $this->login();
    }

    public function login() {
        // If already logged in, redirect to respective role dashboard
        if (is_logged_in()) {
            $role = user_role();
            if ($role === 'admin') redirect('admin');
            if ($role === 'bendahara') redirect('bendahara');
            if ($role === 'pimpinan') redirect('pimpinan');
            redirect('admin');
        }

        // Ensure default accounts exist for testing all roles
        $this->User_model->ensure_default_roles();

        $data['title'] = 'Masuk ke Sistem - ' . ($this->profil->nama_dayah ?? 'LPI Dayah Al-Ikhlas');
        $this->load->view('auth/login', $data);
    }

    public function process() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array(
            'required' => 'Kolom %s wajib diisi.'
        ));
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required', array(
            'required' => 'Kolom %s wajib diisi.'
        ));

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            $this->login();
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        $user = $this->User_model->login($username, $password);

        if ($user) {
            $session_data = array(
                'user_id'   => $user->id,
                'nama'      => $user->nama,
                'username'  => $user->username,
                'role'      => $user->role,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);

            set_alert('success', 'Selamat datang kembali, <strong>' . html_escape($user->nama) . '</strong> (' . ucfirst($user->role) . ').');

            // Redirect based on role
            if ($user->role === 'admin') {
                redirect('admin');
            } elseif ($user->role === 'bendahara') {
                redirect('bendahara');
            } elseif ($user->role === 'pimpinan') {
                redirect('pimpinan');
            } else {
                redirect('admin');
            }
        } else {
            set_alert('danger', 'Username atau Kata Sandi salah. Silakan coba kembali.');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
