<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Uploads
 * Mengamankan dan melayani file unggahan (berkas pendaftaran, foto santri/guru)
 * Menangani kasus ketika file diakses langsung atau melalui mod_rewrite Apache
 */
class Uploads extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load helpers if needed
        $this->load->helper('url');
    }

    /**
     * Layani berkas dari direktori uploads/berkas/
     */
    public function berkas($filename = '') {
        $filename = urldecode($filename);
        $filename = basename($filename); // Keamanan: cegah directory traversal

        $file_path = FCPATH . 'uploads/berkas/' . $filename;

        // Jika nama file kosong atau file fisik tidak ada di server
        if (empty($filename) || !file_exists($file_path)) {
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            // Jika yang diminta adalah file gambar, sajikan placeholder SVG bersih
            if (in_array($ext, array('jpg', 'jpeg', 'png', 'webp', 'gif'))) {
                header('Content-Type: image/svg+xml');
                header('Cache-Control: no-cache, must-revalidate');
                echo '<?xml version="1.0" encoding="UTF-8"?>
                <svg xmlns="http://www.w3.org/2000/svg" width="300" height="360" viewBox="0 0 300 360">
                    <rect width="100%" height="100%" fill="#f8fafc"/>
                    <rect x="10" y="10" width="280" height="340" rx="12" fill="#ffffff" stroke="#e2e8f0" stroke-width="2"/>
                    <circle cx="150" cy="140" r="55" fill="#e2e8f0"/>
                    <path d="M75 270 C75 200, 225 200, 225 270 Z" fill="#e2e8f0"/>
                    <text x="150" y="305" font-family="-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif" font-size="13" font-weight="bold" fill="#64748b" text-anchor="middle">Berkas Foto</text>
                    <text x="150" y="325" font-family="-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif" font-size="11" fill="#94a3b8" text-anchor="middle">Belum diunggah / Belum tersedia</text>
                </svg>';
                exit;
            }

            // Jika PDF atau dokumen lain tidak ditemukan
            $this->output->set_status_header(404);
            $data['heading'] = 'Berkas Tidak Ditemukan (404)';
            $data['message'] = 'File berkas lampiran yang Anda minta ("' . html_escape($filename) . '") belum diunggah atau tidak ditemukan di penyimpanan server dayah.';
            $this->load->view('errors/html/error_404', $data);
            return;
        }

        // Tentukan Content-Type sesuai ekstensi
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $mimes = array(
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'pdf'  => 'application/pdf',
            'svg'  => 'image/svg+xml'
        );

        $content_type = isset($mimes[$ext]) ? $mimes[$ext] : (function_exists('mime_content_type') ? mime_content_type($file_path) : 'application/octet-stream');

        // Bersihkan output buffer sebelum kirim file
        if (ob_get_level() > 0) {
            ob_end_clean();
        }

        // Kirim header HTTP
        header('Content-Type: ' . $content_type);
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Cache-Control: public, max-age=86400');
        header('Pragma: public');

        // Streaming isi file
        readfile($file_path);
        exit;
    }

    /**
     * Layani foto dari direktori uploads/fasilitas/
     */
    public function fasilitas($filename = '') {
        $filename = urldecode($filename);
        $filename = basename($filename);

        $file_path = FCPATH . 'uploads/fasilitas/' . $filename;

        if (empty($filename) || !file_exists($file_path)) {
            // Fallback ke foto default gedung
            $default_img = FCPATH . 'img/gedung_asrama_baru.jpeg';
            if (file_exists($default_img)) {
                header('Content-Type: image/jpeg');
                readfile($default_img);
                exit;
            }
            show_404();
            return;
        }

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $mimes = array(
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'webp' => 'image/webp'
        );

        $content_type = isset($mimes[$ext]) ? $mimes[$ext] : (function_exists('mime_content_type') ? mime_content_type($file_path) : 'image/jpeg');

        if (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: ' . $content_type);
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Cache-Control: public, max-age=86400');

        readfile($file_path);
        exit;
    }
}

