<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunggakan extends Bendahara_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Rekapitulasi Tunggakan SPP Santri';

        $tahun = (int) ($this->input->get('tahun', TRUE) ?: date('Y'));
        $bulan = (int) ($this->input->get('bulan', TRUE) ?: date('m'));
        $kelas_id = $this->input->get('kelas_id', TRUE);

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['kelas_id'] = $kelas_id;

        // Get default SPP nominal
        $spp_tarif = $this->Pembayaran_model->get_jenis_by_id(1);
        $data['tarif_spp'] = $spp_tarif ? (float)$spp_tarif->nominal : 150000;

        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list();
        $data['tunggakan_list'] = $this->Pembayaran_model->get_rekap_tunggakan($tahun, $bulan, $kelas_id);

        $data['total_menunggak'] = count($data['tunggakan_list']);
        $data['total_nominal_tunggakan'] = $data['total_menunggak'] * $data['tarif_spp'];

        $this->render_admin('bendahara/tunggakan/index', $data);
    }
}
