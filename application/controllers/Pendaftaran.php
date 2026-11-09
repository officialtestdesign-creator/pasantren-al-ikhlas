<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Formulir Pendaftaran Santri Baru Online';
        $data['jenjang_list'] = $this->Pendaftaran_model->get_jenjang_list();
        $this->render_public('public/pendaftaran_form', $data);
    }

    public function simpan() {
        // Validation Rules
        $this->form_validation->set_rules('nama', 'Nama Lengkap Calon Santri', 'trim|required', array('required' => '%s wajib diisi.'));
        $this->form_validation->set_rules('nik', 'NIK Calon Santri', 'trim|exact_length[16]|numeric', array(
            'exact_length' => '%s harus 16 digit angka.',
            'numeric'      => '%s hanya boleh berupa angka.'
        ));
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', array('required' => '%s wajib dipilih.'));
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required', array('required' => '%s wajib diisi.'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', array('required' => '%s wajib diisi.'));
        $this->form_validation->set_rules('jenjang_tujuan_id', 'Jenjang Tujuan', 'required|numeric', array('required' => '%s wajib dipilih.'));
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah Kandung', 'trim|required', array('required' => '%s wajib diisi.'));
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu Kandung', 'trim|required', array('required' => '%s wajib diisi.'));
        $this->form_validation->set_rules('no_hp_ortu', 'No. Handphone / WhatsApp Orang Tua', 'trim|required', array('required' => '%s wajib diisi.'));
        $this->form_validation->set_rules('asal_kabupaten', 'Asal Kabupaten / Kota', 'trim|required', array('required' => '%s wajib diisi.'));

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('<div><i class="bi bi-exclamation-circle me-1"></i> ', '</div>'));
            $this->index();
            return;
        }

        // Generate No Pendaftaran
        $no_pendaftaran = $this->Pendaftaran_model->generate_no_pendaftaran();
        $tahun_ajaran_id = $this->tahun_ajaran_aktif ? $this->tahun_ajaran_aktif->id : 1;

        // Prepare data
        $data_pendaftaran = array(
            'no_pendaftaran'      => $no_pendaftaran,
            'tahun_ajaran_id'     => $tahun_ajaran_id,
            'jenjang_tujuan_id'   => $this->input->post('jenjang_tujuan_id'),
            'nama'                => $this->input->post('nama', TRUE),
            'nik'                 => $this->input->post('nik', TRUE) ?: null,
            'jenis_kelamin'       => $this->input->post('jenis_kelamin'),
            'tempat_lahir'        => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir'       => $this->input->post('tanggal_lahir'),
            'anak_ke'             => $this->input->post('anak_ke') ?: null,
            'jumlah_saudara'      => $this->input->post('jumlah_saudara') ?: null,
            'asal_gampong'        => $this->input->post('asal_gampong', TRUE),
            'asal_kecamatan'      => $this->input->post('asal_kecamatan', TRUE),
            'asal_kabupaten'      => $this->input->post('asal_kabupaten', TRUE),
            'asal_provinsi'       => $this->input->post('asal_provinsi', TRUE) ?: 'Aceh',
            'asal_sekolah'        => $this->input->post('asal_sekolah', TRUE),
            'nama_ayah'           => $this->input->post('nama_ayah', TRUE),
            'nama_ibu'            => $this->input->post('nama_ibu', TRUE),
            'pekerjaan_ayah'      => $this->input->post('pekerjaan_ayah', TRUE),
            'pekerjaan_ibu'       => $this->input->post('pekerjaan_ibu', TRUE),
            'alamat_ortu'         => $this->input->post('alamat_ortu', TRUE),
            'no_hp_ortu'          => $this->input->post('no_hp_ortu', TRUE),
            'nama_wali'           => $this->input->post('nama_wali', TRUE),
            'pekerjaan_wali'      => $this->input->post('pekerjaan_wali', TRUE),
            'alamat_wali'         => $this->input->post('alamat_wali', TRUE),
            'no_hp_wali'          => $this->input->post('no_hp_wali', TRUE),
            'pendaftar_nama'      => $this->input->post('pendaftar_nama', TRUE) ?: $this->input->post('nama_ayah', TRUE),
            'pendaftar_pekerjaan' => $this->input->post('pendaftar_pekerjaan', TRUE) ?: $this->input->post('pekerjaan_ayah', TRUE),
            'pendaftar_alamat'    => $this->input->post('pendaftar_alamat', TRUE) ?: $this->input->post('alamat_ortu', TRUE),
            'pendaftar_no_hp'     => $this->input->post('pendaftar_no_hp', TRUE) ?: $this->input->post('no_hp_ortu', TRUE),
            'status'              => 'menunggu',
            'tanggal_daftar'      => date('Y-m-d H:i:s')
        );

        $pendaftaran_id = $this->Pendaftaran_model->insert($data_pendaftaran);

        // Upload Configuration
        $upload_dir = FCPATH . 'uploads/berkas/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, TRUE);
        }

        $config['upload_path']   = $upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 4096; // 4MB
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        $berkas_types = array(
            'berkas_foto'   => 'foto',
            'berkas_kk'     => 'kk',
            'berkas_ktp'    => 'ktp_ortu',
            'berkas_ijazah' => 'ijazah'
        );

        $upload_errors = array();

        foreach ($berkas_types as $input_name => $jenis_berkas) {
            if (!empty($_FILES[$input_name]['name'])) {
                $ext = strtolower(pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION));
                $config['file_name'] = $no_pendaftaran . '_' . $jenis_berkas . '_' . time() . '_' . mt_rand(10, 99) . '.' . $ext;
                $this->upload->initialize($config, TRUE);

                if ($this->upload->do_upload($input_name)) {
                    $upload_data = $this->upload->data();
                    $this->Pendaftaran_model->save_or_replace_berkas(
                        $pendaftaran_id,
                        $jenis_berkas,
                        $upload_data['file_name']
                    );
                } else {
                    $upload_errors[] = ucfirst($jenis_berkas) . ' (' . strip_tags($this->upload->display_errors('', '')) . ')';
                }
            }
        }

        if (!empty($upload_errors)) {
            set_alert('warning', 'Pendaftaran Anda berhasil dikirim dengan Nomor <strong>' . $no_pendaftaran . '</strong>. Namun terdapat catatan berkas: ' . implode(', ', $upload_errors) . '. Berkas fisik dapat diserahkan langsung saat verifikasi di dayah.');
        } else {
            set_alert('success', 'Alhamdulillah! Pendaftaran santri baru berhasil dikirim dengan Nomor Pendaftaran <strong>' . $no_pendaftaran . '</strong>.');
        }

        redirect('pendaftaran/sukses/' . $no_pendaftaran);
    }

    public function sukses($no_pendaftaran) {
        $pendaftar = $this->Pendaftaran_model->get_by_no_pendaftaran($no_pendaftaran);
        if (!$pendaftar) {
            show_404();
        }

        $data['title'] = 'Pendaftaran Berhasil - ' . $pendaftar->no_pendaftaran;
        $data['pendaftar'] = $pendaftar;
        $data['berkas'] = $this->Pendaftaran_model->get_berkas($pendaftar->id);
        $this->render_public('public/pendaftaran_sukses', $data);
    }

    public function bukti($no_pendaftaran) {
        $pendaftar = $this->Pendaftaran_model->get_by_no_pendaftaran($no_pendaftaran);
        if (!$pendaftar) {
            show_404();
        }

        $data['title'] = 'Bukti Pendaftaran Santri Baru - ' . $pendaftar->no_pendaftaran;
        $data['pendaftar'] = $pendaftar;
        $data['berkas'] = $this->Pendaftaran_model->get_berkas($pendaftar->id);
        $data['profil'] = $this->profil;
        $this->load->view('public/pendaftaran_bukti', $data);
    }

    public function cek_status() {
        $data['title'] = 'Cek Status Pendaftaran Santri Baru';
        $data['hasil'] = null;
        $data['berkas'] = array();
        $data['keyword'] = $this->input->get('keyword', TRUE);

        if (!empty($data['keyword'])) {
            $data['hasil'] = $this->Pendaftaran_model->get_by_nik_or_no(trim($data['keyword']));
            if ($data['hasil']) {
                $data['berkas'] = $this->Pendaftaran_model->get_berkas($data['hasil']->id);
            } else {
                set_alert('warning', 'Data pendaftaran dengan Nomor Pendaftaran atau NIK "<strong>' . html_escape($data['keyword']) . '</strong>" tidak ditemukan.');
            }
        }

        $this->render_public('public/pendaftaran_cek', $data);
    }
}
