<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas_model extends CI_Model {

    protected $table = 'fasilitas';

    public function __construct() {
        parent::__construct();
        $this->ensure_schema_and_sample();
    }

    /**
     * Memastikan skema auto-increment dan data awal fasilitas tersedia
     */
    public function ensure_schema_and_sample() {
        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Bersihkan baris id = 0 jika ada
        $this->db->where('id', 0)->delete($this->table);

        // Pastikan primary key auto_increment
        $this->db->query("ALTER TABLE `{$this->table}` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");

        // Cek apakah tabel kosong
        $count = $this->db->count_all($this->table);
        if ($count === 0) {
            $samples = $this->get_default_samples();
            foreach ($samples as $s) {
                $this->db->insert($this->table, $s);
            }
        } else {
            // Sinkronisasi: jika foto merujuk ke file yang tidak ada secara fisik, kosongkan (NULL)
            $existing = $this->db->get($this->table)->result();
            foreach ($existing as $row) {
                if (!empty($row->foto) && !file_exists(FCPATH . $row->foto)) {
                    $this->db->where('id', $row->id)->update($this->table, array('foto' => null));
                }
            }
        }

        $this->db->db_debug = $prev_debug;
    }

    /**
     * Daftar fasilitas awal yang dipetakan ke file asli di direktori img/
     * Fasilitas yang belum ada gambarnya dikosongkan (NULL) agar bisa ditambahkan nanti.
     */
    public function get_default_samples() {
        return array(
            array(
                'nama'      => 'Gedung Asrama Santri Baru',
                'deskripsi' => 'Asrama bertingkat santriwan dan santriwati dengan sirkulasi udara yang nyaman, bersih, dan memadai.',
                'foto'      => 'img/gedung_asrama_baru.jpeg',
                'urutan'    => 1
            ),
            array(
                'nama'      => 'Mushalla & Tempat Ibadah',
                'deskripsi' => 'Pusat pelaksanaan ibadah shalat fardhu lima waktu berjamaah, wirid dalail khairat, dan muhadharah santri.',
                'foto'      => 'img/interior_mushalla.jpeg',
                'urutan'    => 2
            ),
            array(
                'nama'      => 'Bilik & Ruang Halaqah Pengajian',
                'deskripsi' => 'Bilik belajar halaqah dan musyawarah kitab kuning didampingi dewan asatidz secara intensif.',
                'foto'      => 'img/pengajian_santriwati.jpeg',
                'urutan'    => 3
            ),
            array(
                'nama'      => 'Gedung Utama & Administrasi',
                'deskripsi' => 'Pusat perkantoran sekretariat dayah, penerimaan santri baru, dan koordinasi kepengurusan lembaga.',
                'foto'      => 'img/gedung_utama.jpeg',
                'urutan'    => 4
            ),
            array(
                'nama'      => 'Gedung Asrama Bertingkat',
                'deskripsi' => 'Fasilitas hunian bertingkat santri untuk menunjang kenyamanan istirahat selama menuntut ilmu.',
                'foto'      => 'img/asrama_bertingkat.jpeg',
                'urutan'    => 5
            ),
            array(
                'nama'      => 'Kompleks Bilik Santri',
                'deskripsi' => 'Bilik santri khas tradisi dayah salafiyah yang mendidik kemandirian, ukhuwah, dan kesederhanaan.',
                'foto'      => 'img/bilik_santri.jpeg',
                'urutan'    => 6
            ),
            array(
                'nama'      => 'Ruang Belajar & Kelas Lantai 2',
                'deskripsi' => 'Ruang kelas pembelajaran terpadu untuk pendalaman materi kitab kuning dan qawaid.',
                'foto'      => 'img/gedung_lantai2.jpeg',
                'urutan'    => 7
            ),
            array(
                'nama'      => 'Halaman & Lingkungan Pesantren',
                'deskripsi' => 'Area lingkungan pesantren yang asri, sejuk, dan aman untuk aktivitas kebersamaan santri.',
                'foto'      => 'img/halaman_dayah.jpeg',
                'urutan'    => 8
            ),
            array(
                'nama'      => 'Plang Identitas Resmi Dayah',
                'deskripsi' => 'Plang gerbang dan identitas kelembagaan LPI Dayah Al-Ikhlas Al-Aziziyah di Gampong Sangso, Samalanga.',
                'foto'      => 'img/plang_dayah.jpg',
                'urutan'    => 9
            ),
            array(
                'nama'      => 'Perpustakaan Khazanah Kitab Kuning',
                'deskripsi' => 'Koleksi literatur kitab-kitab turats salafiyah, kamus bahasa Arab, tafsir, dan syarah mu\'tabarah.',
                'foto'      => null, // Dikosongkan agar dapat ditambahkan kemudian oleh pengguna
                'urutan'    => 10
            ),
            array(
                'nama'      => 'Dapur Umum & Katering Santri',
                'deskripsi' => 'Fasilitas penyediaan konsumsi higienis dan bergizi harian bagi santriwan dan santriwati.',
                'foto'      => null, // Dikosongkan agar dapat ditambahkan kemudian oleh pengguna
                'urutan'    => 11
            ),
            array(
                'nama'      => 'Pos Kesehatan Pesantren (Poskestren)',
                'deskripsi' => 'Layanan pertolongan pertama dan pemeriksaan kesehatan berkala bagi seluruh warga dayah.',
                'foto'      => null, // Dikosongkan agar dapat ditambahkan kemudian oleh pengguna
                'urutan'    => 12
            )
        );
    }

    public function get_all() {
        return $this->db->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, array('id' => (int)$id))->row();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', (int)$id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', (int)$id)->delete($this->table);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }
}
