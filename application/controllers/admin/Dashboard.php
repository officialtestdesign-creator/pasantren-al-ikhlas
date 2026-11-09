<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profil_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Admin - Panel Pengelola';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();

        // Recent pendaftaran
        $data['recent_pendaftar'] = $this->db->order_by('id', 'DESC')->limit(5)->get('pendaftaran')->result();

        // Recent pembayaran
        $this->db->select('p.*, s.nama as nama_santri, s.no_induk, jp.nama as nama_jenis');
        $this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        $this->db->join('jenis_pembayaran jp', 'jp.id = p.jenis_pembayaran_id', 'left');
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(5);
        $data['recent_pembayaran'] = $this->db->get()->result();

        // Jenjang & Kelas summary
        $data['kelas_list'] = $this->db->select('k.*, j.nama as nama_jenjang, g.nama as nama_wali')
            ->from('kelas k')
            ->join('jenjang j', 'j.id = k.jenjang_id', 'left')
            ->join('guru g', 'g.id = k.wali_kelas_id', 'left')
            ->get()->result();

        $this->render_admin('admin/dashboard', $data);
    }
}
