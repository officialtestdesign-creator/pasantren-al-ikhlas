<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$nama_pimpinan = !empty($profil->nama_pimpinan) ? $profil->nama_pimpinan : 'Tgk. H. Muhammad Nasir';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($title ?? 'Cetak Ringkasan Pendataan Dayah'); ?></title>
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
            width: 210mm;
            min-height: 297mm;
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
            border-bottom: 3px double #854d0e;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .kop-logo {
            width: 55px;
            height: 55px;
            background: #854d0e;
            color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .kop-instansi {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #854d0e;
            margin-bottom: 2px;
        }

        .kop-sub {
            font-size: 10.5px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .kop-alamat {
            font-size: 9px;
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
            color: #854d0e;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .doc-title .meta-text {
            font-size: 9px;
            color: #64748b;
        }

        .section-banner {
            background-color: #fef08a;
            color: #713f12;
            font-weight: 700;
            font-size: 10.5px;
            padding: 4px 10px;
            border-radius: 4px;
            border-left: 4px solid #854d0e;
            margin-top: 12px;
            margin-bottom: 8px;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 10px;
        }

        .table-custom th {
            background-color: #854d0e;
            color: #ffffff;
            font-weight: 700;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #854d0e;
            padding: 5px 6px;
            font-size: 9.5px;
        }

        .table-custom td {
            border: 1px solid #cbd5e1;
            padding: 5px 8px;
            vertical-align: middle;
            line-height: 1.3;
        }

        .table-custom tr:nth-child(even) td {
            background-color: #fefce8;
        }

        .label-col {
            width: 210px;
            background-color: #f8fafc;
            font-weight: 600;
            color: #334155;
        }

        .ttd-section {
            page-break-inside: avoid;
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
            font-size: 10px;
        }

        .ttd-box {
            text-align: center;
            width: 250px;
        }

        .stempel-area {
            height: 65px;
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
                size: A4 portrait;
                margin: 12mm 15mm 12mm 15mm;
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
        <button onclick="window.print()" class="btn btn-sm btn-warning rounded-pill px-3 fw-bold text-dark">
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
                <div class="kop-sub">DATA POKOK KELEMBAGAAN & ROMBEL PENDIDIKAN DAYAH ACEH</div>
                <div class="kop-alamat">
                    Gampong <?= html_escape($profil->gampong ?: 'Sangso'); ?>, Kecamatan <?= html_escape($profil->kecamatan ?: 'Samalanga'); ?>, Kabupaten <?= html_escape($profil->kabupaten ?: 'Bireuen'); ?>, Provinsi Aceh &bull; Kode Pos: 24264<br>
                    Telepon/WA: <?= html_escape($profil->no_hp ?: '0812-3456-7890'); ?> &bull; Email: <?= html_escape($profil->email ?: 'dayah.alikhlas.aziziyah@gmail.com'); ?>
                </div>
            </div>
            <div class="flex-shrink-0 text-center" style="width: 55px;"></div>
        </div>

        <!-- JUDUL DOKUMEN -->
        <div class="doc-title">
            <h5>RINGKASAN PENDATAAN KELEMBAGAAN & ROMBONGAN BELAJAR DAYAH</h5>
            <div class="meta-text">
                Format Pelaporan Resmi Dinas Pendidikan Dayah &bull; Tahun Ajaran: <strong><?= html_escape($tahun_ajaran); ?></strong> &bull; Per: <strong><?= format_tanggal_indo(date('Y-m-d')); ?></strong>
            </div>
        </div>

        <!-- I. IDENTITAS KELEMBAGAAN -->
        <div class="section-banner">
            <i class="bi bi-award me-1"></i> I. DATA IDENTITAS & LEGALITAS KELEMBAGAAN DAYAH
        </div>
        <table class="table-custom">
            <tr>
                <td class="label-col">Nama Satuan Pendidikan Dayah</td>
                <td class="fw-bold text-dark"><?= html_escape($profil->nama_dayah); ?></td>
            </tr>
            <tr>
                <td class="label-col">Tahun Berdiri & Izin Operasional</td>
                <td>Tahun <strong><?= html_escape($profil->tahun_berdiri ?? '2007'); ?></strong> &bull; NSPP/Izin: <strong><?= html_escape($profil->izin_operasional ?: 'Kd.01.02/5/PP.00.7/142/2018'); ?></strong></td>
            </tr>
            <tr>
                <td class="label-col">Pimpinan Dayah</td>
                <td class="fw-bold text-success"><?= html_escape($nama_pimpinan); ?></td>
            </tr>
            <tr>
                <td class="label-col">Status Kelembagaan</td>
                <td><?= html_escape($profil->status_kelembagaan ?: 'Yayasan / Lembaga Pendidikan Islam'); ?></td>
            </tr>
            <tr>
                <td class="label-col">Alamat Lengkap</td>
                <td>Gampong <?= html_escape($profil->gampong ?: 'Sangso'); ?>, Kec. <?= html_escape($profil->kecamatan ?: 'Samalanga'); ?>, Kab. <?= html_escape($profil->kabupaten ?: 'Bireuen'); ?> - Aceh</td>
            </tr>
        </table>

        <!-- II. DEMOGRAFI SANTRI -->
        <div class="section-banner">
            <i class="bi bi-people me-1"></i> II. REKAPITULASI DEMOGRAFI & ASAL SANTRI
        </div>
        <div class="row g-2 mb-2">
            <div class="col-4">
                <div class="p-2 border rounded text-center bg-light">
                    <div class="text-muted small">Total Santri Aktif</div>
                    <div class="fs-6 fw-bold text-dark"><?= (int)$stats['santri_total']; ?> Santri</div>
                </div>
            </div>
            <div class="col-4">
                <div class="p-2 border rounded text-center bg-light">
                    <div class="text-muted small">Putra (L) / Putri (P)</div>
                    <div class="fs-6 fw-bold text-primary"><?= (int)$stats['santri_putra']; ?> L <span class="text-muted font-normal">/</span> <span class="text-danger"><?= (int)$stats['santri_putri']; ?> P</span></div>
                </div>
            </div>
            <div class="col-4">
                <div class="p-2 border rounded text-center bg-light">
                    <div class="text-muted small">Dalam / Luar Bireuen</div>
                    <div class="fs-6 fw-bold text-success"><?= (int)$santri_dalam_kab; ?> <span class="text-muted font-normal">/</span> <?= (int)$santri_luar_kab; ?></div>
                </div>
            </div>
        </div>

        <!-- III. TABEL ROMBEL -->
        <div class="section-banner">
            <i class="bi bi-diagram-3 me-1"></i> III. JUMLAH SANTRI PER ROMBONGAN BELAJAR (ROMBEL)
        </div>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Tingkat / Jenjang</th>
                    <th>Nama Rombel / Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th style="width: 75px;">Laki-laki</th>
                    <th style="width: 75px;">Perempuan</th>
                    <th style="width: 85px;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $tot_l = 0; $tot_p = 0; $tot_all = 0;
                if (!empty($rekap_kelas)):
                    foreach ($rekap_kelas as $rk): 
                        $tot_l += (int)$rk->laki_laki;
                        $tot_p += (int)$rk->perempuan;
                        $tot_all += (int)$rk->jumlah;
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center fw-semibold"><?= html_escape($rk->jenjang); ?></td>
                        <td class="fw-bold"><?= html_escape($rk->nama_kelas); ?></td>
                        <td class="text-center text-muted"><?= html_escape($rk->tahun_ajaran); ?></td>
                        <td class="text-center"><?= (int)$rk->laki_laki; ?></td>
                        <td class="text-center"><?= (int)$rk->perempuan; ?></td>
                        <td class="text-center fw-bold"><?= (int)$rk->jumlah; ?></td>
                    </tr>
                <?php endforeach; ?>
                    <tr style="background-color: #fef08a; font-weight: bold;">
                        <td colspan="4" class="text-end pe-3">TOTAL KESELURUHAN:</td>
                        <td class="text-center"><?= $tot_l; ?></td>
                        <td class="text-center"><?= $tot_p; ?></td>
                        <td class="text-center"><?= $tot_all; ?> Santri</td>
                    </tr>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center py-2">Belum ada data rombel kelas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- IV. DEWAN GURU -->
        <div class="section-banner">
            <i class="bi bi-person-workspace me-1"></i> IV. REKAPITULASI DEWAN GURU / TEUNGKU PENGAJAR
        </div>
        <table class="table-custom">
            <tr>
                <td class="label-col">Total Dewan Guru Aktif</td>
                <td class="fw-bold text-dark"><?= (int)$stats['guru_total']; ?> Asatidz</td>
            </tr>
            <tr>
                <td class="label-col">Guru Berstatus Pegawai Negeri Sipil (PNS)</td>
                <td><strong><?= (int)$guru_pns; ?> Orang</strong></td>
            </tr>
            <tr>
                <td class="label-col">Guru Berstatus Non-PNS (Yayasan / Dayah)</td>
                <td><strong><?= (int)$guru_non_pns; ?> Orang</strong></td>
            </tr>
        </table>

        <!-- LEMBAR PENGESAHAN -->
        <div class="ttd-section">
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

