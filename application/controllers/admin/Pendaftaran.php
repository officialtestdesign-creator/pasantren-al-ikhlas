<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Verifikasi Pendaftaran Santri Baru';

        $filter = array(
            'status'     => $this->input->get('status', TRUE),
            'jenjang_id' => $this->input->get('jenjang_id', TRUE),
            'keyword'    => $this->input->get('keyword', TRUE)
        );

        $data['filter'] = $filter;
        $data['pendaftar_list'] = $this->Pendaftaran_model->get_all($filter);
        $data['jenjang_list'] = $this->Pendaftaran_model->get_jenjang_list();

        // Status Counts
        $data['count_all'] = $this->db->count_all('pendaftaran');
        $data['count_menunggu'] = $this->db->where('status', 'menunggu')->count_all_results('pendaftaran');
        $data['count_diterima'] = $this->db->where('status', 'diterima')->count_all_results('pendaftaran');
        $data['count_ditolak'] = $this->db->where('status', 'ditolak')->count_all_results('pendaftaran');
        $data['count_cadangan'] = $this->db->where('status', 'cadangan')->count_all_results('pendaftaran');

        $this->render_admin('admin/pendaftaran/index', $data);
    }

    public function detail($id) {
        $pendaftar = $this->Pendaftaran_model->get_by_id($id);
        if (!$pendaftar) {
            set_alert('danger', 'Data pendaftaran tidak ditemukan.');
            redirect('admin/pendaftaran');
        }

        $data['title'] = 'Detail Pendaftar: ' . $pendaftar->nama . ' (' . $pendaftar->no_pendaftaran . ')';
        $data['p'] = $pendaftar;
        $data['berkas'] = $this->Pendaftaran_model->get_berkas($id);
        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list($pendaftar->jenjang_tujuan_id);
        $data['auto_nis'] = $this->Pendaftaran_model->generate_nis();

        $this->render_admin('admin/pendaftaran/detail', $data);
    }

    public function ubah_status($id) {
        $status = $this->input->post('status', TRUE);
        $catatan = $this->input->post('catatan', TRUE);

        if (!in_array($status, array('menunggu', 'diterima', 'ditolak', 'cadangan'))) {
            set_alert('danger', 'Status tidak valid.');
            redirect('admin/pendaftaran/detail/' . $id);
            return;
        }

        $this->Pendaftaran_model->update_status($id, $status, $catatan);
        set_alert('success', 'Status pendaftaran berhasil diperbarui menjadi <strong>' . ucfirst($status) . '</strong>.');
        redirect('admin/pendaftaran/detail/' . $id);
    }

    public function jadikan_santri($id) {
        $p = $this->Pendaftaran_model->get_by_id($id);
        if (!$p) {
            set_alert('danger', 'Data pendaftaran tidak ditemukan.');
            redirect('admin/pendaftaran');
            return;
        }

        if (!empty($p->santri_id)) {
            set_alert('warning', 'Pendaftar ini sudah pernah dijadikan santri sebelumnya.');
            redirect('admin/pendaftaran/detail/' . $id);
            return;
        }

        $no_induk = $this->input->post('no_induk', TRUE);
        $kelas_id = $this->input->post('kelas_id', TRUE);

        if (empty($no_induk)) {
            $no_induk = $this->Pendaftaran_model->generate_nis();
        }

        // Check if NIS already exists in santri table
        $check_nis = $this->db->get_where('santri', array('no_induk' => $no_induk))->row();
        if ($check_nis) {
            set_alert('danger', 'Nomor Induk Santri (NIS) <strong>' . html_escape($no_induk) . '</strong> sudah digunakan oleh santri lain.');
            redirect('admin/pendaftaran/detail/' . $id);
            return;
        }

        $santri_id = $this->Pendaftaran_model->jadikan_santri($id, $no_induk, $kelas_id);

        if ($santri_id) {
            set_alert('success', 'Alhamdulillah! Calon santri <strong>' . html_escape($p->nama) . '</strong> berhasil resmi dijadikan Santri Aktif dengan NIS <strong>' . html_escape($no_induk) . '</strong>.');
        } else {
            set_alert('danger', 'Terjadi kesalahan saat memproses data santri.');
        }

        redirect('admin/pendaftaran/detail/' . $id);
    }

    /**
     * Admin mengunggah atau mengganti berkas calon santri
     */
    public function unggah_berkas($id) {
        $p = $this->Pendaftaran_model->get_by_id($id);
        if (!$p) {
            set_alert('danger', 'Data pendaftaran tidak ditemukan.');
            redirect('admin/pendaftaran');
            return;
        }

        $jenis_berkas = $this->input->post('jenis_berkas', TRUE);
        $allowed_berkas = array('foto', 'kk', 'ktp_ortu', 'ijazah');

        if (!in_array($jenis_berkas, $allowed_berkas)) {
            set_alert('danger', 'Jenis berkas tidak valid.');
            redirect('admin/pendaftaran/detail/' . $id);
            return;
        }

        if (empty($_FILES['file_berkas']['name'])) {
            set_alert('danger', 'Silakan pilih file berkas yang ingin diunggah.');
            redirect('admin/pendaftaran/detail/' . $id);
            return;
        }

        $upload_dir = FCPATH . 'uploads/berkas/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, TRUE);
        }

        $ext = strtolower(pathinfo($_FILES['file_berkas']['name'], PATHINFO_EXTENSION));
        $config['upload_path']   = $upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 4096;
        $config['overwrite']     = TRUE;
        $config['file_name']     = $p->no_pendaftaran . '_' . $jenis_berkas . '_' . time() . '_' . mt_rand(10, 99) . '.' . $ext;

        $this->load->library('upload', $config);
        $this->upload->initialize($config, TRUE);

        if ($this->upload->do_upload('file_berkas')) {
            $upload_data = $this->upload->data();
            $this->Pendaftaran_model->save_or_replace_berkas($id, $jenis_berkas, $upload_data['file_name']);

            // Jika santri sudah dibuat dan yang diunggah adalah foto, sinkronkan foto santri juga
            if ($jenis_berkas === 'foto' && !empty($p->santri_id)) {
                $this->db->where('id', $p->santri_id)->update('santri', array(
                    'foto' => $upload_data['file_name']
                ));
            }

            set_alert('success', 'Berkas <strong>' . ucfirst($jenis_berkas) . '</strong> berhasil diunggah.');
        } else {
            set_alert('danger', 'Gagal mengunggah berkas: ' . strip_tags($this->upload->display_errors()));
        }

        redirect('admin/pendaftaran/detail/' . $id);
    }

    /**
     * Admin menghapus salah satu berkas
     */
    public function hapus_berkas($id, $berkas_id) {
        $p = $this->Pendaftaran_model->get_by_id($id);
        if (!$p) {
            set_alert('danger', 'Data pendaftaran tidak ditemukan.');
            redirect('admin/pendaftaran');
            return;
        }

        $berkas = $this->Pendaftaran_model->get_berkas_by_id($berkas_id);
        if ($berkas && $berkas->pendaftaran_id == $id) {
            $this->Pendaftaran_model->delete_berkas_single($berkas_id);
            set_alert('success', 'Berkas <strong>' . ucfirst($berkas->jenis_berkas) . '</strong> berhasil dihapus.');
        } else {
            set_alert('danger', 'Berkas tidak ditemukan.');
        }

        redirect('admin/pendaftaran/detail/' . $id);
    }

    public function hapus($id) {
        $p = $this->Pendaftaran_model->get_by_id($id);
        if (!$p) {
            set_alert('danger', 'Data pendaftaran tidak ditemukan.');
            redirect('admin/pendaftaran');
        }

        // Delete berkas files
        $berkas = $this->Pendaftaran_model->get_berkas($id);
        foreach ($berkas as $b) {
            $file_path = FCPATH . 'uploads/berkas/' . $b->nama_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        $this->db->where('pendaftaran_id', $id)->delete('berkas_pendaftaran');
        $this->db->where('id', $id)->delete('pendaftaran');

        set_alert('success', 'Data pendaftaran <strong>' . html_escape($p->no_pendaftaran) . '</strong> berhasil dihapus.');
        redirect('admin/pendaftaran');
    }
}
