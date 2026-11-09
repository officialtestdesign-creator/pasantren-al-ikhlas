<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$nama_pimpinan = !empty($profil->nama_pimpinan) ? $profil->nama_pimpinan : 'Tgk. H. Muhammad Nasir';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($title ?? 'Cetak Laporan Format EDATUDA Guru'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 20px 0;
            font-size: 11px;
        }

        .paper-container {
            background: #ffffff;
            width: 297mm;
            min-height: 210mm;
            margin: 0 auto;
            padding: 12mm 15mm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
            border-radius: 6px;
        }

        .btn-floating-bar {
            position: fixed;
            top: 15px;
            right: 25px;
            z-index: 9999;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(8px);
            padding: 8px 16px;
            border-radius: 50px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kop-surat {
            border-bottom: 3px double #1e3a8a;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .kop-logo {
            width: 60px;
            height: 60px;
            background: #1e3a8a;
            color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .kop-instansi {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #1e3a8a;
            margin-bottom: 2px;
        }

        .kop-sub {
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .kop-alamat {
            font-size: 9.5px;
            color: #475569;
            line-height: 1.3;
        }

        .doc-title {
            text-align: center;
            margin: 10px 0 14px 0;
        }

        .doc-title h5 {
            font-size: 13px;
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .doc-title .meta-text {
            font-size: 9.5px;
            color: #64748b;
        }

        .table-dinas {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5px;
            margin-bottom: 15px;
        }

        .table-dinas th {
            background-color: #1e3a8a;
            color: #ffffff;
            font-weight: 700;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #1e3a8a;
            padding: 5px 4px;
            font-size: 9px;
            text-transform: uppercase;
        }

        .table-dinas td {
            border: 1px solid #cbd5e1;
            padding: 4px 6px;
            vertical-align: middle;
            line-height: 1.25;
        }

        .table-dinas tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .badge-status {
            font-size: 8.5px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
        }
        .badge-pns {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }
        .badge-aktif {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .ttd-section {
            page-break-inside: avoid;
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 10px;
        }

        .ttd-box {
            text-align: center;
            width: 250px;
        }

        .stempel-area {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-style: italic;
            font-size: 9px;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .paper-container {
                box-shadow: none !important;
                border-radius: 0 !important;
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print, .btn-floating-bar {
                display: none !important;
            }
            @page {
                size: A4 landscape;
                margin: 10mm 12mm 10mm 12mm;
            }
            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <!-- FLOATING ACTION BUTTONS -->
    <div class="btn-floating-bar no-print">
        <a href="<?= base_url('pimpinan/laporan_dinas'); ?>" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">
            <i class="bi bi-printer-fill me-1"></i> Cetak / Simpan PDF
        </button>
        <span class="text-white-50 small ms-1" style="font-size: 10px;">
            <i class="bi bi-info-circle me-1"></i>Pilih destination <b>"Save as PDF"</b> untuk unduh
        </span>
    </div>

    <div class="paper-container">
        <!-- KOP SURAT RESMI -->
        <div class="kop-surat d-flex align-items-center gap-3">
            <div class="kop-logo flex-shrink-0" style="background: #1e3a8a;">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div class="flex-grow-1 text-center">
                <div class="kop-instansi" style="color: #1e3a8a;"><?= strtoupper(html_escape($profil->nama_dayah ?? 'LPI DAYAH AL-IKHLAS AL-AZIZIYAH')); ?></div>
                <div class="kop-sub">PENILAIAN & PENDATAAN TENAGA PENDIDIK EDATUDA DINAS PENDIDIKAN DAYAH ACEH</div>
                <div class="kop-alamat">
                    Gampong <?= html_escape($profil->gampong ?: 'Sangso'); ?>, Kecamatan <?= html_escape($profil->kecamatan ?: 'Samalanga'); ?>, Kabupaten <?= html_escape($profil->kabupaten ?: 'Bireuen'); ?>, Provinsi Aceh &bull; Kode Pos: 24264<br>
                    Telepon/WA: <?= html_escape($profil->no_hp ?: '0812-3456-7890'); ?> &bull; Email: <?= html_escape($profil->email ?: 'dayah.alikhlas.aziziyah@gmail.com'); ?>
                </div>
            </div>
            <div class="flex-shrink-0 text-center" style="width: 60px;"></div>
        </div>

        <!-- JUDUL DOKUMEN -->
        <div class="doc-title">
            <h5 style="color: #1e3a8a;">REKAPITULASI RESMI DEWAN GURU / TENAGA PENDIDIK FORMAT EDATUDA</h5>
            <div class="meta-text">
                Nomor: 421.9/EDATUDA-GURU/<?= date('Y'); ?> &bull; Tanggal: <strong><?= format_tanggal_indo(date('Y-m-d')); ?></strong> &bull; Total Guru Terdaftar: <strong><?= count($guru); ?> Orang</strong>
            </div>
        </div>

        <!-- TABEL DATA DEWAN GURU -->
        <table class="table-dinas">
            <thead>
                <tr>
                    <th style="width: 25px;">No</th>
                    <th style="width: 75px;">NIG</th>
                    <th style="width: 105px;">NIK (16 Digit)</th>
                    <th>Nama Lengkap & Gelar</th>
                    <th style="width: 30px;">L/P</th>
                    <th style="width: 110px;">Tempat, Tgl Lahir</th>
                    <th style="width: 80px;">Pendidikan</th>
                    <th style="width: 70px;">Status PNS</th>
                    <th style="width: 70px;">Kepegawaian</th>
                    <th>Bidang Studi / Kitab Kuning</th>
                    <th style="width: 100px;">Asal Daerah</th>
                    <th style="width: 90px;">No. HP / WA</th>
                    <th style="width: 50px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($guru)): ?>
                    <tr>
                        <td colspan="13" class="text-center py-4 text-muted">Belum ada data guru ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $no = 1; 
                    $total_pns = 0;
                    $total_non_pns = 0;
                    foreach ($guru as $g): 
                        if ($g->status_pns === 'PNS') $total_pns++; else $total_non_pns++;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center fw-semibold"><?= html_escape($g->no_induk); ?></td>
                            <td class="text-center font-monospace"><?= html_escape($g->nik ?: '-'); ?></td>
                            <td class="fw-bold text-dark"><?= html_escape($g->nama); ?></td>
                            <td class="text-center fw-semibold"><?= $g->jenis_kelamin === 'L' ? 'L' : 'P'; ?></td>
                            <td><?= html_escape($g->tempat_lahir ?: '-'); ?>, <?= !empty($g->tanggal_lahir) ? date('d/m/Y', strtotime($g->tanggal_lahir)) : '-'; ?></td>
                            <td class="text-center"><?= html_escape($g->pendidikan_terakhir ?: '-'); ?></td>
                            <td class="text-center">
                                <span class="badge-status badge-pns"><?= html_escape($g->status_pns); ?></span>
                            </td>
                            <td class="text-center"><?= html_escape($g->status_tetap); ?></td>
                            <td><span class="fw-semibold text-primary"><?= html_escape($g->mata_pelajaran ?: '-'); ?></span></td>
                            <td><?= html_escape($g->asal_desa ?: '-'); ?>, <?= html_escape($g->asal_kabupaten ?: '-'); ?></td>
                            <td class="text-center font-monospace"><?= html_escape($g->no_hp ?: '-'); ?></td>
                            <td class="text-center">
                                <span class="badge-status badge-aktif"><?= $g->aktif ? 'AKTIF' : 'NON-AKTIF'; ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- LEMBAR PENGESAHAN -->
        <div class="ttd-section">
            <div>
                <div class="p-2 border rounded bg-light" style="width: 320px; font-size: 9px; line-height: 1.4;">
                    <strong>Rekapitulasi Dewan Guru EDATUDA:</strong><br>
                    &bull; Guru Berstatus PNS : <strong><?= $total_pns; ?> Orang</strong><br>
                    &bull; Guru Berstatus Non-PNS : <strong><?= $total_non_pns; ?> Orang</strong><br>
                    &bull; Total Tenaga Pengajar : <strong><?= count($guru); ?> Asatidz</strong><br>
                    <span class="text-muted" style="font-size: 8px;">Format resmi pangkalan data EDATUDA Dinas Pendidikan Dayah</span>
                </div>
            </div>
            <div class="ttd-box">
                <div>Samalanga, <?= format_tanggal_indo(date('Y-m-d')); ?></div>
                <div class="fw-bold">Pimpinan LPI Dayah Al-Ikhlas Al-Aziziyah</div>
                <div class="stempel-area">
                    ( Tanda Tangan & Stempel Dayah )
                </div>
                <div class="fw-bold text-decoration-underline" style="font-size: 11px;">
                    <?= html_escape($nama_pimpinan); ?>
                </div>
                <div class="text-muted" style="font-size: 8.5px;">Pimpinan Dayah</div>
            </div>
        </div>
    </div>

</body>
</html>

