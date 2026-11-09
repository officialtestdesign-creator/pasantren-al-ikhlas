<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dayah Helper Functions
 * LPI Dayah Al-Ikhlas Al-Aziziyah
 */

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        $ci =& get_instance();
        return (bool) $ci->session->userdata('logged_in');
    }
}

if (!function_exists('user_id')) {
    function user_id() {
        $ci =& get_instance();
        return $ci->session->userdata('user_id');
    }
}

if (!function_exists('user_name')) {
    function user_name() {
        $ci =& get_instance();
        return $ci->session->userdata('nama') ?: 'Pengguna';
    }
}

if (!function_exists('user_role')) {
    function user_role() {
        $ci =& get_instance();
        return $ci->session->userdata('role');
    }
}

if (!function_exists('user_data')) {
    function user_data($key = null) {
        $ci =& get_instance();
        if ($key) {
            return $ci->session->userdata($key);
        }
        return array(
            'id' => $ci->session->userdata('user_id'),
            'nama' => $ci->session->userdata('nama'),
            'username' => $ci->session->userdata('username'),
            'role' => $ci->session->userdata('role'),
        );
    }
}

if (!function_exists('check_role')) {
    function check_role($allowed_roles = array()) {
        $ci =& get_instance();
        if (!is_logged_in()) {
            set_alert('danger', 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.');
            redirect('login');
            exit;
        }

        if (is_string($allowed_roles)) {
            $allowed_roles = array($allowed_roles);
        }

        $current_role = user_role();
        if (!empty($allowed_roles) && !in_array($current_role, $allowed_roles)) {
            set_alert('warning', 'Anda tidak memiliki hak akses untuk halaman tersebut.');
            // Redirect based on current role
            if ($current_role === 'admin') {
                redirect('admin');
            } elseif ($current_role === 'bendahara') {
                redirect('bendahara');
            } elseif ($current_role === 'pimpinan') {
                redirect('pimpinan');
            } else {
                redirect('login');
            }
            exit;
        }
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($angka) {
        return 'Rp ' . number_format((float)$angka, 0, ',', '.');
    }
}

if (!function_exists('nama_bulan')) {
    function nama_bulan($bulan) {
        $bulan = (int) $bulan;
        $daftar_bulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );
        return isset($daftar_bulan[$bulan]) ? $daftar_bulan[$bulan] : '';
    }
}

if (!function_exists('format_tanggal_indo')) {
    function format_tanggal_indo($tanggal, $cetak_hari = false) {
        if (!$tanggal || $tanggal == '0000-00-00' || $tanggal == '0000-00-00 00:00:00') {
            return '-';
        }

        $hari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        );

        $time = strtotime($tanggal);
        $tgl = date('d', $time);
        $bln = nama_bulan(date('m', $time));
        $thn = date('Y', $time);

        $hasil = "$tgl $bln $thn";
        if ($cetak_hari) {
            $nama_hari = $hari[date('l', $time)];
            $hasil = "$nama_hari, $hasil";
        }
        return $hasil;
    }
}

if (!function_exists('set_alert')) {
    function set_alert($type, $message) {
        $ci =& get_instance();
        $ci->session->set_flashdata('alert_type', $type);
        $ci->session->set_flashdata('alert_message', $message);
    }
}

if (!function_exists('get_alert')) {
    function get_alert() {
        $ci =& get_instance();
        $type = $ci->session->flashdata('alert_type');
        $message = $ci->session->flashdata('alert_message');

        if ($type && $message) {
            $is_delete = (stripos($message, 'hapus') !== false || stripos($message, 'dihapus') !== false);
            
            $bg_class = 'bg-success bg-opacity-10 border-success border-opacity-25 text-success-emphasis';
            $icon_bg = 'bg-success text-white';
            $icon = 'bi-check-circle-fill';
            $title = 'Berhasil!';

            if ($is_delete) {
                $bg_class = 'bg-danger bg-opacity-10 border-danger border-opacity-25 text-danger-emphasis';
                $icon_bg = 'bg-danger text-white';
                $icon = 'bi-trash-fill';
                $title = 'Data Berhasil Dihapus!';
            } elseif ($type === 'danger') {
                $bg_class = 'bg-danger bg-opacity-10 border-danger border-opacity-25 text-danger-emphasis';
                $icon_bg = 'bg-danger text-white';
                $icon = 'bi-exclamation-octagon-fill';
                $title = 'Terjadi Kesalahan!';
            } elseif ($type === 'warning') {
                $bg_class = 'bg-warning bg-opacity-10 border-warning border-opacity-25 text-warning-emphasis';
                $icon_bg = 'bg-warning text-dark';
                $icon = 'bi-exclamation-triangle-fill';
                $title = 'Peringatan!';
            } elseif ($type === 'info') {
                $bg_class = 'bg-info bg-opacity-10 border-info border-opacity-25 text-info-emphasis';
                $icon_bg = 'bg-info text-white';
                $icon = 'bi-info-circle-fill';
                $title = 'Informasi Sistem';
            }

            return '<div class="alert ' . $bg_class . ' alert-dismissible fade show d-flex align-items-center shadow-sm rounded-4 py-3 px-4 mb-4 border" role="alert" style="backdrop-filter: blur(8px);">
                <div class="' . $icon_bg . ' rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0 shadow-sm" style="width: 42px; height: 42px; font-size: 1.25rem;">
                    <i class="bi ' . $icon . '"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-bold mb-0.5" style="font-size: 0.95rem;">' . $title . '</div>
                    <div class="small opacity-90">' . $message . '</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        return '';
    }
}

if (!function_exists('clean_string')) {
    function clean_string($str) {
        return htmlspecialchars(trim($str ?? ''), ENT_QUOTES, 'UTF-8');
    }
}
