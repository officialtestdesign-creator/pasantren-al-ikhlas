<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', serif; color: #000; background: #fff; padding: 20px; }
        .header-kop { border-bottom: 3px double #000; padding-bottom: 12px; margin-bottom: 20px; text-align: center; }
        .header-kop h3 { font-size: 18pt; font-weight: bold; margin-bottom: 2px; text-transform: uppercase; }
        .header-kop h4 { font-size: 14pt; font-weight: bold; margin-bottom: 4px; }
        .header-kop p { font-size: 10pt; margin-bottom: 0; }
        .table-cetak { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table-cetak th, .table-cetak td { border: 1px solid #000; padding: 6px 10px; font-size: 10.5pt; }
        .table-cetak th { background-color: #f2f2f2 !important; text-align: center; }
        .ttd-box { margin-top: 40px; float: right; width: 250px; text-align: center; font-size: 11pt; }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>

    <div class="no-print mb-3 text-end">
        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i> Cetak / Simpan PDF</button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm">Tutup</button>
    </div>

    <div class="header-kop">
        <h3>LEMBAGA PENDIDIKAN ISLAM (LPI)</h3>
        <h4>DAYAH AL-IKHLAS AL-AZIZIYAH</h4>
        <p>Gampong Sangso, Kemukiman Samalanga, Kec. Samalanga, Kab. Bireuen, Aceh - Kodepos 24264</p>
        <p>Email: <?= $profil->email ?: 'dayah.alikhlas@gmail.com'; ?> | Kontak: <?= $profil->no_hp ?: '08xxxxxxxxxx'; ?></p>
    </div>

    <div class="text-center my-3">
        <h5 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;"><?= $title; ?></h5>
        <div class="small text-muted">Tahun Ajaran: <?= date('Y') . '/' . (date('Y') + 1); ?></div>
    </div>

    <?php if ($jenis === 'belajar'): ?>
        <table class="table-cetak">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 120px;">Hari</th>
                    <th style="width: 150px;">Waktu (Jam)</th>
                    <th>Kitab Kuning / Bidang Studi</th>
                    <th>Teungku Pengasuh</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($jadwal_belajar)): ?>
                    <tr><td colspan="5" class="text-center py-4">Belum ada jadwal tersusun.</td></tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($jadwal_belajar as $jb): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center fw-bold"><?= $jb->hari; ?></td>
                            <td class="text-center"><?= substr($jb->jam_mulai, 0, 5); ?> - <?= substr($jb->jam_selesai, 0, 5); ?> WIB</td>
                            <td class="fw-bold"><?= htmlspecialchars($jb->nama_bidang_studi); ?></td>
                            <td><?= $jb->nama_guru ? htmlspecialchars($jb->nama_guru) : '-'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php else: ?>
        <table class="table-cetak">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 180px;">Waktu (WIB)</th>
                    <th>Agenda / Kegiatan Santri</th>
                    <th>Keterangan / Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($jadwal_kegiatan as $jk): ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center fw-bold"><?= substr($jk->jam_mulai, 0, 5); ?> - <?= substr($jk->jam_selesai, 0, 5); ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($jk->kegiatan); ?></td>
                        <td><?= htmlspecialchars($jk->keterangan ?: '-'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="clearfix">
        <div class="ttd-box">
            Samalanga, <?= format_tanggal(date('Y-m-d')); ?><br>
            Pimpinan Dayah Al-Ikhlas,<br><br><br><br>
            <strong><u><?= $profil->nama_pimpinan ?: 'Tgk. H. ...'; ?></u></strong>
        </div>
    </div>

</body>
</html>
