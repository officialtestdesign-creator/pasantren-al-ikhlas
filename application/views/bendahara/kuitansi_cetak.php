<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran - <?= html_escape($p->no_kuitansi); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background-color: #f1f5f9;
            color: #0f172a;
            padding: 2rem 0;
        }

        .kuitansi-box {
            background: #ffffff;
            width: 210mm;
            margin: 0 auto;
            padding: 15mm 20mm;
            border: 2px solid #064e3b;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .kop-header {
            border-bottom: 2px solid #064e3b;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }

        .kop-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #064e3b;
            text-transform: uppercase;
        }

        .table-kuitansi td {
            padding: 6px 10px;
            font-size: 0.92rem;
            vertical-align: top;
        }

        .btn-print-floating {
            position: fixed;
            top: 20px;
            right: 25px;
            z-index: 9999;
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .kuitansi-box {
                box-shadow: none;
                width: 100%;
                border: 2px solid #064e3b;
                padding: 12mm 15mm;
            }
            .btn-print-floating, .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="btn-print-floating no-print d-flex align-items-center gap-2">
        <a href="<?= base_url('bendahara/spp'); ?>" class="btn btn-dark fw-bold px-3 py-2 rounded-pill shadow d-inline-flex align-items-center gap-1">
            <i class="bi bi-arrow-left"></i> Kembali ke Buku Kas
        </a>
        <button onclick="window.print()" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow d-inline-flex align-items-center gap-1">
            <i class="bi bi-printer-fill"></i> Cetak Kuitansi
        </button>
        <button onclick="handleTutup()" class="btn btn-secondary px-3 py-2 rounded-pill shadow" title="Tutup / Kembali">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="kuitansi-box">
        <!-- KOP -->
        <div class="kop-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 bg-success text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background: #064e3b !important;">
                    <i class="bi bi-bank fs-3"></i>
                </div>
                <div>
                    <div class="kop-title">LPI DAYAH AL-IKHLAS AL-AZIZIYAH</div>
                    <small class="text-muted">Gampong Sangso, Kec. Samalanga, Kab. Bireuen, Aceh &bull; Telp: <?= html_escape($profil->no_hp ?? '-'); ?></small>
                </div>
            </div>
            <div class="text-end">
                <div class="fw-bold text-success fs-5">KUITANSI PEMBAYARAN</div>
                <div class="font-monospace fw-bold text-dark"><?= html_escape($p->no_kuitansi); ?></div>
            </div>
        </div>

        <!-- ISI KUITANSI -->
        <table class="table table-borderless table-kuitansi mb-4">
            <tr>
                <td style="width: 25%;" class="fw-semibold text-secondary">Telah Diterima Dari</td>
                <td style="width: 3%;" class="fw-bold">:</td>
                <td style="width: 72%;" class="fw-bold text-dark fs-6"><?= html_escape($p->nama_santri); ?></td>
            </tr>
            <tr>
                <td class="fw-semibold text-secondary">Nomor Induk / Kelas</td>
                <td class="fw-bold">:</td>
                <td>NIS: <strong><?= html_escape($p->no_induk); ?></strong> &bull; Kelas: <strong><?= html_escape($p->nama_kelas ?: '-'); ?></strong> (Jenjang <?= html_escape($p->nama_jenjang ?: '-'); ?>)</td>
            </tr>
            <tr>
                <td class="fw-semibold text-secondary">Untuk Pembayaran</td>
                <td class="fw-bold">:</td>
                <td class="fw-bold text-success">
                    <?= html_escape($p->nama_jenis); ?>
                    <?= $p->bulan ? 'Bulan ' . nama_bulan($p->bulan) . ' ' . $p->tahun : ''; ?>
                    <?= $p->tahap ? 'Tahap ke-' . $p->tahap : ''; ?>
                </td>
            </tr>
            <?php if (!empty($p->keterangan)): ?>
                <tr>
                    <td class="fw-semibold text-secondary">Keterangan Tambahan</td>
                    <td class="fw-bold">:</td>
                    <td><?= html_escape($p->keterangan); ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="fw-semibold text-secondary">Tanggal Pembayaran</td>
                <td class="fw-bold">:</td>
                <td><?= format_tanggal_indo($p->tanggal_bayar, true); ?></td>
            </tr>
        </table>

        <!-- JUMLAH UANG & TANDA TANGAN -->
        <div class="d-flex justify-content-between align-items-center pt-3 border-top border-2">
            <div class="p-3 bg-light rounded-3 border border-success border-opacity-50">
                <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.75rem;">Jumlah Pembayaran:</small>
                <div class="display-6 fw-bold text-success" style="font-size: 1.8rem;">
                    <?= format_rupiah($p->jumlah); ?>
                </div>
                <small class="text-muted fst-italic">Status: LUNAS &bull; Sah</small>
            </div>

            <div class="text-center" style="width: 220px;">
                <div class="small text-muted">Samalanga, <?= date('d M Y', strtotime($p->tanggal_bayar)); ?></div>
                <div class="small fw-semibold">Bendahara / Petugas Penerima,</div>
                <div style="height: 55px;"></div>
                <div class="fw-bold text-decoration-underline">( <?= html_escape($p->nama_petugas ?: user_name()); ?> )</div>
            </div>
        </div>

        <!-- Action Navigasi Setelah Pembayaran -->
        <div class="no-print mt-4 pt-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
            <a href="<?= base_url('bendahara/spp'); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Selesai & Kembali ke Buku Kas
            </a>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= base_url('bendahara/kartu_spp/detail/' . $p->santri_id); ?>" class="btn btn-outline-success rounded-pill px-3 fw-semibold">
                    <i class="bi bi-credit-card-2-front me-1"></i> Buka Kartu SPP Santri
                </a>
                <a href="<?= base_url('bendahara/spp/input'); ?>" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Input Pembayaran Baru
                </a>
            </div>
        </div>
    </div>

    <script>
        function handleTutup() {
            if (window.opener && !window.opener.closed) {
                window.close();
            } else {
                window.location.href = '<?= base_url('bendahara/spp'); ?>';
            }
        }
    </script>
</body>
</html>
