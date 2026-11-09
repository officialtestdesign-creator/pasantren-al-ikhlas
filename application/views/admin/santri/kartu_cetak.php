<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Biodata Santri - <?= html_escape($s->no_induk); ?> - <?= html_escape($s->nama); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="btn-print-floating no-print d-flex gap-2">
        <button onclick="window.print()" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow">
            <i class="bi bi-printer-fill me-1"></i> Cetak Dokumen (PDF)
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

        <!-- JUDUL -->
        <div class="text-center mb-3">
            <h5 class="fw-bold mb-1 text-uppercase text-decoration-underline" style="letter-spacing: 0.05em;">KARTU BIODATA SANTRI RESMI</h5>
            <small class="text-muted">Nomor Induk Santri (NIS): <strong><?= html_escape($s->no_induk); ?></strong></small>
        </div>

        <div class="d-flex gap-4 mb-3 align-items-start">
            <div class="flex-shrink-0">
                <?php if (!empty($s->foto) && file_exists(FCPATH . 'uploads/berkas/' . $s->foto)): ?>
                    <img src="<?= base_url('uploads/berkas/' . $s->foto); ?>" class="rounded-2 border object-fit-cover" style="width: 110px; height: 140px;" alt="Foto Santri">
                <?php else: ?>
                    <div class="rounded-2 border bg-light d-flex align-items-center justify-content-center text-muted" style="width: 110px; height: 140px; font-size: 0.8rem;">
                        Pas Foto 3x4
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex-grow-1">
                <table class="table table-sm table-bordered table-data mb-0">
                    <tr>
                        <td style="width: 32%;" class="bg-light fw-semibold">Nama Lengkap</td>
                        <td class="fw-bold text-dark fs-6"><?= html_escape($s->nama); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light fw-semibold">NIK</td>
                        <td class="font-monospace"><?= html_escape($s->nik ?: '-'); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light fw-semibold">Jenis Kelamin</td>
                        <td><?= $s->jenis_kelamin === 'L' ? 'Laki-laki (Santriwan)' : 'Perempuan (Santriwati)'; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light fw-semibold">Tempat, Tanggal Lahir</td>
                        <td><?= html_escape($s->tempat_lahir); ?>, <?= format_tanggal_indo($s->tanggal_lahir); ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light fw-semibold">Jenjang & Kelas</td>
                        <td class="fw-bold text-success">Jenjang <?= html_escape($s->nama_jenjang ?: '-'); ?> &bull; Kelas <?= html_escape($s->nama_kelas ?: '-'); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- 1. DATA PENDIDIKAN & DOMISILI -->
        <div class="section-title">A. RIWAYAT PENDIDIKAN & TEMPAT TINGGAL</div>
        <table class="table table-sm table-bordered table-data mb-2">
            <tr>
                <td style="width: 32%;" class="bg-light fw-semibold">Asal Sekolah</td>
                <td><?= html_escape($s->asal_sekolah ?: '-'); ?></td>
            </tr>
            <tr>
                <td class="bg-light fw-semibold">Tahun Masuk / Status</td>
                <td>Tahun <?= html_escape($s->tahun_masuk ?: '-'); ?> &bull; Status: <strong class="text-uppercase"><?= html_escape($s->status); ?></strong></td>
            </tr>
            <tr>
                <td class="bg-light fw-semibold">Alamat Asal</td>
                <td>
                    Gampong <?= html_escape($s->asal_gampong ?: '-'); ?>, 
                    Kec. <?= html_escape($s->asal_kecamatan ?: '-'); ?>, 
                    Kab. <?= html_escape($s->asal_kabupaten ?: '-'); ?>, 
                    Prov. <?= html_escape($s->asal_provinsi ?: 'Aceh'); ?>
                </td>
            </tr>
            <tr>
                <td class="bg-light fw-semibold">Wali Kelas Pengampu</td>
                <td><?= html_escape($s->nama_wali_kelas ?: '-'); ?></td>
            </tr>
        </table>

        <!-- 2. DATA ORANG TUA / WALI -->
        <div class="section-title">B. DATA ORANG TUA / WALI</div>
        <table class="table table-sm table-bordered table-data mb-3">
            <tr>
                <td style="width: 32%;" class="bg-light fw-semibold">Nama Ayah Kandung</td>
                <td><?= html_escape($s->nama_ayah); ?> (Pekerjaan: <?= html_escape($s->pekerjaan_ayah ?: '-'); ?>)</td>
            </tr>
            <tr>
                <td class="bg-light fw-semibold">Nama Ibu Kandung</td>
                <td><?= html_escape($s->nama_ibu); ?> (Pekerjaan: <?= html_escape($s->pekerjaan_ibu ?: '-'); ?>)</td>
            </tr>
            <tr>
                <td class="bg-light fw-semibold">Alamat Orang Tua</td>
                <td><?= html_escape($s->alamat_ortu ?: '-'); ?></td>
            </tr>
            <tr>
                <td class="bg-light fw-semibold">No. HP / WhatsApp Ortu</td>
                <td class="fw-bold"><?= html_escape($s->no_hp_ortu ?: '-'); ?></td>
            </tr>
            <?php if (!empty($s->nama_wali)): ?>
                <tr>
                    <td class="bg-light fw-semibold">Nama Wali / Kontak</td>
                    <td><?= html_escape($s->nama_wali); ?> (HP: <?= html_escape($s->no_hp_wali ?: '-'); ?>)</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- TANDA TANGAN RESMI -->
        <div class="row text-center mt-5" style="font-size: 0.88rem;">
            <div class="col-6">
                <div>Santri yang bersangkutan,</div>
                <div style="height: 60px;"></div>
                <div class="fw-bold text-decoration-underline">( <?= html_escape($s->nama); ?> )</div>
            </div>
            <div class="col-6">
                <div>Samalanga, <?= date('d M Y'); ?></div>
                <div class="fw-semibold">Pimpinan / Sekretariat Dayah,</div>
                <div style="height: 45px;"></div>
                <div class="fw-bold text-decoration-underline">( <?= html_escape($profil->nama_pimpinan ?: 'Pimpinan Dayah'); ?> )</div>
            </div>
        </div>
    </div>

</body>
</html>
