<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_profil() {
        $profil = $this->db->get('profil_dayah')->row();
        if (!$profil) {
            $default = (object) array(
                'id' => 1,
                'nama_dayah' => 'LPI Dayah Al-Ikhlas Al-Aziziyah',
                'tahun_berdiri' => 2007,
                'gampong' => 'Sangso',
                'kecamatan' => 'Samalanga',
                'kabupaten' => 'Bireuen',
                'status_kelembagaan' => 'Yayasan/Lembaga Pendidikan Islam',
                'nama_pimpinan' => 'Tgk. H. ...',
                'visi' => 'Mewujudkan generasi santri yang berakhlak mulia, berilmu amaliyah, dan berpegang teguh pada Al-Qur\'an dan As-Sunnah.',
                'misi' => 'Menyelenggarakan pendidikan Islam berbasis salafiyah terpadu dan pengkajian kitab kuning.',
                'no_hp' => '08xxxxxxxxxx',
                'email' => 'dayah.alikhlas.aziziyah@gmail.com',
                'logo' => null
            );
            return $default;
        }
        return $profil;
    }

    public function update_profil($data) {
        $check = $this->db->get('profil_dayah')->row();
        if ($check) {
            return $this->db->where('id', $check->id)->update('profil_dayah', $data);
        } else {
            return $this->db->insert('profil_dayah', $data);
        }
    }

    public function get_tahun_ajaran_aktif() {
        $ta = $this->db->get_where('tahun_ajaran', array('aktif' => 1))->row();
        if (!$ta) {
            $ta = $this->db->order_by('id', 'DESC')->get('tahun_ajaran')->row();
        }
        return $ta ?: (object) array('id' => 1, 'nama' => '2026/2027');
    }

    /**
     * Get aggregate statistics for dashboards
     */
    public function get_dashboard_stats() {
        $stats = array();

        // 1. Santri Stats
        $stats['santri_total'] = $this->db->where('status', 'aktif')->count_all_results('santri');
        $stats['santri_putra'] = $this->db->where('status', 'aktif')->where('jenis_kelamin', 'L')->count_all_results('santri');
        $stats['santri_putri'] = $this->db->where('status', 'aktif')->where('jenis_kelamin', 'P')->count_all_results('santri');

        // 2. Guru / Teungku Stats
        $stats['guru_total'] = $this->db->where('aktif', 1)->count_all_results('guru');

        // 3. Pendaftaran Stats
        $stats['pendaftar_baru'] = $this->db->where('status', 'menunggu')->count_all_results('pendaftaran');
        $stats['pendaftar_total'] = $this->db->count_all_results('pendaftaran');

        // 4. Keuangan / SPP Bulan Berjalan
        $bulan_ini = (int) date('m');
        $tahun_ini = (int) date('Y');

        $this->db->select_sum('jumlah');
        $this->db->where('bulan', $bulan_ini);
        $this->db->where('tahun', $tahun_ini);
        $query_spp = $this->db->get('pembayaran')->row();
        $stats['spp_bulan_ini'] = $query_spp && $query_spp->jumlah ? (float) $query_spp->jumlah : 0;

        // 5. Total Pemasukan Keseluruhan
        $this->db->select_sum('jumlah');
        $query_total = $this->db->get('pembayaran')->row();
        $stats['total_pemasukan'] = $query_total && $query_total->jumlah ? (float) $query_total->jumlah : 0;

        // 6. Jenjang
        $stats['jenjang_total'] = $this->db->count_all_results('jenjang');
        $stats['kelas_total'] = $this->db->count_all_results('kelas');

        return $stats;
    }
}
