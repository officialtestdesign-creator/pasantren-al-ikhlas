<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Pimpinan_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profil_model');
        $this->load->model('Guru_model');
        $this->load->model('Santri_model');
        $this->load->model('Pembayaran_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Pimpinan - Laporan Eksekutif Dayah';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();

        // Data rekap per jenjang & kelas dari view database
        $data['rekap_kelas'] = $this->db->get('v_jumlah_santri_per_kelas')->result();

        // Statistik asal santri (Kabupaten / Wilayah)
        $this->db->select('coalesce(asal_kabupaten, "Belum diisi") as kabupaten, count(id) as total');
        $this->db->where('status', 'aktif');
        $this->db->group_by('asal_kabupaten');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(6);
        $data['asal_santri'] = $this->db->get('santri')->result();

        // Ringkasan Keuangan Bulanan Tahun Ini
        $tahun_ini = (int) date('Y');
        $this->db->select('bulan, sum(jumlah) as total');
        $this->db->where('tahun', $tahun_ini);
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'ASC');
        $data['keuangan_bulanan'] = $this->db->get('pembayaran')->result();

        $this->render_admin('pimpinan/dashboard', $data);
    }

    public function rekap_santri() {
        $data['title'] = 'Monitoring Demografi & Status Santri';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();
        $data['rekap_kelas'] = $this->db->get('v_jumlah_santri_per_kelas')->result();

        // Sebaran daerah asal
        $this->db->select('coalesce(asal_kabupaten, "Lainnya") as kabupaten, count(id) as total');
        $this->db->where('status', 'aktif');
        $this->db->group_by('asal_kabupaten');
        $this->db->order_by('total', 'DESC');
        $data['asal_santri'] = $this->db->get('santri')->result();

        // Santri dalam vs luar kabupaten
        $data['santri_dalam_kab'] = $this->db->where('status', 'aktif')
            ->like('asal_kabupaten', 'Bireuen')
            ->count_all_results('santri');
        $data['santri_luar_kab'] = $data['stats']['santri_total'] - $data['santri_dalam_kab'];

        $this->render_admin('pimpinan/rekap_santri', $data);
    }

    public function rekap_guru() {
        $data['title'] = 'Monitoring Dewan Guru / Teungku Pengajar';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();
        $data['guru_list'] = $this->Guru_model->get_all();
        $data['guru_pns'] = $this->db->where('status_pns', 'PNS')->count_all_results('guru');
        $data['guru_non_pns'] = $this->db->where('status_pns', 'NON PNS')->count_all_results('guru');

        $this->render_admin('pimpinan/rekap_guru', $data);
    }

    public function rekap_keuangan() {
        $data['title'] = 'Monitoring Arus Penerimaan Kas Dayah';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();

        $tahun_ini = $this->input->get('tahun', TRUE) ?: (int)date('Y');
        $data['tahun_terpilih'] = $tahun_ini;

        // Bulanan matrix
        $this->db->select('bulan, sum(jumlah) as total');
        $this->db->where('tahun', $tahun_ini);
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'ASC');
        $data['keuangan_bulanan'] = $this->db->get('pembayaran')->result();

        // Recent 10 payments
        $this->db->select('p.*, s.nama as nama_santri, s.no_induk, jp.nama as nama_jenis');
        $this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        $this->db->join('jenis_pembayaran jp', 'jp.id = p.jenis_pembayaran_id', 'left');
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(10);
        $data['recent_transaksi'] = $this->db->get()->result();

        $this->render_admin('pimpinan/rekap_keuangan', $data);
    }

    public function laporan_dinas() {
        $data['title'] = 'Laporan Eksekutif Format Dinas Pendidikan Dayah';
        $data['stats'] = $this->Profil_model->get_dashboard_stats();
        $data['rekap_kelas'] = $this->db->get('v_jumlah_santri_per_kelas')->result();

        $this->render_admin('pimpinan/laporan_dinas', $data);
    }

    /**
     * Ekspor Data Santri Format Dinas Pendidikan Dayah (Excel .xls)
     */
    public function ekspor_santri_excel() {
        $data['santri'] = $this->Santri_model->get_santri_dinas_export();
        $data['profil'] = $this->profil;
        $data['tahun_ajaran'] = $this->tahun_ajaran_aktif ? $this->tahun_ajaran_aktif->nama : date('Y') . '/' . (date('Y') + 1);
        $data['tanggal_cetak'] = date('d-m-Y H:i:s');

        $filename = 'Format_Dinas_Data_Santri_' . date('Ymd_His') . '.xls';

        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $this->load->view('pimpinan/ekspor_santri_excel', $data);
    }

    /**
     * Ekspor Data Santri Format Dinas Pendidikan Dayah (CSV)
     */
    public function ekspor_santri_csv() {
        $santri = $this->Santri_model->get_santri_dinas_export();
        $filename = 'Format_Dinas_Data_Santri_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM

        fputcsv($output, array(
            'NO', 'NOMOR INDUK (NIS)', 'NIK', 'NAMA SANTRI', 'JENIS KELAMIN',
            'TEMPAT LAHIR', 'TANGGAL LAHIR', 'NAMA AYAH', 'NAMA IBU',
            'PEKERJAAN ORTU', 'GAMPONG/DESA', 'KECAMATAN', 'KABUPATEN/KOTA',
            'PROVINSI', 'ASAL SEKOLAH', 'JENJANG PENDIDIKAN', 'KELAS', 'TAHUN MASUK', 'STATUS'
        ));

        $no = 1;
        foreach ($santri as $s) {
            fputcsv($output, array(
                $no++,
                "'" . $s->no_induk,
                "'" . ($s->nik ?: '-'),
                $s->nama,
                $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                $s->tempat_lahir ?: '-',
                $s->tanggal_lahir ?: '-',
                $s->nama_ayah ?: '-',
                $s->nama_ibu ?: '-',
                $s->pekerjaan_ayah ?: ($s->pekerjaan_ibu ?: '-'),
                $s->asal_gampong ?: '-',
                $s->asal_kecamatan ?: '-',
                $s->asal_kabupaten ?: '-',
                $s->asal_provinsi ?: 'Aceh',
                $s->asal_sekolah ?: '-',
                $s->nama_jenjang ?: '-',
                $s->nama_kelas ?: '-',
                $s->tahun_masuk ?: '-',
                strtoupper($s->status)
            ));
        }
        fclose($output);
        exit;
    }

    /**
     * Cetak Resmi Data Santri Format Dinas (Printable / PDF)
     */
    public function cetak_santri_pdf() {
        $data['santri'] = $this->Santri_model->get_santri_dinas_export();
        $data['profil'] = $this->profil;
        $data['tahun_ajaran'] = $this->tahun_ajaran_aktif ? $this->tahun_ajaran_aktif->nama : date('Y') . '/' . (date('Y') + 1);
        $data['title'] = 'Cetak Rekapitulasi Santri Format Dinas - ' . ($this->profil->nama_dayah ?? 'Dayah Al-Ikhlas');

        $this->load->view('pimpinan/cetak_santri_pdf', $data);
    }

    /**
     * Ekspor Format EDATUDA Dewan Guru (Excel .xls)
     */
    public function ekspor_guru_excel() {
        $data['guru'] = $this->Guru_model->get_guru_edatuda_export();
        $data['profil'] = $this->profil;
        $data['tanggal_cetak'] = date('d-m-Y H:i:s');

        $filename = 'Format_EDATUDA_Dewan_Guru_' . date('Ymd_His') . '.xls';

        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $this->load->view('pimpinan/ekspor_guru_excel', $data);
    }

    /**
     * Ekspor Format EDATUDA Dewan Guru (CSV)
     */
    public function ekspor_guru_csv() {
        $guru = $this->Guru_model->get_guru_edatuda_export();
        $filename = 'Format_EDATUDA_Dewan_Guru_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, array(
            'NO', 'NOMOR INDUK GURU', 'NIK', 'NAMA LENGKAP & GELAR', 'JENIS KELAMIN',
            'TEMPAT LAHIR', 'TANGGAL LAHIR', 'PENDIDIKAN TERAKHIR', 'STATUS PNS',
            'STATUS KEPEGAWAIAN', 'MATA PELAJARAN / KITAB YANG DIASUH', 'KABUPATEN ASAL',
            'KECAMATAN ASAL', 'DESA ASAL', 'ALAMAT DOMISILI', 'NO. HP / WA', 'EMAIL', 'STATUS AKTIF'
        ));

        $no = 1;
        foreach ($guru as $g) {
            fputcsv($output, array(
                $no++,
                "'" . $g->no_induk,
                "'" . ($g->nik ?: '-'),
                $g->nama,
                $g->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                $g->tempat_lahir ?: '-',
                $g->tanggal_lahir ?: '-',
                $g->pendidikan_terakhir ?: '-',
                $g->status_pns,
                $g->status_tetap,
                $g->mata_pelajaran ?: '-',
                $g->asal_kabupaten ?: '-',
                $g->asal_kecamatan ?: '-',
                $g->asal_desa ?: '-',
                $g->alamat_domisili ?: '-',
                $g->no_hp ?: '-',
                $g->email ?: '-',
                $g->aktif ? 'AKTIF' : 'TIDAK AKTIF'
            ));
        }
        fclose($output);
        exit;
    }

    /**
     * Cetak Resmi Format EDATUDA Dewan Guru (Printable / PDF)
     */
    public function cetak_guru_pdf() {
        $data['guru'] = $this->Guru_model->get_guru_edatuda_export();
        $data['profil'] = $this->profil;
        $data['title'] = 'Cetak Rekapitulasi Dewan Guru Format EDATUDA - ' . ($this->profil->nama_dayah ?? 'Dayah Al-Ikhlas');

        $this->load->view('pimpinan/cetak_guru_pdf', $data);
    }

    /**
     * Ekspor Ringkasan Pendataan Dayah (Excel .xls)
     */
    public function ekspor_pendataan_excel() {
        $stats = $this->Profil_model->get_dashboard_stats();
        $profil = $this->profil;
        $rekap_kelas = $this->db->get('v_jumlah_santri_per_kelas')->result();

        $santri_dalam_kab = $this->db->where('status', 'aktif')
            ->like('asal_kabupaten', 'Bireuen')
            ->count_all_results('santri');
        $santri_luar_kab = $stats['santri_total'] - $santri_dalam_kab;

        $guru_pns = $this->db->where('status_pns', 'PNS')->count_all_results('guru');
        $guru_non_pns = $this->db->where('status_pns', 'NON PNS')->count_all_results('guru');

        $filename = 'Ringkasan_Pendataan_Dinas_Dayah_' . date('Ymd_His') . '.xls';

        $data = array(
            'profil' => $profil,
            'stats' => $stats,
            'rekap_kelas' => $rekap_kelas,
            'santri_dalam_kab' => $santri_dalam_kab,
            'santri_luar_kab' => $santri_luar_kab,
            'guru_pns' => $guru_pns,
            'guru_non_pns' => $guru_non_pns,
            'tanggal_cetak' => date('d-m-Y H:i:s')
        );

        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $this->load->view('pimpinan/ekspor_pendataan_excel', $data);
    }

    /**
     * Ekspor Ringkasan Pendataan Dayah (CSV)
     */
    public function ekspor_pendataan_csv() {
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
        fputcsv($output, array('Pimpinan Dayah', $profil->nama_pimpinan ?: 'Tgk. H. Muhammad Nasir'));
        fputcsv($output, array('Status Kelembagaan', $profil->status_kelembagaan));
        fputcsv($output, array('Izin Operasional', $profil->izin_operasional ?: 'Kd.01.02/5/PP.00.7/142/2018'));
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

    /**
     * Cetak Ringkasan Pendataan Dayah (Printable / PDF)
     */
    public function cetak_pendataan_pdf() {
        $stats = $this->Profil_model->get_dashboard_stats();
        $profil = $this->profil;
        $rekap_kelas = $this->db->get('v_jumlah_santri_per_kelas')->result();

        $santri_dalam_kab = $this->db->where('status', 'aktif')
            ->like('asal_kabupaten', 'Bireuen')
            ->count_all_results('santri');
        $santri_luar_kab = $stats['santri_total'] - $santri_dalam_kab;

        $guru_pns = $this->db->where('status_pns', 'PNS')->count_all_results('guru');
        $guru_non_pns = $this->db->where('status_pns', 'NON PNS')->count_all_results('guru');

        $data = array(
            'profil' => $profil,
            'stats' => $stats,
            'rekap_kelas' => $rekap_kelas,
            'santri_dalam_kab' => $santri_dalam_kab,
            'santri_luar_kab' => $santri_luar_kab,
            'guru_pns' => $guru_pns,
            'guru_non_pns' => $guru_non_pns,
            'tahun_ajaran' => $this->tahun_ajaran_aktif ? $this->tahun_ajaran_aktif->nama : date('Y') . '/' . (date('Y') + 1),
            'title' => 'Cetak Ringkasan Pendataan Dayah Format Dinas - ' . ($this->profil->nama_dayah ?? 'Dayah Al-Ikhlas')
        );

        $this->load->view('pimpinan/cetak_pendataan_pdf', $data);
    }
}
