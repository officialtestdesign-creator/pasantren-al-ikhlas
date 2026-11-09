<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Bendahara_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
    }

    public function index() {
        $data['title'] = 'Laporan Penerimaan Kas & Keuangan Dayah';

        $filter = array(
            'tanggal_awal'  => $this->input->get('tanggal_awal', TRUE) ?: date('Y-m-01'),
            'tanggal_akhir' => $this->input->get('tanggal_akhir', TRUE) ?: date('Y-m-d'),
            'jenis_id'      => $this->input->get('jenis_id', TRUE)
        );

        $data['filter'] = $filter;
        $data['riwayat'] = $this->Pembayaran_model->get_riwayat(array(
            'tanggal_awal'        => $filter['tanggal_awal'],
            'tanggal_akhir'       => $filter['tanggal_akhir'],
            'jenis_pembayaran_id' => $filter['jenis_id']
        ));

        // Grouping totals
        $total = 0;
        $by_jenis = array();
        foreach ($data['riwayat'] as $r) {
            $total += (float)$r->jumlah;
            if (!isset($by_jenis[$r->nama_jenis])) {
                $by_jenis[$r->nama_jenis] = 0;
            }
            $by_jenis[$r->nama_jenis] += (float)$r->jumlah;
        }

        $data['total_kas'] = $total;
        $data['by_jenis'] = $by_jenis;
        $data['jenis_list'] = $this->Pembayaran_model->get_jenis_pembayaran();

        $this->render_admin('bendahara/laporan/index', $data);
    }

    public function ekspor_csv() {
        $tanggal_awal  = $this->input->get('tanggal_awal', TRUE) ?: date('Y-m-01');
        $tanggal_akhir = $this->input->get('tanggal_akhir', TRUE) ?: date('Y-m-d');
        $jenis_id      = $this->input->get('jenis_id', TRUE);

        $riwayat = $this->Pembayaran_model->get_riwayat(array(
            'tanggal_awal'        => $tanggal_awal,
            'tanggal_akhir'       => $tanggal_akhir,
            'jenis_pembayaran_id' => $jenis_id
        ));

        $filename = 'Laporan_Keuangan_Dayah_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, array('NO', 'NO. KUITANSI', 'TANGGAL BAYAR', 'NIS', 'NAMA SANTRI', 'KELAS', 'JENIS PEMBAYARAN', 'PERIODE/BULAN', 'JUMLAH (RP)', 'KETERANGAN'));

        $no = 1;
        $total = 0;
        foreach ($riwayat as $r) {
            $periode = $r->bulan ? nama_bulan($r->bulan) . ' ' . $r->tahun : '-';
            $total += (float)$r->jumlah;
            fputcsv($output, array(
                $no++,
                "'" . $r->no_kuitansi,
                $r->tanggal_bayar,
                "'" . $r->no_induk,
                $r->nama_santri,
                $r->nama_kelas ?: '-',
                $r->nama_jenis,
                $periode,
                $r->jumlah,
                $r->keterangan ?: '-'
            ));
        }

        fputcsv($output, array('', '', '', '', '', '', '', 'TOTAL PENERIMAAN:', $total, ''));

        fclose($output);
        exit;
    }
}
