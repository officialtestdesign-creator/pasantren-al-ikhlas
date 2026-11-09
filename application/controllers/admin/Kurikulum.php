<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Akademik_model');
        $this->load->model('Guru_model');
    }

    public function index() {
        $data['title'] = 'Kurikulum Kitab Kuning & Bidang Studi Dayah';

        $kelas_id = $this->input->get('kelas_id', TRUE);
        $data['kelas_list'] = $this->Akademik_model->get_kelas_all();

        // Default to first class if not selected
        if (!$kelas_id && !empty($data['kelas_list'])) {
            $kelas_id = $data['kelas_list'][0]->id;
        }
        $data['kelas_id_selected'] = $kelas_id;
        $data['selected_kelas'] = $kelas_id ? $this->Akademik_model->get_kelas($kelas_id) : null;

        $data['bidang_studi_list'] = $this->Akademik_model->get_bidang_studi_all();
        $data['guru_list'] = $this->Guru_model->get_all(array('aktif' => 1));
        $data['kurikulum_kelas'] = $kelas_id ? $this->Akademik_model->get_kurikulum_by_kelas($kelas_id) : array();

        $this->render_admin('admin/kurikulum/index', $data);
    }

    public function simpan_bidang_studi() {
        $nama = $this->input->post('nama', TRUE);
        $urutan = $this->input->post('urutan', TRUE) ?: 0;

        if (empty($nama)) {
            set_alert('danger', 'Nama bidang studi / kitab kuning wajib diisi.');
            redirect('admin/kurikulum');
            return;
        }

        $exist = $this->db->get_where('bidang_studi', array('nama' => $nama))->row();
        if ($exist) {
            set_alert('danger', 'Bidang studi tersebut sudah ada.');
            redirect('admin/kurikulum');
            return;
        }

        $this->Akademik_model->insert_bidang_studi(array('nama' => $nama, 'urutan' => $urutan));
        set_alert('success', 'Bidang studi / kitab berhasil ditambahkan.');
        redirect('admin/kurikulum');
    }

    public function update_bidang_studi($id) {
        $nama = $this->input->post('nama', TRUE);
        $urutan = $this->input->post('urutan', TRUE) ?: 0;

        $this->Akademik_model->update_bidang_studi($id, array('nama' => $nama, 'urutan' => $urutan));
        set_alert('success', 'Bidang studi berhasil diperbarui.');
        redirect('admin/kurikulum');
    }

    public function hapus_bidang_studi($id) {
        $count = $this->db->where('bidang_studi_id', $id)->count_all_results('kurikulum');
        if ($count > 0) {
            set_alert('danger', 'Tidak dapat menghapus bidang studi karena sudah dipetakan pada kurikulum kelas.');
            redirect('admin/kurikulum');
            return;
        }

        $this->Akademik_model->delete_bidang_studi($id);
        set_alert('success', 'Bidang studi berhasil dihapus.');
        redirect('admin/kurikulum');
    }

    public function simpan_pemetaan() {
        $kelas_id = $this->input->post('kelas_id', TRUE);
        $bidang_studi_id = $this->input->post('bidang_studi_id', TRUE);
        $guru_id = $this->input->post('guru_id', TRUE) ?: null;
        $keterangan = $this->input->post('keterangan', TRUE);

        if (!$kelas_id || !$bidang_studi_id) {
            set_alert('danger', 'Kelas dan Bidang Studi wajib dipilih.');
            redirect('admin/kurikulum?kelas_id=' . $kelas_id);
            return;
        }

        // Check if already mapped
        $exist = $this->db->get_where('kurikulum', array(
            'kelas_id' => $kelas_id,
            'bidang_studi_id' => $bidang_studi_id
        ))->row();

        if ($exist) {
            // Update instead
            $this->db->where('id', $exist->id)->update('kurikulum', array(
                'guru_id' => $guru_id,
                'keterangan' => $keterangan
            ));
            set_alert('success', 'Pengampu bidang studi berhasil diperbarui.');
        } else {
            $this->Akademik_model->insert_kurikulum(array(
                'kelas_id' => $kelas_id,
                'bidang_studi_id' => $bidang_studi_id,
                'guru_id' => $guru_id,
                'keterangan' => $keterangan
            ));
            set_alert('success', 'Bidang studi berhasil ditambahkan ke kurikulum kelas.');
        }

        redirect('admin/kurikulum?kelas_id=' . $kelas_id);
    }

    public function hapus_pemetaan($id) {
        $row = $this->db->get_where('kurikulum', array('id' => $id))->row();
        $kelas_id = $row ? $row->kelas_id : '';
        $this->Akademik_model->delete_kurikulum($id);
        set_alert('success', 'Bidang studi berhasil dihapus dari kurikulum kelas.');
        redirect('admin/kurikulum?kelas_id=' . $kelas_id);
    }
}
