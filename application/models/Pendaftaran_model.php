<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    protected $table = 'pendaftaran';

    public function __construct() {
        parent::__construct();
        $this->ensure_default_classes();
        $this->ensure_sample_pendaftaran();
    }

    /**
     * Ensure at least 10 realistic sample applicants exist for PSB
     */
    public function ensure_sample_pendaftaran() {
        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Clean up stray row with id = 0 if any
        $this->db->where('id', 0)->delete($this->table);

        // Ensure AUTO_INCREMENT is enabled on primary key id
        $this->db->query("ALTER TABLE `{$this->table}` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");

        $count = $this->db->count_all($this->table);
        if ($count < 10) {
            $default_ta = $this->db->get_where('tahun_ajaran', array('aktif' => 1))->row();
            $ta_id = $default_ta ? (int)$default_ta->id : 1;

            $samples = array(
                array(
                    'id'                  => 1,
                    'no_pendaftaran'      => 'PSB-2026-0001',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 1, // Tajhizi
                    'nama'                => 'Muhammad Zayyan Al-Ghazali',
                    'nik'                 => '1111011504140001',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Samalanga',
                    'tanggal_lahir'       => '2014-04-15',
                    'anak_ke'             => 1,
                    'jumlah_saudara'      => 3,
                    'asal_gampong'        => 'Namploh Baro',
                    'asal_kecamatan'      => 'Samalanga',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'MIN 1 Bireuen',
                    'nama_ayah'           => 'Tgk. Hamdani',
                    'nama_ibu'            => 'Ruwaida, S.Pd',
                    'pekerjaan_ayah'      => 'Guru Dayah',
                    'pekerjaan_ibu'       => 'Guru SD',
                    'alamat_ortu'         => 'Gampong Namploh Baro, Samalanga, Kab. Bireuen',
                    'no_hp_ortu'          => '085277112201',
                    'nama_wali'           => 'Tgk. Hamdani',
                    'pekerjaan_wali'      => 'Guru Dayah',
                    'alamat_wali'         => 'Gampong Namploh Baro, Samalanga, Kab. Bireuen',
                    'no_hp_wali'          => '085277112201',
                    'pendaftar_nama'      => 'Tgk. Hamdani',
                    'pendaftar_pekerjaan' => 'Guru Dayah',
                    'pendaftar_alamat'    => 'Gampong Namploh Baro, Samalanga, Kab. Bireuen',
                    'pendaftar_no_hp'     => '085277112201',
                    'status'              => 'menunggu',
                    'catatan'             => 'Pendaftaran online gelombang 1. Berkas administrasi lengkap, menunggu jadwal wawancara baca Al-Qur\'an.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-01-20 08:30:00'
                ),
                array(
                    'id'                  => 2,
                    'no_pendaftaran'      => 'PSB-2026-0002',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 1, // Tajhizi
                    'nama'                => 'Cut Syifa Azzahra',
                    'nik'                 => '1171012206140002',
                    'jenis_kelamin'       => 'P',
                    'tempat_lahir'        => 'Banda Aceh',
                    'tanggal_lahir'       => '2014-06-22',
                    'anak_ke'             => 2,
                    'jumlah_saudara'      => 3,
                    'asal_gampong'        => 'Lampriet',
                    'asal_kecamatan'      => 'Kuta Alam',
                    'asal_kabupaten'      => 'Kota Banda Aceh',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'SD IT Al-Azhar Banda Aceh',
                    'nama_ayah'           => 'Teuku Reza Fachlevi, S.E',
                    'nama_ibu'            => 'Cut Mutiawati',
                    'pekerjaan_ayah'      => 'Wiraswasta',
                    'pekerjaan_ibu'       => 'PNS',
                    'alamat_ortu'         => 'Jl. T. Nyak Arief No. 34 Lampriet, Banda Aceh',
                    'no_hp_ortu'          => '081260223302',
                    'nama_wali'           => 'Teuku Reza Fachlevi, S.E',
                    'pekerjaan_wali'      => 'Wiraswasta',
                    'alamat_wali'         => 'Jl. T. Nyak Arief No. 34 Lampriet, Banda Aceh',
                    'no_hp_wali'          => '081260223302',
                    'pendaftar_nama'      => 'Teuku Reza Fachlevi, S.E',
                    'pendaftar_pekerjaan' => 'Wiraswasta',
                    'pendaftar_alamat'    => 'Jl. T. Nyak Arief No. 34 Lampriet, Banda Aceh',
                    'pendaftar_no_hp'     => '081260223302',
                    'status'              => 'menunggu',
                    'catatan'             => 'Menunggu verifikasi berkas rapor SD dan tes kelancaran makharijul huruf.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-01-22 10:15:00'
                ),
                array(
                    'id'                  => 3,
                    'no_pendaftaran'      => 'PSB-2026-0003',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 2, // Ula
                    'nama'                => 'Ahmad Rayyan Khadafi',
                    'nik'                 => '1107011008130003',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Sigli',
                    'tanggal_lahir'       => '2013-08-10',
                    'anak_ke'             => 1,
                    'jumlah_saudara'      => 2,
                    'asal_gampong'        => 'Tijue',
                    'asal_kecamatan'      => 'Pidie',
                    'asal_kabupaten'      => 'Pidie',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'MTsS Tijue Sigli',
                    'nama_ayah'           => 'Marwan Abdullah',
                    'nama_ibu'            => 'Nurlela',
                    'pekerjaan_ayah'      => 'Pedagang',
                    'pekerjaan_ibu'       => 'Ibu Rumah Tangga',
                    'alamat_ortu'         => 'Gampong Tijue, Kec. Pidie, Kab. Pidie',
                    'no_hp_ortu'          => '085366334403',
                    'nama_wali'           => 'Marwan Abdullah',
                    'pekerjaan_wali'      => 'Pedagang',
                    'alamat_wali'         => 'Gampong Tijue, Kec. Pidie, Kab. Pidie',
                    'no_hp_wali'          => '085366334403',
                    'pendaftar_nama'      => 'Marwan Abdullah',
                    'pendaftar_pekerjaan' => 'Pedagang',
                    'pendaftar_alamat'    => 'Gampong Tijue, Kec. Pidie, Kab. Pidie',
                    'pendaftar_no_hp'     => '085366334403',
                    'status'              => 'diterima',
                    'catatan'             => 'Lulus tes baca Al-Qur\'an (Jayyid Jiddan) dan hafalan Juz \'Amma. Siap penempatan asrama dan kelas Ula.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-01-25 11:45:00'
                ),
                array(
                    'id'                  => 4,
                    'no_pendaftaran'      => 'PSB-2026-0004',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 2, // Ula
                    'nama'                => 'Naila Husna Amalia',
                    'nik'                 => '1173010512130004',
                    'jenis_kelamin'       => 'P',
                    'tempat_lahir'        => 'Lhokseumawe',
                    'tanggal_lahir'       => '2013-12-05',
                    'anak_ke'             => 2,
                    'jumlah_saudara'      => 4,
                    'asal_gampong'        => 'Hagu Teungoh',
                    'asal_kecamatan'      => 'Banda Sakti',
                    'asal_kabupaten'      => 'Kota Lhokseumawe',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'MTsN 1 Kota Lhokseumawe',
                    'nama_ayah'           => 'Saifullah, M.Pd',
                    'nama_ibu'            => 'Dra. Maryani',
                    'pekerjaan_ayah'      => 'Dosen IAIN',
                    'pekerjaan_ibu'       => 'Guru MTsN',
                    'alamat_ortu'         => 'Jl. Samudera No. 18 Banda Sakti, Lhokseumawe',
                    'no_hp_ortu'          => '081377445504',
                    'nama_wali'           => 'Saifullah, M.Pd',
                    'pekerjaan_wali'      => 'Dosen IAIN',
                    'alamat_wali'         => 'Jl. Samudera No. 18 Banda Sakti, Lhokseumawe',
                    'no_hp_wali'          => '081377445504',
                    'pendaftar_nama'      => 'Saifullah, M.Pd',
                    'pendaftar_pekerjaan' => 'Dosen IAIN',
                    'pendaftar_alamat'    => 'Jl. Samudera No. 18 Banda Sakti, Lhokseumawe',
                    'pendaftar_no_hp'     => '081377445504',
                    'status'              => 'diterima',
                    'catatan'             => 'Nilai tes murni 88.5, hafalan Qur\'an 2 juz mu\'tamad. Berkas lengkap dan sah.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-01-28 14:20:00'
                ),
                array(
                    'id'                  => 5,
                    'no_pendaftaran'      => 'PSB-2026-0005',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 1, // Tajhizi
                    'nama'                => 'Muhammad Fathir Ar-Razi',
                    'nik'                 => '1111011809140005',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Bireuen',
                    'tanggal_lahir'       => '2014-09-18',
                    'anak_ke'             => 3,
                    'jumlah_saudara'      => 4,
                    'asal_gampong'        => 'Pulo Ara',
                    'asal_kecamatan'      => 'Kota Juang',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'SD Negeri 1 Bireuen',
                    'nama_ayah'           => 'Zulkifli Daud',
                    'nama_ibu'            => 'Roslinda',
                    'pekerjaan_ayah'      => 'Wiraswasta',
                    'pekerjaan_ibu'       => 'Pedagang',
                    'alamat_ortu'         => 'Jl. Bireuen-Takengon KM 1.5 Pulo Ara, Bireuen',
                    'no_hp_ortu'          => '085260556605',
                    'nama_wali'           => 'Zulkifli Daud',
                    'pekerjaan_wali'      => 'Wiraswasta',
                    'alamat_wali'         => 'Jl. Bireuen-Takengon KM 1.5 Pulo Ara, Bireuen',
                    'no_hp_wali'          => '085260556605',
                    'pendaftar_nama'      => 'Zulkifli Daud',
                    'pendaftar_pekerjaan' => 'Wiraswasta',
                    'pendaftar_alamat'    => 'Jl. Bireuen-Takengon KM 1.5 Pulo Ara, Bireuen',
                    'pendaftar_no_hp'     => '085260556605',
                    'status'              => 'menunggu',
                    'catatan'             => 'Menunggu jadwal tes wawancara gelombang 1 pada tanggal 20 Februari 2026.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-02-01 09:10:00'
                ),
                array(
                    'id'                  => 6,
                    'no_pendaftaran'      => 'PSB-2026-0006',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 3, // Wustha
                    'nama'                => 'Dhiyaul Haq Syahputra',
                    'nik'                 => '1104011402120006',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Takengon',
                    'tanggal_lahir'       => '2012-02-14',
                    'anak_ke'             => 1,
                    'jumlah_saudara'      => 3,
                    'asal_gampong'        => 'Blang Kolak II',
                    'asal_kecamatan'      => 'Bebesen',
                    'asal_kabupaten'      => 'Aceh Tengah',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'MTsN 1 Takengon',
                    'nama_ayah'           => 'Aman Yusra',
                    'nama_ibu'            => 'Inen Yusra',
                    'pekerjaan_ayah'      => 'Petani Kopi Gayo',
                    'pekerjaan_ibu'       => 'Ibu Rumah Tangga',
                    'alamat_ortu'         => 'Gampong Blang Kolak II, Bebesen, Takengon',
                    'no_hp_ortu'          => '082168667706',
                    'nama_wali'           => 'Aman Yusra',
                    'pekerjaan_wali'      => 'Petani Kopi Gayo',
                    'alamat_wali'         => 'Gampong Blang Kolak II, Bebesen, Takengon',
                    'no_hp_wali'          => '082168667706',
                    'pendaftar_nama'      => 'Aman Yusra',
                    'pendaftar_pekerjaan' => 'Petani Kopi Gayo',
                    'pendaftar_alamat'    => 'Gampong Blang Kolak II, Bebesen, Takengon',
                    'pendaftar_no_hp'     => '082168667706',
                    'status'              => 'menunggu',
                    'catatan'             => 'Pindahan dari MTsN, peminatan kajian kitab Nahwu-Saraf dan Tajwid tingkat Wustha.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-02-03 13:00:00'
                ),
                array(
                    'id'                  => 7,
                    'no_pendaftaran'      => 'PSB-2026-0007',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 1, // Tajhizi
                    'nama'                => 'Siti Khadijah Al-Mawaddah',
                    'nik'                 => '1118012507140007',
                    'jenis_kelamin'       => 'P',
                    'tempat_lahir'        => 'Meureudu',
                    'tanggal_lahir'       => '2014-07-25',
                    'anak_ke'             => 1,
                    'jumlah_saudara'      => 3,
                    'asal_gampong'        => 'Rhieng Krueng',
                    'asal_kecamatan'      => 'Meureudu',
                    'asal_kabupaten'      => 'Pidie Jaya',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'MIN 1 Pidie Jaya',
                    'nama_ayah'           => 'Tgk. Anwar Sulaiman',
                    'nama_ibu'            => 'Halimatussa\'diyah',
                    'pekerjaan_ayah'      => 'PNS Kemenag',
                    'pekerjaan_ibu'       => 'Guru',
                    'alamat_ortu'         => 'Gampong Rhieng Krueng, Meureudu, Pidie Jaya',
                    'no_hp_ortu'          => '081269778807',
                    'nama_wali'           => 'Tgk. Anwar Sulaiman',
                    'pekerjaan_wali'      => 'PNS Kemenag',
                    'alamat_wali'         => 'Gampong Rhieng Krueng, Meureudu, Pidie Jaya',
                    'no_hp_wali'          => '081269778807',
                    'pendaftar_nama'      => 'Tgk. Anwar Sulaiman',
                    'pendaftar_pekerjaan' => 'PNS Kemenag',
                    'pendaftar_alamat'    => 'Gampong Rhieng Krueng, Meureudu, Pidie Jaya',
                    'pendaftar_no_hp'     => '081269778807',
                    'status'              => 'cadangan',
                    'catatan'             => 'Nilai tes passing grade bersaing, masuk daftar kuota cadangan asrama santriwati.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-02-05 15:30:00'
                ),
                array(
                    'id'                  => 8,
                    'no_pendaftaran'      => 'PSB-2026-0008',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 4, // Ulya
                    'nama'                => 'Teuku M. Haikal Firdaus',
                    'nik'                 => '1171010305100008',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Banda Aceh',
                    'tanggal_lahir'       => '2010-05-03',
                    'anak_ke'             => 2,
                    'jumlah_saudara'      => 3,
                    'asal_gampong'        => 'Jeulingke',
                    'asal_kecamatan'      => 'Syiah Kuala',
                    'asal_kabupaten'      => 'Kota Banda Aceh',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'SMP Swasta Babun Najah Banda Aceh',
                    'nama_ayah'           => 'Teuku Firdaus, S.T',
                    'nama_ibu'            => 'Cut Dahlia, S.Sos',
                    'pekerjaan_ayah'      => 'PNS Dinas PUPR Aceh',
                    'pekerjaan_ibu'       => 'Wiraswasta',
                    'alamat_ortu'         => 'Jl. Rawasari No. 14 Jeulingke, Banda Aceh',
                    'no_hp_ortu'          => '081370889908',
                    'nama_wali'           => 'Teuku Firdaus, S.T',
                    'pekerjaan_wali'      => 'PNS Dinas PUPR Aceh',
                    'alamat_wali'         => 'Jl. Rawasari No. 14 Jeulingke, Banda Aceh',
                    'no_hp_wali'          => '081370889908',
                    'pendaftar_nama'      => 'Teuku Firdaus, S.T',
                    'pendaftar_pekerjaan' => 'PNS Dinas PUPR Aceh',
                    'pendaftar_alamat'    => 'Jl. Rawasari No. 14 Jeulingke, Banda Aceh',
                    'pendaftar_no_hp'     => '081370889908',
                    'status'              => 'menunggu',
                    'catatan'             => 'Mendaftar jenjang Ulya peminatan kajian Fiqih Muamalah & Tafsir Jalalain.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-02-07 10:40:00'
                ),
                array(
                    'id'                  => 9,
                    'no_pendaftaran'      => 'PSB-2026-0009',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 5, // Ma'had Aly
                    'nama'                => 'Sayed Fachrul Razi',
                    'nik'                 => '1111011111060009',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Samalanga',
                    'tanggal_lahir'       => '2006-11-11',
                    'anak_ke'             => 1,
                    'jumlah_saudara'      => 2,
                    'asal_gampong'        => 'Sangso',
                    'asal_kecamatan'      => 'Samalanga',
                    'asal_kabupaten'      => 'Bireuen',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'MAS Dayah MUDI Mesra Samalanga',
                    'nama_ayah'           => 'Sayed Muchsin',
                    'nama_ibu'            => 'Syarifah Nur',
                    'pekerjaan_ayah'      => 'Pensiunan PNS',
                    'pekerjaan_ibu'       => 'Ibu Rumah Tangga',
                    'alamat_ortu'         => 'Gampong Sangso, Samalanga, Kab. Bireuen',
                    'no_hp_ortu'          => '085270990009',
                    'nama_wali'           => 'Sayed Muchsin',
                    'pekerjaan_wali'      => 'Pensiunan PNS',
                    'alamat_wali'         => 'Gampong Sangso, Samalanga, Kab. Bireuen',
                    'no_hp_wali'          => '085270990009',
                    'pendaftar_nama'      => 'Sayed Fachrul Razi',
                    'pendaftar_pekerjaan' => 'Santri Mandiri',
                    'pendaftar_alamat'    => 'Gampong Sangso, Samalanga, Kab. Bireuen',
                    'pendaftar_no_hp'     => '085270990009',
                    'status'              => 'menunggu',
                    'catatan'             => 'Tamatan Aliyah Dayah Salafiyah, mendaftar Ma\'had Aly takhasus Fiqh wa Ushuluhu.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-02-08 11:20:00'
                ),
                array(
                    'id'                  => 10,
                    'no_pendaftaran'      => 'PSB-2026-0010',
                    'tahun_ajaran_id'     => $ta_id,
                    'jenjang_tujuan_id'   => 1, // Tajhizi
                    'nama'                => 'Rizqullah Al-Ghifari',
                    'nik'                 => '1105012803140010',
                    'jenis_kelamin'       => 'L',
                    'tempat_lahir'        => 'Meulaboh',
                    'tanggal_lahir'       => '2014-03-28',
                    'anak_ke'             => 2,
                    'jumlah_saudara'      => 3,
                    'asal_gampong'        => 'Rundeng',
                    'asal_kecamatan'      => 'Johan Pahlawan',
                    'asal_kabupaten'      => 'Aceh Barat',
                    'asal_provinsi'       => 'Aceh',
                    'asal_sekolah'        => 'SD Negeri 14 Meulaboh',
                    'nama_ayah'           => 'Rusli Hasan',
                    'nama_ibu'            => 'Suryati',
                    'pekerjaan_ayah'      => 'Nelayan',
                    'pekerjaan_ibu'       => 'Pedagang Pasar',
                    'alamat_ortu'         => 'Jl. Singgahmata No. 89 Rundeng, Meulaboh',
                    'no_hp_ortu'          => '085375112210',
                    'nama_wali'           => 'Rusli Hasan',
                    'pekerjaan_wali'      => 'Nelayan',
                    'alamat_wali'         => 'Jl. Singgahmata No. 89 Rundeng, Meulaboh',
                    'no_hp_wali'          => '085375112210',
                    'pendaftar_nama'      => 'Rusli Hasan',
                    'pendaftar_pekerjaan' => 'Nelayan',
                    'pendaftar_alamat'    => 'Jl. Singgahmata No. 89 Rundeng, Meulaboh',
                    'pendaftar_no_hp'     => '085375112210',
                    'status'              => 'ditolak',
                    'catatan'             => 'Berkas Kartu Keluarga dan Surat Keterangan Lulus tidak terlampir hingga batas akhir verifikasi berkas.',
                    'santri_id'           => null,
                    'tanggal_daftar'      => '2026-02-09 16:10:00'
                )
            );

            foreach ($samples as $sample) {
                $existing = $this->db->where('no_pendaftaran', $sample['no_pendaftaran'])
                                     ->or_where('id', $sample['id'])
                                     ->get($this->table)->row();
                if (!$existing) {
                    $this->db->insert($this->table, $sample);
                } else {
                    $this->db->where('id', $existing->id)->update($this->table, $sample);
                }
            }
        }

        $this->db->db_debug = $prev_debug;
    }

    /**
     * Generate unique registration number (e.g. PSB-2026-0001)
     */
    public function generate_no_pendaftaran() {
        $tahun = date('Y');
        $prefix = "PSB-{$tahun}-";

        $this->db->like('no_pendaftaran', $prefix, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get($this->table)->row();

        if ($last && !empty($last->no_pendaftaran)) {
            $last_num = (int) substr($last->no_pendaftaran, strlen($prefix));
            $next_num = $last_num + 1;
        } else {
            $next_num = 1;
        }

        return $prefix . str_pad($next_num, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Generate automatic NIS for newly admitted santri (e.g. 2026001)
     */
    public function generate_nis($tahun_masuk = null) {
        $tahun = $tahun_masuk ?: date('Y');
        $prefix = $tahun;

        $this->db->like('no_induk', $prefix, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get('santri')->row();

        if ($last && !empty($last->no_induk)) {
            $last_num = (int) substr($last->no_induk, strlen($prefix));
            $next_num = $last_num + 1;
        } else {
            $next_num = 1;
        }

        return $prefix . str_pad($next_num, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Ensure standard default classes exist per jenjang
     */
    public function ensure_default_classes() {
        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Clean up any stray row with id = 0 if auto_increment was previously missing
        $this->db->where('id', 0)->delete('kelas');

        $count = $this->db->count_all('kelas');
        if ($count === 0) {
            $default_ta = $this->db->get_where('tahun_ajaran', array('aktif' => 1))->row();
            $ta_id = $default_ta ? $default_ta->id : 1;

            $classes = array(
                array('id' => 1, 'jenjang_id' => 1, 'tahun_ajaran_id' => $ta_id, 'nama_kelas' => 'Tajhizi A'),
                array('id' => 2, 'jenjang_id' => 1, 'tahun_ajaran_id' => $ta_id, 'nama_kelas' => 'Tajhizi B'),
                array('id' => 3, 'jenjang_id' => 2, 'tahun_ajaran_id' => $ta_id, 'nama_kelas' => 'Ula 1'),
                array('id' => 4, 'jenjang_id' => 2, 'tahun_ajaran_id' => $ta_id, 'nama_kelas' => 'Ula 2'),
                array('id' => 5, 'jenjang_id' => 3, 'tahun_ajaran_id' => $ta_id, 'nama_kelas' => 'Wustha 1'),
                array('id' => 6, 'jenjang_id' => 4, 'tahun_ajaran_id' => $ta_id, 'nama_kelas' => 'Ulya 1'),
                array('id' => 7, 'jenjang_id' => 5, 'tahun_ajaran_id' => $ta_id, 'nama_kelas' => 'Ma\'had Aly'),
            );
            $this->db->insert_batch('kelas', $classes);
        }

        $this->db->db_debug = $prev_debug;
    }

    public function get_jenjang_list() {
        return $this->db->order_by('urutan', 'ASC')->get('jenjang')->result();
    }

    public function get_kelas_list($jenjang_id = null) {
        $this->db->select('k.*, j.nama as nama_jenjang');
        $this->db->from('kelas k');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');
        if ($jenjang_id) {
            $this->db->where('k.jenjang_id', $jenjang_id);
        }
        $this->db->order_by('k.jenjang_id', 'ASC');
        $this->db->order_by('k.nama_kelas', 'ASC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insert_berkas($data) {
        return $this->db->insert('berkas_pendaftaran', $data);
    }

    public function get_berkas($pendaftaran_id) {
        return $this->db->get_where('berkas_pendaftaran', array('pendaftaran_id' => $pendaftaran_id))->result();
    }

    public function get_berkas_by_id($berkas_id) {
        return $this->db->get_where('berkas_pendaftaran', array('id' => $berkas_id))->row();
    }

    public function save_or_replace_berkas($pendaftaran_id, $jenis_berkas, $nama_file) {
        $existing = $this->db->get_where('berkas_pendaftaran', array(
            'pendaftaran_id' => $pendaftaran_id,
            'jenis_berkas'   => $jenis_berkas
        ))->row();

        if ($existing) {
            // Hapus file lama jika ada dan berbeda
            if (!empty($existing->nama_file) && $existing->nama_file !== $nama_file) {
                $old_path = FCPATH . 'uploads/berkas/' . $existing->nama_file;
                if (file_exists($old_path)) {
                    @unlink($old_path);
                }
            }

            return $this->db->where('id', $existing->id)->update('berkas_pendaftaran', array(
                'nama_file'   => $nama_file,
                'uploaded_at' => date('Y-m-d H:i:s')
            ));
        } else {
            return $this->db->insert('berkas_pendaftaran', array(
                'pendaftaran_id' => $pendaftaran_id,
                'jenis_berkas'   => $jenis_berkas,
                'nama_file'      => $nama_file,
                'uploaded_at'    => date('Y-m-d H:i:s')
            ));
        }
    }

    public function delete_berkas_single($berkas_id) {
        $b = $this->get_berkas_by_id($berkas_id);
        if ($b) {
            $file_path = FCPATH . 'uploads/berkas/' . $b->nama_file;
            if (!empty($b->nama_file) && file_exists($file_path)) {
                @unlink($file_path);
            }
            return $this->db->where('id', $berkas_id)->delete('berkas_pendaftaran');
        }
        return false;
    }

    public function get_by_id($id) {
        $this->db->select('p.*, j.nama as nama_jenjang, ta.nama as nama_tahun_ajaran, s.no_induk as nis_santri');
        $this->db->from('pendaftaran p');
        $this->db->join('jenjang j', 'j.id = p.jenjang_tujuan_id', 'left');
        $this->db->join('tahun_ajaran ta', 'ta.id = p.tahun_ajaran_id', 'left');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    public function get_by_no_pendaftaran($no_pendaftaran) {
        $this->db->select('p.*, j.nama as nama_jenjang, ta.nama as nama_tahun_ajaran, s.no_induk as nis_santri');
        $this->db->from('pendaftaran p');
        $this->db->join('jenjang j', 'j.id = p.jenjang_tujuan_id', 'left');
        $this->db->join('tahun_ajaran ta', 'ta.id = p.tahun_ajaran_id', 'left');
        $this->db->join('santri s', 's.id = p.santri_id', 'left');
        $this->db->where('p.no_pendaftaran', $no_pendaftaran);
        return $this->db->get()->row();
    }

    public function get_by_nik_or_no($keyword) {
        $this->db->select('p.*, j.nama as nama_jenjang, ta.nama as nama_tahun_ajaran');
        $this->db->from('pendaftaran p');
        $this->db->join('jenjang j', 'j.id = p.jenjang_tujuan_id', 'left');
        $this->db->join('tahun_ajaran ta', 'ta.id = p.tahun_ajaran_id', 'left');
        $this->db->group_start();
        $this->db->where('p.no_pendaftaran', $keyword);
        $this->db->or_where('p.nik', $keyword);
        $this->db->group_end();
        return $this->db->get()->row();
    }

    public function get_all($filter = array(), $limit = null, $offset = null) {
        $this->db->select('p.*, j.nama as nama_jenjang, ta.nama as nama_tahun_ajaran');
        $this->db->from('pendaftaran p');
        $this->db->join('jenjang j', 'j.id = p.jenjang_tujuan_id', 'left');
        $this->db->join('tahun_ajaran ta', 'ta.id = p.tahun_ajaran_id', 'left');

        if (!empty($filter['status'])) {
            $this->db->where('p.status', $filter['status']);
        }
        if (!empty($filter['jenjang_id'])) {
            $this->db->where('p.jenjang_tujuan_id', $filter['jenjang_id']);
        }
        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('p.nama', $filter['keyword']);
            $this->db->or_like('p.no_pendaftaran', $filter['keyword']);
            $this->db->or_like('p.nik', $filter['keyword']);
            $this->db->or_like('p.asal_kabupaten', $filter['keyword']);
            $this->db->group_end();
        }

        $this->db->order_by('p.id', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }

    public function count_all($filter = array()) {
        $this->db->from('pendaftaran p');
        if (!empty($filter['status'])) {
            $this->db->where('p.status', $filter['status']);
        }
        if (!empty($filter['jenjang_id'])) {
            $this->db->where('p.jenjang_tujuan_id', $filter['jenjang_id']);
        }
        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('p.nama', $filter['keyword']);
            $this->db->or_like('p.no_pendaftaran', $filter['keyword']);
            $this->db->or_like('p.nik', $filter['keyword']);
            $this->db->or_like('p.asal_kabupaten', $filter['keyword']);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }

    public function update_status($id, $status, $catatan = null) {
        $data = array('status' => $status);
        if ($catatan !== null) {
            $data['catatan'] = $catatan;
        }
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Convert admitted applicant to permanent Santri record
     */
    public function jadikan_santri($pendaftaran_id, $no_induk, $kelas_id) {
        $p = $this->get_by_id($pendaftaran_id);
        if (!$p) {
            return false;
        }

        // If already converted, return existing santri id
        if (!empty($p->santri_id)) {
            return $p->santri_id;
        }

        // Find foto from berkas
        $berkas_foto = $this->db->get_where('berkas_pendaftaran', array(
            'pendaftaran_id' => $pendaftaran_id,
            'jenis_berkas' => 'foto'
        ))->row();

        $foto_name = $berkas_foto ? $berkas_foto->nama_file : null;

        // Salin file foto khusus santri agar independen dari berkas pendaftaran
        $santri_foto = null;
        if (!empty($foto_name)) {
            $src_path = FCPATH . 'uploads/berkas/' . $foto_name;
            if (file_exists($src_path)) {
                $ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));
                $santri_foto = 'santri_' . time() . '_' . mt_rand(100, 999) . '.' . $ext;
                $dest_path = FCPATH . 'uploads/berkas/' . $santri_foto;
                if (!@copy($src_path, $dest_path)) {
                    $santri_foto = $foto_name; // Fallback jika gagal copy
                }
            } else {
                $santri_foto = $foto_name;
            }
        }

        // Prepare data for santri table
        $data_santri = array(
            'no_induk'        => $no_induk,
            'nik'             => $p->nik,
            'nama'            => $p->nama,
            'jenis_kelamin'   => $p->jenis_kelamin,
            'tempat_lahir'    => $p->tempat_lahir,
            'tanggal_lahir'   => $p->tanggal_lahir,
            'anak_ke'         => $p->anak_ke,
            'jumlah_saudara'  => $p->jumlah_saudara,
            'asal_gampong'    => $p->asal_gampong,
            'asal_kecamatan'  => $p->asal_kecamatan,
            'asal_kabupaten'  => $p->asal_kabupaten,
            'asal_provinsi'   => $p->asal_provinsi,
            'alamat_domisili' => $p->asal_gampong . ', ' . $p->asal_kecamatan . ', ' . $p->asal_kabupaten,
            'no_hp'           => $p->no_hp_ortu ?: $p->pendaftar_no_hp,
            'email'           => null,
            'asal_sekolah'    => $p->asal_sekolah,
            'nama_ayah'       => $p->nama_ayah,
            'nama_ibu'        => $p->nama_ibu,
            'pekerjaan_ayah'  => $p->pekerjaan_ayah,
            'pekerjaan_ibu'   => $p->pekerjaan_ibu,
            'alamat_ortu'     => $p->alamat_ortu,
            'no_hp_ortu'      => $p->no_hp_ortu,
            'nama_wali'       => $p->nama_wali,
            'pekerjaan_wali'  => $p->pekerjaan_wali,
            'alamat_wali'     => $p->alamat_wali,
            'no_hp_wali'      => $p->no_hp_wali,
            'kelas_id'        => $kelas_id ?: null,
            'tahun_masuk'     => date('Y'),
            'status'          => 'aktif',
            'foto'            => $santri_foto
        );

        $this->db->insert('santri', $data_santri);
        $santri_id = $this->db->insert_id();

        // Update pendaftaran record
        $this->db->where('id', $pendaftaran_id)->update($this->table, array(
            'status'    => 'diterima',
            'santri_id' => $santri_id
        ));

        return $santri_id;
    }
}
