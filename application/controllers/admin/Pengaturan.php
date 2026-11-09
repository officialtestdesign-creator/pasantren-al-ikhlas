<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profil_model');
        $this->load->model('User_model');
        $this->load->model('Pembayaran_model');
    }

    public function index() {
        $data['title'] = 'Pengaturan Lembaga, Tarif & Pengguna Sistem';

        $tab = $this->input->get('tab', TRUE) ?: 'profil';
        $data['active_tab'] = $tab;

        // Data Profil
        $data['profil'] = $this->Profil_model->get_profil();

        // Data Tahun Ajaran
        $data['ta_list'] = $this->db->order_by('id', 'DESC')->get('tahun_ajaran')->result();

        // Data Tarif Pembayaran
        $data['jenis_pembayaran'] = $this->Pembayaran_model->get_jenis_pembayaran();

        // Data Pengguna
        $data['user_list'] = $this->db->order_by('role', 'ASC')->get('users')->result();

        $this->render_admin('admin/pengaturan/index', $data);
    }

    public function simpan_profil() {
        $data_update = array(
            'nama_dayah'         => $this->input->post('nama_dayah', TRUE),
            'tahun_berdiri'      => $this->input->post('tahun_berdiri', TRUE),
            'status_kelembagaan' => $this->input->post('status_kelembagaan', TRUE),
            'izin_operasional'   => $this->input->post('izin_operasional', TRUE),
            'nama_pimpinan'      => $this->input->post('nama_pimpinan', TRUE),
            'gampong'            => $this->input->post('gampong', TRUE),
            'kemukiman'          => $this->input->post('kemukiman', TRUE),
            'kecamatan'          => $this->input->post('kecamatan', TRUE),
            'kabupaten'          => $this->input->post('kabupaten', TRUE),
            'no_hp'              => $this->input->post('no_hp', TRUE),
            'email'              => $this->input->post('email', TRUE),
            'visi'               => $this->input->post('visi', TRUE),
            'misi'               => $this->input->post('misi', TRUE),
            'sejarah'            => $this->input->post('sejarah', TRUE)
        );

        $this->Profil_model->update_profil($data_update);
        set_alert('success', 'Profil kelembagaan dayah berhasil diperbarui.');
        redirect('admin/pengaturan?tab=profil');
    }

    public function simpan_tahun_ajaran() {
        $nama = $this->input->post('nama', TRUE);
        $tgl_mulai = $this->input->post('tanggal_mulai', TRUE) ?: null;
        $tgl_selesai = $this->input->post('tanggal_selesai', TRUE) ?: null;

        if (empty($nama)) {
            set_alert('danger', 'Nama tahun ajaran wajib diisi.');
            redirect('admin/pengaturan?tab=tahun_ajaran');
            return;
        }

        $this->db->insert('tahun_ajaran', array(
            'nama'            => $nama,
            'tanggal_mulai'   => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai,
            'aktif'           => 0
        ));

        set_alert('success', 'Tahun ajaran baru berhasil ditambahkan.');
        redirect('admin/pengaturan?tab=tahun_ajaran');
    }

    public function set_tahun_ajaran_aktif($id) {
        $this->db->update('tahun_ajaran', array('aktif' => 0));
        $this->db->where('id', $id)->update('tahun_ajaran', array('aktif' => 1));

        set_alert('success', 'Tahun ajaran aktif berhasil dialihkan.');
        redirect('admin/pengaturan?tab=tahun_ajaran');
    }

    public function update_tarif() {
        $id = $this->input->post('id', TRUE);
        $nominal = $this->input->post('nominal', TRUE);

        $this->db->where('id', $id)->update('jenis_pembayaran', array(
            'nominal' => (float)$nominal
        ));

        set_alert('success', 'Tarif biaya pembayaran berhasil disesuaikan.');
        redirect('admin/pengaturan?tab=tarif');
    }

    public function simpan_user() {
        $nama = $this->input->post('nama', TRUE);
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $role = $this->input->post('role', TRUE);

        if (empty($nama) || empty($username) || empty($password) || empty($role)) {
            set_alert('danger', 'Semua kolom pengguna wajib diisi.');
            redirect('admin/pengaturan?tab=pengguna');
            return;
        }

        $exist = $this->db->get_where('users', array('username' => $username))->row();
        if ($exist) {
            set_alert('danger', 'Username tersebut sudah digunakan oleh akun lain.');
            redirect('admin/pengaturan?tab=pengguna');
            return;
        }

        $this->db->insert('users', array(
            'nama'          => $nama,
            'username'      => $username,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'role'          => $role,
            'aktif'         => 1
        ));

        set_alert('success', 'Akun pengguna baru berhasil dibuat.');
        redirect('admin/pengaturan?tab=pengguna');
    }

    public function ganti_password_user() {
        $user_id = $this->input->post('user_id', TRUE);
        $password_baru = $this->input->post('password_baru', TRUE);

        if (empty($password_baru) || strlen($password_baru) < 4) {
            set_alert('danger', 'Password baru minimal 4 karakter.');
            redirect('admin/pengaturan?tab=pengguna');
            return;
        }

        $this->db->where('id', $user_id)->update('users', array(
            'password_hash' => password_hash($password_baru, PASSWORD_BCRYPT)
        ));

        set_alert('success', 'Kata sandi pengguna berhasil diperbarui.');
        redirect('admin/pengaturan?tab=pengguna');
    }

    public function hapus_user($id) {
        if ($id == user_id()) {
            set_alert('danger', 'Anda tidak dapat menghapus akun yang sedang Anda gunakan saat ini.');
            redirect('admin/pengaturan?tab=pengguna');
            return;
        }

        $user = $this->db->get_where('users', array('id' => $id))->row();
        if (!$user) {
            set_alert('danger', 'Akun pengguna tidak ditemukan.');
            redirect('admin/pengaturan?tab=pengguna');
            return;
        }

        $this->db->where('id', $id)->delete('users');
        set_alert('success', 'Akun pengguna <strong>' . html_escape($user->username) . '</strong> berhasil dihapus.');
        redirect('admin/pengaturan?tab=pengguna');
    }
}
