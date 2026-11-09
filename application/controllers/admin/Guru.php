<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Guru_model');
    }

    public function index() {
        $data['title'] = 'Manajemen Dewan Guru (Teungku)';

        $filter = array(
            'status_pns'    => $this->input->get('status_pns', TRUE),
            'status_tetap'  => $this->input->get('status_tetap', TRUE),
            'jenis_kelamin' => $this->input->get('jenis_kelamin', TRUE),
            'aktif'         => $this->input->get('aktif', TRUE),
            'keyword'       => $this->input->get('keyword', TRUE)
        );

        $data['filter'] = $filter;
        $data['guru_list'] = $this->Guru_model->get_all($filter);

        // Counts
        $data['count_total'] = $this->db->count_all('guru');
        $data['count_aktif'] = $this->db->where('aktif', 1)->count_all_results('guru');
        $data['count_pns'] = $this->db->where('status_pns', 'PNS')->count_all_results('guru');
        $data['count_non_pns'] = $this->db->where('status_pns', 'NON PNS')->count_all_results('guru');

        $this->render_admin('admin/guru/index', $data);
    }

    public function tambah() {
        $data['title'] = 'Tambah Dewan Guru / Teungku Baru';
        $data['auto_no_induk'] = $this->Guru_model->generate_no_induk();
        $this->render_admin('admin/guru/form', $data);
    }

    public function simpan() {
        $this->form_validation->set_rules('nama', 'Nama Lengkap Guru / Teungku', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('status_pns', 'Status PNS', 'required');
        $this->form_validation->set_rules('status_tetap', 'Status Tetap', 'required');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            $this->tambah();
            return;
        }

        // Upload foto
        $foto_name = null;
        if (!empty($_FILES['foto']['name'])) {
            $upload_dir = FCPATH . 'uploads/berkas/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, TRUE);

            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = 'guru_' . time();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto_name = $upload_data['file_name'];
            }
        }

        $data = array(
            'no_induk'            => $this->input->post('no_induk', TRUE) ?: $this->Guru_model->generate_no_induk(),
            'nik'                 => $this->input->post('nik', TRUE) ?: null,
            'nama'                => $this->input->post('nama', TRUE),
            'jenis_kelamin'       => $this->input->post('jenis_kelamin'),
            'tempat_lahir'        => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir'       => $this->input->post('tanggal_lahir') ?: null,
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir', TRUE),
            'status_pns'          => $this->input->post('status_pns'),
            'status_tetap'        => $this->input->post('status_tetap'),
            'mata_pelajaran'      => $this->input->post('mata_pelajaran', TRUE),
            'asal_kabupaten'      => $this->input->post('asal_kabupaten', TRUE),
            'asal_kecamatan'      => $this->input->post('asal_kecamatan', TRUE),
            'asal_desa'           => $this->input->post('asal_desa', TRUE),
            'alamat_domisili'     => $this->input->post('alamat_domisili', TRUE),
            'no_hp'               => $this->input->post('no_hp', TRUE),
            'email'               => $this->input->post('email', TRUE) ?: null,
            'foto'                => $foto_name,
            'aktif'               => $this->input->post('aktif') !== null ? (int)$this->input->post('aktif') : 1
        );

        $guru_id = $this->Guru_model->create($data);
        set_alert('success', 'Data dewan guru <strong>' . html_escape($data['nama']) . '</strong> berhasil ditambahkan.');
        redirect('admin/guru/detail/' . $guru_id);
    }

    public function detail($id) {
        $guru = $this->Guru_model->get_by_id($id);
        if (!$guru) {
            set_alert('danger', 'Data dewan guru tidak ditemukan.');
            redirect('admin/guru');
        }

        $data['title'] = 'Profil Dewan Guru: ' . $guru->nama;
        $data['g'] = $guru;

        // Kelas yang diampu sebagai wali kelas
        $data['kelas_wali'] = $this->db->get_where('kelas', array('wali_kelas_id' => $id))->result();

        $this->render_admin('admin/guru/detail', $data);
    }

    public function edit($id) {
        $guru = $this->Guru_model->get_by_id($id);
        if (!$guru) {
            set_alert('danger', 'Data guru tidak ditemukan.');
            redirect('admin/guru');
        }

        $data['title'] = 'Ubah Data Guru: ' . $guru->nama;
        $data['g'] = $guru;
        $this->render_admin('admin/guru/form', $data);
    }

    public function update($id) {
        $guru = $this->Guru_model->get_by_id($id);
        if (!$guru) {
            set_alert('danger', 'Data guru tidak ditemukan.');
            redirect('admin/guru');
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap Guru / Teungku', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            $this->edit($id);
            return;
        }

        $foto_name = $guru->foto;
        if (!empty($_FILES['foto']['name'])) {
            $upload_dir = FCPATH . 'uploads/berkas/';
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = 'guru_' . time();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto_name = $upload_data['file_name'];
            }
        }

        $data = array(
            'no_induk'            => $this->input->post('no_induk', TRUE) ?: $guru->no_induk,
            'nik'                 => $this->input->post('nik', TRUE) ?: null,
            'nama'                => $this->input->post('nama', TRUE),
            'jenis_kelamin'       => $this->input->post('jenis_kelamin'),
            'tempat_lahir'        => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir'       => $this->input->post('tanggal_lahir') ?: null,
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir', TRUE),
            'status_pns'          => $this->input->post('status_pns'),
            'status_tetap'        => $this->input->post('status_tetap'),
            'mata_pelajaran'      => $this->input->post('mata_pelajaran', TRUE),
            'asal_kabupaten'      => $this->input->post('asal_kabupaten', TRUE),
            'asal_kecamatan'      => $this->input->post('asal_kecamatan', TRUE),
            'asal_desa'           => $this->input->post('asal_desa', TRUE),
            'alamat_domisili'     => $this->input->post('alamat_domisili', TRUE),
            'no_hp'               => $this->input->post('no_hp', TRUE),
            'email'               => $this->input->post('email', TRUE) ?: null,
            'foto'                => $foto_name,
            'aktif'               => $this->input->post('aktif') !== null ? (int)$this->input->post('aktif') : $guru->aktif
        );

        $this->Guru_model->update($id, $data);
        set_alert('success', 'Data guru <strong>' . html_escape($data['nama']) . '</strong> berhasil diperbarui.');
        redirect('admin/guru/detail/' . $id);
    }

    public function hapus($id) {
        $guru = $this->Guru_model->get_by_id($id);
        if (!$guru) {
            set_alert('danger', 'Data guru tidak ditemukan.');
            redirect('admin/guru');
        }

        $this->Guru_model->delete($id);
        set_alert('success', 'Data guru <strong>' . html_escape($guru->nama) . '</strong> berhasil dihapus.');
        redirect('admin/guru');
    }

    /**
     * Ekspor Format EDATUDA Dinas Pendidikan Dayah
     */
    public function ekspor_edatuda() {
        $guru = $this->Guru_model->get_guru_edatuda_export();

        $filename = 'Format_EDATUDA_Data_Guru_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Format Kolom EDATUDA Resmi Dinas Pendidikan Dayah
        fputcsv($output, array(
            'NO',
            'NOMOR INDUK GURU',
            'NIK',
            'NAMA LENGKAP & GELAR',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'PENDIDIKAN TERAKHIR',
            'STATUS PNS',
            'STATUS KEPEGAWAIAN',
            'MATA PELAJARAN / KITAB YANG DIASUH',
            'KABUPATEN ASAL',
            'KECAMATAN ASAL',
            'DESA ASAL',
            'ALAMAT DOMISILI',
            'NO. HP / WA',
            'EMAIL',
            'STATUS AKTIF'
        ));

        $no = 1;
        foreach ($guru as $g) {
            fputcsv($output, array(
                $no++,
                "'" . $g->no_induk,
                "'" . ($g->nik ?: '-'),
                $g->nama,
                $g->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                $g->tempat_lahir ?: '-',
                $g->tanggal_lahir ?: '-',
                $g->pendidikan_terakhir ?: '-',
                $g->status_pns,
                $g->status_tetap,
                $g->mata_pelajaran ?: '-',
                $g->asal_kabupaten ?: '-',
                $g->asal_kecamatan ?: '-',
                $g->asal_desa ?: '-',
                $g->alamat_domisili ?: '-',
                $g->no_hp ?: '-',
                $g->email ?: '-',
                $g->aktif ? 'AKTIF' : 'TIDAK AKTIF'
            ));
        }

        fclose($output);
        exit;
    }
}
