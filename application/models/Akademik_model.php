<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akademik_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->seed_if_empty();
    }

    /**
     * Auto-seed default classes, daily schedule, and curriculum if empty
     */
    private function seed_if_empty() {
        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Clean up any stray row with id = 0 if auto_increment was previously missing
        $check_kelas = $this->db->query("SELECT 1 FROM `kelas` LIMIT 1");
        if ($check_kelas !== FALSE) {
            $this->db->where('id', 0)->delete('kelas');
            $this->db->query("ALTER TABLE `kelas` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");

            // Seed default classes if none
            $count = $this->db->count_all('kelas');
            if ($count === 0 || $count === '0') {
                $default_ta = $this->db->get_where('tahun_ajaran', array('aktif' => 1))->row();
                $ta_id = $default_ta ? $default_ta->id : 1;

                $default_kelas = array(
                    array('id' => 1, 'jenjang_id' => 1, 'nama_kelas' => 'Tajhizi A', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 2, 'jenjang_id' => 1, 'nama_kelas' => 'Tajhizi B', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 3, 'jenjang_id' => 2, 'nama_kelas' => 'Ula 1 A', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 4, 'jenjang_id' => 2, 'nama_kelas' => 'Ula 1 B', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 5, 'jenjang_id' => 2, 'nama_kelas' => 'Ula 2', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 6, 'jenjang_id' => 3, 'nama_kelas' => 'Wustha 1', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 7, 'jenjang_id' => 3, 'nama_kelas' => 'Wustha 2', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 8, 'jenjang_id' => 4, 'nama_kelas' => 'Ulya 1', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 9, 'jenjang_id' => 4, 'nama_kelas' => 'Ulya 2', 'tahun_ajaran_id' => $ta_id),
                    array('id' => 10, 'jenjang_id' => 5, 'nama_kelas' => 'Ma\'had Aly', 'tahun_ajaran_id' => $ta_id),
                );
                $this->db->insert_batch('kelas', $default_kelas);
            }
        }

        // Seed default daily schedule if none
        $check_jadwal = $this->db->query("SELECT 1 FROM `jadwal_kegiatan` LIMIT 1");
        if ($check_jadwal !== FALSE) {
            $this->db->where('id', 0)->delete('jadwal_kegiatan');
            $this->db->query("ALTER TABLE `jadwal_kegiatan` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");
            $count_jadwal = $this->db->count_all('jadwal_kegiatan');
            if ($count_jadwal === 0 || $count_jadwal === '0') {
            $default_jadwal = array(
                array('id' => 1, 'jam_mulai' => '04:30:00', 'jam_selesai' => '05:30:00', 'kegiatan' => 'Shalat Subuh Berjamaah & Wirid', 'keterangan' => 'Musalla Utama Dayah', 'urutan' => 1),
                array('id' => 2, 'jam_mulai' => '05:30:00', 'jam_selesai' => '06:30:00', 'kegiatan' => 'Halaqah Tahfizh & Pengajian Pagi', 'keterangan' => 'Pengajian kitab kuning dasar bersama Teungku', 'urutan' => 2),
                array('id' => 3, 'jam_mulai' => '06:30:00', 'jam_selesai' => '07:30:00', 'kegiatan' => 'Makan Pagi & Persiapan Masuk Kelas', 'keterangan' => 'Dapur & Asrama Santri', 'urutan' => 3),
                array('id' => 4, 'jam_mulai' => '07:45:00', 'jam_selesai' => '12:00:00', 'kegiatan' => 'Belajar Mengajar Klasikal (Sesi Pagi)', 'keterangan' => 'Ruang Kelas Sesuai Jenjang (Kitab Kuning)', 'urutan' => 4),
                array('id' => 5, 'jam_mulai' => '12:30:00', 'jam_selesai' => '13:30:00', 'kegiatan' => 'Shalat Dzuhur Berjamaah & Makan Siang', 'keterangan' => 'Musalla & Ruang Makan', 'urutan' => 5),
                array('id' => 6, 'jam_mulai' => '13:30:00', 'jam_selesai' => '15:30:00', 'kegiatan' => 'Qoilulah (Istirahat Siang) & Belajar Mandiri', 'keterangan' => 'Asrama Dayah', 'urutan' => 6),
                array('id' => 7, 'jam_mulai' => '16:00:00', 'jam_selesai' => '17:30:00', 'kegiatan' => 'Shalat Ashar & Pengajian Sore', 'keterangan' => 'Kajian Nahwu & Saraf', 'urutan' => 7),
                array('id' => 8, 'jam_mulai' => '18:30:00', 'jam_selesai' => '20:00:00', 'kegiatan' => 'Shalat Maghrib, Ratib Haddad & Tadarus Al-Qur\'an', 'keterangan' => 'Musalla Utama', 'urutan' => 8),
                array('id' => 9, 'jam_mulai' => '20:00:00', 'jam_selesai' => '22:00:00', 'kegiatan' => 'Shalat Isya & Mudzakarah Kitab Malam', 'keterangan' => 'Diskusi & Bahtsul Masail antarsantri', 'urutan' => 9),
                array('id' => 10, 'jam_mulai' => '22:30:00', 'jam_selesai' => '04:00:00', 'kegiatan' => 'Istirahat Tidur Malam', 'keterangan' => 'Lampu asrama dipadamkan', 'urutan' => 10),
            );
            $this->db->insert_batch('jadwal_kegiatan', $default_jadwal);
            }
        }

        // Seed default peraturan dayah if none
        $this->db->where('id', 0)->delete('peraturan');
        $this->db->query("ALTER TABLE `peraturan` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");
        if ($this->db->count_all('peraturan') == 0) {
            $default_peraturan = array(
                array('id' => 1, 'bidang' => 'Pendidikan', 'urutan' => 1, 'isi' => 'Santri wajib mengikuti seluruh kegiatan pengajian dan halaqah kitab kuning tepat waktu.'),
                array('id' => 2, 'bidang' => 'Pendidikan', 'urutan' => 2, 'isi' => 'Santri wajib memiliki dan menjaga kitab pegangan sesuai jenjang kelas masing-masing.'),
                array('id' => 3, 'bidang' => 'Pendidikan', 'urutan' => 3, 'isi' => 'Santri wajib menggunakan bahasa resmi dayah (Arab/Melayu/Aceh yang beradab) di lingkungan pengajian.'),
                array('id' => 4, 'bidang' => 'Jamaah', 'urutan' => 1, 'isi' => 'Seluruh santri wajib melaksanakan shalat lima waktu secara berjamaah di Musalla Utama.'),
                array('id' => 5, 'bidang' => 'Jamaah', 'urutan' => 2, 'isi' => 'Wajib memakai pakaian putih bersih dan peci/kopiah saat shalat berjamaah.'),
                array('id' => 6, 'bidang' => 'Humas', 'urutan' => 1, 'isi' => 'Wali santri hanya diperkenankan menjenguk pada hari libur (Jumat/Ahad) sesuai jadwal kunjung resmi.'),
                array('id' => 7, 'bidang' => 'Humas', 'urutan' => 2, 'isi' => 'Santri dilarang membawa dan menggunakan telepon genggam (HP/smartphone) tanpa izin Pimpinan.'),
                array('id' => 8, 'bidang' => 'Naker', 'urutan' => 1, 'isi' => 'Santri wajib menjaga kebersihan bilik/kamar asrama dan lingkungan komplek dayah (roan pagi Jumat).'),
                array('id' => 9, 'bidang' => 'Naker', 'urutan' => 2, 'isi' => 'Santri wajib mematuhi jam malam dan dilarang keluar komplek dayah tanpa surat izin resmi teungku pengasuh.')
            );
            $this->db->insert_batch('peraturan', $default_peraturan);
        }

        // Seed default fasilitas if none
        $this->db->where('id', 0)->delete('fasilitas');
        $this->db->query("ALTER TABLE `fasilitas` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");
        if ($this->db->count_all('fasilitas') == 0) {
            $default_fasilitas = array(
                array('id' => 1, 'nama' => 'Musalla Utama Dayah', 'deskripsi' => 'Tempat shalat berjamaah 5 waktu, pengajian akbar, wirid harian, dan kajian umum pimpinan dayah.', 'urutan' => 1),
                array('id' => 2, 'nama' => 'Bilik / Asrama Santri', 'deskripsi' => 'Komplek pemondokan santri berlantai kayu yang sejuk, bersih, dan menanamkan ukhuwah islamiyah.', 'urutan' => 2),
                array('id' => 3, 'nama' => 'Ruang Kelas Klasikal', 'deskripsi' => 'Ruang belajar pengkajian kitab kuning per jenjang dengan meja halaqah dan papan tulis.', 'urutan' => 3),
                array('id' => 4, 'nama' => 'Perpustakaan & Maktabah Kitab', 'deskripsi' => 'Koleksi ratusan judul kitab turats, kamus bahasa Arab, tafsir, hadits, dan kitab fiqih mu\'tamad.', 'urutan' => 4),
                array('id' => 5, 'nama' => 'Dapur & Ruang Makan', 'deskripsi' => 'Fasilitas memasak higienis penyedia konsumsi harian santri 3 kali sehari.', 'urutan' => 5),
                array('id' => 6, 'nama' => 'Pos Kesehatan Santri (Poskestren)', 'deskripsi' => 'Pelayanan pertolongan pertama dan pemeriksaan kesehatan dasar santri.', 'urutan' => 6),
            );
            $this->db->insert_batch('fasilitas', $default_fasilitas);
        }

        $this->db->db_debug = $prev_debug;
    }

    // ==========================================
    // JENJANG METHODS
    // ==========================================
    public function get_jenjang_all() {
        return $this->db->order_by('urutan', 'ASC')->get('jenjang')->result();
    }

    public function get_jenjang($id) {
        return $this->db->get_where('jenjang', array('id' => $id))->row();
    }

    public function insert_jenjang($data) {
        return $this->db->insert('jenjang', $data);
    }

    public function update_jenjang($id, $data) {
        return $this->db->where('id', $id)->update('jenjang', $data);
    }

    public function delete_jenjang($id) {
        return $this->db->where('id', $id)->delete('jenjang');
    }

    // ==========================================
    // KELAS METHODS
    // ==========================================
    public function get_kelas_all($ta_id = null) {
        $this->db->select('k.*, j.nama as nama_jenjang, ta.nama as nama_ta, g.nama as nama_wali, 
            (SELECT COUNT(s.id) FROM santri s WHERE s.kelas_id = k.id AND s.status = "aktif") as total_santri,
            (SELECT COUNT(s.id) FROM santri s WHERE s.kelas_id = k.id AND s.status = "aktif" AND s.jenis_kelamin = "L") as total_putra,
            (SELECT COUNT(s.id) FROM santri s WHERE s.kelas_id = k.id AND s.status = "aktif" AND s.jenis_kelamin = "P") as total_putri');
        $this->db->from('kelas k');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');
        $this->db->join('tahun_ajaran ta', 'ta.id = k.tahun_ajaran_id', 'left');
        $this->db->join('guru g', 'g.id = k.wali_kelas_id', 'left');
        if ($ta_id) {
            $this->db->where('k.tahun_ajaran_id', $ta_id);
        }
        $this->db->order_by('j.urutan', 'ASC');
        $this->db->order_by('k.nama_kelas', 'ASC');
        return $this->db->get()->result();
    }

    public function get_kelas($id) {
        $this->db->select('k.*, j.nama as nama_jenjang, g.nama as nama_wali');
        $this->db->from('kelas k');
        $this->db->join('jenjang j', 'j.id = k.jenjang_id', 'left');
        $this->db->join('guru g', 'g.id = k.wali_kelas_id', 'left');
        $this->db->where('k.id', $id);
        return $this->db->get()->row();
    }

    public function insert_kelas($data) {
        return $this->db->insert('kelas', $data);
    }

    public function update_kelas($id, $data) {
        return $this->db->where('id', $id)->update('kelas', $data);
    }

    public function delete_kelas($id) {
        return $this->db->where('id', $id)->delete('kelas');
    }

    public function get_santri_by_kelas($kelas_id) {
        return $this->db->where('kelas_id', $kelas_id)
            ->where('status', 'aktif')
            ->order_by('nama', 'ASC')
            ->get('santri')->result();
    }

    // ==========================================
    // BIDANG STUDI (KITAB KUNING) METHODS
    // ==========================================
    public function get_bidang_studi_all() {
        return $this->db->order_by('urutan', 'ASC')->order_by('nama', 'ASC')->get('bidang_studi')->result();
    }

    public function get_bidang_studi($id) {
        return $this->db->get_where('bidang_studi', array('id' => $id))->row();
    }

    public function insert_bidang_studi($data) {
        return $this->db->insert('bidang_studi', $data);
    }

    public function update_bidang_studi($id, $data) {
        return $this->db->where('id', $id)->update('bidang_studi', $data);
    }

    public function delete_bidang_studi($id) {
        return $this->db->where('id', $id)->delete('bidang_studi');
    }

    // ==========================================
    // KURIKULUM (PEMETAAN KITAB - KELAS - GURU)
    // ==========================================
    public function get_kurikulum_by_kelas($kelas_id) {
        $this->db->select('kur.*, bs.nama as nama_bidang_studi, g.nama as nama_guru');
        $this->db->from('kurikulum kur');
        $this->db->join('bidang_studi bs', 'bs.id = kur.bidang_studi_id', 'left');
        $this->db->join('guru g', 'g.id = kur.guru_id', 'left');
        $this->db->where('kur.kelas_id', $kelas_id);
        $this->db->order_by('bs.urutan', 'ASC');
        return $this->db->get()->result();
    }

    public function insert_kurikulum($data) {
        return $this->db->insert('kurikulum', $data);
    }

    public function delete_kurikulum($id) {
        return $this->db->where('id', $id)->delete('kurikulum');
    }

    // ==========================================
    // JADWAL KEGIATAN HARIAN
    // ==========================================
    public function get_jadwal_kegiatan_all() {
        return $this->db->order_by('urutan', 'ASC')->order_by('jam_mulai', 'ASC')->get('jadwal_kegiatan')->result();
    }

    public function insert_jadwal_kegiatan($data) {
        return $this->db->insert('jadwal_kegiatan', $data);
    }

    public function update_jadwal_kegiatan($id, $data) {
        return $this->db->where('id', $id)->update('jadwal_kegiatan', $data);
    }

    public function delete_jadwal_kegiatan($id) {
        return $this->db->where('id', $id)->delete('jadwal_kegiatan');
    }

    // ==========================================
    // JADWAL BELAJAR PER KELAS
    // ==========================================
    public function get_jadwal_belajar($kelas_id, $hari = null) {
        $this->db->select('jb.*, bs.nama as nama_bidang_studi, g.nama as nama_guru');
        $this->db->from('jadwal_belajar jb');
        $this->db->join('bidang_studi bs', 'bs.id = jb.bidang_studi_id', 'left');
        $this->db->join('guru g', 'g.id = jb.guru_id', 'left');
        $this->db->where('jb.kelas_id', $kelas_id);
        if ($hari) {
            $this->db->where('jb.hari', $hari);
        }
        $this->db->order_by('FIELD(jb.hari, "Sabtu", "Ahad", "Senin", "Selasa", "Rabu", "Kamis", "Jumat")', '', FALSE);
        $this->db->order_by('jb.jam_mulai', 'ASC');
        return $this->db->get()->result();
    }

    public function insert_jadwal_belajar($data) {
        return $this->db->insert('jadwal_belajar', $data);
    }

    public function delete_jadwal_belajar($id) {
        return $this->db->where('id', $id)->delete('jadwal_belajar');
    }
}
