<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartu_spp extends Bendahara_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Santri_model');
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Kartu SPP Digital Santri';

        $filter = array(
            'status'   => 'aktif',
            'kelas_id' => $this->input->get('kelas_id', TRUE),
            'keyword'  => $this->input->get('keyword', TRUE)
        );

        $data['filter'] = $filter;
        $data['santri_list'] = $this->Santri_model->get_all($filter);
        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list();

        $this->render_admin('bendahara/kartu_spp/index', $data);
    }

    public function detail($santri_id) {
        $santri = $this->Santri_model->get_by_id($santri_id);
        if (!$santri) {
            set_alert('danger', 'Data santri tidak ditemukan.');
            redirect('bendahara/kartu_spp');
        }

        $tahun = (int) ($this->input->get('tahun', TRUE) ?: date('Y'));

        $data['title'] = 'Kartu SPP Digital: ' . $santri->nama . ' (' . $tahun . ')';
        $data['s'] = $santri;
        $data['tahun'] = $tahun;
        $data['matrix'] = $this->Pembayaran_model->get_kartu_spp($santri_id, $tahun);

        // Calculate summary
        $total_lunas = 0;
        $total_nominal = 0;
        foreach ($data['matrix'] as $m) {
            if ($m['is_lunas']) {
                $total_lunas++;
                $total_nominal += $m['jumlah'];
            }
        }
        $data['total_lunas'] = $total_lunas;
        $data['total_nominal_terbayar'] = $total_nominal;

        $this->render_admin('bendahara/kartu_spp/detail', $data);
    }

    public function cetak($santri_id, $tahun = null) {
        $santri = $this->Santri_model->get_by_id($santri_id);
        if (!$santri) {
            show_404();
        }

        $tahun = (int) ($tahun ?: date('Y'));
        $data['title'] = 'Kartu SPP - ' . $santri->nama . ' - Tahun ' . $tahun;
        $data['s'] = $santri;
        $data['tahun'] = $tahun;
        $data['matrix'] = $this->Pembayaran_model->get_kartu_spp($santri_id, $tahun);
        $data['profil'] = $this->profil;

        $this->load->view('bendahara/kartu_spp/cetak', $data);
    }
}
