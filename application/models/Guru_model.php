<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

    protected $table = 'guru';

    public function __construct() {
        parent::__construct();
        $this->ensure_sample_guru();
    }

    /**
     * Ensure at least 12 comprehensive sample dewan guru records exist for initial setup
     */
    public function ensure_sample_guru() {
        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Clean up any stray row with id = 0 if auto_increment was previously missing
        $this->db->where('id', 0)->delete($this->table);

        // Ensure AUTO_INCREMENT is enabled on primary key id
        $this->db->query("ALTER TABLE `{$this->table}` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");

        $count = $this->db->count_all($this->table);
        if ($count < 12) {
            $samples = array(
                array(
                    'id'                  => 1,
                    'no_induk'            => 'TGK-001',
                    'nik'                 => '1111010101850001',
                    'nama'                => 'Tgk. H. Muhammad Dahlan, M.Ag',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Samalanga',
                    'tanggal_lahir'       => '1985-04-12',
                    'pendidikan_terakhir' => 'S2 / Ma\'had Aly',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Fiqih & Ushul Fiqh (Fathul Mu\'in)',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_kecamatan'      => 'Samalanga',
                    'asal_desa'           => 'Sangso',
                    'alamat_domisili'     => 'Komplek Dayah Al-Ikhlas, Sangso',
                    'no_hp'               => '085277123456',
                    'email'               => 'tgk.dahlan@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 2,
                    'no_induk'            => 'TGK-002',
                    'nik'                 => '1111010508880002',
                    'nama'                => 'Tgk. Zulkifli, S.Pd.I',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Bireuen',
                    'tanggal_lahir'       => '1988-08-05',
                    'pendidikan_terakhir' => 'S1 PAI',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Nahwu & Saraf (Kawakibud Durriyyah)',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_kecamatan'      => 'Pandrah',
                    'asal_desa'           => 'Pantee Batee',
                    'alamat_domisili'     => 'Samalanga, Bireuen',
                    'no_hp'               => '085366234567',
                    'email'               => 'tgk.zulkifli@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 3,
                    'no_induk'            => 'TGK-003',
                    'nik'                 => '1111011210900003',
                    'nama'                => 'Ustazah Nurul Fadhilah, S.Pd',
                    'jenis_kelamin'       => 'P',
                    'tempat_lahir'        => 'Pidie Jaya',
                    'tanggal_lahir'       => '1990-10-12',
                    'pendidikan_terakhir' => 'S1 Bahasa Arab',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Akhlaq & Tasawuf (Bidayatul Hidayah)',
                    'asal_kabupaten'      => 'Pidie Jaya',
                    'asal_kecamatan'      => 'Meureudu',
                    'asal_desa'           => 'Rhieng',
                    'alamat_domisili'     => 'Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'               => '082188345678',
                    'email'               => 'ustazah.nurul@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 4,
                    'no_induk'            => 'TGK-004',
                    'nik'                 => '1111011502840004',
                    'nama'                => 'Tgk. M. Yusuf Ibrahim, M.Ag',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Lhokseumawe',
                    'tanggal_lahir'       => '1984-02-15',
                    'pendidikan_terakhir' => 'S2 Studi Islam',
                    'status_pns'          => 'PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Tafsir & Ulumul Qur\'an (Tafsir Jalalain)',
                    'asal_kabupaten'      => 'Kota Lhokseumawe',
                    'asal_kecamatan'      => 'Muara Dua',
                    'asal_desa'           => 'Keude Cunda',
                    'alamat_domisili'     => 'Komplek Dayah Al-Ikhlas, Sangso',
                    'no_hp'               => '081269345678',
                    'email'               => 'tgk.yusuf@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 5,
                    'no_induk'            => 'TGK-005',
                    'nik'                 => '1111012007870005',
                    'nama'                => 'Tgk. Ridwan Syamsuddin',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Bireuen',
                    'tanggal_lahir'       => '1987-07-20',
                    'pendidikan_terakhir' => 'Ma\'had Aly Dayah',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Hadits & Musthalah Hadits (Riyadhus Shalihin)',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_kecamatan'      => 'Simpang Mamplam',
                    'asal_desa'           => 'Tambue Barat',
                    'alamat_domisili'     => 'Samalanga, Bireuen',
                    'no_hp'               => '085260112233',
                    'email'               => 'tgk.ridwan@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 6,
                    'no_induk'            => 'TGK-006',
                    'nik'                 => '1111012809890006',
                    'nama'                => 'Tgk. Faisal Bukhari, S.H.I',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Sigli',
                    'tanggal_lahir'       => '1989-09-28',
                    'pendidikan_terakhir' => 'S1 Hukum Islam / Syariah',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Tauhid & Aqidah (Kifayatul Awam)',
                    'asal_kabupaten'      => 'Pidie',
                    'asal_kecamatan'      => 'Kota Sigli',
                    'asal_desa'           => 'Blang Paseh',
                    'alamat_domisili'     => 'Komplek Dayah Al-Ikhlas Putra',
                    'no_hp'               => '085370223344',
                    'email'               => 'tgk.faisal@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 7,
                    'no_induk'            => 'TGK-007',
                    'nik'                 => '1111011403920007',
                    'nama'                => 'Ustazah Cut Rahmawati, S.Pd',
                    'jenis_kelamin'       => 'P',
                    'tempat_lahir'        => 'Samalanga',
                    'tanggal_lahir'       => '1992-03-14',
                    'pendidikan_terakhir' => 'S1 Tarbiyah',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Fiqih Nisa\' & Sirah Nabawiyah (Risalatul Mahidh)',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_kecamatan'      => 'Samalanga',
                    'asal_desa'           => 'Namploh Baro',
                    'alamat_domisili'     => 'Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'               => '082274556677',
                    'email'               => 'ustazah.cut@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 8,
                    'no_induk'            => 'TGK-008',
                    'nik'                 => '1111010311860008',
                    'nama'                => 'Tgk. Munawir Usman, Lc',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Banda Aceh',
                    'tanggal_lahir'       => '1986-11-03',
                    'pendidikan_terakhir' => 'S1 Dirasat Islamiyah (Al-Azhar)',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Mantiq & Balaghah (Sullamul Munauraq)',
                    'asal_kabupaten'      => 'Kota Banda Aceh',
                    'asal_kecamatan'      => 'Syiah Kuala',
                    'asal_desa'           => 'Jeulingke',
                    'alamat_domisili'     => 'Komplek Dayah Al-Ikhlas, Sangso',
                    'no_hp'               => '081360889900',
                    'email'               => 'tgk.munawir@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 9,
                    'no_induk'            => 'TGK-009',
                    'nik'                 => '1111011806830009',
                    'nama'                => 'Tgk. Khairuddin Jalil',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Jeunieb',
                    'tanggal_lahir'       => '1983-06-18',
                    'pendidikan_terakhir' => 'Ma\'had Aly Dayah',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Fathul Wahhab & Fiqih Muamalah',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_kecamatan'      => 'Jeunieb',
                    'asal_desa'           => 'Meunasah Tambo',
                    'alamat_domisili'     => 'Samalanga, Bireuen',
                    'no_hp'               => '085261334455',
                    'email'               => 'tgk.khairuddin@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 10,
                    'no_induk'            => 'TGK-010',
                    'nik'                 => '1111010901810010',
                    'nama'                => 'Tgk. H. Syamsuddin Ismail',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Samalanga',
                    'tanggal_lahir'       => '1981-01-09',
                    'pendidikan_terakhir' => 'Dayah Tinggi Salafiyah',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Khat Kaligrafi & Bahasa Arab Klasik',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_kecamatan'      => 'Samalanga',
                    'asal_desa'           => 'Sangso',
                    'alamat_domisili'     => 'Komplek Dayah Al-Ikhlas, Sangso',
                    'no_hp'               => '081263445566',
                    'email'               => 'tgk.syamsuddin@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 11,
                    'no_induk'            => 'TGK-011',
                    'nik'                 => '1111012505930011',
                    'nama'                => 'Ustazah Maryana Zahra, S.Hum',
                    'jenis_kelamin'       => 'P',
                    'tempat_lahir'        => 'Takengon',
                    'tanggal_lahir'       => '1993-05-25',
                    'pendidikan_terakhir' => 'S1 Bahasa & Sastra Arab',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Tahsin Al-Qur\'an & Tajwid (Al-Jazariyyah)',
                    'asal_kabupaten'      => 'Aceh Tengah',
                    'asal_kecamatan'      => 'Lut Tawar',
                    'asal_desa'           => 'Takengon Timur',
                    'alamat_domisili'     => 'Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'               => '082367889901',
                    'email'               => 'ustazah.maryana@alikhlas.sch.id',
                    'aktif'               => 1
                ),
                array(
                    'id'                  => 12,
                    'no_induk'            => 'TGK-012',
                    'nik'                 => '1111011112910012',
                    'nama'                => 'Tgk. Ilham Muslem, S.Kom.I',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Bireuen',
                    'tanggal_lahir'       => '1991-12-11',
                    'pendidikan_terakhir' => 'S1 Komunikasi Islam',
                    'status_pns'          => 'NON PNS',
                    'status_tetap'        => 'TETAP',
                    'mata_pelajaran'      => 'Tarikh Tasyri\' Islam & Kepemimpinan Santri',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_kecamatan'      => 'Peusangan',
                    'asal_desa'           => 'Matang Glumpang Dua',
                    'alamat_domisili'     => 'Komplek Dayah Al-Ikhlas Putra',
                    'no_hp'               => '085270119922',
                    'email'               => 'tgk.ilham@alikhlas.sch.id',
                    'aktif'               => 1
                )
            );

            foreach ($samples as $sample) {
                $existing = $this->db->where('no_induk', $sample['no_induk'])->or_where('id', $sample['id'])->get($this->table)->row();
                if (!$existing) {
                    $this->db->insert($this->table, $sample);
                } else {
                    $this->db->where('id', $existing->id)->update($this->table, $sample);
                }
            }

            // Assign wali kelas for kelas 1..10 to guru 1..10 if not set
            if ($this->db->table_exists('kelas')) {
                for ($k = 1; $k <= 10; $k++) {
                    $this->db->where('id', $k)->update('kelas', array('wali_kelas_id' => $k));
                }
            }
        }

        $this->db->db_debug = $prev_debug;
    }

    public function get_all($filter = array(), $limit = null, $offset = null) {
        $this->db->from($this->table);

        if (isset($filter['aktif']) && $filter['aktif'] !== '') {
            $this->db->where('aktif', $filter['aktif']);
        }
        if (!empty($filter['status_pns'])) {
            $this->db->where('status_pns', $filter['status_pns']);
        }
        if (!empty($filter['status_tetap'])) {
            $this->db->where('status_tetap', $filter['status_tetap']);
        }
        if (!empty($filter['jenis_kelamin'])) {
            $this->db->where('jenis_kelamin', $filter['jenis_kelamin']);
        }
        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('nama', $filter['keyword']);
            $this->db->or_like('no_induk', $filter['keyword']);
            $this->db->or_like('nik', $filter['keyword']);
            $this->db->or_like('mata_pelajaran', $filter['keyword']);
            $this->db->or_like('asal_kabupaten', $filter['keyword']);
            $this->db->group_end();
        }

        $this->db->order_by('nama', 'ASC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        // 1. Unlink as wali kelas
        $this->db->where('wali_kelas_id', $id)->update('kelas', array('wali_kelas_id' => null));

        // 2. Unlink from kurikulum
        $this->db->where('guru_id', $id)->update('kurikulum', array('guru_id' => null));

        // 3. Unlink from jadwal_belajar
        $this->db->where('guru_id', $id)->update('jadwal_belajar', array('guru_id' => null));

        // 4. Delete photo if exists
        $guru = $this->db->get_where($this->table, array('id' => $id))->row();
        if ($guru && !empty($guru->foto)) {
            $foto_path = FCPATH . 'uploads/berkas/' . $guru->foto;
            if (file_exists($foto_path)) {
                @unlink($foto_path);
            }
        }

        return $this->db->where('id', $id)->delete($this->table);
    }

    public function generate_no_induk() {
        $prefix = 'TGK-';
        $this->db->like('no_induk', $prefix, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get($this->table)->row();

        if ($last && !empty($last->no_induk)) {
            $num = (int) substr($last->no_induk, strlen($prefix));
            $next = $num + 1;
        } else {
            $next = 1;
        }

        return $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get data structured for EDATUDA format (Dinas Pendidikan Dayah Aceh)
     */
    public function get_guru_edatuda_export() {
        return $this->db->order_by('nama', 'ASC')->get($this->table)->result();
    }
}
