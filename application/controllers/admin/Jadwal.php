<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Akademik_model');
        $this->load->model('Guru_model');
    }

    public function index() {
        $data['title'] = 'Manajemen Jadwal Kegiatan & Belajar Dayah';

        $tab = $this->input->get('tab', TRUE) ?: 'kegiatan';
        $data['active_tab'] = $tab;

        // Jadwal Kegiatan Harian
        $data['jadwal_kegiatan'] = $this->Akademik_model->get_jadwal_kegiatan_all();

        // Jadwal Belajar Mingguan
        $kelas_id = $this->input->get('kelas_id', TRUE);
        $data['kelas_list'] = $this->Akademik_model->get_kelas_all();
        if (!$kelas_id && !empty($data['kelas_list'])) {
            $kelas_id = $data['kelas_list'][0]->id;
        }
        $data['kelas_id_selected'] = $kelas_id;
        $data['selected_kelas'] = $kelas_id ? $this->Akademik_model->get_kelas($kelas_id) : null;

        $data['bidang_studi_list'] = $this->Akademik_model->get_bidang_studi_all();
        $data['guru_list'] = $this->Guru_model->get_all(array('aktif' => 1));

        $data['jadwal_belajar'] = $kelas_id ? $this->Akademik_model->get_jadwal_belajar($kelas_id) : array();

        $this->render_admin('admin/jadwal/index', $data);
    }

    public function simpan_kegiatan() {
        $data_insert = array(
            'jam_mulai'   => $this->input->post('jam_mulai', TRUE),
            'jam_selesai' => $this->input->post('jam_selesai', TRUE),
            'kegiatan'    => $this->input->post('kegiatan', TRUE),
            'keterangan'  => $this->input->post('keterangan', TRUE),
            'urutan'      => $this->input->post('urutan', TRUE) ?: 0
        );

        if (empty($data_insert['kegiatan']) || empty($data_insert['jam_mulai'])) {
            set_alert('danger', 'Nama kegiatan dan jam mulai wajib diisi.');
            redirect('admin/jadwal?tab=kegiatan');
            return;
        }

        $this->Akademik_model->insert_jadwal_kegiatan($data_insert);
        set_alert('success', 'Jadwal kegiatan harian berhasil ditambahkan.');
        redirect('admin/jadwal?tab=kegiatan');
    }

    public function update_kegiatan($id) {
        $data_update = array(
            'jam_mulai'   => $this->input->post('jam_mulai', TRUE),
            'jam_selesai' => $this->input->post('jam_selesai', TRUE),
            'kegiatan'    => $this->input->post('kegiatan', TRUE),
            'keterangan'  => $this->input->post('keterangan', TRUE),
            'urutan'      => $this->input->post('urutan', TRUE) ?: 0
        );

        $this->Akademik_model->update_jadwal_kegiatan($id, $data_update);
        set_alert('success', 'Jadwal kegiatan berhasil diperbarui.');
        redirect('admin/jadwal?tab=kegiatan');
    }

    public function hapus_kegiatan($id) {
        $this->Akademik_model->delete_jadwal_kegiatan($id);
        set_alert('success', 'Jadwal kegiatan berhasil dihapus.');
        redirect('admin/jadwal?tab=kegiatan');
    }

    public function simpan_belajar() {
        $kelas_id = $this->input->post('kelas_id', TRUE);
        $hari = $this->input->post('hari', TRUE);
        $jam_mulai = $this->input->post('jam_mulai', TRUE);
        $jam_selesai = $this->input->post('jam_selesai', TRUE);
        $bidang_studi_id = $this->input->post('bidang_studi_id', TRUE);
        $guru_id = $this->input->post('guru_id', TRUE) ?: null;

        if (!$kelas_id || !$hari || !$jam_mulai || !$bidang_studi_id) {
            set_alert('danger', 'Kolom wajib jadwal belajar belum lengkap.');
            redirect('admin/jadwal?tab=belajar&kelas_id=' . $kelas_id);
            return;
        }

        $this->Akademik_model->insert_jadwal_belajar(array(
            'kelas_id'        => $kelas_id,
            'hari'            => $hari,
            'jam_mulai'       => $jam_mulai,
            'jam_selesai'     => $jam_selesai,
            'bidang_studi_id' => $bidang_studi_id,
            'guru_id'         => $guru_id
        ));

        set_alert('success', 'Jadwal pelajaran kelas berhasil ditambahkan.');
        redirect('admin/jadwal?tab=belajar&kelas_id=' . $kelas_id);
    }

    public function hapus_belajar($id) {
        $row = $this->db->get_where('jadwal_belajar', array('id' => $id))->row();
        $kelas_id = $row ? $row->kelas_id : '';
        $this->Akademik_model->delete_jadwal_belajar($id);
        set_alert('success', 'Jadwal pelajaran berhasil dihapus.');
        redirect('admin/jadwal?tab=belajar&kelas_id=' . $kelas_id);
    }

    public function cetak() {
        $jenis = $this->input->get('jenis', TRUE) ?: 'kegiatan';
        $kelas_id = $this->input->get('kelas_id', TRUE);

        $data['jenis'] = $jenis;
        $data['profil'] = $this->profil;

        if ($jenis === 'belajar') {
            $data['kelas'] = $this->Akademik_model->get_kelas($kelas_id);
            $data['jadwal_belajar'] = $this->Akademik_model->get_jadwal_belajar($kelas_id);
            $data['title'] = 'Jadwal Pelajaran Kelas: ' . ($data['kelas'] ? $data['kelas']->nama_kelas : '');
        } else {
            $data['jadwal_kegiatan'] = $this->Akademik_model->get_jadwal_kegiatan_all();
            $data['title'] = 'Jadwal Rutinitas Kegiatan Harian Santri Dayah';
        }

        $this->load->view('admin/jadwal/cetak', $data);
    }
}
