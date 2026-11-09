<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

    protected $table = 'pembayaran';

    public function __construct() {
        parent::__construct();
        $this->ensure_default_jenis();
        $this->ensure_sample_1_tahun();
    }

    /**
     * Ensure 1 full year (12 months) of realistic financial transactions
     * simulating a dayah system running actively for 1 full year for Bendahara & Pimpinan
     */
    public function ensure_sample_1_tahun() {
        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Ensure AUTO_INCREMENT is enabled on primary key id
        $this->db->query("ALTER TABLE `{$this->table}` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");

        $count = $this->db->count_all($this->table);
        if ($count < 50) {
            // Reset existing minimal samples if any to build an orderly 1-year history
            $this->db->empty_table($this->table);
            $this->db->query("ALTER TABLE `{$this->table}` AUTO_INCREMENT = 1");

            $tahun = (int) date('Y');
            $kuitansi_counter = 1;
            $payments = array();

            // 1. Biaya Pendaftaran (jenis_pembayaran_id = 2, nominal 250.000)
            // 30 santri paid in early January
            for ($s_id = 1; $s_id <= 30; $s_id++) {
                $day = ($s_id % 7) + 3; // 3 to 9 Jan
                $payments[] = array(
                    'no_kuitansi'         => sprintf('KW-%d-01-%04d', $tahun, $kuitansi_counter++),
                    'santri_id'           => $s_id,
                    'jenis_pembayaran_id' => 2,
                    'tahun'               => $tahun,
                    'bulan'               => 0,
                    'tahap'               => 0,
                    'tanggal_bayar'       => sprintf('%04d-01-%02d', $tahun, $day),
                    'jumlah'              => 250000.00,
                    'keterangan'          => 'Infaq & Biaya Pendaftaran Santri Baru',
                    'petugas_id'          => 1
                );
            }

            // 2. Sumbangan Pembangunan Tahap 1 (jenis_pembayaran_id = 3, nominal 500.000)
            // 20 santri in January
            for ($s_id = 1; $s_id <= 20; $s_id++) {
                $day = ($s_id % 12) + 10; // 10 to 21 Jan
                $payments[] = array(
                    'no_kuitansi'         => sprintf('KW-%d-01-%04d', $tahun, $kuitansi_counter++),
                    'santri_id'           => $s_id,
                    'jenis_pembayaran_id' => 3,
                    'tahun'               => $tahun,
                    'bulan'               => 0,
                    'tahap'               => 1,
                    'tanggal_bayar'       => sprintf('%04d-01-%02d', $tahun, $day),
                    'jumlah'              => 500000.00,
                    'keterangan'          => 'Sumbangan Pembangunan Dayah Tahap I',
                    'petugas_id'          => 1
                );
            }

            // 3. Sumbangan Pembangunan Tahap 2 (jenis_pembayaran_id = 3, nominal 500.000)
            // 18 santri in July (awal semester ganjil)
            for ($s_id = 1; $s_id <= 18; $s_id++) {
                $day = ($s_id % 14) + 6; // 6 to 19 Jul
                $payments[] = array(
                    'no_kuitansi'         => sprintf('KW-%d-07-%04d', $tahun, $kuitansi_counter++),
                    'santri_id'           => $s_id,
                    'jenis_pembayaran_id' => 3,
                    'tahun'               => $tahun,
                    'bulan'               => 0,
                    'tahap'               => 2,
                    'tanggal_bayar'       => sprintf('%04d-07-%02d', $tahun, $day),
                    'jumlah'              => 500000.00,
                    'keterangan'          => 'Sumbangan Pembangunan Dayah Tahap II',
                    'petugas_id'          => 1
                );
            }

            // 4. SPP Bulanan (jenis_pembayaran_id = 1, nominal 200.000) across all 12 months
            $daftar_bulan = array(
                1  => 'Januari',
                2  => 'Februari',
                3  => 'Maret',
                4  => 'April',
                5  => 'Mei',
                6  => 'Juni',
                7  => 'Juli',
                8  => 'Agustus',
                9  => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            );

            // Months 1 to 10: Almost complete payments with a few realistic arrears
            for ($m = 1; $m <= 10; $m++) {
                for ($s_id = 1; $s_id <= 30; $s_id++) {
                    // Deliberate arrears for authentic testing of Tunggakan feature:
                    if ($m === 5 && $s_id === 7) continue;   // Santri 7 belum bayar Mei
                    if ($m === 8 && $s_id === 14) continue;  // Santri 14 belum bayar Agustus
                    if ($m === 10 && $s_id === 21) continue; // Santri 21 belum bayar Oktober

                    $day = (($s_id * 3) % 18) + 2; // day between 2 and 19
                    $payments[] = array(
                        'no_kuitansi'         => sprintf('KW-%d-%02d-%04d', $tahun, $m, $kuitansi_counter++),
                        'santri_id'           => $s_id,
                        'jenis_pembayaran_id' => 1,
                        'tahun'               => $tahun,
                        'bulan'               => $m,
                        'tahap'               => 0,
                        'tanggal_bayar'       => sprintf('%04d-%02d-%02d', $tahun, $m, $day),
                        'jumlah'              => 200000.00,
                        'keterangan'          => 'SPP Bulanan ' . $daftar_bulan[$m] . ' ' . $tahun,
                        'petugas_id'          => 1
                    );
                }
            }

            // Month 11 (November - bulan berjalan): 22 santri paid, 8 santri menunggak
            for ($s_id = 1; $s_id <= 22; $s_id++) {
                $day = (($s_id * 2) % 8) + 1; // 1 to 8 Nov
                $payments[] = array(
                    'no_kuitansi'         => sprintf('KW-%d-11-%04d', $tahun, $kuitansi_counter++),
                    'santri_id'           => $s_id,
                    'jenis_pembayaran_id' => 1,
                    'tahun'               => $tahun,
                    'bulan'               => 11,
                    'tahap'               => 0,
                    'tanggal_bayar'       => sprintf('%04d-11-%02d', $tahun, $day),
                    'jumlah'              => 200000.00,
                    'keterangan'          => 'SPP Bulanan ' . $daftar_bulan[11] . ' ' . $tahun,
                    'petugas_id'          => 1
                );
            }

            // Month 12 (Desember - bulan penutup tahun): 6 santri paid early in advance
            for ($s_id = 1; $s_id <= 6; $s_id++) {
                $day = $s_id + 2;
                $payments[] = array(
                    'no_kuitansi'         => sprintf('KW-%d-12-%04d', $tahun, $kuitansi_counter++),
                    'santri_id'           => $s_id,
                    'jenis_pembayaran_id' => 1,
                    'tahun'               => $tahun,
                    'bulan'               => 12,
                    'tahap'               => 0,
                    'tanggal_bayar'       => sprintf('%04d-11-%02d', $tahun, $day),
                    'jumlah'              => 200000.00,
                    'keterangan'          => 'SPP Bulanan ' . $daftar_bulan[12] . ' ' . $tahun . ' (Bayar Lunas Awal)',
                    'petugas_id'          => 1
                );
            }

            // Insert in chunks of 50
            $chunks = array_chunk($payments, 50);
            foreach ($chunks as $chunk) {
                $this->db->insert_batch($this->table, $chunk);
            }
        }

        $this->db->db_debug = $prev_debug;
    }

    public function ensure_default_jenis() {
        // Ensure default nominal is set if 0
        $spp = $this->db->get_where('jenis_pembayaran', array('id' => 1))->row();
        if ($spp && $spp->nominal == 0) {
            $this->db->where('id', 1)->update('jenis_pembayaran', array('nominal' => 150000.00));
        }
        $daftar = $this->db->get_where('jenis_pembayaran', array('id' => 2))->row();
        if ($daftar && $daftar->nominal == 0) {
            $this->db->where('id', 2)->update('jenis_pembayaran', array('nominal' => 250000.00));
        }
        $sumbangan = $this->db->get_where('jenis_pembayaran', array('id' => 3))->row();
        if ($sumbangan && $sumbangan->nominal == 0) {
            $this->db->where('id', 3)->update('jenis_pembayaran', array('nominal' => 500000.00));
        }
    }

    public function get_jenis_pembayaran() {
        return $this->db->where('aktif', 1)->get('jenis_pembayaran')->result();
    }

    public function get_jenis_by_id($id) {
        return $this->db->get_where('jenis_pembayaran', array('id' => $id))->row();
    }

    public function update_tarif($id, $nominal) {
        return $this->db->where('id', $id)->update('jenis_pembayaran', array('nominal' => $nominal));
    }

    public function generate_no_kuitansi() {
        $prefix = 'KW-' . date('Ymd') . '-';
        $this->db->like('no_kuitansi', $prefix, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get($this->table)->row();

        if ($last && !empty($last->no_kuitansi)) {
            $num = (int) substr($last->no_kuitansi, strlen($prefix));
            $next = $num + 1;
        } else {
            $next = 1;
        }

        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function simpan($data) {
        if (empty($data['no_kuitansi'])) {
            $data['no_kuitansi'] = $this->generate_no_kuitansi();
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id) {
        $this->db->select('p.*, s.nama as nama_santri, s.no_induk, s.no_induk as nis, s.asal_kabupaten, k.nama_kelas, j.nama as nama_jenjang, jp.nama as nama_jenis, jp.periode, u.nama as nama_petugas');
        $this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');
        $this->db->join('jenis_pembayaran jp', 'jp.id = p.jenis_pembayaran_id', 'left');
        $this->db->join('users u', 'u.id = p.petugas_id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    public function get_riwayat($filter = array(), $limit = null, $offset = null) {
        $this->db->select('p.*, s.nama as nama_santri, s.no_induk, k.nama_kelas, jp.nama as nama_jenis, jp.periode');
        $this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->join('jenis_pembayaran jp', 'jp.id = p.jenis_pembayaran_id', 'left');

        if (!empty($filter['santri_id'])) {
            $this->db->where('p.santri_id', $filter['santri_id']);
        }
        if (!empty($filter['jenis_pembayaran_id'])) {
            $this->db->where('p.jenis_pembayaran_id', $filter['jenis_pembayaran_id']);
        }
        if (!empty($filter['tahun'])) {
            $this->db->where('p.tahun', $filter['tahun']);
        }
        if (!empty($filter['bulan'])) {
            $this->db->where('p.bulan', $filter['bulan']);
        }
        if (!empty($filter['kelas_id'])) {
            $this->db->where('s.kelas_id', $filter['kelas_id']);
        }
        if (!empty($filter['tanggal_awal'])) {
            $this->db->where('p.tanggal_bayar >=', $filter['tanggal_awal']);
        }
        if (!empty($filter['tanggal_akhir'])) {
            $this->db->where('p.tanggal_bayar <=', $filter['tanggal_akhir']);
        }
        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('s.nama', $filter['keyword']);
            $this->db->or_like('s.no_induk', $filter['keyword']);
            $this->db->or_like('p.no_kuitansi', $filter['keyword']);
            $this->db->group_end();
        }

        $this->db->order_by('p.id', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }

    public function count_riwayat($filter = array()) {
        $this->db->from('pembayaran p');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        if (!empty($filter['santri_id'])) $this->db->where('p.santri_id', $filter['santri_id']);
        if (!empty($filter['jenis_pembayaran_id'])) $this->db->where('p.jenis_pembayaran_id', $filter['jenis_pembayaran_id']);
        if (!empty($filter['tahun'])) $this->db->where('p.tahun', $filter['tahun']);
        if (!empty($filter['bulan'])) $this->db->where('p.bulan', $filter['bulan']);
        if (!empty($filter['kelas_id'])) $this->db->where('s.kelas_id', $filter['kelas_id']);
        return $this->db->count_all_results();
    }

    /**
     * Get 12 months matrix for digital SPP card
     */
    public function get_kartu_spp($santri_id, $tahun) {
        // Query payments for SPP (jenis_pembayaran_id = 1 or bulanan)
        $this->db->select('p.*');
        $this->db->from('pembayaran p');
        $this->db->where('p.santri_id', $santri_id);
        $this->db->where('p.tahun', $tahun);
        $this->db->where('p.bulan >=', 1);
        $this->db->where('p.bulan <=', 12);
        $payments = $this->db->get()->result();

        $by_month = array();
        foreach ($payments as $pay) {
            $by_month[(int)$pay->bulan] = $pay;
        }

        $matrix = array();
        $curr_month = (int)date('m');
        $curr_year = (int)date('Y');

        for ($b = 1; $b <= 12; $b++) {
            $is_lunas = isset($by_month[$b]);
            $is_past_or_current = ($tahun < $curr_year) || ($tahun == $curr_year && $b <= $curr_month);

            $matrix[$b] = array(
                'bulan_angka'   => $b,
                'bulan_nama'    => nama_bulan($b),
                'is_lunas'      => $is_lunas,
                'status_label'  => $is_lunas ? 'Lunas' : ($is_past_or_current ? 'Menunggak' : 'Belum Bayar'),
                'tanggal_bayar' => $is_lunas ? $by_month[$b]->tanggal_bayar : null,
                'jumlah'        => $is_lunas ? $by_month[$b]->jumlah : 0,
                'no_kuitansi'   => $is_lunas ? $by_month[$b]->no_kuitansi : null,
                'pembayaran_id' => $is_lunas ? $by_month[$b]->id : null,
                'keterangan'    => $is_lunas ? $by_month[$b]->keterangan : null
            );
        }

        return $matrix;
    }

    /**
     * Get list of santri who haven't paid SPP for given month & year
     */
    public function get_rekap_tunggakan($tahun, $bulan, $kelas_id = null) {
        // Subquery of santri who paid this month
        $this->db->select('santri_id');
        $this->db->from('pembayaran');
        $this->db->where('tahun', $tahun);
        $this->db->where('bulan', $bulan);
        $subquery = $this->db->get_compiled_select();

        // Get active santri NOT in that subquery
        $this->db->select('s.*, k.nama_kelas, j.nama as nama_jenjang');
        $this->db->from('santri s');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');
        $this->db->where('s.status', 'aktif');
        $this->db->where("s.id NOT IN ($subquery)", NULL, FALSE);
        if ($kelas_id) {
            $this->db->where('s.kelas_id', $kelas_id);
        }
        $this->db->order_by('k.nama_kelas', 'ASC');
        $this->db->order_by('s.nama', 'ASC');
        return $this->db->get()->result();
    }
}
