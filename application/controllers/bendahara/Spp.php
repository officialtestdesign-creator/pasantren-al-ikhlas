<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spp extends Bendahara_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Santri_model');
        $this->load->model('Pendaftaran_model');
    }

    public function index() {
        $data['title'] = 'Buku Kas & Transaksi Pembayaran Dayah';

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

        // Calculate total nominal from filtered result
        $total_penerimaan = 0;
        foreach ($data['riwayat'] as $r) {
            $total_penerimaan += (float)$r->jumlah;
        }
        $data['total_nominal_terfilter'] = $total_penerimaan;

        $this->render_admin('bendahara/spp/index', $data);
    }

    public function input() {
        $data['title'] = 'Input Penerimaan Kas / Pembayaran SPP';
        $data['santri_id_selected'] = $this->input->get('santri_id', TRUE);
        $data['bulan_selected'] = $this->input->get('bulan', TRUE) ?: (int)date('m');
        $data['tahun_selected'] = $this->input->get('tahun', TRUE) ?: (int)date('Y');

        $data['santri_list'] = $this->Santri_model->get_all(array('status' => 'aktif'));
        $data['jenis_list'] = $this->Pembayaran_model->get_jenis_pembayaran();
        $data['auto_kuitansi'] = $this->Pembayaran_model->generate_no_kuitansi();

        $this->render_admin('bendahara/spp/form', $data);
    }

    public function simpan() {
        $this->form_validation->set_rules('santri_id', 'Nama Santri', 'required|numeric');
        $this->form_validation->set_rules('jenis_pembayaran_id', 'Jenis Pembayaran', 'required|numeric');
        $this->form_validation->set_rules('tanggal_bayar', 'Tanggal Pembayaran', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah Nominal Pembayaran', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            set_alert('danger', validation_errors('', '<br>'));
            $this->input();
            return;
        }

        $santri_id = $this->input->post('santri_id', TRUE);
        $jenis_id  = $this->input->post('jenis_pembayaran_id', TRUE);
        $tahun     = $this->input->post('tahun', TRUE) ?: date('Y');
        $bulan     = $this->input->post('bulan', TRUE) ?: 0;
        $tahap     = $this->input->post('tahap', TRUE) ?: 0;
        $jumlah    = $this->input->post('jumlah', TRUE);

        // Check duplicate SPP payment for same month/year
        if ($jenis_id == 1 && $bulan > 0) {
            $existing = $this->db->get_where('pembayaran', array(
                'santri_id' => $santri_id,
                'jenis_pembayaran_id' => 1,
                'tahun' => $tahun,
                'bulan' => $bulan
            ))->row();

            if ($existing) {
                set_alert('danger', 'Santri tersebut sudah pernah membayar SPP bulan <strong>' . nama_bulan($bulan) . ' ' . $tahun . '</strong> (Kuitansi: ' . $existing->no_kuitansi . '). Transaksi ganda ditolak.');
                redirect('bendahara/spp/input?santri_id=' . $santri_id);
                return;
            }
        }

        $data = array(
            'no_kuitansi'         => $this->Pembayaran_model->generate_no_kuitansi(),
            'santri_id'           => $santri_id,
            'jenis_pembayaran_id' => $jenis_id,
            'tahun'               => $tahun,
            'bulan'               => $bulan,
            'tahap'               => $tahap,
            'tanggal_bayar'       => $this->input->post('tanggal_bayar', TRUE),
            'jumlah'              => $jumlah,
            'keterangan'          => $this->input->post('keterangan', TRUE),
            'petugas_id'          => user_id()
        );

        $id = $this->Pembayaran_model->simpan($data);

        $action = $this->input->post('submit_action', TRUE);
        if ($action === 'simpan_kembali') {
            set_alert('success', 'Pembayaran berhasil dicatat dengan No. Kuitansi <strong>' . $data['no_kuitansi'] . '</strong>. <a href="' . base_url('bendahara/spp/kuitansi/' . $id) . '" target="_blank" class="fw-bold text-success text-decoration-underline ms-2"><i class="bi bi-printer-fill me-1"></i>Cetak Kuitansi</a>');
            redirect('bendahara/spp');
            return;
        }

        set_alert('success', 'Pembayaran berhasil dicatat dengan No. Kuitansi <strong>' . $data['no_kuitansi'] . '</strong>.');
        redirect('bendahara/spp/kuitansi/' . $id);
    }

    public function kuitansi($id) {
        $pembayaran = $this->Pembayaran_model->get_by_id($id);
        if (!$pembayaran) {
            show_404();
        }

        $data['title'] = 'Kuitansi Pembayaran - ' . $pembayaran->no_kuitansi;
        $data['p'] = $pembayaran;
        $data['profil'] = $this->profil;
        $this->load->view('bendahara/kuitansi_cetak', $data);
    }

    public function hapus($id) {
        $pembayaran = $this->Pembayaran_model->get_by_id($id);
        if (!$pembayaran) {
            set_alert('danger', 'Transaksi tidak ditemukan.');
            redirect('bendahara/spp');
        }

        $this->db->where('id', $id)->delete('pembayaran');
        set_alert('success', 'Transaksi kuitansi <strong>' . html_escape($pembayaran->no_kuitansi) . '</strong> berhasil dibatalkan/dihapus.');
        redirect('bendahara/spp');
    }
}
