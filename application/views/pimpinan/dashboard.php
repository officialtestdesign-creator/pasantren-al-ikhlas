<div class="container-fluid px-0">
    <!-- Welcome Header Banner -->
    <div class="card card-custom mb-4 border-0 text-white" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #1e40af 100%);">
        <div class="card-body p-4 p-lg-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="badge bg-white text-primary px-3 py-1.5 rounded-pill fw-semibold mb-2">
                    <i class="bi bi-award-fill me-1"></i> Dashboard Eksekutif Pimpinan
                </span>
                <h3 class="fw-bold mb-1">Assalamu'alaikum, Pimpinan Dayah</h3>
                <p class="mb-0 text-white-50" style="max-width: 620px;">
                    Laporan eksekutif berkala perkembangan santri, ketenagaan guru, dan ringkasan institusi LPI Dayah Al-Ikhlas Al-Aziziyah untuk evaluasi kebijakan dan pelaporan dinas.
                </p>
            </div>
            <div>
                <a href="<?= base_url('pimpinan/laporan_dinas'); ?>" class="btn btn-warning fw-bold d-inline-flex align-items-center gap-2 shadow-sm text-dark">
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i> Ringkasan Format Dinas
                </a>
            </div>
        </div>
    </div>

    <!-- Executive KPI Row -->
    <div class="row g-3 mb-4">
        <!-- Total Santri -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Total Santri</span>
                </div>
                <div class="metric-val text-primary"><?= number_format($stats['santri_total'] ?? 0); ?></div>
                <div class="metric-label d-flex justify-content-between mt-1">
                    <span>Laki-laki: <strong><?= $stats['santri_putra'] ?? 0; ?></strong></span>
                    <span>Perempuan: <strong><?= $stats['santri_putri'] ?? 0; ?></strong></span>
                </div>
            </div>
        </div>

        <!-- Dewan Guru -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-success bg-opacity-10 text-success">
                        <i class="bi bi-person-video3"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Ketenagaan</span>
                </div>
                <div class="metric-val text-success"><?= number_format($stats['guru_total'] ?? 0); ?></div>
                <div class="metric-label mt-1">Total Teungku / Guru Pengasuh</div>
            </div>
        </div>

        <!-- Peminat / Pendaftar Baru -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Tahun Ini</span>
                </div>
                <div class="metric-val text-warning"><?= number_format($stats['pendaftar_total'] ?? 0); ?></div>
                <div class="metric-label mt-1">Total Formulir Pendaftaran</div>
            </div>
        </div>

        <!-- Penerimaan SPP Kumulatif -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-info bg-opacity-10 text-info">
                        <i class="bi bi-bank2"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Keuangan</span>
                </div>
                <div class="metric-val text-dark" style="font-size: 1.4rem;"><?= format_rupiah($stats['total_pemasukan'] ?? 0); ?></div>
                <div class="metric-label mt-1">Penerimaan Biaya Masuk & SPP</div>
            </div>
        </div>
    </div>

    <!-- Realisasi Keuangan 1 Tahun Pimpinan -->
    <div class="card card-custom mb-4 border-0 shadow-sm">
        <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 py-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-graph-up text-primary fs-5"></i>
                <div>
                    <span class="fw-bold text-dark d-block">Monitoring Arus Kas Masuk 1 Tahun Penuh (Tahun Anggaran <?= date('Y'); ?>)</span>
                    <small class="text-muted">Realisasi penerimaan SPP bulanan, biaya pendaftaran santri baru, dan sumbangan pembangunan</small>
                </div>
            </div>
            <a href="<?= base_url('pimpinan/rekap_keuangan'); ?>" class="btn btn-primary btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                <i class="bi bi-receipt me-1"></i> Rincian Kas Bulanan
            </a>
        </div>
        <div class="card-body p-3 p-md-4">
            <?php
            $daftar_bln = array(
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            );
            $map_kas = array();
            if (!empty($keuangan_bulanan)) {
                foreach ($keuangan_bulanan as $kb) {
                    $map_kas[$kb->bulan] = (float) $kb->total;
                }
            }
            $curr_bln = (int) date('m');
            ?>
            <div class="row g-2 g-md-3">
                <?php foreach ($daftar_bln as $num => $nama_bln): 
                    $nominal = isset($map_kas[$num]) ? $map_kas[$num] : 0;
                    $is_current = ($num === $curr_bln);
                ?>
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <div class="p-2.5 rounded-3 border text-center transition-all <?= $is_current ? 'border-primary bg-primary bg-opacity-10 shadow-sm' : ($nominal > 0 ? 'border-success-subtle bg-light' : 'border-light bg-light opacity-75'); ?>">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="badge <?= $is_current ? 'bg-primary text-white' : 'bg-secondary text-white'; ?> rounded-pill" style="font-size: 0.7rem;">
                                    <?= substr($nama_bln, 0, 3); ?>
                                </span>
                                <?php if ($nominal > 0): ?>
                                    <i class="bi bi-check-circle-fill text-success small"></i>
                                <?php else: ?>
                                    <i class="bi bi-dash-circle text-muted small"></i>
                                <?php endif; ?>
                            </div>
                            <div class="fw-bold <?= $nominal > 0 ? 'text-dark' : 'text-muted'; ?>" style="font-size: 0.86rem;">
                                <?= format_rupiah($nominal); ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.72rem;">
                                <?= $is_current ? 'Bulan Berjalan' : ($nominal > 0 ? 'Terealisasi' : 'Belum Ada'); ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Data Tables: Rekapitulasi Kelas & Asal Daerah -->
    <div class="row g-4 mb-4">
        <!-- Rekap Per Kelas -->
        <div class="col-lg-8">
            <div class="card card-custom h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-table text-primary"></i>
                        <span>Distribusi Santri per Kelas & Jenjang</span>
                    </div>
                    <span class="badge bg-light text-dark border">Tahun Ajaran <?= html_escape($tahun_ajaran_aktif->nama ?? '2026/2027'); ?></span>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Jenjang</th>
                                <th>Kelas</th>
                                <th class="text-center">Putra (L)</th>
                                <th class="text-center">Putri (P)</th>
                                <th class="text-center">Total Santri</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rekap_kelas)): ?>
                                <?php foreach ($rekap_kelas as $rk): ?>
                                    <tr>
                                        <td><span class="badge bg-light text-dark border"><?= html_escape($rk->jenjang); ?></span></td>
                                        <td class="fw-bold text-dark"><?= html_escape($rk->nama_kelas); ?></td>
                                        <td class="text-center text-primary fw-semibold"><?= (int) $rk->laki_laki; ?></td>
                                        <td class="text-center text-danger fw-semibold"><?= (int) $rk->perempuan; ?></td>
                                        <td class="text-center fw-bold text-success"><?= (int) $rk->jumlah; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        Belum ada data distribusi kelas.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Asal Daerah Santri -->
        <div class="col-lg-4">
            <div class="card card-custom h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-danger"></i>
                        <span>Sebaran Asal Kabupaten Santri</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <?php if (!empty($asal_santri)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($asal_santri as $as): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-2 py-2.5">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-pin-map text-secondary"></i>
                                        <span class="fw-semibold text-dark"><?= html_escape($as->kabupaten); ?></span>
                                    </div>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill fw-bold">
                                        <?= $as->total; ?> Santri
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            Data asal kabupaten belum tercatat.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
