<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('bendahara/kartu_spp'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div>
                <h4 class="fw-bold text-dark mb-0">Kartu SPP Digital: <?= html_escape($s->nama); ?></h4>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <span class="badge bg-light text-dark border font-monospace">NIS: <?= html_escape($s->no_induk); ?></span>
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold"><?= html_escape($s->nama_kelas ?: 'Belum Ada Kelas'); ?></span>
                    <span class="text-muted small">&bull; Jenjang <?= html_escape($s->nama_jenjang ?: '-'); ?></span>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Year Selector -->
            <form action="<?= base_url('bendahara/kartu_spp/detail/' . $s->id); ?>" method="GET" class="d-flex align-items-center gap-2">
                <select name="tahun" class="form-select form-select-sm fw-bold" onchange="this.form.submit()">
                    <?php for ($y = date('Y') - 2; $y <= date('Y') + 1; $y++): ?>
                        <option value="<?= $y; ?>" <?= $tahun == $y ? 'selected' : ''; ?>>Tahun <?= $y; ?></option>
                    <?php endfor; ?>
                </select>
            </form>

            <a href="<?= base_url('bendahara/kartu_spp/cetak/' . $s->id . '/' . $tahun); ?>" target="_blank" class="btn btn-outline-secondary btn-sm fw-semibold shadow-sm d-flex align-items-center gap-1">
                <i class="bi bi-printer"></i> Cetak Kartu Fisik
            </a>
            <a href="<?= base_url('bendahara/spp/input?santri_id=' . $s->id); ?>" class="btn btn-success btn-sm fw-bold shadow-sm d-flex align-items-center gap-1">
                <i class="bi bi-plus-circle"></i> Input Pembayaran
            </a>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-4">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="text-muted small fw-semibold">Bulan Terbayar (Lunas)</div>
                <div class="fs-4 fw-bold text-success"><?= $total_lunas; ?> / 12 Bulan</div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-custom p-3 border-start border-4 border-primary">
                <div class="text-muted small fw-semibold">Total Terbayar Tahun <?= $tahun; ?></div>
                <div class="fs-4 fw-bold text-primary"><?= format_rupiah($total_nominal_terbayar); ?></div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-custom p-3 border-start border-4 border-warning">
                <div class="text-muted small fw-semibold">Sisa Bulan Belum Bayar</div>
                <div class="fs-4 fw-bold text-warning"><?= 12 - $total_lunas; ?> Bulan</div>
            </div>
        </div>
    </div>

    <!-- 12-Month SPP Digital Card Table -->
    <div class="card card-custom">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-credit-card-2-front text-success fs-5"></i>
                <span class="fw-bold">Rincian Kartu Iuran SPP Bulanan (Januari - Desember <?= $tahun; ?>)</span>
            </div>
            <small class="text-muted">Sesuai format Kartu SPP fisik Dayah Al-Ikhlas</small>
        </div>

        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Bulan</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah (Rp)</th>
                        <th>No. Kuitansi</th>
                        <th>Keterangan / Catatan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matrix as $m): ?>
                        <tr class="<?= $m['is_lunas'] ? 'table-light' : ''; ?>">
                            <td class="text-center text-muted fw-bold"><?= $m['bulan_angka']; ?></td>
                            <td class="fw-bold text-dark">
                                <?= $m['bulan_nama']; ?> <?= $tahun; ?>
                            </td>
                            <td>
                                <?= $m['is_lunas'] ? format_tanggal_indo($m['tanggal_bayar']) : '<span class="text-muted">-</span>'; ?>
                            </td>
                            <td class="fw-bold <?= $m['is_lunas'] ? 'text-success' : 'text-muted'; ?>">
                                <?= $m['is_lunas'] ? format_rupiah($m['jumlah']) : '-'; ?>
                            </td>
                            <td>
                                <?php if ($m['is_lunas']): ?>
                                    <span class="badge bg-light text-dark border font-monospace"><?= html_escape($m['no_kuitansi']); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-secondary"><?= html_escape($m['keterangan'] ?: ($m['is_lunas'] ? 'Lunas' : '-')); ?></small>
                            </td>
                            <td class="text-center">
                                <?php if ($m['is_lunas']): ?>
                                    <span class="badge bg-success text-white px-3 py-1.5 rounded-pill">
                                        <i class="bi bi-check-circle-fill me-1"></i> LUNAS
                                    </span>
                                <?php elseif ($m['status_label'] === 'Menunggak'): ?>
                                    <span class="badge bg-danger text-white px-3 py-1.5 rounded-pill">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> MENUNGGAK
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border px-3 py-1.5 rounded-pill">
                                        Belum Jatuh Tempo
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if ($m['is_lunas']): ?>
                                    <a href="<?= base_url('bendahara/spp/kuitansi/' . $m['pembayaran_id']); ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2.5" title="Cetak Kuitansi">
                                        <i class="bi bi-printer me-1"></i> Kuitansi
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('bendahara/spp/input?santri_id=' . $s->id . '&bulan=' . $m['bulan_angka'] . '&tahun=' . $tahun); ?>" class="btn btn-sm btn-primary rounded-pill px-2.5 fw-semibold shadow-sm">
                                        <i class="bi bi-cash me-1"></i> Bayar
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
