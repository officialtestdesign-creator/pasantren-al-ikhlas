<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Application Controller
 * Handles global variables, common models, and access control
 */
class MY_Controller extends CI_Controller {

    public $profil;
    public $tahun_ajaran_aktif;

    public function __construct() {
        parent::__construct();

        // Self-heal missing database views and auto-increment schemas if needed
        $this->ensure_database_schema();

        // Auto-load essential models
        $this->load->model('User_model');
        $this->load->model('Profil_model');
        $this->load->model('Akademik_model');
        $this->load->model('Guru_model');
        $this->load->model('Santri_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Pembayaran_model');

        // Load Profil Dayah & Active School Year
        $this->profil = $this->Profil_model->get_profil();
        $this->tahun_ajaran_aktif = $this->Profil_model->get_tahun_ajaran_aktif();
    }

    /**
     * Ensure database views and auto-increment properties are created if missing
     */
    private function ensure_database_schema() {
        static $checked = false;
        if ($checked) {
            return;
        }
        $checked = true;

        $prev_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        // Auto-seed database on initial cloud/Railway deployment if tables do not exist yet
        $check_users = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        if ($check_users === FALSE) {
            $sql_file = FCPATH . 'db/db_dayah_alikhlas.sql';
            if (file_exists($sql_file)) {
                $lines = file($sql_file);
                $statement = '';
                $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
                foreach ($lines as $line) {
                    $trimmed = trim($line);
                    if ($trimmed === '' || strpos($trimmed, '--') === 0 || strpos($trimmed, '/*') === 0 || strpos($trimmed, '#') === 0) {
                        continue;
                    }
                    $statement .= ' ' . $line;
                    if (substr($trimmed, -1) === ';') {
                        $this->db->query($statement);
                        $statement = '';
                    }
                }
                $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
            }
        }

        $check = $this->db->query("SELECT 1 FROM `v_jumlah_santri_per_kelas` LIMIT 1");
        if ($check === FALSE) {
            $this->db->query("DROP VIEW IF EXISTS `v_jumlah_santri_per_kelas`");
            $this->db->query("DROP TABLE IF EXISTS `v_jumlah_santri_per_kelas`");
            $this->db->query("CREATE VIEW `v_jumlah_santri_per_kelas` AS 
                SELECT `j`.`nama` AS `jenjang`, `k`.`nama_kelas` AS `nama_kelas`, `ta`.`nama` AS `tahun_ajaran`, 
                       sum((`s`.`jenis_kelamin` = 'L')) AS `laki_laki`, 
                       sum((`s`.`jenis_kelamin` = 'P')) AS `perempuan`, 
                       count(`s`.`id`) AS `jumlah` 
                FROM (((`kelas` `k` 
                  JOIN `jenjang` `j` ON ((`j`.`id` = `k`.`jenjang_id`))) 
                  JOIN `tahun_ajaran` `ta` ON ((`ta`.`id` = `k`.`tahun_ajaran_id`))) 
                  LEFT JOIN `santri` `s` ON (((`s`.`kelas_id` = `k`.`id`) AND (`s`.`status` = 'aktif')))) 
                GROUP BY `k`.`id`, `j`.`nama`, `k`.`nama_kelas`, `ta`.`nama`");

            $this->db->query("DROP VIEW IF EXISTS `v_spp_santri`");
            $this->db->query("DROP TABLE IF EXISTS `v_spp_santri`");
            $this->db->query("CREATE VIEW `v_spp_santri` AS 
                SELECT `s`.`id` AS `santri_id`, `s`.`no_induk` AS `no_induk`, `s`.`nama` AS `nama`, 
                       `p`.`tahun` AS `tahun`, `p`.`bulan` AS `bulan`, `p`.`tanggal_bayar` AS `tanggal_bayar`, 
                       `p`.`jumlah` AS `jumlah`, `p`.`keterangan` AS `keterangan` 
                FROM ((`pembayaran` `p` 
                  JOIN `santri` `s` ON ((`s`.`id` = `p`.`santri_id`))) 
                  JOIN `jenis_pembayaran` `jp` ON ((`jp`.`id` = `p`.`jenis_pembayaran_id`))) 
                WHERE (`jp`.`periode` = 'bulanan')");

            $tables = array(
                'berita', 'berkas_pendaftaran', 'bidang_studi', 'fasilitas', 'galeri', 
                'guru', 'jadwal_belajar', 'jadwal_kegiatan', 'jenis_pembayaran', 'jenjang', 
                'kelas', 'kurikulum', 'pembayaran', 'pendaftaran', 'peraturan', 'santri', 
                'tahun_ajaran', 'users'
            );
            foreach ($tables as $t) {
                $this->db->where('id', 0)->delete($t);
                $this->db->query("ALTER TABLE `{$t}` MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT");
            }
        }

        $this->db->db_debug = $prev_debug;
    }

    /**
     * Render view with backend dashboard layout
     */
    protected function render_admin($view, $data = array()) {
        $data['profil'] = $this->profil;
        $data['tahun_ajaran_aktif'] = $this->tahun_ajaran_aktif;
        $data['user_login'] = user_data();
        $data['content_view'] = $view;
        $this->load->view('layouts/backend_master', $data);
    }

    /**
     * Render view with public layout
     */
    protected function render_public($view, $data = array()) {
        $data['profil'] = $this->profil;
        $data['tahun_ajaran_aktif'] = $this->tahun_ajaran_aktif;
        $data['content_view'] = $view;
        $this->load->view('layouts/public_master', $data);
    }
}

/**
 * Controller for Admin Role
 */
class Admin_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        check_role(array('admin'));
    }
}

/**
 * Controller for Bendahara Role (also accessible by Admin)
 */
class Bendahara_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        check_role(array('admin', 'bendahara'));
    }
}

/**
 * Controller for Pimpinan Role (also accessible by Admin)
 */
class Pimpinan_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        check_role(array('admin', 'pimpinan'));
    }
}

/**
 * Controller for Public Views
 */
class Public_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
}
