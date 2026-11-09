<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profil_model');
        $this->load->model('Fasilitas_model');
    }

    public function index() {
        $data['title'] = 'Sistem Informasi dan Promosi LPI Dayah Al-Ikhlas Al-Aziziyah';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();

        // Get Jenjang list
        $data['jenjang_list'] = $this->db->order_by('urutan', 'ASC')->get('jenjang')->result();

        // Get Peraturan Dayah list
        $data['peraturan_list'] = $this->db->order_by('bidang', 'ASC')->order_by('urutan', 'ASC')->get('peraturan')->result();

        // Get Jadwal Kegiatan list
        $data['jadwal_list'] = $this->db->order_by('urutan', 'ASC')->order_by('jam_mulai', 'ASC')->get('jadwal_kegiatan')->result();

        // Get Fasilitas list
        $data['fasilitas_list'] = $this->Fasilitas_model->get_all();

        $this->render_public('public/beranda', $data);
    }
}
