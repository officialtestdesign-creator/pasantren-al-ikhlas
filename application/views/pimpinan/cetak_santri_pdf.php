<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$nama_pimpinan = !empty($profil->nama_pimpinan) ? $profil->nama_pimpinan : 'Tgk. H. Muhammad Nasir';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($title ?? 'Cetak Laporan Format Dinas Santri'); ?></title>
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
            border-bottom: 3px double #064e3b;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .kop-logo {
            width: 60px;
            height: 60px;
            background: #064e3b;
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
            color: #064e3b;
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
            color: #064e3b;
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
            background-color: #064e3b;
            color: #ffffff;
            font-weight: 700;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #064e3b;
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
        <button onclick="window.print()" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
            <i class="bi bi-printer-fill me-1"></i> Cetak / Simpan PDF
        </button>
        <span class="text-white-50 small ms-1" style="font-size: 10px;">
            <i class="bi bi-info-circle me-1"></i>Pilih destination <b>"Save as PDF"</b> untuk unduh
        </span>
    </div>

    <div class="paper-container">
        <!-- KOP SURAT RESMI -->
        <div class="kop-surat d-flex align-items-center gap-3">
            <div class="kop-logo flex-shrink-0">
                <i class="bi bi-bank2"></i>
            </div>
            <div class="flex-grow-1 text-center">
                <div class="kop-instansi"><?= strtoupper(html_escape($profil->nama_dayah ?? 'LPI DAYAH AL-IKHLAS AL-AZIZIYAH')); ?></div>
                <div class="kop-sub">TERAKREDITASI DINAS PENDIDIKAN DAYAH ACEH &bull; IZIN OPERASIONAL: <?= html_escape($profil->izin_operasional ?: 'Kd.01.02/5/PP.00.7/142/2018'); ?></div>
                <div class="kop-alamat">
                    Gampong <?= html_escape($profil->gampong ?: 'Sangso'); ?>, Kecamatan <?= html_escape($profil->kecamatan ?: 'Samalanga'); ?>, Kabupaten <?= html_escape($profil->kabupaten ?: 'Bireuen'); ?>, Provinsi Aceh &bull; Kode Pos: 24264<br>
                    Telepon/WA: <?= html_escape($profil->no_hp ?: '0812-3456-7890'); ?> &bull; Email: <?= html_escape($profil->email ?: 'dayah.alikhlas.aziziyah@gmail.com'); ?>
                </div>
            </div>
            <div class="flex-shrink-0 text-center" style="width: 60px;">
                <!-- Balanced Header spacer -->
            </div>
        </div>

        <!-- JUDUL DOKUMEN -->
        <div class="doc-title">
            <h5>REKAPITULASI DATA SANTRI AKTIF FORMAT DINAS PENDIDIKAN DAYAH</h5>
            <div class="meta-text">
                Nomor: 421.9/DAYAH-AI/DISDAYAH/<?= date('Y'); ?> &bull; Tahun Ajaran: <strong><?= html_escape($tahun_ajaran); ?></strong> &bull; Total Terdaftar: <strong><?= count($santri); ?> Santri</strong>
            </div>
        </div>

        <!-- TABEL DATA SANTRI -->
        <table class="table-dinas">
            <thead>
                <tr>
                    <th style="width: 25px;">No</th>
                    <th style="width: 70px;">NIS</th>
                    <th style="width: 105px;">NIK (16 Digit)</th>
                    <th>Nama Lengkap Santri</th>
                    <th style="width: 30px;">L/P</th>
                    <th style="width: 120px;">Tempat, Tgl Lahir</th>
                    <th style="width: 120px;">Orang Tua (Ayah/Ibu)</th>
                    <th style="width: 130px;">Asal Daerah (Gampong/Kab)</th>
                    <th style="width: 80px;">Rombel / Kelas</th>
                    <th style="width: 50px;">Masuk</th>
                    <th style="width: 55px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($santri)): ?>
                    <tr>
                        <td colspan="11" class="text-center py-4 text-muted">Belum ada data santri aktif ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $no = 1; 
                    $total_l = 0;
                    $total_p = 0;
                    foreach ($santri as $s): 
                        if ($s->jenis_kelamin === 'L') $total_l++; else $total_p++;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center fw-semibold"><?= html_escape($s->no_induk); ?></td>
                            <td class="text-center font-monospace"><?= html_escape($s->nik ?: '-'); ?></td>
                            <td class="fw-bold text-dark"><?= html_escape($s->nama); ?></td>
                            <td class="text-center fw-semibold"><?= $s->jenis_kelamin === 'L' ? 'L' : 'P'; ?></td>
                            <td><?= html_escape($s->tempat_lahir ?: '-'); ?>, <?= !empty($s->tanggal_lahir) ? date('d/m/Y', strtotime($s->tanggal_lahir)) : '-'; ?></td>
                            <td>
                                <div>A: <?= html_escape($s->nama_ayah ?: '-'); ?></div>
                                <div class="text-muted" style="font-size: 8.5px;">I: <?= html_escape($s->nama_ibu ?: '-'); ?></div>
                            </td>
                            <td>
                                <div><?= html_escape($s->asal_gampong ?: '-'); ?></div>
                                <div class="text-muted" style="font-size: 8.5px;"><?= html_escape($s->asal_kecamatan ?: '-'); ?>, <?= html_escape($s->asal_kabupaten ?: '-'); ?></div>
                            </td>
                            <td class="text-center">
                                <span class="fw-semibold"><?= html_escape($s->nama_kelas ?: '-'); ?></span><br>
                                <span class="text-muted" style="font-size: 8.5px;"><?= html_escape($s->nama_jenjang ?: '-'); ?></span>
                            </td>
                            <td class="text-center"><?= html_escape($s->tahun_masuk ?: '-'); ?></td>
                            <td class="text-center">
                                <span class="badge-status badge-aktif"><?= strtoupper(html_escape($s->status)); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- LEMBAR PENGESAHAN & REKAP KECIL -->
        <div class="ttd-section">
            <div>
                <div class="p-2 border rounded bg-light" style="width: 320px; font-size: 9px; line-height: 1.4;">
                    <strong>Rekapitulasi Santri:</strong><br>
                    &bull; Santri Putra (Laki-laki) : <strong><?= $total_l; ?> Orang</strong><br>
                    &bull; Santri Putri (Perempuan) : <strong><?= $total_p; ?> Orang</strong><br>
                    &bull; Total Keseluruhan : <strong><?= count($santri); ?> Santri Aktif</strong><br>
                    <span class="text-muted" style="font-size: 8px;">Dicetak otomatis dari SIM-Dayah Al-Ikhlas Al-Aziziyah</span>
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

