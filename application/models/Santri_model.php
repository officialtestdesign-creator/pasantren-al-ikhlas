<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Santri_model extends CI_Model {

    protected $table = 'santri';

    public function __construct() {
        parent::__construct();
        $this->ensure_sample_santri();
    }

    /**
     * Ensure comprehensive sample santri (students) data exists across all jenjang and classes
     */
    public function ensure_sample_santri() {
        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Clean up stray row with id = 0 if any
        $this->db->where('id', 0)->delete($this->table);

        // Ensure AUTO_INCREMENT is enabled on primary key id
        $this->db->query("ALTER TABLE `{$this->table}` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");

        $count = $this->db->count_all($this->table);
        if ($count < 20) {
            $samples = array(
                // KELAS 1: TAJHIZI A
                array(
                    'id'              => 1,
                    'no_induk'        => '2026001',
                    'nik'             => '1111011503130001',
                    'nama'            => 'Muhammad Al-Fatih',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Samalanga',
                    'tanggal_lahir'   => '2013-03-15',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Sangso',
                    'asal_kecamatan'  => 'Samalanga',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112201',
                    'email'           => 'alfatih2026@gmail.com',
                    'asal_sekolah'    => 'MIN 1 Bireuen',
                    'nama_ayah'       => 'Ibrahim Ahmad',
                    'nama_ibu'        => 'Maryamah',
                    'pekerjaan_ayah'  => 'PNS',
                    'pekerjaan_ibu'   => 'Guru',
                    'alamat_ortu'     => 'Gampong Sangso, Samalanga, Kab. Bireuen',
                    'no_hp_ortu'      => '081260112201',
                    'nama_wali'       => 'Ibrahim Ahmad',
                    'pekerjaan_wali'  => 'PNS',
                    'alamat_wali'     => 'Gampong Sangso, Samalanga, Kab. Bireuen',
                    'no_hp_wali'      => '081260112201',
                    'kelas_id'        => 1,
                    'tahun_masuk'     => 2026,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 2,
                    'no_induk'        => '2026002',
                    'nik'             => '1171011805130002',
                    'nama'            => 'Teuku Raihan Syahputra',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Banda Aceh',
                    'tanggal_lahir'   => '2013-05-18',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Lamteh',
                    'asal_kecamatan'  => 'Ulee Kareng',
                    'asal_kabupaten'  => 'Kota Banda Aceh',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112202',
                    'email'           => 'raihan.syahputra@gmail.com',
                    'asal_sekolah'    => 'SD IT Nurul Ishlah Banda Aceh',
                    'nama_ayah'       => 'Teuku Iskandar, S.T',
                    'nama_ibu'        => 'Cut Safura',
                    'pekerjaan_ayah'  => 'Wiraswasta',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Jl. Kebun Raja No. 12 Lamteh, Banda Aceh',
                    'no_hp_ortu'      => '081377223302',
                    'nama_wali'       => 'Teuku Iskandar, S.T',
                    'pekerjaan_wali'  => 'Wiraswasta',
                    'alamat_wali'     => 'Jl. Kebun Raja No. 12 Lamteh, Banda Aceh',
                    'no_hp_wali'      => '081377223302',
                    'kelas_id'        => 1,
                    'tahun_masuk'     => 2026,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 3,
                    'no_induk'        => '2026003',
                    'nik'             => '1173012208130003',
                    'nama'            => 'Cut Nabila Azzahra',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Lhokseumawe',
                    'tanggal_lahir'   => '2013-08-22',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 2,
                    'asal_gampong'    => 'Keude Cunda',
                    'asal_kecamatan'  => 'Muara Dua',
                    'asal_kabupaten'  => 'Kota Lhokseumawe',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112203',
                    'email'           => 'cut.nabila@gmail.com',
                    'asal_sekolah'    => 'MIN 1 Kota Lhokseumawe',
                    'nama_ayah'       => 'Teuku Muslem',
                    'nama_ibu'        => 'Faridah Hanum',
                    'pekerjaan_ayah'  => 'Pedagang',
                    'pekerjaan_ibu'   => 'PNS',
                    'alamat_ortu'     => 'Jl. Medan-Banda Aceh No. 45 Cunda, Lhokseumawe',
                    'no_hp_ortu'      => '085260334403',
                    'nama_wali'       => 'Teuku Muslem',
                    'pekerjaan_wali'  => 'Pedagang',
                    'alamat_wali'     => 'Jl. Medan-Banda Aceh No. 45 Cunda, Lhokseumawe',
                    'no_hp_wali'      => '085260334403',
                    'kelas_id'        => 1,
                    'tahun_masuk'     => 2026,
                    'status'          => 'aktif'
                ),

                // KELAS 2: TAJHIZI B
                array(
                    'id'              => 4,
                    'no_induk'        => '2026004',
                    'nik'             => '1107011002130004',
                    'nama'            => 'Ahmad Fauzan',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Sigli',
                    'tanggal_lahir'   => '2013-02-10',
                    'anak_ke'         => 3,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Blang Paseh',
                    'asal_kecamatan'  => 'Kota Sigli',
                    'asal_kabupaten'  => 'Pidie',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112204',
                    'email'           => 'ahmad.fauzan@gmail.com',
                    'asal_sekolah'    => 'SD Negeri 1 Sigli',
                    'nama_ayah'       => 'Mahdi Sulaiman',
                    'nama_ibu'        => 'Rohana',
                    'pekerjaan_ayah'  => 'Petani / Pekebun',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Blang Paseh, Sigli, Kab. Pidie',
                    'no_hp_ortu'      => '085277445504',
                    'nama_wali'       => 'Mahdi Sulaiman',
                    'pekerjaan_wali'  => 'Petani / Pekebun',
                    'alamat_wali'     => 'Gampong Blang Paseh, Sigli, Kab. Pidie',
                    'no_hp_wali'      => '085277445504',
                    'kelas_id'        => 2,
                    'tahun_masuk'     => 2026,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 5,
                    'no_induk'        => '2026005',
                    'nik'             => '1118011211130005',
                    'nama'            => 'Siti Sarah Humaira',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Meureudu',
                    'tanggal_lahir'   => '2013-11-12',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Rhieng Blang',
                    'asal_kecamatan'  => 'Meureudu',
                    'asal_kabupaten'  => 'Pidie Jaya',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112205',
                    'email'           => 'sarah.humaira@gmail.com',
                    'asal_sekolah'    => 'MIN 1 Meureudu Pidie Jaya',
                    'nama_ayah'       => 'Drs. T. Muchlis',
                    'nama_ibu'        => 'Ainun Mardhiah, S.Pd',
                    'pekerjaan_ayah'  => 'PNS Kemenag',
                    'pekerjaan_ibu'   => 'Guru',
                    'alamat_ortu'     => 'Gampong Rhieng Blang, Meureudu, Pidie Jaya',
                    'no_hp_ortu'      => '081269556605',
                    'nama_wali'       => 'Drs. T. Muchlis',
                    'pekerjaan_wali'  => 'PNS Kemenag',
                    'alamat_wali'     => 'Gampong Rhieng Blang, Meureudu, Pidie Jaya',
                    'no_hp_wali'      => '081269556605',
                    'kelas_id'        => 2,
                    'tahun_masuk'     => 2026,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 6,
                    'no_induk'        => '2026006',
                    'nik'             => '1111012906130006',
                    'nama'            => 'Aisyah Zahratun Nisa',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Bireuen',
                    'tanggal_lahir'   => '2013-06-29',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Matang Glumpang Dua',
                    'asal_kecamatan'  => 'Peusangan',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112206',
                    'email'           => 'aisyah.zahra@gmail.com',
                    'asal_sekolah'    => 'SD IT Az-Zahra Peusangan',
                    'nama_ayah'       => 'Saifuddin',
                    'nama_ibu'        => 'Khadijah',
                    'pekerjaan_ayah'  => 'Wiraswasta',
                    'pekerjaan_ibu'   => 'Pedagang',
                    'alamat_ortu'     => 'Jl. Al-Muslim No. 8 Matang Glumpang Dua, Bireuen',
                    'no_hp_ortu'      => '085360667706',
                    'nama_wali'       => 'Saifuddin',
                    'pekerjaan_wali'  => 'Wiraswasta',
                    'alamat_wali'     => 'Jl. Al-Muslim No. 8 Matang Glumpang Dua, Bireuen',
                    'no_hp_wali'      => '085360667706',
                    'kelas_id'        => 2,
                    'tahun_masuk'     => 2026,
                    'status'          => 'aktif'
                ),

                // KELAS 3: ULA 1 A
                array(
                    'id'              => 7,
                    'no_induk'        => '2025001',
                    'nik'             => '1104011404120007',
                    'nama'            => 'Muhammad Ilham Ramadhan',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Takengon',
                    'tanggal_lahir'   => '2012-04-14',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 2,
                    'asal_gampong'    => 'Kemili',
                    'asal_kecamatan'  => 'Bebesen',
                    'asal_kabupaten'  => 'Aceh Tengah',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112207',
                    'email'           => 'ilham.ramadhan@gmail.com',
                    'asal_sekolah'    => 'MTsN 1 Takengon',
                    'nama_ayah'       => 'Aman Firdaus',
                    'nama_ibu'        => 'Inen Firdaus',
                    'pekerjaan_ayah'  => 'Petani Kopi Gayo',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Kemili, Bebesen, Takengon',
                    'no_hp_ortu'      => '081362778807',
                    'nama_wali'       => 'Aman Firdaus',
                    'pekerjaan_wali'  => 'Petani Kopi Gayo',
                    'alamat_wali'     => 'Gampong Kemili, Bebesen, Takengon',
                    'no_hp_wali'      => '081362778807',
                    'kelas_id'        => 3,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 8,
                    'no_induk'        => '2025002',
                    'nik'             => '1111010809120008',
                    'nama'            => 'Zaki Mubarak',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Jeunieb',
                    'tanggal_lahir'   => '2012-09-08',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Meunasah Lueng',
                    'asal_kecamatan'  => 'Jeunieb',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112208',
                    'email'           => 'zaki.mubarak@gmail.com',
                    'asal_sekolah'    => 'SMP Negeri 1 Jeunieb',
                    'nama_ayah'       => 'Marzuki Abdullah',
                    'nama_ibu'        => 'Fatimah',
                    'pekerjaan_ayah'  => 'Nelayan / Pengusaha Ikan',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Meunasah Lueng, Jeunieb, Bireuen',
                    'no_hp_ortu'      => '085270889908',
                    'nama_wali'       => 'Marzuki Abdullah',
                    'pekerjaan_wali'  => 'Nelayan / Pengusaha Ikan',
                    'alamat_wali'     => 'Gampong Meunasah Lueng, Jeunieb, Bireuen',
                    'no_hp_wali'      => '085270889908',
                    'kelas_id'        => 3,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 9,
                    'no_induk'        => '2025003',
                    'nik'             => '1108011901120009',
                    'nama'            => 'Putri Ramadhani',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Krueng Geukueh',
                    'tanggal_lahir'   => '2012-01-19',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Keude Krueng Geukueh',
                    'asal_kecamatan'  => 'Dewantara',
                    'asal_kabupaten'  => 'Aceh Utara',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112209',
                    'email'           => 'putri.ramadhani@gmail.com',
                    'asal_sekolah'    => 'MTsS Ulumuddin Dewantara',
                    'nama_ayah'       => 'Bukhari',
                    'nama_ibu'        => 'Nurjannah',
                    'pekerjaan_ayah'  => 'Karyawan Swasta',
                    'pekerjaan_ibu'   => 'PNS',
                    'alamat_ortu'     => 'Komplek Perumahan, Dewantara, Aceh Utara',
                    'no_hp_ortu'      => '081264990009',
                    'nama_wali'       => 'Bukhari',
                    'pekerjaan_wali'  => 'Karyawan Swasta',
                    'alamat_wali'     => 'Komplek Perumahan, Dewantara, Aceh Utara',
                    'no_hp_wali'      => '081264990009',
                    'kelas_id'        => 3,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),

                // KELAS 4: ULA 1 B
                array(
                    'id'              => 10,
                    'no_induk'        => '2025004',
                    'nik'             => '1174011707120010',
                    'nama'            => 'M. Hafizh Ar-Rasyid',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Langsa',
                    'tanggal_lahir'   => '2012-07-17',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Gampong Jawa',
                    'asal_kecamatan'  => 'Langsa Kota',
                    'asal_kabupaten'  => 'Kota Langsa',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112210',
                    'email'           => 'hafizh.rasyid@gmail.com',
                    'asal_sekolah'    => 'MTsN 1 Kota Langsa',
                    'nama_ayah'       => 'H. Rasyid Ridha',
                    'nama_ibu'        => 'Hj. Syarifah Aminah',
                    'pekerjaan_ayah'  => 'Wiraswasta',
                    'pekerjaan_ibu'   => 'Guru',
                    'alamat_ortu'     => 'Jl. A. Yani No. 54 Gampong Jawa, Kota Langsa',
                    'no_hp_ortu'      => '081361112210',
                    'nama_wali'       => 'H. Rasyid Ridha',
                    'pekerjaan_wali'  => 'Wiraswasta',
                    'alamat_wali'     => 'Jl. A. Yani No. 54 Gampong Jawa, Kota Langsa',
                    'no_hp_wali'      => '081361112210',
                    'kelas_id'        => 4,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 11,
                    'no_induk'        => '2025005',
                    'nik'             => '1105012510120011',
                    'nama'            => 'Farah Nadia',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Meulaboh',
                    'tanggal_lahir'   => '2012-10-25',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 2,
                    'asal_gampong'    => 'Ujong Baroh',
                    'asal_kecamatan'  => 'Johan Pahlawan',
                    'asal_kabupaten'  => 'Aceh Barat',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112211',
                    'email'           => 'farah.nadia@gmail.com',
                    'asal_sekolah'    => 'SMP Negeri 1 Meulaboh',
                    'nama_ayah'       => 'Teuku Nurdin',
                    'nama_ibu'        => 'Rosmawati',
                    'pekerjaan_ayah'  => 'PNS Dinas Pendidikan',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Jl. Gajah Mada No. 22 Meulaboh',
                    'no_hp_ortu'      => '081265223311',
                    'nama_wali'       => 'Teuku Nurdin',
                    'pekerjaan_wali'  => 'PNS Dinas Pendidikan',
                    'alamat_wali'     => 'Jl. Gajah Mada No. 22 Meulaboh',
                    'no_hp_wali'      => '081265223311',
                    'kelas_id'        => 4,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 12,
                    'no_induk'        => '2025006',
                    'nik'             => '1111010412120012',
                    'nama'            => 'Syifa Maulida',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Samalanga',
                    'tanggal_lahir'   => '2012-12-04',
                    'anak_ke'         => 3,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Keude Samalanga',
                    'asal_kecamatan'  => 'Samalanga',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112212',
                    'email'           => 'syifa.maulida@gmail.com',
                    'asal_sekolah'    => 'MTsN 2 Bireuen',
                    'nama_ayah'       => 'Hasanuddin',
                    'nama_ibu'        => 'Salbiah',
                    'pekerjaan_ayah'  => 'Pedagang',
                    'pekerjaan_ibu'   => 'Pedagang',
                    'alamat_ortu'     => 'Keude Samalanga, Samalanga, Kab. Bireuen',
                    'no_hp_ortu'      => '085260334412',
                    'nama_wali'       => 'Hasanuddin',
                    'pekerjaan_wali'  => 'Pedagang',
                    'alamat_wali'     => 'Keude Samalanga, Samalanga, Kab. Bireuen',
                    'no_hp_wali'      => '085260334412',
                    'kelas_id'        => 4,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),

                // KELAS 5: ULA 2
                array(
                    'id'              => 13,
                    'no_induk'        => '2025007',
                    'nik'             => '1111010303110013',
                    'nama'            => 'Tariqul Huda',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Pandrah',
                    'tanggal_lahir'   => '2011-03-03',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Pantee Batee',
                    'asal_kecamatan'  => 'Pandrah',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112213',
                    'email'           => 'tariqul.huda@gmail.com',
                    'asal_sekolah'    => 'MTsS Pandrah',
                    'nama_ayah'       => 'Tgk. M. Jamil',
                    'nama_ibu'        => 'Halimah',
                    'pekerjaan_ayah'  => 'Teungku Gampong',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Pantee Batee, Pandrah, Bireuen',
                    'no_hp_ortu'      => '085371445513',
                    'nama_wali'       => 'Tgk. M. Jamil',
                    'pekerjaan_wali'  => 'Teungku Gampong',
                    'alamat_wali'     => 'Gampong Pantee Batee, Pandrah, Bireuen',
                    'no_hp_wali'      => '085371445513',
                    'kelas_id'        => 5,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 14,
                    'no_induk'        => '2025008',
                    'nik'             => '1101011806110014',
                    'nama'            => 'Teuku Wildan Pratama',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Tapaktuan',
                    'tanggal_lahir'   => '2011-06-18',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Pasir Raja',
                    'asal_kecamatan'  => 'Tapaktuan',
                    'asal_kabupaten'  => 'Aceh Selatan',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112214',
                    'email'           => 'wildan.pratama@gmail.com',
                    'asal_sekolah'    => 'SMP Negeri 1 Tapaktuan',
                    'nama_ayah'       => 'Teuku Syamsul Bahri',
                    'nama_ibu'        => 'Cut Nurhasanah',
                    'pekerjaan_ayah'  => 'Wiraswasta',
                    'pekerjaan_ibu'   => 'Guru SD',
                    'alamat_ortu'     => 'Jl. Merdeka No. 17 Tapaktuan, Aceh Selatan',
                    'no_hp_ortu'      => '081266556614',
                    'nama_wali'       => 'Teuku Syamsul Bahri',
                    'pekerjaan_wali'  => 'Wiraswasta',
                    'alamat_wali'     => 'Jl. Merdeka No. 17 Tapaktuan, Aceh Selatan',
                    'no_hp_wali'      => '081266556614',
                    'kelas_id'        => 5,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 15,
                    'no_induk'        => '2025009',
                    'nik'             => '1171012909110015',
                    'nama'            => 'Nurul Maulida',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Banda Aceh',
                    'tanggal_lahir'   => '2011-09-29',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Peunayong',
                    'asal_kecamatan'  => 'Kuta Alam',
                    'asal_kabupaten'  => 'Kota Banda Aceh',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112215',
                    'email'           => 'nurul.maulida@gmail.com',
                    'asal_sekolah'    => 'MTsN 1 Model Banda Aceh',
                    'nama_ayah'       => 'Drs. H. Anwar',
                    'nama_ibu'        => 'Hj. Mardhiah',
                    'pekerjaan_ayah'  => 'Pensiunan PNS',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Jl. Kartini No. 4 Peunayong, Banda Aceh',
                    'no_hp_ortu'      => '081370667715',
                    'nama_wali'       => 'Drs. H. Anwar',
                    'pekerjaan_wali'  => 'Pensiunan PNS',
                    'alamat_wali'     => 'Jl. Kartini No. 4 Peunayong, Banda Aceh',
                    'no_hp_wali'      => '081370667715',
                    'kelas_id'        => 5,
                    'tahun_masuk'     => 2025,
                    'status'          => 'aktif'
                ),

                // KELAS 6: WUSTHA 1
                array(
                    'id'              => 16,
                    'no_induk'        => '2024001',
                    'nik'             => '1111011101100016',
                    'nama'            => 'M. Daffa Al-Ghifari',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Bireuen',
                    'tanggal_lahir'   => '2010-01-11',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 2,
                    'asal_gampong'    => 'Kota Bireuen',
                    'asal_kecamatan'  => 'Kota Juang',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112216',
                    'email'           => 'daffa.ghifari@gmail.com',
                    'asal_sekolah'    => 'SMP Negeri 1 Bireuen',
                    'nama_ayah'       => 'dr. H. Fachrul Razi',
                    'nama_ibu'        => 'dr. Cut Yuliana, Sp.A',
                    'pekerjaan_ayah'  => 'Dokter',
                    'pekerjaan_ibu'   => 'Dokter Spesialis Anak',
                    'alamat_ortu'     => 'Jl. Mayjen T. Hamzah Bendahara No. 10 Kota Juang',
                    'no_hp_ortu'      => '081269778816',
                    'nama_wali'       => 'dr. H. Fachrul Razi',
                    'pekerjaan_wali'  => 'Dokter',
                    'alamat_wali'     => 'Jl. Mayjen T. Hamzah Bendahara No. 10 Kota Juang',
                    'no_hp_wali'      => '081269778816',
                    'kelas_id'        => 6,
                    'tahun_masuk'     => 2024,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 17,
                    'no_induk'        => '2024002',
                    'nik'             => '1173010505100017',
                    'nama'            => 'Khairun Nisa',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Lhokseumawe',
                    'tanggal_lahir'   => '2010-05-05',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Hagu Teungoh',
                    'asal_kecamatan'  => 'Banda Sakti',
                    'asal_kabupaten'  => 'Kota Lhokseumawe',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112217',
                    'email'           => 'khairun.nisa@gmail.com',
                    'asal_sekolah'    => 'MTsN 1 Kota Lhokseumawe',
                    'nama_ayah'       => 'Nasruddin, S.E',
                    'nama_ibu'        => 'Dahliana',
                    'pekerjaan_ayah'  => 'Pegawai Bank Syariah',
                    'pekerjaan_ibu'   => 'Guru MTsN',
                    'alamat_ortu'     => 'Gampong Hagu Teungoh, Banda Sakti, Lhokseumawe',
                    'no_hp_ortu'      => '085277889917',
                    'nama_wali'       => 'Nasruddin, S.E',
                    'pekerjaan_wali'  => 'Pegawai Bank Syariah',
                    'alamat_wali'     => 'Gampong Hagu Teungoh, Banda Sakti, Lhokseumawe',
                    'no_hp_wali'      => '085277889917',
                    'kelas_id'        => 6,
                    'tahun_masuk'     => 2024,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 18,
                    'no_induk'        => '2024003',
                    'nik'             => '1107012010100018',
                    'nama'            => 'Naila Safitri',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Beureunuen',
                    'tanggal_lahir'   => '2010-10-20',
                    'anak_ke'         => 3,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Keude Beureunuen',
                    'asal_kecamatan'  => 'Mutiara Timur',
                    'asal_kabupaten'  => 'Pidie',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112218',
                    'email'           => 'naila.safitri@gmail.com',
                    'asal_sekolah'    => 'SMP IT Ibnu Khaldun Beureunuen',
                    'nama_ayah'       => 'H. Zulkarnain',
                    'nama_ibu'        => 'Hj. Syamsiah',
                    'pekerjaan_ayah'  => 'Pedagang Grosir',
                    'pekerjaan_ibu'   => 'Pedagang',
                    'alamat_ortu'     => 'Pasar Beureunuen, Mutiara Timur, Kab. Pidie',
                    'no_hp_ortu'      => '081267990018',
                    'nama_wali'       => 'H. Zulkarnain',
                    'pekerjaan_wali'  => 'Pedagang Grosir',
                    'alamat_wali'     => 'Pasar Beureunuen, Mutiara Timur, Kab. Pidie',
                    'no_hp_wali'      => '081267990018',
                    'kelas_id'        => 6,
                    'tahun_masuk'     => 2024,
                    'status'          => 'aktif'
                ),

                // KELAS 7: WUSTHA 2
                array(
                    'id'              => 19,
                    'no_induk'        => '2024004',
                    'nik'             => '1175011408090019',
                    'nama'            => 'Rizki Ramadhan',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Subulussalam',
                    'tanggal_lahir'   => '2009-08-14',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Subulussalam Barat',
                    'asal_kecamatan'  => 'Simpang Kiri',
                    'asal_kabupaten'  => 'Kota Subulussalam',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112219',
                    'email'           => 'rizki.ramadhan@gmail.com',
                    'asal_sekolah'    => 'SMP Negeri 1 Simpang Kiri',
                    'nama_ayah'       => 'M. Nasir Kombih',
                    'nama_ibu'        => 'Nuraisyah',
                    'pekerjaan_ayah'  => 'PNS Setdakot Subulussalam',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Jl. Teuku Umar No. 88 Subulussalam Barat',
                    'no_hp_ortu'      => '085275112219',
                    'nama_wali'       => 'M. Nasir Kombih',
                    'pekerjaan_wali'  => 'PNS Setdakot Subulussalam',
                    'alamat_wali'     => 'Jl. Teuku Umar No. 88 Subulussalam Barat',
                    'no_hp_wali'      => '085275112219',
                    'kelas_id'        => 7,
                    'tahun_masuk'     => 2024,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 20,
                    'no_induk'        => '2024005',
                    'nik'             => '1207011911090020',
                    'nama'            => 'M. Bilal Al-Habsy',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Medan',
                    'tanggal_lahir'   => '2009-11-19',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Bandar Khalipah',
                    'asal_kecamatan'  => 'Percut Sei Tuan',
                    'asal_kabupaten'  => 'Deli Serdang',
                    'asal_provinsi'   => 'Sumatera Utara',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112220',
                    'email'           => 'bilal.habsy@gmail.com',
                    'asal_sekolah'    => 'MTs Swasta Al-Ittihadiyah Medan',
                    'nama_ayah'       => 'Habib Ali Al-Habsy',
                    'nama_ibu'        => 'Syarifah Fatimah',
                    'pekerjaan_ayah'  => 'Wiraswasta',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Jl. Letda Sujono No. 104 Medan',
                    'no_hp_ortu'      => '081375223320',
                    'nama_wali'       => 'Habib Ali Al-Habsy',
                    'pekerjaan_wali'  => 'Wiraswasta',
                    'alamat_wali'     => 'Jl. Letda Sujono No. 104 Medan',
                    'no_hp_wali'      => '081375223320',
                    'kelas_id'        => 7,
                    'tahun_masuk'     => 2024,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 21,
                    'no_induk'        => '2024006',
                    'nik'             => '1111012102090021',
                    'nama'            => 'Rahmatillah',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Samalanga',
                    'tanggal_lahir'   => '2009-02-21',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Namploh Baro',
                    'asal_kecamatan'  => 'Samalanga',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112221',
                    'email'           => 'rahmatillah@gmail.com',
                    'asal_sekolah'    => 'MTsN 2 Samalanga Bireuen',
                    'nama_ayah'       => 'Tgk. Razali',
                    'nama_ibu'        => 'Maimunah',
                    'pekerjaan_ayah'  => 'Petani',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Namploh Baro, Samalanga, Bireuen',
                    'no_hp_ortu'      => '085270334421',
                    'nama_wali'       => 'Tgk. Razali',
                    'pekerjaan_wali'  => 'Petani',
                    'alamat_wali'     => 'Gampong Namploh Baro, Samalanga, Bireuen',
                    'no_hp_wali'      => '085270334421',
                    'kelas_id'        => 7,
                    'tahun_masuk'     => 2024,
                    'status'          => 'aktif'
                ),

                // KELAS 8: ULYA 1
                array(
                    'id'              => 22,
                    'no_induk'        => '2023001',
                    'nik'             => '1171011604080022',
                    'nama'            => 'Teuku Danial Akbar',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Banda Aceh',
                    'tanggal_lahir'   => '2008-04-16',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 2,
                    'asal_gampong'    => 'Lamlagang',
                    'asal_kecamatan'  => 'Banda Raya',
                    'asal_kabupaten'  => 'Kota Banda Aceh',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112222',
                    'email'           => 'danial.akbar@gmail.com',
                    'asal_sekolah'    => 'Dayah Jeumala Hayah Pidie Jaya',
                    'nama_ayah'       => 'Ir. Teuku Iskandar Muda',
                    'nama_ibu'        => 'Cut Erlina, S.E',
                    'pekerjaan_ayah'  => 'Konsultan Teknik',
                    'pekerjaan_ibu'   => 'Wiraswasta',
                    'alamat_ortu'     => 'Jl. Teuku Umar No. 25 Lamlagang, Banda Aceh',
                    'no_hp_ortu'      => '081260445522',
                    'nama_wali'       => 'Ir. Teuku Iskandar Muda',
                    'pekerjaan_wali'  => 'Konsultan Teknik',
                    'alamat_wali'     => 'Jl. Teuku Umar No. 25 Lamlagang, Banda Aceh',
                    'no_hp_wali'      => '081260445522',
                    'kelas_id'        => 8,
                    'tahun_masuk'     => 2023,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 23,
                    'no_induk'        => '2023002',
                    'nik'             => '1111012808080023',
                    'nama'            => 'Zahra Salsabila',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Bireuen',
                    'tanggal_lahir'   => '2008-08-28',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Geudong-Geudong',
                    'asal_kecamatan'  => 'Kota Juang',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112223',
                    'email'           => 'zahra.salsabila@gmail.com',
                    'asal_sekolah'    => 'SMP Negeri 2 Bireuen',
                    'nama_ayah'       => 'H. Sofyan Arsyad',
                    'nama_ibu'        => 'Hj. Nilawati',
                    'pekerjaan_ayah'  => 'Wiraswasta',
                    'pekerjaan_ibu'   => 'PNS Dinas Kesehatan',
                    'alamat_ortu'     => 'Gampong Geudong-Geudong, Kota Juang, Bireuen',
                    'no_hp_ortu'      => '081363556623',
                    'nama_wali'       => 'H. Sofyan Arsyad',
                    'pekerjaan_wali'  => 'Wiraswasta',
                    'alamat_wali'     => 'Gampong Geudong-Geudong, Kota Juang, Bireuen',
                    'no_hp_wali'      => '081363556623',
                    'kelas_id'        => 8,
                    'tahun_masuk'     => 2023,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 24,
                    'no_induk'        => '2023003',
                    'nik'             => '1118011512080024',
                    'nama'            => 'Cut Mutia Rahmah',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Meureudu',
                    'tanggal_lahir'   => '2008-12-15',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Manyang Cut',
                    'asal_kecamatan'  => 'Meureudu',
                    'asal_kabupaten'  => 'Pidie Jaya',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112224',
                    'email'           => 'cut.mutia@gmail.com',
                    'asal_sekolah'    => 'MTsN Meureudu',
                    'nama_ayah'       => 'Teuku Fauzi',
                    'nama_ibu'        => 'Fauziah',
                    'pekerjaan_ayah'  => 'PNS',
                    'pekerjaan_ibu'   => 'Guru',
                    'alamat_ortu'     => 'Gampong Manyang Cut, Meureudu, Pidie Jaya',
                    'no_hp_ortu'      => '085270667724',
                    'nama_wali'       => 'Teuku Fauzi',
                    'pekerjaan_wali'  => 'PNS',
                    'alamat_wali'     => 'Gampong Manyang Cut, Meureudu, Pidie Jaya',
                    'no_hp_wali'      => '085270667724',
                    'kelas_id'        => 8,
                    'tahun_masuk'     => 2023,
                    'status'          => 'aktif'
                ),

                // KELAS 9: ULYA 2
                array(
                    'id'              => 25,
                    'no_induk'        => '2023004',
                    'nik'             => '1111011003070025',
                    'nama'            => 'Muhammad Farhan',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Peusangan',
                    'tanggal_lahir'   => '2007-03-10',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Cot Bada',
                    'asal_kecamatan'  => 'Peusangan',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112225',
                    'email'           => 'farhan.peusangan@gmail.com',
                    'asal_sekolah'    => 'MAS Ummul Ayman Samalanga',
                    'nama_ayah'       => 'Mukhtar Daud',
                    'nama_ibu'        => 'Rohani',
                    'pekerjaan_ayah'  => 'Pedagang',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Cot Bada, Peusangan, Bireuen',
                    'no_hp_ortu'      => '085377778825',
                    'nama_wali'       => 'Mukhtar Daud',
                    'pekerjaan_wali'  => 'Pedagang',
                    'alamat_wali'     => 'Gampong Cot Bada, Peusangan, Bireuen',
                    'no_hp_wali'      => '085377778825',
                    'kelas_id'        => 9,
                    'tahun_masuk'     => 2023,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 26,
                    'no_induk'        => '2023005',
                    'nik'             => '1171010707070026',
                    'nama'            => 'Sayed Syahrul Ramadhan',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Banda Aceh',
                    'tanggal_lahir'   => '2007-07-07',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Alue Deah Teungoh',
                    'asal_kecamatan'  => 'Meuraxa',
                    'asal_kabupaten'  => 'Kota Banda Aceh',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112226',
                    'email'           => 'sayed.syahrul@gmail.com',
                    'asal_sekolah'    => 'MTsN 1 Banda Aceh',
                    'nama_ayah'       => 'Sayed Helmi',
                    'nama_ibu'        => 'Syarifah Aisyah',
                    'pekerjaan_ayah'  => 'Wiraswasta',
                    'pekerjaan_ibu'   => 'Guru SMA',
                    'alamat_ortu'     => 'Gampong Alue Deah Teungoh, Meuraxa, Banda Aceh',
                    'no_hp_ortu'      => '081260889926',
                    'nama_wali'       => 'Sayed Helmi',
                    'pekerjaan_wali'  => 'Wiraswasta',
                    'alamat_wali'     => 'Gampong Alue Deah Teungoh, Meuraxa, Banda Aceh',
                    'no_hp_wali'      => '081260889926',
                    'kelas_id'        => 9,
                    'tahun_masuk'     => 2023,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 27,
                    'no_induk'        => '2023006',
                    'nik'             => '1108011211070027',
                    'nama'            => 'Siti Aminah',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Lhoksukon',
                    'tanggal_lahir'   => '2007-11-12',
                    'anak_ke'         => 3,
                    'jumlah_saudara'  => 5,
                    'asal_gampong'    => 'Kota Lhoksukon',
                    'asal_kecamatan'  => 'Lhoksukon',
                    'asal_kabupaten'  => 'Aceh Utara',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112227',
                    'email'           => 'siti.aminah@gmail.com',
                    'asal_sekolah'    => 'MAS Babussalam Matangkuli',
                    'nama_ayah'       => 'Teungku Marwan',
                    'nama_ibu'        => 'Khatijah',
                    'pekerjaan_ayah'  => 'PNS Kemenag',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Jl. Medan-Banda Aceh KM 305 Lhoksukon, Aceh Utara',
                    'no_hp_ortu'      => '085261990027',
                    'nama_wali'       => 'Teungku Marwan',
                    'pekerjaan_wali'  => 'PNS Kemenag',
                    'alamat_wali'     => 'Jl. Medan-Banda Aceh KM 305 Lhoksukon, Aceh Utara',
                    'no_hp_wali'      => '085261990027',
                    'kelas_id'        => 9,
                    'tahun_masuk'     => 2023,
                    'status'          => 'aktif'
                ),

                // KELAS 10: MA'HAD ALY
                array(
                    'id'              => 28,
                    'no_induk'        => '2022001',
                    'nik'             => '1111010101050028',
                    'nama'            => 'Fathur Rahman',
                    'jenis_kelamin'   => 'L',
                    'tempat_lahir'    => 'Samalanga',
                    'tanggal_lahir'   => '2005-01-01',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 2,
                    'asal_gampong'    => 'Sangso',
                    'asal_kecamatan'  => 'Samalanga',
                    'asal_kabupaten'  => 'Bireuen',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putra Dayah Al-Ikhlas',
                    'no_hp'           => '082167112228',
                    'email'           => 'fathur.mahadaly@gmail.com',
                    'asal_sekolah'    => 'MAS Dayah Al-Ikhlas Samalanga',
                    'nama_ayah'       => 'Tgk. H. Syukri',
                    'nama_ibu'        => 'Hj. Maryati',
                    'pekerjaan_ayah'  => 'Tokoh Agama / Pimpinan Dayah',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Sangso, Samalanga, Bireuen',
                    'no_hp_ortu'      => '081260113328',
                    'nama_wali'       => 'Tgk. H. Syukri',
                    'pekerjaan_wali'  => 'Tokoh Agama / Pimpinan Dayah',
                    'alamat_wali'     => 'Gampong Sangso, Samalanga, Bireuen',
                    'no_hp_wali'      => '081260113328',
                    'kelas_id'        => 10,
                    'tahun_masuk'     => 2022,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 29,
                    'no_induk'        => '2022002',
                    'nik'             => '1104011804050029',
                    'nama'            => 'Tazkia Aulia',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Takengon',
                    'tanggal_lahir'   => '2005-04-18',
                    'anak_ke'         => 2,
                    'jumlah_saudara'  => 3,
                    'asal_gampong'    => 'Blang Kolak I',
                    'asal_kecamatan'  => 'Bebesen',
                    'asal_kabupaten'  => 'Aceh Tengah',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112229',
                    'email'           => 'tazkia.aulia@gmail.com',
                    'asal_sekolah'    => 'MAS Ruhul Islam Anak Bangsa',
                    'nama_ayah'       => 'Drs. Zulfikar, M.Pd',
                    'nama_ibu'        => 'Dra. Salmawati',
                    'pekerjaan_ayah'  => 'Dosen IAIN Takengon',
                    'pekerjaan_ibu'   => 'Guru MAN',
                    'alamat_ortu'     => 'Jl. Sengeda No. 40 Takengon, Aceh Tengah',
                    'no_hp_ortu'      => '081360224429',
                    'nama_wali'       => 'Drs. Zulfikar, M.Pd',
                    'pekerjaan_wali'  => 'Dosen IAIN Takengon',
                    'alamat_wali'     => 'Jl. Sengeda No. 40 Takengon, Aceh Tengah',
                    'no_hp_wali'      => '081360224429',
                    'kelas_id'        => 10,
                    'tahun_masuk'     => 2022,
                    'status'          => 'aktif'
                ),
                array(
                    'id'              => 30,
                    'no_induk'        => '2022003',
                    'nik'             => '1107010909050030',
                    'nama'            => 'Salwa Humaira',
                    'jenis_kelamin'   => 'P',
                    'tempat_lahir'    => 'Sigli',
                    'tanggal_lahir'   => '2005-09-09',
                    'anak_ke'         => 1,
                    'jumlah_saudara'  => 4,
                    'asal_gampong'    => 'Tijue',
                    'asal_kecamatan'  => 'Pidie',
                    'asal_kabupaten'  => 'Pidie',
                    'asal_provinsi'   => 'Aceh',
                    'alamat_domisili' => 'Komplek Asrama Putri Dayah Al-Ikhlas',
                    'no_hp'           => '082167112230',
                    'email'           => 'salwa.humaira@gmail.com',
                    'asal_sekolah'    => 'MAS Ulumul Quran Sigli',
                    'nama_ayah'       => 'Tgk. M. Daud Hasan',
                    'nama_ibu'        => 'Khadijah Basyah',
                    'pekerjaan_ayah'  => 'PNS Pengadilan Agama Sigli',
                    'pekerjaan_ibu'   => 'Ibu Rumah Tangga',
                    'alamat_ortu'     => 'Gampong Tijue, Kec. Pidie, Kab. Pidie',
                    'no_hp_ortu'      => '085270335530',
                    'nama_wali'       => 'Tgk. M. Daud Hasan',
                    'pekerjaan_wali'  => 'PNS Pengadilan Agama Sigli',
                    'alamat_wali'     => 'Gampong Tijue, Kec. Pidie, Kab. Pidie',
                    'no_hp_wali'      => '085270335530',
                    'kelas_id'        => 10,
                    'tahun_masuk'     => 2022,
                    'status'          => 'aktif'
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

            // Seed sample SPP payments if table pembayaran is empty
            if ($this->db->table_exists('pembayaran') && $this->db->count_all('pembayaran') == 0) {
                $current_year = (int) date('Y');
                $payments = array(
                    array(
                        'no_kuitansi'         => 'KW-SPP-001',
                        'santri_id'           => 1,
                        'jenis_pembayaran_id' => 1,
                        'tahun'               => $current_year,
                        'bulan'               => 1,
                        'tahap'               => 0,
                        'tanggal_bayar'       => date('Y-01-10'),
                        'jumlah'              => 350000.00,
                        'keterangan'          => 'SPP Bulanan Bulan Januari ' . $current_year,
                        'petugas_id'          => 1
                    ),
                    array(
                        'no_kuitansi'         => 'KW-SPP-002',
                        'santri_id'           => 2,
                        'jenis_pembayaran_id' => 1,
                        'tahun'               => $current_year,
                        'bulan'               => 1,
                        'tahap'               => 0,
                        'tanggal_bayar'       => date('Y-01-12'),
                        'jumlah'              => 350000.00,
                        'keterangan'          => 'SPP Bulanan Bulan Januari ' . $current_year,
                        'petugas_id'          => 1
                    ),
                    array(
                        'no_kuitansi'         => 'KW-SPP-003',
                        'santri_id'           => 3,
                        'jenis_pembayaran_id' => 1,
                        'tahun'               => $current_year,
                        'bulan'               => 1,
                        'tahap'               => 0,
                        'tanggal_bayar'       => date('Y-01-15'),
                        'jumlah'              => 350000.00,
                        'keterangan'          => 'SPP Bulanan Bulan Januari ' . $current_year,
                        'petugas_id'          => 1
                    ),
                    array(
                        'no_kuitansi'         => 'KW-SPP-004',
                        'santri_id'           => 4,
                        'jenis_pembayaran_id' => 1,
                        'tahun'               => $current_year,
                        'bulan'               => 1,
                        'tahap'               => 0,
                        'tanggal_bayar'       => date('Y-01-18'),
                        'jumlah'              => 350000.00,
                        'keterangan'          => 'SPP Bulanan Bulan Januari ' . $current_year,
                        'petugas_id'          => 1
                    ),
                    array(
                        'no_kuitansi'         => 'KW-SPP-005',
                        'santri_id'           => 1,
                        'jenis_pembayaran_id' => 1,
                        'tahun'               => $current_year,
                        'bulan'               => (int) date('m'),
                        'tahap'               => 0,
                        'tanggal_bayar'       => date('Y-m-d'),
                        'jumlah'              => 350000.00,
                        'keterangan'          => 'SPP Bulanan Bulan Berjalan',
                        'petugas_id'          => 1
                    ),
                    array(
                        'no_kuitansi'         => 'KW-SPP-006',
                        'santri_id'           => 2,
                        'jenis_pembayaran_id' => 1,
                        'tahun'               => $current_year,
                        'bulan'               => (int) date('m'),
                        'tahap'               => 0,
                        'tanggal_bayar'       => date('Y-m-d'),
                        'jumlah'              => 350000.00,
                        'keterangan'          => 'SPP Bulanan Bulan Berjalan',
                        'petugas_id'          => 1
                    )
                );
                foreach ($payments as $p) {
                    $this->db->insert('pembayaran', $p);
                }
            }
        }

        $this->db->db_debug = $prev_debug;
    }

    public function get_all($filter = array(), $limit = null, $offset = null) {
        $this->db->select('s.*, k.nama_kelas, j.nama as nama_jenjang, j.id as jenjang_id');
        $this->db->from('santri s');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');

        if (!empty($filter['status'])) {
            $this->db->where('s.status', $filter['status']);
        }
        if (!empty($filter['kelas_id'])) {
            $this->db->where('s.kelas_id', $filter['kelas_id']);
        }
        if (!empty($filter['jenjang_id'])) {
            $this->db->where('k.jenjang_id', $filter['jenjang_id']);
        }
        if (!empty($filter['jenis_kelamin'])) {
            $this->db->where('s.jenis_kelamin', $filter['jenis_kelamin']);
        }
        if (!empty($filter['tahun_masuk'])) {
            $this->db->where('s.tahun_masuk', $filter['tahun_masuk']);
        }
        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('s.nama', $filter['keyword']);
            $this->db->or_like('s.no_induk', $filter['keyword']);
            $this->db->or_like('s.nik', $filter['keyword']);
            $this->db->or_like('s.asal_kabupaten', $filter['keyword']);
            $this->db->or_like('s.asal_gampong', $filter['keyword']);
            $this->db->group_end();
        }

        $this->db->order_by('s.nama', 'ASC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }

    public function count_all($filter = array()) {
        $this->db->from('santri s');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        if (!empty($filter['status'])) {
            $this->db->where('s.status', $filter['status']);
        }
        if (!empty($filter['kelas_id'])) {
            $this->db->where('s.kelas_id', $filter['kelas_id']);
        }
        if (!empty($filter['jenjang_id'])) {
            $this->db->where('k.jenjang_id', $filter['jenjang_id']);
        }
        if (!empty($filter['jenis_kelamin'])) {
            $this->db->where('s.jenis_kelamin', $filter['jenis_kelamin']);
        }
        if (!empty($filter['keyword'])) {
            $this->db->group_start();
            $this->db->like('s.nama', $filter['keyword']);
            $this->db->or_like('s.no_induk', $filter['keyword']);
            $this->db->or_like('s.nik', $filter['keyword']);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->select('s.*, k.nama_kelas, j.nama as nama_jenjang, j.id as jenjang_id, g.nama as nama_wali_kelas');
        $this->db->from('santri s');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');
        $this->db->join('guru g', 'g.id = k.wali_kelas_id', 'left');
        $this->db->where('s.id', $id);
        return $this->db->get()->row();
    }

    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        // 1. Unlink from pendaftaran if registered
        $this->db->where('santri_id', $id)->update('pendaftaran', array('santri_id' => null));

        // 2. Unlink from users (e.g. wali account)
        $this->db->where('santri_id', $id)->update('users', array('santri_id' => null));

        // 3. Delete payments record
        $this->db->where('santri_id', $id)->delete('pembayaran');

        // 4. Delete photo if exists and not used in berkas_pendaftaran
        $santri = $this->db->get_where($this->table, array('id' => $id))->row();
        if ($santri && !empty($santri->foto)) {
            $is_used_in_berkas = $this->db->where('nama_file', $santri->foto)->count_all_results('berkas_pendaftaran') > 0;
            if (!$is_used_in_berkas) {
                $foto_path = FCPATH . 'uploads/berkas/' . $santri->foto;
                if (file_exists($foto_path)) {
                    @unlink($foto_path);
                }
            }
        }

        // 5. Delete santri record
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Batch promotion / class move
     */
    public function kenaikan_kelas_massal($santri_ids, $kelas_tujuan_id, $status = null) {
        if (empty($santri_ids)) {
            return false;
        }

        $data = array('kelas_id' => $kelas_tujuan_id ?: null);
        if ($status) {
            $data['status'] = $status;
        }

        $this->db->where_in('id', $santri_ids);
        return $this->db->update($this->table, $data);
    }

    /**
     * Data formatted according to Dinas Pendidikan Dayah specification
     */
    public function get_santri_dinas_export($filter = array()) {
        $this->db->select('s.*, k.nama_kelas, j.nama as nama_jenjang');
        $this->db->from('santri s');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');
        if (!empty($filter['status'])) {
            $this->db->where('s.status', $filter['status']);
        } else {
            $this->db->where('s.status', 'aktif');
        }
        if (!empty($filter['kelas_id'])) {
            $this->db->where('s.kelas_id', $filter['kelas_id']);
        }
        $this->db->order_by('k.nama_kelas', 'ASC');
        $this->db->order_by('s.nama', 'ASC');
        return $this->db->get()->result();
    }

    public function generate_nis($tahun = null) {
        $tahun = $tahun ?: date('Y');
        $prefix = $tahun;

        $this->db->like('no_induk', $prefix, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get($this->table)->row();

        if ($last && !empty($last->no_induk)) {
            $last_num = (int) substr($last->no_induk, strlen($prefix));
            $next_num = $last_num + 1;
        } else {
            $next_num = 1;
        }

        return $prefix . str_pad($next_num, 3, '0', STR_PAD_LEFT);
    }
}
