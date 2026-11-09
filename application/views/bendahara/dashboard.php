<div class="container-fluid px-0">
    <!-- Welcome Header Banner -->
    <div class="card card-custom mb-4 border-0 text-white" style="background: linear-gradient(135deg, #b45309 0%, #d97706 60%, #78350f 100%);">
        <div class="card-body p-4 p-lg-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="badge bg-white text-dark px-3 py-1.5 rounded-pill fw-semibold mb-2">
                    <i class="bi bi-wallet2 me-1 text-warning"></i> Modul Keuangan & Bendahara
                </span>
                <h3 class="fw-bold mb-1">Selamat Bertugas, <?= html_escape(user_name()); ?></h3>
                <p class="mb-0 text-white-50" style="max-width: 600px;">
                    Kelola penerimaan SPP santri bulanan, sumbangan wajib per tahap, pemantauan tunggakan, dan pencetakan kuitansi resmi dayah.
                </p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= base_url('bendahara/spp'); ?>" class="btn btn-light fw-bold d-inline-flex align-items-center gap-2 shadow-sm text-dark">
                    <i class="bi bi-plus-circle-fill text-warning"></i> Input Pembayaran Baru
                </a>
                <a href="<?= base_url('bendahara/kartu_spp'); ?>" class="btn btn-outline-light fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-person-lines-fill"></i> Kartu SPP Santri
                </a>
            </div>
        </div>
    </div>

    <!-- Financial KPI Cards -->
    <div class="row g-3 mb-4">
        <!-- Pemasukan Bulan Berjalan -->
        <div class="col-sm-6 col-xl-4">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <span class="badge bg-light text-secondary border"><?= nama_bulan(date('m')); ?> <?= date('Y'); ?></span>
                </div>
                <div class="metric-val text-dark"><?= format_rupiah($stats['spp_bulan_ini'] ?? 0); ?></div>
                <div class="metric-label mt-1">Total Penerimaan Bulan Ini</div>
            </div>
        </div>

        <!-- Total Keseluruhan Kas -->
        <div class="col-sm-6 col-xl-4">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-success bg-opacity-10 text-success">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Akumulasi</span>
                </div>
                <div class="metric-val text-success"><?= format_rupiah($stats['total_pemasukan'] ?? 0); ?></div>
                <div class="metric-label mt-1">Total Seluruh Penerimaan Terinput</div>
            </div>
        </div>

        <!-- Jumlah Santri Aktif Tagihan -->
        <div class="col-sm-6 col-xl-4">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Wajib SPP</span>
                </div>
                <div class="metric-val text-primary"><?= number_format($stats['santri_total'] ?? 0); ?> Santri</div>
                <div class="metric-label mt-1">Santri Aktif Terdaftar</div>
            </div>
        </div>
    </div>

    <!-- Realisasi Keuangan 1 Tahun Berjalan -->
    <div class="card card-custom mb-4 border-0 shadow-sm">
        <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 py-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-graph-up-arrow text-success fs-5"></i>
                <span class="fw-bold text-dark">Ringkasan Realisasi Penerimaan Kas 1 Tahun Penuh (Januari - Desember <?= date('Y'); ?>)</span>
            </div>
            <a href="<?= base_url('bendahara/laporan'); ?>" class="btn btn-outline-success btn-sm rounded-pill fw-semibold">
                <i class="bi bi-journal-text me-1"></i> Buka Buku Kas & Laporan Lengkap
            </a>
        </div>
        <div class="card-body p-3 p-md-4">
            <?php
            $daftar_bln = array(
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            );
            $map_bulanan = array();
            $map_trx = array();
            if (!empty($keuangan_bulanan)) {
                foreach ($keuangan_bulanan as $kb) {
                    $map_bulanan[$kb->bulan] = (float) $kb->total;
                    $map_trx[$kb->bulan] = (int) ($kb->total_transaksi ?? 0);
                }
            }
            $curr_bln = (int) date('m');
            ?>
            <div class="row g-2 g-md-3">
                <?php foreach ($daftar_bln as $num => $nama_bln): 
                    $nominal = isset($map_bulanan[$num]) ? $map_bulanan[$num] : 0;
                    $trx = isset($map_trx[$num]) ? $map_trx[$num] : 0;
                    $is_current = ($num === $curr_bln);
                ?>
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <div class="p-2.5 rounded-3 border text-center transition-all <?= $is_current ? 'border-warning bg-warning bg-opacity-10 shadow-sm' : ($nominal > 0 ? 'border-success-subtle bg-light' : 'border-light bg-light opacity-75'); ?>">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="badge <?= $is_current ? 'bg-warning text-dark' : 'bg-secondary text-white'; ?> rounded-pill" style="font-size: 0.7rem;">
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
                                <?= $trx > 0 ? $trx . ' transaksi' : '0 transaksi'; ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Breakdown Jenis Pembayaran & Recent Transactions -->
    <div class="row g-4 mb-4">
        <!-- Breakdown -->
        <div class="col-lg-4">
            <div class="card card-custom h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-pie-chart text-warning"></i>
                        <span>Rekap Per Kategori Biaya</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <?php if (!empty($breakdown_jenis)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($breakdown_jenis as $bj): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-2 py-3">
                                    <div>
                                        <div class="fw-bold text-dark"><?= html_escape($bj->nama); ?></div>
                                        <small class="text-muted"><?= $bj->total_transaksi; ?> kali transaksi</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold text-success"><?= format_rupiah($bj->total_nominal); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            Belum ada rekap kategori pembayaran.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-lg-8">
            <div class="card card-custom h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-clock-history text-success"></i>
                        <span>Catatan Pembayaran Terbaru</span>
                    </div>
                    <a href="<?= base_url('bendahara/spp'); ?>" class="small text-decoration-none text-success fw-semibold">
                        Lihat Buku Kas <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>No. Kuitansi</th>
                                <th>Santri / Kelas</th>
                                <th>Jenis / Periode</th>
                                <th>Jumlah</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_pembayaran)): ?>
                                <?php foreach ($recent_pembayaran as $pb): ?>
                                    <tr>
                                        <td><span class="badge bg-light text-dark border"><?= html_escape($pb->no_kuitansi ?: '-'); ?></span></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?= html_escape($pb->nama_santri ?: 'Santri #' . $pb->santri_id); ?></div>
                                            <small class="text-muted"><?= html_escape($pb->nama_kelas ?: 'Belum ada kelas'); ?></small>
                                        </td>
                                        <td>
                                            <?= $pb->bulan ? 'SPP ' . nama_bulan($pb->bulan) . ' ' . $pb->tahun : html_escape($pb->nama_jenis); ?>
                                        </td>
                                        <td class="fw-bold text-success"><?= format_rupiah($pb->jumlah); ?></td>
                                        <td class="text-muted small"><?= format_tanggal_indo($pb->tanggal_bayar); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-receipt-cutoff fs-3 d-block mb-1"></i>
                                        Belum ada data pembayaran terinput.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
