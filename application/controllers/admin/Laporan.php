<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Santri_model');
        $this->load->model('Guru_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Akademik_model');
        $this->load->model('Profil_model');
    }

    public function index() {
        $data['title'] = 'Pusat Laporan & Ekspor Format Dinas Dayah';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();

        // 1. Rekap Per Jenjang & Kelas (Database View)
        $data['rekap_kelas'] = $this->db->get('v_jumlah_santri_per_kelas')->result();

        // 2. Rekap Asal Santri (Dalam vs Luar Kabupaten Bireuen)
        $data['santri_dalam_kab'] = $this->db->where('status', 'aktif')
            ->like('asal_kabupaten', 'Bireuen')
            ->count_all_results('santri');
        $data['santri_luar_kab'] = $data['stats']['santri_total'] - $data['santri_dalam_kab'];

        // 3. Rekap Asal Wilayah Top 8
        $this->db->select('coalesce(asal_kabupaten, "Belum diisi") as kabupaten, count(id) as total');
        $this->db->where('status', 'aktif');
        $this->db->group_by('asal_kabupaten');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(8);
        $data['wilayah_list'] = $this->db->get('santri')->result();

        // 4. Rekap Dewan Guru
        $data['guru_list'] = $this->Guru_model->get_all();
        $data['guru_pns'] = $this->db->where('status_pns', 'PNS')->count_all_results('guru');
        $data['guru_non_pns'] = $this->db->where('status_pns', 'NON PNS')->count_all_results('guru');

        $this->render_admin('admin/laporan/index', $data);
    }

    /**
     * Ekspor Rekapitulasi Pendataan Dayah Format Dinas Pendidikan Dayah
     */
    public function ekspor_pendataan_dinas() {
        $stats = $this->Profil_model->get_dashboard_stats();
        $profil = $this->profil;

        $santri_dalam_kab = $this->db->where('status', 'aktif')
            ->like('asal_kabupaten', 'Bireuen')
            ->count_all_results('santri');
        $santri_luar_kab = $stats['santri_total'] - $santri_dalam_kab;

        $filename = 'Format_Pendataan_Dinas_Dayah_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM

        fputcsv($output, array('FORMAT PENDATAAN LEMBAGA PENDIDIKAN ISLAM (DAYAH) DINAS PENDIDIKAN DAYAH'));
        fputcsv($output, array('LPI DAYAH AL-IKHLAS AL-AZIZIYAH SAMALANGA - TAHUN ' . date('Y')));
        fputcsv($output, array(''));

        // Profil Kelembagaan
        fputcsv($output, array('--- DATA IDENTITAS & KELEMBAGAAN DAYAH ---'));
        fputcsv($output, array('Nama Dayah', $profil->nama_dayah));
        fputcsv($output, array('Tahun Berdiri', $profil->tahun_berdiri));
        fputcsv($output, array('Pimpinan Dayah', $profil->nama_pimpinan));
        fputcsv($output, array('Status Kelembagaan', $profil->status_kelembagaan));
        fputcsv($output, array('Izin Operasional', $profil->izin_operasional));
        fputcsv($output, array('Alamat Dayah', 'Gampong ' . $profil->gampong . ', Kec. ' . $profil->kecamatan . ', Kab. ' . $profil->kabupaten));
        fputcsv($output, array('Kontak Dayah', $profil->no_hp . ' / ' . $profil->email));
        fputcsv($output, array(''));

        // Statistik Santri
        fputcsv($output, array('--- REKAPITULASI DATA SANTRI ---'));
        fputcsv($output, array('Total Santri Aktif', $stats['santri_total']));
        fputcsv($output, array('Santri Laki-laki (Putra)', $stats['santri_putra']));
        fputcsv($output, array('Santri Perempuan (Putri)', $stats['santri_putri']));
        fputcsv($output, array('Santri Asal Dalam Kabupaten', $santri_dalam_kab));
        fputcsv($output, array('Santri Asal Luar Kabupaten', $santri_luar_kab));
        fputcsv($output, array(''));

        // Rekap Per Kelas
        fputcsv($output, array('--- REKAPITULASI JUMLAH SANTRI PER ROMBEL / KELAS ---'));
        fputcsv($output, array('No', 'Jenjang', 'Nama Kelas', 'Tahun Ajaran', 'Laki-Laki', 'Perempuan', 'Total Santri'));
        $rekap_kelas = $this->db->get('v_jumlah_santri_per_kelas')->result();
        $no = 1;
        foreach ($rekap_kelas as $rk) {
            fputcsv($output, array(
                $no++,
                $rk->jenjang,
                $rk->nama_kelas,
                $rk->tahun_ajaran,
                (int)$rk->laki_laki,
                (int)$rk->perempuan,
                (int)$rk->jumlah
            ));
        }
        fputcsv($output, array(''));

        // Statistik Dewan Guru
        fputcsv($output, array('--- REKAPITULASI DEWAN GURU / TEUNGKU ---'));
        fputcsv($output, array('Total Guru Aktif', $stats['guru_total']));
        $guru_pns = $this->db->where('status_pns', 'PNS')->count_all_results('guru');
        $guru_non_pns = $this->db->where('status_pns', 'NON PNS')->count_all_results('guru');
        fputcsv($output, array('Guru Berstatus PNS', $guru_pns));
        fputcsv($output, array('Guru Berstatus Non-PNS', $guru_non_pns));

        fclose($output);
        exit;
    }
}
