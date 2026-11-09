<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-pie-chart-fill text-success me-2"></i>Demografi & Rekapitulasi Santri
        </h4>
        <p class="text-muted small mb-0">Laporan eksekutif sebaran santri per jenjang rombel, rasio putra/putri, dan asal daerah santri.</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Total Santri Aktif</div>
            <div class="fs-4 fw-bold text-dark mt-1"><?= $stats['santri_total']; ?> <span class="fs-6 fw-normal text-muted">Santri</span></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Santri Putra (L)</div>
            <div class="fs-4 fw-bold text-primary mt-1"><?= $stats['santri_putra']; ?> <span class="fs-6 fw-normal text-muted">Santri</span></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Santri Putri (P)</div>
            <div class="fs-4 fw-bold text-danger mt-1"><?= $stats['santri_putri']; ?> <span class="fs-6 fw-normal text-muted">Santri</span></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Asal Dalam Kab. Bireuen</div>
            <div class="fs-4 fw-bold text-success mt-1"><?= $santri_dalam_kab; ?> <span class="fs-6 fw-normal text-muted">(<?= $santri_luar_kab; ?> Luar Kab)</span></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-diagram-3-fill text-success me-2"></i>Rincian Jumlah Santri per Kelas & Jenjang</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-4">No</th>
                            <th>Jenjang</th>
                            <th>Nama Kelas</th>
                            <th class="text-center">Putra (L)</th>
                            <th class="text-center">Putri (P)</th>
                            <th class="text-center pe-4">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rekap_kelas)): ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data.</td></tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($rekap_kelas as $rk): ?>
                                <tr>
                                    <td class="ps-4 text-muted small"><?= $no++; ?></td>
                                    <td><span class="badge bg-emerald-subtle text-emerald rounded-pill px-2.5 py-1 fw-semibold"><?= $rk->jenjang; ?></span></td>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($rk->nama_kelas); ?></td>
                                    <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-0.5"><?= (int)$rk->laki_laki; ?></span></td>
                                    <td class="text-center"><span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-0.5"><?= (int)$rk->perempuan; ?></span></td>
                                    <td class="text-center pe-4 fw-bold text-dark"><?= (int)$rk->jumlah; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 p-4">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Sebaran Kabupaten Asal</h6>
            <div class="list-group list-group-flush">
                <?php foreach ($asal_santri as $as): ?>
                    <div class="list-group-item px-0 py-2 d-flex align-items-center justify-content-between border-0">
                        <span class="small fw-medium text-dark"><i class="bi bi-dot text-primary fs-5"></i><?= htmlspecialchars($as->kabupaten); ?></span>
                        <span class="badge bg-light text-dark border px-2.5 py-1 rounded-pill fw-bold"><?= $as->total; ?> Santri</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
