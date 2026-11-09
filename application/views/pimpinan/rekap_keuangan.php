<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-graph-up-arrow text-success me-2"></i>Monitoring Arus Penerimaan Kas Dayah
        </h4>
        <p class="text-muted small mb-0">Laporan eksekutif realisasi penerimaan SPP bulanan santri dan sumbangan wajib tahun berjalan.</p>
    </div>
    <div>
        <a href="<?= base_url('bendahara/laporan/ekspor_csv'); ?>" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-medium">
            <i class="bi bi-download me-1"></i>Unduh Rekap Kas (CSV)
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Penerimaan SPP Bulan Ini</div>
            <div class="fs-4 fw-bold text-success mt-1"><?= format_rupiah($stats['spp_bulan_ini']); ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Total Akumulasi Kas Masuk</div>
            <div class="fs-4 fw-bold text-dark mt-1"><?= format_rupiah($stats['total_pemasukan']); ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Tahun Anggaran Berjalan</div>
            <div class="fs-4 fw-bold text-primary mt-1"><?= $tahun_terpilih; ?></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Tabel Realisasi Bulanan -->
    <div class="col-lg-5">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-calendar3 text-success me-2"></i>Realisasi Kas Masuk per Bulan</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-4">Bulan</th>
                            <th class="text-end pe-4">Total Kas Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $daftar_bulan = array(
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        );
                        $map_kas = array();
                        foreach ($keuangan_bulanan as $kb) {
                            $map_kas[$kb->bulan] = (float)$kb->total;
                        }
                        $total_thn = 0;
                        ?>
                        <?php foreach ($daftar_bulan as $num => $nama_bln): 
                            $nom = isset($map_kas[$num]) ? $map_kas[$num] : 0;
                            $total_thn += $nom;
                        ?>
                            <tr>
                                <td class="ps-4 fw-medium text-dark">
                                    <span class="badge rounded-circle bg-light text-secondary border me-1.5"><?= $num; ?></span>
                                    <?= $nama_bln; ?>
                                </td>
                                <td class="text-end pe-4 font-monospace <?= $nom > 0 ? 'fw-bold text-success' : 'text-muted'; ?>">
                                    <?= format_rupiah($nom); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-light fw-bold">
                            <td class="ps-4 text-dark">TOTAL TAHUN <?= $tahun_terpilih; ?>:</td>
                            <td class="text-end pe-4 text-success fs-6 font-monospace"><?= format_rupiah($total_thn); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi Terbaru -->
    <div class="col-lg-7">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-receipt-cutoff text-success me-2"></i>10 Transaksi Pembayaran Terakhir</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-3">No. Kuitansi</th>
                            <th>Nama Santri</th>
                            <th>Jenis / Bulan</th>
                            <th class="text-end pe-3">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_transaksi)): ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recent_transaksi as $rt): ?>
                                <tr>
                                    <td class="ps-3">
                                        <span class="badge bg-light text-dark border font-monospace"><?= htmlspecialchars($rt->no_kuitansi ?: '-'); ?></span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark small"><?= htmlspecialchars($rt->nama_santri); ?></div>
                                        <span class="text-muted" style="font-size: 0.75rem;">NIS: <?= htmlspecialchars($rt->no_induk); ?></span>
                                    </td>
                                    <td>
                                        <div class="small fw-medium text-dark"><?= htmlspecialchars($rt->nama_jenis); ?></div>
                                        <span class="text-muted" style="font-size: 0.75rem;"><?= $rt->bulan ? $daftar_bulan[$rt->bulan] . ' ' . $rt->tahun : format_tanggal($rt->tanggal_bayar); ?></span>
                                    </td>
                                    <td class="text-end pe-3 font-monospace fw-bold text-success small">
                                        <?= format_rupiah($rt->jumlah); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
