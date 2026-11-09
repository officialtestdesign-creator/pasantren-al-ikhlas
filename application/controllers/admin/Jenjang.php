<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenjang extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Akademik_model');
        $this->load->model('Guru_model');
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Manajemen Jenjang & Kelas Dayah';

        $ta_aktif = $this->tahun_ajaran_aktif;
        $ta_id = $this->input->get('tahun_ajaran_id') ?: ($ta_aktif ? $ta_aktif->id : 1);

        $data['ta_aktif'] = $ta_aktif;
        $data['ta_id_selected'] = $ta_id;
        $data['ta_list'] = $this->db->order_by('id', 'DESC')->get('tahun_ajaran')->result();

        $data['jenjang_list'] = $this->Akademik_model->get_jenjang_all();
        $data['kelas_list'] = $this->Akademik_model->get_kelas_all($ta_id);
        $data['guru_list'] = $this->Guru_model->get_all(array('aktif' => 1));

        // Aggregate statistics
        $data['total_kelas'] = count($data['kelas_list']);
        $total_santri_terdaftar = 0;
        foreach ($data['kelas_list'] as $k) {
            $total_santri_terdaftar += (int)$k->total_santri;
        }
        $data['total_santri_terdaftar'] = $total_santri_terdaftar;

        $this->render_admin('admin/jenjang/index', $data);
    }

    public function simpan_kelas() {
        $this->form_validation->set_rules('jenjang_id', 'Jenjang', 'required|numeric');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'trim|required');
        $this->form_validation->set_rules('tahun_ajaran_id', 'Tahun Ajaran', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            redirect('admin/jenjang');
            return;
        }

        $data_insert = array(
            'jenjang_id'      => $this->input->post('jenjang_id', TRUE),
            'nama_kelas'      => $this->input->post('nama_kelas', TRUE),
            'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id', TRUE),
            'wali_kelas_id'   => $this->input->post('wali_kelas_id', TRUE) ?: null
        );

        // Check duplicate
        $exist = $this->db->get_where('kelas', array(
            'nama_kelas'      => $data_insert['nama_kelas'],
            'tahun_ajaran_id' => $data_insert['tahun_ajaran_id']
        ))->row();

        if ($exist) {
            set_alert('danger', 'Nama kelas tersebut sudah terdaftar pada tahun ajaran yang dipilih.');
            redirect('admin/jenjang');
            return;
        }

        $this->Akademik_model->insert_kelas($data_insert);
        set_alert('success', 'Kelas baru berhasil ditambahkan.');
        redirect('admin/jenjang');
    }

    public function update_kelas($id) {
        $kelas = $this->Akademik_model->get_kelas($id);
        if (!$kelas) {
            set_alert('danger', 'Data kelas tidak ditemukan.');
            redirect('admin/jenjang');
            return;
        }

        $this->form_validation->set_rules('jenjang_id', 'Jenjang', 'required|numeric');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            redirect('admin/jenjang');
            return;
        }

        $data_update = array(
            'jenjang_id'    => $this->input->post('jenjang_id', TRUE),
            'nama_kelas'    => $this->input->post('nama_kelas', TRUE),
            'wali_kelas_id' => $this->input->post('wali_kelas_id', TRUE) ?: null
        );

        $this->Akademik_model->update_kelas($id, $data_update);
        set_alert('success', 'Perubahan data kelas berhasil disimpan.');
        redirect('admin/jenjang');
    }

    public function hapus_kelas($id) {
        $santri_count = $this->db->where('kelas_id', $id)->count_all_results('santri');
        if ($santri_count > 0) {
            set_alert('danger', 'Kelas tidak dapat dihapus karena masih terdapat ' . $santri_count . ' santri di dalamnya. Pindahkan santri terlebih dahulu.');
            redirect('admin/jenjang');
            return;
        }

        // Clean up linked curriculum and schedule for this class
        $this->db->where('kelas_id', $id)->delete('kurikulum');
        $this->db->where('kelas_id', $id)->delete('jadwal_belajar');

        $this->Akademik_model->delete_kelas($id);
        set_alert('success', 'Kelas berhasil dihapus.');
        redirect('admin/jenjang');
    }

    public function hapus_jenjang($id) {
        $kelas_count = $this->db->where('jenjang_id', $id)->count_all_results('kelas');
        if ($kelas_count > 0) {
            set_alert('danger', 'Jenjang tidak dapat dihapus karena masih menaungi ' . $kelas_count . ' kelas / rombel.');
            redirect('admin/jenjang');
            return;
        }

        $this->Akademik_model->delete_jenjang($id);
        set_alert('success', 'Jenjang pendidikan berhasil dihapus.');
        redirect('admin/jenjang');
    }

    public function simpan_jenjang() {
        $nama = $this->input->post('nama', TRUE);
        $urutan = $this->input->post('urutan', TRUE) ?: 0;
        $keterangan = $this->input->post('keterangan', TRUE);

        if (empty($nama)) {
            set_alert('danger', 'Nama jenjang wajib diisi.');
            redirect('admin/jenjang');
            return;
        }

        $this->Akademik_model->insert_jenjang(array(
            'nama' => $nama,
            'urutan' => $urutan,
            'keterangan' => $keterangan
        ));
        set_alert('success', 'Jenjang pendidikan baru berhasil ditambahkan.');
        redirect('admin/jenjang');
    }

    public function detail_kelas($id) {
        $kelas = $this->Akademik_model->get_kelas($id);
        if (!$kelas) {
            set_alert('danger', 'Data kelas tidak ditemukan.');
            redirect('admin/jenjang');
            return;
        }

        $data['title'] = 'Daftar Santri Kelas: ' . $kelas->nama_kelas;
        $data['kelas'] = $kelas;
        $data['santri_list'] = $this->Akademik_model->get_santri_by_kelas($id);

        $this->render_admin('admin/jenjang/detail_kelas', $data);
    }
}
