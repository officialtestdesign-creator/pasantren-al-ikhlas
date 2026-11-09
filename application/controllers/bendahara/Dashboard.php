<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Bendahara_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profil_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Bendahara - Keuangan & SPP Dayah';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();

        $bulan_ini = (int) date('m');
        $tahun_ini = (int) date('Y');

        // Recent pembayaran (last 10 transactions)
        $this->db->select('p.*, s.nama as nama_santri, s.no_induk, k.nama_kelas, jp.nama as nama_jenis');
        $this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->join('jenis_pembayaran jp', 'jp.id = p.jenis_pembayaran_id', 'left');
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(10);
        $data['recent_pembayaran'] = $this->db->get()->result();

        // Breakdown per jenis pembayaran
        $this->db->select('jp.nama, count(p.id) as total_transaksi, coalesce(sum(p.jumlah), 0) as total_nominal');
        $this->db->from('jenis_pembayaran jp');
        $this->db->join('pembayaran p', 'p.jenis_pembayaran_id = jp.id', 'left');
        $this->db->group_by('jp.id');
        $data['breakdown_jenis'] = $this->db->get()->result();

        // Rekap 1 Tahun Realisasi Kas Masuk Bulanan
        $this->db->select('bulan, count(id) as total_transaksi, sum(jumlah) as total');
        $this->db->where('tahun', $tahun_ini);
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'ASC');
        $data['keuangan_bulanan'] = $this->db->get('pembayaran')->result();

        $this->render_admin('bendahara/dashboard', $data);
    }
}
