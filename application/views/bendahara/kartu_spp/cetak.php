<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu SPP - <?= html_escape($s->nama); ?> - <?= $tahun; ?></title>
    
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

        .sheet {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 15mm 20mm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .kop-header {
            text-align: center;
            border-bottom: 3px double #064e3b;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .kop-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: #064e3b;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .table-kartu th, .table-kartu td {
            padding: 6px 10px;
            font-size: 0.88rem;
            vertical-align: middle;
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

    <div class="btn-print-floating no-print d-flex align-items-center gap-2">
        <a href="<?= base_url('bendahara/kartu_spp/detail/' . $s->id . '?tahun=' . $tahun); ?>" class="btn btn-dark fw-bold px-3 py-2 rounded-pill shadow d-inline-flex align-items-center gap-1">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow d-inline-flex align-items-center gap-1">
            <i class="bi bi-printer-fill"></i> Cetak Kartu SPP
        </button>
        <button onclick="handleTutupKartu()" class="btn btn-secondary px-3 py-2 rounded-pill shadow" title="Tutup / Kembali">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="sheet">
        <!-- KOP -->
        <div class="kop-header d-flex align-items-center gap-3">
            <div class="rounded-3 bg-success text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 55px; height: 55px; background: #064e3b !important;">
                <i class="bi bi-bank fs-2"></i>
            </div>
            <div class="flex-grow-1 text-center">
                <div class="kop-title">LEMBAGA PENDIDIKAN ISLAM DAYAH AL-IKHLAS</div>
                <div class="fw-bold text-dark" style="font-size: 1rem; letter-spacing: 0.05em;">AL-AZIZIYAH SAMALANGA</div>
                <div class="text-muted" style="font-size: 0.8rem;">
                    Gampong Sangso, Kecamatan Samalanga, Kabupaten Bireuen, Provinsi Aceh &bull; Telp: <?= html_escape($profil->no_hp ?? '-'); ?>
                </div>
            </div>
        </div>

        <!-- JUDUL KARTU -->
        <div class="text-center mb-3">
            <h5 class="fw-bold mb-1 text-uppercase text-decoration-underline" style="letter-spacing: 0.05em;">KARTU SPP SANTRI BULANAN</h5>
            <small class="text-muted">Tahun Anggaran <?= $tahun; ?></small>
        </div>

        <!-- IDENTITAS SANTRI -->
        <div class="p-3 bg-light border rounded-2 mb-3">
            <div class="row g-2" style="font-size: 0.88rem;">
                <div class="col-6">
                    <span class="text-muted">Nama Santri:</span> <strong><?= html_escape($s->nama); ?></strong>
                </div>
                <div class="col-6">
                    <span class="text-muted">Nomor Induk (NIS):</span> <strong class="font-monospace"><?= html_escape($s->no_induk); ?></strong>
                </div>
                <div class="col-6">
                    <span class="text-muted">Kelas / Jenjang:</span> <strong><?= html_escape($s->nama_kelas ?: '-'); ?></strong> (Jenjang <?= html_escape($s->nama_jenjang ?: '-'); ?>)
                </div>
                <div class="col-6">
                    <span class="text-muted">Nama Orang Tua:</span> <strong><?= html_escape($s->nama_ayah); ?></strong>
                </div>
            </div>
        </div>

        <!-- TABEL KARTU SPP -->
        <table class="table table-bordered table-kartu mb-4 text-center">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;" class="text-start">Bulan</th>
                    <th style="width: 20%;">Tanggal Bayar</th>
                    <th style="width: 20%;">Jumlah (Rp)</th>
                    <th style="width: 20%;">Kuitansi / Keterangan</th>
                    <th style="width: 15%;">Paraf Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matrix as $m): ?>
                    <tr>
                        <td><?= $m['bulan_angka']; ?></td>
                        <td class="text-start fw-bold"><?= $m['bulan_nama']; ?></td>
                        <td><?= $m['is_lunas'] ? format_tanggal_indo($m['tanggal_bayar']) : '-'; ?></td>
                        <td class="fw-semibold <?= $m['is_lunas'] ? 'text-success' : 'text-muted'; ?>">
                            <?= $m['is_lunas'] ? format_rupiah($m['jumlah']) : '-'; ?>
                        </td>
                        <td>
                            <?php if ($m['is_lunas']): ?>
                                <small class="font-monospace text-dark"><?= html_escape($m['no_kuitansi']); ?></small>
                            <?php else: ?>
                                <small class="text-muted">-</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $m['is_lunas'] ? '<i class="bi bi-check-lg text-success fs-5"></i>' : ''; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- TANDA TANGAN -->
        <div class="row text-center mt-4" style="font-size: 0.88rem;">
            <div class="col-6">
                <div>Orang Tua / Wali Santri,</div>
                <div style="height: 50px;"></div>
                <div class="fw-bold text-decoration-underline">( <?= html_escape($s->nama_ayah); ?> )</div>
            </div>
            <div class="col-6">
                <div>Samalanga, <?= date('d M Y'); ?></div>
                <div class="fw-semibold">Bendahara Dayah Al-Ikhlas,</div>
                <div style="height: 45px;"></div>
                <div class="fw-bold text-decoration-underline">( Bendahara Dayah )</div>
            </div>
        </div>
    </div>

    <script>
        function handleTutupKartu() {
            if (window.opener && !window.opener.closed) {
                window.close();
            } else {
                window.location.href = '<?= base_url('bendahara/kartu_spp/detail/' . $s->id . '?tahun=' . $tahun); ?>';
            }
        }
    </script>
</body>
</html>
