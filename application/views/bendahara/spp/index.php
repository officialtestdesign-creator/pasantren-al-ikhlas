<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Buku Kas & Transaksi Pembayaran</h4>
            <p class="text-muted small mb-0">Catatan penerimaan SPP santri bulanan, biaya masuk, dan sumbangan wajib Dayah Al-Ikhlas.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('bendahara/kartu_spp'); ?>" class="btn btn-outline-success fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-credit-card-2-front"></i> Kartu SPP Digital
            </a>
            <a href="<?= base_url('bendahara/tunggakan'); ?>" class="btn btn-outline-warning fw-semibold d-inline-flex align-items-center gap-1 shadow-sm text-dark">
                <i class="bi bi-exclamation-octagon"></i> Rekap Tunggakan
            </a>
            <a href="<?= base_url('bendahara/spp/input'); ?>" class="btn btn-success fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-plus-circle-fill"></i> Input Pembayaran Baru
            </a>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="card card-custom mb-4 border-start border-4 border-success">
        <div class="card-body p-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="metric-icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Penerimaan Kas (Sesuai Filter)</div>
                    <div class="fs-3 fw-bold text-success"><?= format_rupiah($total_nominal_terfilter); ?></div>
                </div>
            </div>
            <div>
                <span class="badge bg-light text-secondary border px-3 py-2">
                    <?= count($riwayat); ?> Transaksi Tercatat
                </span>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-3">
            <form action="<?= current_url(); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <select name="jenis_id" class="form-select form-select-sm">
                        <option value="">-- Semua Jenis Biaya --</option>
                        <?php if (!empty($jenis_list)): ?>
                            <?php foreach ($jenis_list as $jl): ?>
                                <option value="<?= $jl->id; ?>" <?= ($filter['jenis_pembayaran_id'] ?? '') == $jl->id ? 'selected' : ''; ?>>
                                    <?= html_escape($jl->nama); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="bulan" class="form-select form-select-sm">
                        <option value="">-- Semua Bulan --</option>
                        <?php for ($b = 1; $b <= 12; $b++): ?>
                            <option value="<?= $b; ?>" <?= ($filter['bulan'] ?? '') == $b ? 'selected' : ''; ?>>
                                <?= nama_bulan($b); ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="tahun" class="form-select form-select-sm">
                        <?php for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++): ?>
                            <option value="<?= $y; ?>" <?= ($filter['tahun'] ?? date('Y')) == $y ? 'selected' : ''; ?>><?= $y; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari santri, no. kuitansi..." value="<?= html_escape($filter['keyword'] ?? ''); ?>">
                </div>

                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-success fw-semibold w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <a href="<?= current_url(); ?>" class="btn btn-sm btn-outline-secondary" title="Reset">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card card-custom">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-receipt-cutoff text-success"></i>
                <span>Riwayat Penerimaan Pembayaran</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>No. Kuitansi</th>
                        <th>Tanggal Bayar</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Pos Pembayaran</th>
                        <th>Periode</th>
                        <th>Jumlah Nominal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riwayat)): ?>
                        <?php foreach ($riwayat as $row): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace fw-bold">
                                        <?= html_escape($row->no_kuitansi ?: '-'); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="small"><?= format_tanggal_indo($row->tanggal_bayar); ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($row->nama_santri); ?></div>
                                    <small class="text-muted">NIS: <?= html_escape($row->no_induk); ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><?= html_escape($row->nama_kelas ?: '-'); ?></span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= html_escape($row->nama_jenis); ?></span>
                                </td>
                                <td>
                                    <?= $row->bulan ? '<span class="text-success fw-semibold">' . nama_bulan($row->bulan) . ' ' . $row->tahun . '</span>' : ($row->tahap ? 'Tahap ' . $row->tahap : '-'); ?>
                                </td>
                                <td class="fw-bold text-success fs-6">
                                    <?= format_rupiah($row->jumlah); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('bendahara/spp/kuitansi/' . $row->id); ?>" target="_blank" class="btn btn-outline-success" title="Cetak Kuitansi">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <a href="<?= base_url('bendahara/kartu_spp/detail/' . $row->santri_id); ?>" class="btn btn-outline-primary" title="Buka Kartu SPP">
                                            <i class="bi bi-credit-card-2-front"></i>
                                        </a>
                                        <a href="<?= user_role() === 'admin' ? base_url('admin/pembayaran/hapus/' . $row->id) : base_url('bendahara/spp/hapus/' . $row->id); ?>" 
                                           data-name="Kuitansi <?= html_escape($row->no_kuitansi ?: ('#' . $row->id)); ?> - <?= html_escape($row->nama_santri); ?>"
                                           data-sub="Nominal: <?= format_rupiah($row->jumlah); ?> &bull; Santri: <?= html_escape($row->nama_santri); ?>"
                                           data-title="Batalkan Transaksi Pembayaran"
                                           class="btn btn-outline-danger" 
                                           title="Batalkan Transaksi">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-wallet2 fs-2 d-block mb-2"></i>
                                Belum ada transaksi pembayaran yang tercatat sesuai filter.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
