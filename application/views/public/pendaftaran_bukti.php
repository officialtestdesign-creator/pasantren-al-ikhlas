<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - <?= html_escape($pendaftar->no_pendaftaran); ?> - <?= html_escape($pendaftar->nama); ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background-color: #f1f5f9;
            color: #0f172a;
            padding: 2rem 0;
        }

        .sheet {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm 20mm 15mm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .kop-header {
            text-align: center;
            border-bottom: 3px double #064e3b;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .kop-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #064e3b;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            margin-bottom: 2px;
        }

        .kop-sub {
            font-size: 0.85rem;
            color: #334155;
            line-height: 1.4;
        }

        .table-data th, .table-data td {
            padding: 6px 10px;
            font-size: 0.88rem;
            vertical-align: top;
        }

        .section-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: #064e3b;
            background: #ecfdf5;
            padding: 6px 10px;
            border-left: 4px solid #059669;
            margin-top: 15px;
            margin-bottom: 8px;
        }

        .btn-print-floating {
            position: fixed;
            top: 20px;
            right: 25px;
            z-index: 9999;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .sheet {
                box-shadow: none;
                width: 100%;
                min-height: auto;
                padding: 0;
            }
            .btn-print-floating, .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Print Button -->
    <div class="btn-print-floating no-print d-flex gap-2">
        <button onclick="window.print()" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow">
            <i class="bi bi-printer-fill me-1"></i> Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary px-3 py-2 rounded-pill shadow">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="sheet">
        <!-- KOP SURAT -->
        <div class="kop-header d-flex align-items-center gap-3">
            <div class="rounded-3 bg-success text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px; background: #064e3b !important;">
                <i class="bi bi-bank fs-1"></i>
            </div>
            <div class="flex-grow-1 text-center">
                <div class="kop-title">LEMBAGA PENDIDIKAN ISLAM DAYAH AL-IKHLAS</div>
                <div class="fw-bold text-dark" style="font-size: 1.05rem; letter-spacing: 0.05em;">AL-AZIZIYAH SAMALANGA</div>
                <div class="kop-sub">
                    Gampong Sangso, Kecamatan Samalanga, Kabupaten Bireuen, Provinsi Aceh - Kode Pos 24264<br>
                    Kontak Sekretariat: <?= html_escape($profil->no_hp ?? '0812-xxxx-xxxx'); ?> &bull; Email: <?= html_escape($profil->email ?? 'dayah.alikhlas.aziziyah@gmail.com'); ?>
                </div>
            </div>
        </div>

        <!-- JUDUL SURAT -->
        <div class="text-center mb-3">
            <h5 class="fw-bold mb-1 text-uppercase text-decoration-underline" style="letter-spacing: 0.05em;">TANDA BUKTI PENDAFTARAN SANTRI BARU</h5>
            <small class="text-muted">Tahun Ajaran <?= html_escape($pendaftar->nama_tahun_ajaran ?: '2026/2027'); ?></small>
        </div>

        <!-- Nomor & Tanggal -->
        <div class="d-flex justify-content-between align-items-center mb-3 p-2 px-3 border rounded-2 bg-light" style="font-size: 0.88rem;">
            <div>Nomor Pendaftaran: <strong class="text-success fs-6"><?= html_escape($pendaftar->no_pendaftaran); ?></strong></div>
            <div>Tanggal Daftar: <strong><?= format_tanggal_indo($pendaftar->tanggal_daftar, true); ?></strong></div>
        </div>

        <!-- 1. DATA CALON SANTRI -->
        <div class="section-title">A. DATA CALON SANTRI</div>
        <table class="table table-sm table-bordered table-data mb-2">
            <tr>
                <td style="width: 28%;" class="fw-semibold bg-light">Nama Lengkap</td>
                <td style="width: 72%;" class="fw-bold text-dark"><?= html_escape($pendaftar->nama); ?></td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">NIK (No. KTP/KK)</td>
                <td><?= html_escape($pendaftar->nik ?: '-'); ?></td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Jenis Kelamin</td>
                <td><?= $pendaftar->jenis_kelamin === 'L' ? 'Laki-laki (Santriwan)' : 'Perempuan (Santriwati)'; ?></td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Tempat, Tanggal Lahir</td>
                <td><?= html_escape($pendaftar->tempat_lahir); ?>, <?= format_tanggal_indo($pendaftar->tanggal_lahir); ?></td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Anak Ke / Jumlah Saudara</td>
                <td>Anak ke-<?= $pendaftar->anak_ke ?: '-'; ?> dari <?= $pendaftar->jumlah_saudara ?: '-'; ?> bersaudara</td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Asal Sekolah Terakhir</td>
                <td><?= html_escape($pendaftar->asal_sekolah ?: '-'); ?></td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Jenjang Tujuan</td>
                <td class="fw-bold text-success">Jenjang <?= html_escape($pendaftar->nama_jenjang ?: '-'); ?></td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Alamat Asal Santri</td>
                <td>
                    Gampong <?= html_escape($pendaftar->asal_gampong ?: '-'); ?>, 
                    Kec. <?= html_escape($pendaftar->asal_kecamatan ?: '-'); ?>, 
                    Kab. <?= html_escape($pendaftar->asal_kabupaten ?: '-'); ?>, 
                    Prov. <?= html_escape($pendaftar->asal_provinsi ?: 'Aceh'); ?>
                </td>
            </tr>
        </table>

        <!-- 2. DATA ORANG TUA / WALI -->
        <div class="section-title">B. DATA ORANG TUA / WALI</div>
        <table class="table table-sm table-bordered table-data mb-2">
            <tr>
                <td style="width: 28%;" class="fw-semibold bg-light">Nama Ayah Kandung</td>
                <td style="width: 72%;"><?= html_escape($pendaftar->nama_ayah); ?> (Pekerjaan: <?= html_escape($pendaftar->pekerjaan_ayah ?: '-'); ?>)</td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Nama Ibu Kandung</td>
                <td><?= html_escape($pendaftar->nama_ibu); ?> (Pekerjaan: <?= html_escape($pendaftar->pekerjaan_ibu ?: '-'); ?>)</td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">Alamat Domisili Orang Tua</td>
                <td><?= html_escape($pendaftar->alamat_ortu ?: '-'); ?></td>
            </tr>
            <tr>
                <td class="fw-semibold bg-light">No. HP / WhatsApp Orang Tua</td>
                <td class="fw-bold"><?= html_escape($pendaftar->no_hp_ortu); ?></td>
            </tr>
            <?php if (!empty($pendaftar->nama_wali)): ?>
                <tr>
                    <td class="fw-semibold bg-light">Nama Wali / Pekerjaan</td>
                    <td><?= html_escape($pendaftar->nama_wali); ?> (<?= html_escape($pendaftar->pekerjaan_wali ?: '-'); ?>)</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- 3. KELENGKAPAN BERKAS -->
        <div class="section-title">C. KELENGKAPAN BERKAS PERSYARATAN</div>
        <div class="row g-2 mb-3" style="font-size: 0.85rem;">
            <?php 
                $berkas_map = array();
                if (!empty($berkas)) {
                    foreach ($berkas as $b) {
                        $berkas_map[$b->jenis_berkas] = $b->nama_file;
                    }
                }
            ?>
            <div class="col-6">
                <div class="p-2 border rounded-1 d-flex align-items-center gap-2">
                    <i class="bi <?= isset($berkas_map['foto']) ? 'bi-check-square-fill text-success' : 'bi-square text-muted'; ?> fs-5"></i>
                    <span>Pas Foto 3x4 / 2x3 (<?= isset($berkas_map['foto']) ? 'Terlampir' : 'Belum'; ?>)</span>
                </div>
            </div>
            <div class="col-6">
                <div class="p-2 border rounded-1 d-flex align-items-center gap-2">
                    <i class="bi <?= isset($berkas_map['kk']) ? 'bi-check-square-fill text-success' : 'bi-square text-muted'; ?> fs-5"></i>
                    <span>Fotokopi Kartu Keluarga (<?= isset($berkas_map['kk']) ? 'Terlampir' : 'Belum'; ?>)</span>
                </div>
            </div>
            <div class="col-6">
                <div class="p-2 border rounded-1 d-flex align-items-center gap-2">
                    <i class="bi <?= isset($berkas_map['ktp_ortu']) ? 'bi-check-square-fill text-success' : 'bi-square text-muted'; ?> fs-5"></i>
                    <span>Fotokopi KTP Orang Tua (<?= isset($berkas_map['ktp_ortu']) ? 'Terlampir' : 'Belum'; ?>)</span>
                </div>
            </div>
            <div class="col-6">
                <div class="p-2 border rounded-1 d-flex align-items-center gap-2">
                    <i class="bi <?= isset($berkas_map['ijazah']) ? 'bi-check-square-fill text-success' : 'bi-square text-muted'; ?> fs-5"></i>
                    <span>Fotokopi Ijazah / SKL (<?= isset($berkas_map['ijazah']) ? 'Terlampir' : 'Belum'; ?>)</span>
                </div>
            </div>
        </div>

        <!-- Catatan Panitia -->
        <div class="p-2 bg-light border rounded-1 mb-4" style="font-size: 0.78rem; line-height: 1.5;">
            <strong>Catatan Penting:</strong>
            <ol class="mb-0 ps-3">
                <li>Harap membawa lembar bukti pendaftaran ini dan berkas asli saat melakukan verifikasi / daftar ulang di Sekretariat Dayah.</li>
                <li>Calon santri wajib menaati seluruh tata tertib dan ketentuan penerimaan yang berlaku di LPI Dayah Al-Ikhlas Al-Aziziyah.</li>
            </ol>
        </div>

        <!-- TANDA TANGAN -->
        <div class="row text-center mt-4" style="font-size: 0.88rem;">
            <div class="col-6">
                <div>Orang Tua / Wali Santri,</div>
                <div style="height: 60px;"></div>
                <div class="fw-bold text-decoration-underline">( <?= html_escape($pendaftar->pendaftar_nama ?: $pendaftar->nama_ayah); ?> )</div>
            </div>
            <div class="col-6">
                <div>Samalanga, <?= date('d M Y'); ?></div>
                <div class="fw-semibold">Panitia Penerimaan Santri Baru,</div>
                <div style="height: 45px;"></div>
                <div class="fw-bold text-decoration-underline">( Panitia PSB Dayah Al-Ikhlas )</div>
            </div>
        </div>
    </div>

</body>
</html>
