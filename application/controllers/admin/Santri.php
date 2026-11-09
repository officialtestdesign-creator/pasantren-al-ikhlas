<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Santri extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Santri_model');
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Manajemen Data Santri';

        $filter = array(
            'status'        => $this->input->get('status', TRUE) ?: 'aktif',
            'kelas_id'      => $this->input->get('kelas_id', TRUE),
            'jenjang_id'    => $this->input->get('jenjang_id', TRUE),
            'jenis_kelamin' => $this->input->get('jenis_kelamin', TRUE),
            'keyword'       => $this->input->get('keyword', TRUE)
        );

        $data['filter'] = $filter;
        $data['santri_list'] = $this->Santri_model->get_all($filter);
        $data['jenjang_list'] = $this->Pendaftaran_model->get_jenjang_list();
        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list();

        // Counters
        $data['count_aktif'] = $this->db->where('status', 'aktif')->count_all_results('santri');
        $data['count_alumni'] = $this->db->where('status', 'alumni')->count_all_results('santri');
        $data['count_keluar'] = $this->db->where('status', 'keluar')->count_all_results('santri');
        $data['count_putra'] = $this->db->where('status', 'aktif')->where('jenis_kelamin', 'L')->count_all_results('santri');
        $data['count_putri'] = $this->db->where('status', 'aktif')->where('jenis_kelamin', 'P')->count_all_results('santri');

        $this->render_admin('admin/santri/index', $data);
    }

    public function tambah() {
        $data['title'] = 'Tambah Data Santri Baru';
        $data['auto_nis'] = $this->Santri_model->generate_nis();
        $data['jenjang_list'] = $this->Pendaftaran_model->get_jenjang_list();
        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list();
        $this->render_admin('admin/santri/form', $data);
    }

    public function simpan() {
        $this->form_validation->set_rules('nama', 'Nama Lengkap Santri', 'trim|required');
        $this->form_validation->set_rules('no_induk', 'Nomor Induk Santri (NIS)', 'trim|required|is_unique[santri.no_induk]', array(
            'is_unique' => '%s sudah terdaftar untuk santri lain.'
        ));
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');
        $this->form_validation->set_rules('asal_kabupaten', 'Kabupaten/Kota Asal', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            $this->tambah();
            return;
        }

        // Upload foto if provided
        $foto_name = null;
        if (!empty($_FILES['foto']['name'])) {
            $upload_dir = FCPATH . 'uploads/berkas/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, TRUE);

            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = 'santri_' . time();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto_name = $upload_data['file_name'];
            }
        }

        $data = array(
            'no_induk'        => $this->input->post('no_induk', TRUE),
            'nik'             => $this->input->post('nik', TRUE) ?: null,
            'nama'            => $this->input->post('nama', TRUE),
            'jenis_kelamin'   => $this->input->post('jenis_kelamin'),
            'tempat_lahir'    => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir'   => $this->input->post('tanggal_lahir'),
            'anak_ke'         => $this->input->post('anak_ke') ?: null,
            'jumlah_saudara'  => $this->input->post('jumlah_saudara') ?: null,
            'asal_gampong'    => $this->input->post('asal_gampong', TRUE),
            'asal_kecamatan'  => $this->input->post('asal_kecamatan', TRUE),
            'asal_kabupaten'  => $this->input->post('asal_kabupaten', TRUE),
            'asal_provinsi'   => $this->input->post('asal_provinsi', TRUE) ?: 'Aceh',
            'alamat_domisili' => $this->input->post('alamat_domisili', TRUE),
            'no_hp'           => $this->input->post('no_hp', TRUE),
            'email'           => $this->input->post('email', TRUE) ?: null,
            'asal_sekolah'    => $this->input->post('asal_sekolah', TRUE),
            'nama_ayah'       => $this->input->post('nama_ayah', TRUE),
            'nama_ibu'        => $this->input->post('nama_ibu', TRUE),
            'pekerjaan_ayah'  => $this->input->post('pekerjaan_ayah', TRUE),
            'pekerjaan_ibu'   => $this->input->post('pekerjaan_ibu', TRUE),
            'alamat_ortu'     => $this->input->post('alamat_ortu', TRUE),
            'no_hp_ortu'      => $this->input->post('no_hp_ortu', TRUE),
            'nama_wali'       => $this->input->post('nama_wali', TRUE),
            'pekerjaan_wali'  => $this->input->post('pekerjaan_wali', TRUE),
            'alamat_wali'     => $this->input->post('alamat_wali', TRUE),
            'no_hp_wali'      => $this->input->post('no_hp_wali', TRUE),
            'kelas_id'        => $this->input->post('kelas_id') ?: null,
            'tahun_masuk'     => $this->input->post('tahun_masuk') ?: date('Y'),
            'status'          => $this->input->post('status') ?: 'aktif',
            'foto'            => $foto_name
        );

        $santri_id = $this->Santri_model->create($data);
        set_alert('success', 'Data santri <strong>' . html_escape($data['nama']) . '</strong> berhasil ditambahkan.');
        redirect('admin/santri/detail/' . $santri_id);
    }

    public function detail($id) {
        $santri = $this->Santri_model->get_by_id($id);
        if (!$santri) {
            set_alert('danger', 'Data santri tidak ditemukan.');
            redirect('admin/santri');
        }

        $data['title'] = 'Biodata Santri: ' . $santri->nama;
        $data['s'] = $santri;

        // Riwayat SPP Santri
        $this->db->select('p.*, jp.nama as nama_jenis');
        $this->db->from('pembayaran p');
        $this->db->join('jenis_pembayaran jp', 'jp.id = p.jenis_pembayaran_id', 'left');
        $this->db->where('p.santri_id', $id);
        $this->db->order_by('p.id', 'DESC');
        $data['riwayat_pembayaran'] = $this->db->get()->result();

        $this->render_admin('admin/santri/detail', $data);
    }

    public function edit($id) {
        $santri = $this->Santri_model->get_by_id($id);
        if (!$santri) {
            set_alert('danger', 'Data santri tidak ditemukan.');
            redirect('admin/santri');
        }

        $data['title'] = 'Ubah Data Santri: ' . $santri->nama;
        $data['s'] = $santri;
        $data['jenjang_list'] = $this->Pendaftaran_model->get_jenjang_list();
        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list();
        $this->render_admin('admin/santri/form', $data);
    }

    public function update($id) {
        $santri = $this->Santri_model->get_by_id($id);
        if (!$santri) {
            set_alert('danger', 'Data santri tidak ditemukan.');
            redirect('admin/santri');
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap Santri', 'trim|required');
        $this->form_validation->set_rules('no_induk', 'Nomor Induk Santri', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            $this->edit($id);
            return;
        }

        $foto_name = $santri->foto;
        if (!empty($_FILES['foto']['name'])) {
            $upload_dir = FCPATH . 'uploads/berkas/';
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['file_name']     = 'santri_' . time();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto_name = $upload_data['file_name'];
            }
        }

        $data = array(
            'no_induk'        => $this->input->post('no_induk', TRUE),
            'nik'             => $this->input->post('nik', TRUE) ?: null,
            'nama'            => $this->input->post('nama', TRUE),
            'jenis_kelamin'   => $this->input->post('jenis_kelamin'),
            'tempat_lahir'    => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir'   => $this->input->post('tanggal_lahir'),
            'anak_ke'         => $this->input->post('anak_ke') ?: null,
            'jumlah_saudara'  => $this->input->post('jumlah_saudara') ?: null,
            'asal_gampong'    => $this->input->post('asal_gampong', TRUE),
            'asal_kecamatan'  => $this->input->post('asal_kecamatan', TRUE),
            'asal_kabupaten'  => $this->input->post('asal_kabupaten', TRUE),
            'asal_provinsi'   => $this->input->post('asal_provinsi', TRUE) ?: 'Aceh',
            'alamat_domisili' => $this->input->post('alamat_domisili', TRUE),
            'no_hp'           => $this->input->post('no_hp', TRUE),
            'email'           => $this->input->post('email', TRUE) ?: null,
            'asal_sekolah'    => $this->input->post('asal_sekolah', TRUE),
            'nama_ayah'       => $this->input->post('nama_ayah', TRUE),
            'nama_ibu'        => $this->input->post('nama_ibu', TRUE),
            'pekerjaan_ayah'  => $this->input->post('pekerjaan_ayah', TRUE),
            'pekerjaan_ibu'   => $this->input->post('pekerjaan_ibu', TRUE),
            'alamat_ortu'     => $this->input->post('alamat_ortu', TRUE),
            'no_hp_ortu'      => $this->input->post('no_hp_ortu', TRUE),
            'nama_wali'       => $this->input->post('nama_wali', TRUE),
            'pekerjaan_wali'  => $this->input->post('pekerjaan_wali', TRUE),
            'alamat_wali'     => $this->input->post('alamat_wali', TRUE),
            'no_hp_wali'      => $this->input->post('no_hp_wali', TRUE),
            'kelas_id'        => $this->input->post('kelas_id') ?: null,
            'tahun_masuk'     => $this->input->post('tahun_masuk') ?: $santri->tahun_masuk,
            'status'          => $this->input->post('status') ?: $santri->status,
            'foto'            => $foto_name
        );

        $this->Santri_model->update($id, $data);
        set_alert('success', 'Data santri <strong>' . html_escape($data['nama']) . '</strong> berhasil diperbarui.');
        redirect('admin/santri/detail/' . $id);
    }

    public function hapus($id) {
        $santri = $this->Santri_model->get_by_id($id);
        if (!$santri) {
            set_alert('danger', 'Data santri tidak ditemukan.');
            redirect('admin/santri');
        }

        $this->Santri_model->delete($id);
        set_alert('success', 'Data santri <strong>' . html_escape($santri->nama) . '</strong> berhasil dihapus.');
        redirect('admin/santri');
    }

    public function cetak_kartu($id) {
        $santri = $this->Santri_model->get_by_id($id);
        if (!$santri) {
            show_404();
        }

        $data['title'] = 'Kartu Biodata Santri - ' . $santri->nama;
        $data['s'] = $santri;
        $data['profil'] = $this->profil;
        $this->load->view('admin/santri/kartu_cetak', $data);
    }

    /**
     * Kenaikan Kelas Massal View
     */
    public function kenaikan_kelas() {
        $data['title'] = 'Kenaikan Kelas & Mutasi Massal Santri';
        $kelas_asal_id = $this->input->get('kelas_asal_id', TRUE);

        $data['kelas_asal_id'] = $kelas_asal_id;
        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list();

        $santri_list = array();
        if ($kelas_asal_id) {
            $santri_list = $this->Santri_model->get_all(array(
                'status'   => 'aktif',
                'kelas_id' => $kelas_asal_id
            ));
        }
        $data['santri_list'] = $santri_list;

        $this->render_admin('admin/santri/kenaikan_kelas', $data);
    }

    public function proses_kenaikan_kelas() {
        $santri_ids = $this->input->post('santri_ids');
        $kelas_tujuan_id = $this->input->post('kelas_tujuan_id');
        $aksi = $this->input->post('aksi'); // 'pindah' atau 'lulus'

        if (empty($santri_ids) || !is_array($santri_ids)) {
            set_alert('danger', 'Silakan pilih minimal satu santri yang akan diproses.');
            redirect('admin/santri/kenaikan_kelas');
            return;
        }

        if ($aksi === 'lulus') {
            $this->Santri_model->kenaikan_kelas_massal($santri_ids, null, 'alumni');
            set_alert('success', 'Sebanyak ' . count($santri_ids) . ' santri berhasil dimutasi menjadi <strong>Alumni (Tamat)</strong>.');
        } else {
            if (empty($kelas_tujuan_id)) {
                set_alert('danger', 'Silakan pilih kelas tujuan kenaikan kelas.');
                redirect('admin/santri/kenaikan_kelas');
                return;
            }
            $this->Santri_model->kenaikan_kelas_massal($santri_ids, $kelas_tujuan_id, 'aktif');
            set_alert('success', 'Sebanyak ' . count($santri_ids) . ' santri berhasil dinaikkan / dipindahkan ke kelas tujuan.');
        }

        redirect('admin/santri');
    }

    /**
     * Ekspor Format Dinas Pendidikan Dayah
     */
    public function ekspor_dinas() {
        $santri = $this->Santri_model->get_santri_dinas_export();

        $filename = 'Format_Dinas_Data_Santri_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        // UTF-8 BOM for Microsoft Excel compatibility
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Header Sesuai Format Dinas Pendidikan Dayah
        fputcsv($output, array(
            'NO',
            'NOMOR INDUK (NIS)',
            'NIK',
            'NAMA SANTRI',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'NAMA AYAH',
            'NAMA IBU',
            'PEKERJAAN ORTU',
            'GAMPONG/DESA',
            'KECAMATAN',
            'KABUPATEN/KOTA',
            'PROVINSI',
            'ASAL SEKOLAH',
            'JENJANG PENDIDIKAN',
            'KELAS',
            'TAHUN MASUK',
            'STATUS'
        ));

        $no = 1;
        foreach ($santri as $s) {
            fputcsv($output, array(
                $no++,
                "'" . $s->no_induk,
                "'" . ($s->nik ?: '-'),
                $s->nama,
                $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                $s->tempat_lahir,
                $s->tanggal_lahir,
                $s->nama_ayah,
                $s->nama_ibu,
                $s->pekerjaan_ayah ?: '-',
                $s->asal_gampong ?: '-',
                $s->asal_kecamatan ?: '-',
                $s->asal_kabupaten ?: '-',
                $s->asal_provinsi ?: 'Aceh',
                $s->asal_sekolah ?: '-',
                $s->nama_jenjang ?: '-',
                $s->nama_kelas ?: '-',
                $s->tahun_masuk,
                strtoupper($s->status)
            ));
        }

        fclose($output);
        exit;
    }
}
