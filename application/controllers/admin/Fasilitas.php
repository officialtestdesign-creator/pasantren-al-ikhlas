<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Fasilitas_model');
        $this->load->library('upload');
    }

    public function index() {
        $data['title'] = 'Data Master Fasilitas Dayah';
        $data['fasilitas_list'] = $this->Fasilitas_model->get_all();
        $data['total_fasilitas'] = count($data['fasilitas_list']);

        // Preset foto asli yang ada di direktori img/
        $data['preset_images'] = array(
            'img/gedung_asrama_baru.jpeg'   => 'Gedung Asrama Baru (img/gedung_asrama_baru.jpeg)',
            'img/interior_mushalla.jpeg'    => 'Interior Mushalla (img/interior_mushalla.jpeg)',
            'img/pengajian_santriwati.jpeg' => 'Ruang Pengajian / Halaqah (img/pengajian_santriwati.jpeg)',
            'img/gedung_utama.jpeg'         => 'Gedung Utama (img/gedung_utama.jpeg)',
            'img/asrama_bertingkat.jpeg'    => 'Asrama Bertingkat (img/asrama_bertingkat.jpeg)',
            'img/bilik_santri.jpeg'         => 'Bilik Santri (img/bilik_santri.jpeg)',
            'img/gedung_lantai2.jpeg'       => 'Gedung Lantai 2 (img/gedung_lantai2.jpeg)',
            'img/halaman_dayah.jpeg'        => 'Halaman Dayah (img/halaman_dayah.jpeg)',
            'img/plang_dayah.jpg'           => 'Plang Dayah (img/plang_dayah.jpg)'
        );

        $this->render_admin('admin/fasilitas/index', $data);
    }

    public function simpan() {
        $this->form_validation->set_rules('nama', 'Nama Fasilitas', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Fasilitas', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan Tampil', 'trim|numeric');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            redirect('admin/fasilitas');
            return;
        }

        $nama = $this->input->post('nama', TRUE);
        $deskripsi = $this->input->post('deskripsi', TRUE);
        $urutan = $this->input->post('urutan', TRUE) !== '' ? (int)$this->input->post('urutan', TRUE) : 0;
        
        $foto_path = null; // Default kosong jika tidak ada gambar

        // 1. Cek apakah ada unggahan file dari komputer
        if (!empty($_FILES['foto']['name'])) {
            $upload_path = FCPATH . 'uploads/fasilitas/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, TRUE);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 4096; // 4MB
            $config['file_name']     = 'fasilitas_' . time() . '_' . substr(md5(uniqid(mt_rand(), true)), 0, 8);

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto_path = 'uploads/fasilitas/' . $upload_data['file_name'];
            } else {
                set_alert('danger', 'Gagal mengunggah foto: ' . $this->upload->display_errors('', ''));
                redirect('admin/fasilitas');
                return;
            }
        }
        // 2. Jika tidak ada file baru, cek apakah memilih gambar dari preset img/
        elseif (!empty($this->input->post('preset_foto', TRUE))) {
            $preset = $this->input->post('preset_foto', TRUE);
            if (file_exists(FCPATH . $preset)) {
                $foto_path = $preset;
            }
        }
        // 3. Jika tidak memilih foto: tetap NULL (dikosongkan untuk ditambahkan nanti)

        $data_insert = array(
            'nama'      => $nama,
            'deskripsi' => $deskripsi,
            'foto'      => $foto_path,
            'urutan'    => $urutan
        );

        $this->Fasilitas_model->insert($data_insert);
        set_alert('success', 'Fasilitas baru <strong>' . html_escape($nama) . '</strong> berhasil ditambahkan.');
        redirect('admin/fasilitas');
    }

    public function update($id) {
        $fasilitas = $this->Fasilitas_model->get_by_id($id);
        if (!$fasilitas) {
            set_alert('danger', 'Data fasilitas tidak ditemukan.');
            redirect('admin/fasilitas');
            return;
        }

        $this->form_validation->set_rules('nama', 'Nama Fasilitas', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Fasilitas', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan Tampil', 'trim|numeric');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            redirect('admin/fasilitas');
            return;
        }

        $nama = $this->input->post('nama', TRUE);
        $deskripsi = $this->input->post('deskripsi', TRUE);
        $urutan = $this->input->post('urutan', TRUE) !== '' ? (int)$this->input->post('urutan', TRUE) : 0;
        
        $foto_path = $fasilitas->foto; // Pertahankan foto lama

        // Cek jika pengguna memilih opsi mengosongkan/menghapus foto
        if ($this->input->post('hapus_foto', TRUE) == '1') {
            if (!empty($fasilitas->foto) && strpos($fasilitas->foto, 'uploads/fasilitas/') === 0) {
                @unlink(FCPATH . $fasilitas->foto);
            }
            $foto_path = null;
        }
        // Cek jika mengunggah file foto baru dari komputer
        elseif (!empty($_FILES['foto']['name'])) {
            $upload_path = FCPATH . 'uploads/fasilitas/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, TRUE);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 4096; // 4MB
            $config['file_name']     = 'fasilitas_' . time() . '_' . substr(md5(uniqid(mt_rand(), true)), 0, 8);

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                if (!empty($fasilitas->foto) && strpos($fasilitas->foto, 'uploads/fasilitas/') === 0) {
                    $old_file = FCPATH . $fasilitas->foto;
                    if (file_exists($old_file)) {
                        @unlink($old_file);
                    }
                }

                $upload_data = $this->upload->data();
                $foto_path = 'uploads/fasilitas/' . $upload_data['file_name'];
            } else {
                set_alert('danger', 'Gagal mengunggah foto baru: ' . $this->upload->display_errors('', ''));
                redirect('admin/fasilitas');
                return;
            }
        }
        // Cek jika memilih foto dari preset img/
        elseif (!empty($this->input->post('preset_foto', TRUE))) {
            $preset = $this->input->post('preset_foto', TRUE);
            if (file_exists(FCPATH . $preset)) {
                $foto_path = $preset;
            }
        }

        $data_update = array(
            'nama'      => $nama,
            'deskripsi' => $deskripsi,
            'foto'      => $foto_path,
            'urutan'    => $urutan
        );

        $this->Fasilitas_model->update($id, $data_update);
        set_alert('success', 'Perubahan data fasilitas <strong>' . html_escape($nama) . '</strong> berhasil disimpan.');
        redirect('admin/fasilitas');
    }

    public function hapus($id) {
        $fasilitas = $this->Fasilitas_model->get_by_id($id);
        if (!$fasilitas) {
            set_alert('danger', 'Data fasilitas tidak ditemukan.');
            redirect('admin/fasilitas');
            return;
        }

        // Hapus file fisik jika berada di direktori uploads
        if (!empty($fasilitas->foto) && strpos($fasilitas->foto, 'uploads/fasilitas/') === 0) {
            $file = FCPATH . $fasilitas->foto;
            if (file_exists($file)) {
                @unlink($file);
            }
        }

        $this->Fasilitas_model->delete($id);
        set_alert('success', 'Data fasilitas <strong>' . html_escape($fasilitas->nama) . '</strong> berhasil dihapus.');
        redirect('admin/fasilitas');
    }
}
