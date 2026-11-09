<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'beranda';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['auth'] = 'auth/login';

// Role Dashboard shortcuts
$route['admin'] = 'admin/dashboard';
$route['bendahara'] = 'bendahara/dashboard';
$route['pimpinan'] = 'pimpinan/dashboard';

// Pendaftaran Santri Baru Online
$route['pendaftaran'] = 'pendaftaran';
$route['pendaftaran/simpan'] = 'pendaftaran/simpan';
$route['pendaftaran/sukses/(:any)'] = 'pendaftaran/sukses/$1';
$route['pendaftaran/bukti/(:any)'] = 'pendaftaran/bukti/$1';
$route['pendaftaran/cek_status'] = 'pendaftaran/cek_status';

// Pelayanan File Unggahan / Berkas & Fasilitas
$route['uploads/berkas/(:any)'] = 'uploads/berkas/$1';
$route['uploads/berkas'] = 'uploads/berkas';
$route['uploads/fasilitas/(:any)'] = 'uploads/fasilitas/$1';
$route['uploads/fasilitas'] = 'uploads/fasilitas';

// Admin Master Fasilitas
$route['admin/fasilitas'] = 'admin/fasilitas';
$route['admin/fasilitas/simpan'] = 'admin/fasilitas/simpan';
$route['admin/fasilitas/update/(:num)'] = 'admin/fasilitas/update/$1';
$route['admin/fasilitas/hapus/(:num)'] = 'admin/fasilitas/hapus/$1';

// Admin Pendaftaran
$route['admin/pendaftaran'] = 'admin/pendaftaran';
$route['admin/pendaftaran/unggah_berkas/(:num)'] = 'admin/pendaftaran/unggah_berkas/$1';
$route['admin/pendaftaran/hapus_berkas/(:num)/(:num)'] = 'admin/pendaftaran/hapus_berkas/$1/$2';
$route['admin/pendaftaran/(:any)'] = 'admin/pendaftaran/$1';
$route['admin/pendaftaran/(:any)/(:any)'] = 'admin/pendaftaran/$1/$2';

// Admin Santri
$route['admin/santri'] = 'admin/santri';
$route['admin/santri/tambah'] = 'admin/santri/tambah';
$route['admin/santri/simpan'] = 'admin/santri/simpan';
$route['admin/santri/edit/(:num)'] = 'admin/santri/edit/$1';
$route['admin/santri/update/(:num)'] = 'admin/santri/update/$1';
$route['admin/santri/detail/(:num)'] = 'admin/santri/detail/$1';
$route['admin/santri/hapus/(:num)'] = 'admin/santri/hapus/$1';
$route['admin/santri/cetak_kartu/(:num)'] = 'admin/santri/cetak_kartu/$1';
$route['admin/santri/kenaikan_kelas'] = 'admin/santri/kenaikan_kelas';
$route['admin/santri/proses_kenaikan_kelas'] = 'admin/santri/proses_kenaikan_kelas';
$route['admin/santri/ekspor_dinas'] = 'admin/santri/ekspor_dinas';

// Admin Guru
$route['admin/guru'] = 'admin/guru';
$route['admin/guru/tambah'] = 'admin/guru/tambah';
$route['admin/guru/simpan'] = 'admin/guru/simpan';
$route['admin/guru/edit/(:num)'] = 'admin/guru/edit/$1';
$route['admin/guru/update/(:num)'] = 'admin/guru/update/$1';
$route['admin/guru/detail/(:num)'] = 'admin/guru/detail/$1';
$route['admin/guru/hapus/(:num)'] = 'admin/guru/hapus/$1';
$route['admin/guru/ekspor_edatuda'] = 'admin/guru/ekspor_edatuda';

// Admin Pembayaran
$route['admin/pembayaran'] = 'admin/pembayaran';
$route['admin/pembayaran/hapus/(:num)'] = 'admin/pembayaran/hapus/$1';

// Bendahara SPP & Keuangan
$route['bendahara/spp'] = 'bendahara/spp';
$route['bendahara/spp/input'] = 'bendahara/spp/input';
$route['bendahara/spp/simpan'] = 'bendahara/spp/simpan';
$route['bendahara/spp/kuitansi/(:num)'] = 'bendahara/spp/kuitansi/$1';
$route['bendahara/spp/hapus/(:num)'] = 'bendahara/spp/hapus/$1';
$route['bendahara/kartu_spp'] = 'bendahara/kartu_spp';
$route['bendahara/kartu_spp/detail/(:num)'] = 'bendahara/kartu_spp/detail/$1';
$route['bendahara/kartu_spp/cetak/(:num)'] = 'bendahara/kartu_spp/cetak/$1';
$route['bendahara/kartu_spp/cetak/(:num)/(:num)'] = 'bendahara/kartu_spp/cetak/$1/$2';
$route['bendahara/tunggakan'] = 'bendahara/tunggakan';
$route['bendahara/laporan'] = 'bendahara/laporan';
$route['bendahara/laporan/ekspor_csv'] = 'bendahara/laporan/ekspor_csv';

