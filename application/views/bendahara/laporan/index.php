<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Laporan Penerimaan Kas & Keuangan Dayah</h4>
            <p class="text-muted small mb-0">Rekapitulasi pembukuan kas masuk, SPP bulanan, uang pendaftaran, dan sumbangan wajib.</p>
        </div>
        <div>
            <a href="<?= base_url('bendahara/laporan/ekspor_csv?tanggal_awal=' . ($filter['tanggal_awal'] ?? '') . '&tanggal_akhir=' . ($filter['tanggal_akhir'] ?? '') . '&jenis_id=' . ($filter['jenis_id'] ?? '')); ?>" class="btn btn-success fw-bold shadow-sm d-inline-flex align-items-center gap-1">
                <i class="bi bi-file-earmark-excel"></i> Ekspor Laporan Kas (Excel/CSV)
            </a>
        </div>
    </div>

    <!-- Filter Rentang Tanggal -->
    <div class="card card-custom mb-4">
        <div class="card-body p-3">
            <form action="<?= base_url('bendahara/laporan'); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" class="form-control form-control-sm" value="<?= html_escape($filter['tanggal_awal']); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control form-control-sm" value="<?= html_escape($filter['tanggal_akhir']); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Pos Biaya</label>
                    <select name="jenis_id" class="form-select form-select-sm">
                        <option value="">-- Semua Pos Penerimaan --</option>
                        <?php if (!empty($jenis_list)): ?>
                            <?php foreach ($jenis_list as $jl): ?>
                                <option value="<?= $jl->id; ?>" <?= ($filter['jenis_id'] ?? '') == $jl->id ? 'selected' : ''; ?>>
                                    <?= html_escape($jl->nama); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold w-100" style="margin-top: 25px;">
                        <i class="bi bi-filter"></i> Tampilkan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Breakdown Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-custom p-4 border-start border-4 border-success">
                <div class="text-muted small fw-semibold">Total Seluruh Kas Masuk</div>
                <div class="display-6 fw-bold text-success mt-1" style="font-size: 1.8rem;"><?= format_rupiah($total_kas); ?></div>
                <small class="text-muted">Periode <?= format_tanggal_indo($filter['tanggal_awal']); ?> s/d <?= format_tanggal_indo($filter['tanggal_akhir']); ?></small>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom p-3 h-100">
                <span class="fw-bold small text-secondary d-block mb-2">Rincian Per Pos Penerimaan:</span>
                <div class="row g-2">
                    <?php if (!empty($by_jenis)): ?>
                        <?php foreach ($by_jenis as $nama_jenis => $nominal): ?>
                            <div class="col-sm-6">
                                <div class="p-2 border rounded-2 bg-light d-flex justify-content-between align-items-center">
                                    <span class="small fw-semibold text-dark"><?= html_escape($nama_jenis); ?>:</span>
                                    <span class="fw-bold text-success"><?= format_rupiah($nominal); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-muted small">Belum ada rincian transaksi pada periode ini.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Details -->
    <div class="card card-custom">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-bold">Rincian Pembukuan Kas (<?= count($riwayat); ?> Transaksi)</span>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>No. Kuitansi</th>
                        <th>Tanggal Bayar</th>
                        <th>NIS & Santri</th>
                        <th>Kelas</th>
                        <th>Pos Biaya</th>
                        <th>Periode</th>
                        <th>Jumlah Kas Masuk</th>
                        <th class="text-center">Kuitansi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riwayat)): ?>
                        <?php foreach ($riwayat as $r): ?>
                            <tr>
                                <td><span class="badge bg-light text-dark border font-monospace"><?= html_escape($r->no_kuitansi); ?></span></td>
                                <td><?= format_tanggal_indo($r->tanggal_bayar); ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($r->nama_santri); ?></div>
                                    <small class="text-muted font-monospace"><?= html_escape($r->no_induk); ?></small>
                                </td>
                                <td><?= html_escape($r->nama_kelas ?: '-'); ?></td>
                                <td><span class="fw-semibold text-dark"><?= html_escape($r->nama_jenis); ?></span></td>
                                <td><?= $r->bulan ? nama_bulan($r->bulan) . ' ' . $r->tahun : '-'; ?></td>
                                <td class="fw-bold text-success"><?= format_rupiah($r->jumlah); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('bendahara/spp/kuitansi/' . $r->id); ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-2.5">
                                        <i class="bi bi-printer me-1"></i> Cetak
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Tidak ada transaksi kas pada periode yang dipilih.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
