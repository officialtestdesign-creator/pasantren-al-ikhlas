<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Santri_model');
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Manajemen Keuangan & SPP Dayah';

        $filter = array(
            'jenis_pembayaran_id' => $this->input->get('jenis_id', TRUE),
            'tahun'               => $this->input->get('tahun', TRUE) ?: date('Y'),
            'bulan'               => $this->input->get('bulan', TRUE),
            'kelas_id'            => $this->input->get('kelas_id', TRUE),
            'keyword'             => $this->input->get('keyword', TRUE)
        );

        $data['filter'] = $filter;
        $data['riwayat'] = $this->Pembayaran_model->get_riwayat($filter);
        $data['jenis_list'] = $this->Pembayaran_model->get_jenis_pembayaran();
        $data['kelas_list'] = $this->Pendaftaran_model->get_kelas_list();

        $total_penerimaan = 0;
        foreach ($data['riwayat'] as $r) {
            $total_penerimaan += (float)$r->jumlah;
        }
        $data['total_nominal_terfilter'] = $total_penerimaan;

        $this->render_admin('bendahara/spp/index', $data);
    }

    public function input() {
        redirect('bendahara/spp/input');
    }

    public function hapus($id) {
        $pembayaran = $this->Pembayaran_model->get_by_id($id);
        if (!$pembayaran) {
            set_alert('danger', 'Transaksi pembayaran tidak ditemukan.');
            redirect('admin/pembayaran');
            return;
        }

        $this->db->where('id', $id)->delete('pembayaran');
        set_alert('success', 'Transaksi pembayaran kuitansi <strong>' . html_escape($pembayaran->no_kuitansi) . '</strong> berhasil dibatalkan/dihapus.');
        redirect('admin/pembayaran');
    }
}