// Admin Jenjang & Kelas
$route['admin/jenjang'] = 'admin/jenjang';
$route['admin/jenjang/(:any)'] = 'admin/jenjang/$1';
$route['admin/jenjang/(:any)/(:num)'] = 'admin/jenjang/$1/$2';

// Admin Kurikulum & Kitab
$route['admin/kurikulum'] = 'admin/kurikulum';
$route['admin/kurikulum/(:any)'] = 'admin/kurikulum/$1';
$route['admin/kurikulum/(:any)/(:num)'] = 'admin/kurikulum/$1/$2';

// Admin Jadwal
$route['admin/jadwal'] = 'admin/jadwal';
$route['admin/jadwal/(:any)'] = 'admin/jadwal/$1';
$route['admin/jadwal/(:any)/(:num)'] = 'admin/jadwal/$1/$2';

// Admin Laporan
$route['admin/laporan'] = 'admin/laporan';
$route['admin/laporan/(:any)'] = 'admin/laporan/$1';

// Admin Pengaturan
$route['admin/pengaturan'] = 'admin/pengaturan';
$route['admin/pengaturan/(:any)'] = 'admin/pengaturan/$1';
$route['admin/pengaturan/(:any)/(:num)'] = 'admin/pengaturan/$1/$2';

// Pimpinan Monitoring Routes
$route['pimpinan/rekap_santri'] = 'pimpinan/dashboard/rekap_santri';
$route['pimpinan/rekap_guru'] = 'pimpinan/dashboard/rekap_guru';
$route['pimpinan/rekap_keuangan'] = 'pimpinan/dashboard/rekap_keuangan';
$route['pimpinan/laporan_dinas'] = 'pimpinan/dashboard/laporan_dinas';

// Pimpinan Format Dinas Ekspor (Excel, CSV & Cetak PDF)
$route['pimpinan/laporan_dinas/santri_excel'] = 'pimpinan/dashboard/ekspor_santri_excel';
$route['pimpinan/laporan_dinas/santri_csv']   = 'pimpinan/dashboard/ekspor_santri_csv';
$route['pimpinan/laporan_dinas/santri_pdf']   = 'pimpinan/dashboard/cetak_santri_pdf';

$route['pimpinan/laporan_dinas/guru_excel']   = 'pimpinan/dashboard/ekspor_guru_excel';
$route['pimpinan/laporan_dinas/guru_csv']     = 'pimpinan/dashboard/ekspor_guru_csv';
$route['pimpinan/laporan_dinas/guru_pdf']     = 'pimpinan/dashboard/cetak_guru_pdf';

$route['pimpinan/laporan_dinas/pendataan_excel'] = 'pimpinan/dashboard/ekspor_pendataan_excel';
$route['pimpinan/laporan_dinas/pendataan_csv']   = 'pimpinan/dashboard/ekspor_pendataan_csv';
$route['pimpinan/laporan_dinas/pendataan_pdf']   = 'pimpinan/dashboard/cetak_pendataan_pdf';

$route['pimpinan/ekspor_santri_excel']        = 'pimpinan/dashboard/ekspor_santri_excel';
$route['pimpinan/ekspor_santri_csv']          = 'pimpinan/dashboard/ekspor_santri_csv';
$route['pimpinan/cetak_santri_pdf']           = 'pimpinan/dashboard/cetak_santri_pdf';
$route['pimpinan/ekspor_guru_excel']          = 'pimpinan/dashboard/ekspor_guru_excel';
$route['pimpinan/ekspor_guru_csv']            = 'pimpinan/dashboard/ekspor_guru_csv';
$route['pimpinan/cetak_guru_pdf']             = 'pimpinan/dashboard/cetak_guru_pdf';
$route['pimpinan/ekspor_pendataan_excel']     = 'pimpinan/dashboard/ekspor_pendataan_excel';
$route['pimpinan/ekspor_pendataan_csv']       = 'pimpinan/dashboard/ekspor_pendataan_csv';
$route['pimpinan/cetak_pendataan_pdf']        = 'pimpinan/dashboard/cetak_pendataan_pdf';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
