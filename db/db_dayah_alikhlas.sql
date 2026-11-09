-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2026 at 07:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dayah_alikhlas`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int UNSIGNED NOT NULL,
  `judul` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','terbit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `penulis_id` int UNSIGNED DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_pendaftaran`
--

CREATE TABLE `berkas_pendaftaran` (
  `id` int UNSIGNED NOT NULL,
  `pendaftaran_id` int UNSIGNED NOT NULL,
  `jenis_berkas` enum('foto','kk','ktp_ortu','ijazah','nilai','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bidang_studi`
--

CREATE TABLE `bidang_studi` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidang_studi`
--

INSERT INTO `bidang_studi` (`id`, `nama`, `urutan`) VALUES
(1, 'Al-Qur\'an', 1),
(2, 'Fiqih', 2),
(3, 'Nahwu', 3),
(4, 'Saraf', 4),
(5, 'Tauhid', 5),
(6, 'Akhlaq/Tasawuf', 6),
(7, 'Balaghah', 7),
(8, 'Ma\'ani', 8),
(9, 'Mantek', 9),
(10, 'Bayan', 10),
(11, 'Tarikh', 11),
(12, 'Tafsir', 12),
(13, 'Ilmu Tafsir', 13),
(14, 'Hadits', 14),
(15, 'Usul Fiqh', 15),
(16, 'Imlak/Insyak', 16),
(17, 'Tahfizh', 17),
(18, 'Mustahalah Hadits', 18),
(19, 'Ilmu Hadits', 19);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int UNSIGNED NOT NULL,
  `judul` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int UNSIGNED NOT NULL,
  `no_induk` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `pendidikan_terakhir` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SMP, SMA, S1, MSTN, dst.',
  `status_pns` enum('PNS','NON PNS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NON PNS',
  `status_tetap` enum('TETAP','TIDAK TETAP') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TETAP',
  `mata_pelajaran` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'bidang studi yang diasuh (teks bebas, sesuai format Dinas)',
  `asal_kabupaten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_desa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_belajar`
--

CREATE TABLE `jadwal_belajar` (
  `id` int UNSIGNED NOT NULL,
  `kelas_id` int UNSIGNED NOT NULL,
  `hari` enum('Sabtu','Ahad','Senin','Selasa','Rabu','Kamis','Jumat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `bidang_studi_id` int UNSIGNED NOT NULL,
  `guru_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kegiatan`
--

CREATE TABLE `jadwal_kegiatan` (
  `id` int UNSIGNED NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `kegiatan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` smallint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `periode` enum('bulanan','sekali','per_tahap') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bulanan',
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id`, `nama`, `nominal`, `periode`, `aktif`) VALUES
(1, 'SPP Bulanan', '0.00', 'bulanan', 1),
(2, 'Biaya Pendaftaran', '0.00', 'sekali', 1),
(3, 'Sumbangan Wajib', '0.00', 'per_tahap', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id`, `nama`, `urutan`, `keterangan`) VALUES
(1, 'Tajhizi', 1, NULL),
(2, 'Ula', 2, NULL),
(3, 'Wustha', 3, NULL),
(4, 'Ulya', 4, NULL),
(5, 'Ma\'had Aly', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int UNSIGNED NOT NULL,
  `jenjang_id` int UNSIGNED NOT NULL,
  `tahun_ajaran_id` int UNSIGNED NOT NULL,
  `nama_kelas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'contoh: Ula 1, Wustha 3 A',
  `wali_kelas_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` int UNSIGNED NOT NULL,
  `kelas_id` int UNSIGNED NOT NULL,
  `bidang_studi_id` int UNSIGNED NOT NULL,
  `guru_id` int UNSIGNED DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int UNSIGNED NOT NULL,
  `no_kuitansi` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `santri_id` int UNSIGNED NOT NULL,
  `jenis_pembayaran_id` int UNSIGNED NOT NULL,
  `tahun` year NOT NULL,
  `bulan` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '1-12 untuk SPP, 0 jika bukan bulanan',
  `tahap` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'untuk sumbangan per tahap, 0 jika tidak ada',
  `tanggal_bayar` date NOT NULL,
  `jumlah` decimal(12,2) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `petugas_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int UNSIGNED NOT NULL,
  `no_pendaftaran` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran_id` int UNSIGNED NOT NULL,
  `jenjang_tujuan_id` int UNSIGNED DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `anak_ke` tinyint UNSIGNED DEFAULT NULL,
  `jumlah_saudara` tinyint UNSIGNED DEFAULT NULL,
  `asal_gampong` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_kabupaten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_provinsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_ortu` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_wali` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendaftar_nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'yang mendaftarkan santri',
  `pendaftar_pekerjaan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendaftar_alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendaftar_no_hp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('menunggu','diterima','ditolak','cadangan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `santri_id` int UNSIGNED DEFAULT NULL COMMENT 'terisi setelah dijadikan santri',
  `tanggal_daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peraturan`
--

CREATE TABLE `peraturan` (
  `id` int UNSIGNED NOT NULL,
  `bidang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Pendidikan, Humas, Naker, Jamaah',
  `urutan` smallint UNSIGNED NOT NULL DEFAULT '0',
  `isi` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil_dayah`
--

CREATE TABLE `profil_dayah` (
  `id` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `nama_dayah` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_berdiri` year DEFAULT NULL,
  `jalan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dusun` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gampong` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kemukiman` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kelembagaan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `izin_operasional` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pimpinan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sejarah` text COLLATE utf8mb4_unicode_ci,
  `visi` text COLLATE utf8mb4_unicode_ci,
  `misi` text COLLATE utf8mb4_unicode_ci,
  `tujuan` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_dayah`
--

INSERT INTO `profil_dayah` (`id`, `nama_dayah`, `tahun_berdiri`, `jalan`, `dusun`, `gampong`, `kemukiman`, `kecamatan`, `kabupaten`, `status_kelembagaan`, `izin_operasional`, `nama_pimpinan`, `sejarah`, `visi`, `misi`, `tujuan`, `no_hp`, `email`, `latitude`, `longitude`, `logo`, `updated_at`) VALUES
(1, 'LPI Dayah Al-Ikhlas Al-Aziziyah', 2007, NULL, NULL, 'Sangso', NULL, 'Samalanga', 'Bireuen', 'Yayasan/Lembaga Pendidikan Islam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-25 07:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id` int UNSIGNED NOT NULL,
  `no_induk` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `anak_ke` tinyint UNSIGNED DEFAULT NULL,
  `jumlah_saudara` tinyint UNSIGNED DEFAULT NULL,
  `asal_gampong` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_kabupaten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_provinsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_domisili` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_ortu` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_wali` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` int UNSIGNED DEFAULT NULL,
  `tahun_masuk` year DEFAULT NULL,
  `status` enum('aktif','alumni','keluar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'contoh: 2026/2027',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `aktif`) VALUES
(1, '2026/2027', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','bendahara','pimpinan','wali') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `santri_id` int UNSIGNED DEFAULT NULL COMMENT 'diisi jika role = wali (opsional)',
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `terakhir_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password_hash`, `role`, `santri_id`, `aktif`, `terakhir_login`, `created_at`) VALUES
(1, 'Administrator', 'admin', '$2b$10$gTnkuagr2HvRyNsL//jGkue2JbvjZ1jfoVNUfK2KerAvRwFY0UFem', 'admin', NULL, 1, NULL, '2026-10-25 07:07:45');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jumlah_santri_per_kelas`
-- (See below for the actual view)
--
CREATE TABLE `v_jumlah_santri_per_kelas` (
`jenjang` varchar(50)
,`jumlah` bigint
,`laki_laki` decimal(23,0)
,`nama_kelas` varchar(50)
,`perempuan` decimal(23,0)
,`tahun_ajaran` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_spp_santri`
-- (See below for the actual view)
--
CREATE TABLE `v_spp_santri` (
`bulan` tinyint unsigned
,`jumlah` decimal(12,2)
,`keterangan` varchar(255)
,`nama` varchar(150)
,`no_induk` varchar(30)
,`santri_id` int unsigned
,`tahun` year
,`tanggal_bayar` date
);

-- --------------------------------------------------------

--
-- Structure for view `v_jumlah_santri_per_kelas`
--
DROP TABLE IF EXISTS `v_jumlah_santri_per_kelas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jumlah_santri_per_kelas`  AS SELECT `j`.`nama` AS `jenjang`, `k`.`nama_kelas` AS `nama_kelas`, `ta`.`nama` AS `tahun_ajaran`, sum((`s`.`jenis_kelamin` = 'L')) AS `laki_laki`, sum((`s`.`jenis_kelamin` = 'P')) AS `perempuan`, count(`s`.`id`) AS `jumlah` FROM (((`kelas` `k` join `jenjang` `j` on((`j`.`id` = `k`.`jenjang_id`))) join `tahun_ajaran` `ta` on((`ta`.`id` = `k`.`tahun_ajaran_id`))) left join `santri` `s` on(((`s`.`kelas_id` = `k`.`id`) and (`s`.`status` = 'aktif')))) GROUP BY `k`.`id`, `j`.`nama`, `k`.`nama_kelas`, `ta`.`nama`  ;

-- --------------------------------------------------------

--
-- Structure for view `v_spp_santri`
--
DROP TABLE IF EXISTS `v_spp_santri`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_spp_santri`  AS SELECT `s`.`id` AS `santri_id`, `s`.`no_induk` AS `no_induk`, `s`.`nama` AS `nama`, `p`.`tahun` AS `tahun`, `p`.`bulan` AS `bulan`, `p`.`tanggal_bayar` AS `tanggal_bayar`, `p`.`jumlah` AS `jumlah`, `p`.`keterangan` AS `keterangan` FROM ((`pembayaran` `p` join `santri` `s` on((`s`.`id` = `p`.`santri_id`))) join `jenis_pembayaran` `jp` on((`jp`.`id` = `p`.`jenis_pembayaran_id`))) WHERE (`jp`.`periode` = 'bulanan')  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_berita_user` (`penulis_id`);

--
-- Indexes for table `berkas_pendaftaran`
--
ALTER TABLE `berkas_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_berkas_pend` (`pendaftaran_id`);

--
-- Indexes for table `bidang_studi`
--
ALTER TABLE `bidang_studi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_induk` (`no_induk`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `jadwal_belajar`
--
ALTER TABLE `jadwal_belajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_jb_kelas_hari` (`kelas_id`,`hari`),
  ADD KEY `fk_jb_bs` (`bidang_studi_id`),
  ADD KEY `fk_jb_guru` (`guru_id`);

--
-- Indexes for table `jadwal_kegiatan`
--
ALTER TABLE `jadwal_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_kelas` (`tahun_ajaran_id`,`nama_kelas`),
  ADD KEY `fk_kelas_jenjang` (`jenjang_id`),
  ADD KEY `fk_kelas_wali` (`wali_kelas_id`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_kurikulum` (`kelas_id`,`bidang_studi_id`),
  ADD KEY `fk_kur_bs` (`bidang_studi_id`),
  ADD KEY `fk_kur_guru` (`guru_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_bayar` (`santri_id`,`jenis_pembayaran_id`,`tahun`,`bulan`,`tahap`),
  ADD UNIQUE KEY `no_kuitansi` (`no_kuitansi`),
  ADD KEY `idx_bayar_tanggal` (`tanggal_bayar`),
  ADD KEY `fk_bayar_jenis` (`jenis_pembayaran_id`),
  ADD KEY `fk_bayar_petugas` (`petugas_id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_pendaftaran` (`no_pendaftaran`),
  ADD KEY `idx_pend_status` (`status`),
  ADD KEY `fk_pend_ta` (`tahun_ajaran_id`),
  ADD KEY `fk_pend_jenjang` (`jenjang_tujuan_id`),
  ADD KEY `fk_pend_santri` (`santri_id`);

--
-- Indexes for table `peraturan`
--
ALTER TABLE `peraturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_dayah`
--
ALTER TABLE `profil_dayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_induk` (`no_induk`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `idx_santri_nama` (`nama`),
  ADD KEY `idx_santri_status` (`status`),
  ADD KEY `fk_santri_kelas` (`kelas_id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_santri` (`santri_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berkas_pendaftaran`
--
ALTER TABLE `berkas_pendaftaran`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bidang_studi`
--
ALTER TABLE `bidang_studi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_belajar`
--
ALTER TABLE `jadwal_belajar`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_kegiatan`
--
ALTER TABLE `jadwal_kegiatan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peraturan`
--
ALTER TABLE `peraturan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `santri`
--
ALTER TABLE `santri`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `fk_berita_user` FOREIGN KEY (`penulis_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `berkas_pendaftaran`
--
ALTER TABLE `berkas_pendaftaran`
  ADD CONSTRAINT `fk_berkas_pend` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_belajar`
--
ALTER TABLE `jadwal_belajar`
  ADD CONSTRAINT `fk_jb_bs` FOREIGN KEY (`bidang_studi_id`) REFERENCES `bidang_studi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jb_guru` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jb_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_kelas_jenjang` FOREIGN KEY (`jenjang_id`) REFERENCES `jenjang` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelas_ta` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelas_wali` FOREIGN KEY (`wali_kelas_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD CONSTRAINT `fk_kur_bs` FOREIGN KEY (`bidang_studi_id`) REFERENCES `bidang_studi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kur_guru` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kur_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_bayar_jenis` FOREIGN KEY (`jenis_pembayaran_id`) REFERENCES `jenis_pembayaran` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bayar_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bayar_santri` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `fk_pend_jenjang` FOREIGN KEY (`jenjang_tujuan_id`) REFERENCES `jenjang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pend_santri` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pend_ta` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `fk_santri_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_santri` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
