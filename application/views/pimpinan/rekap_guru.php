<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-person-vcard-fill text-success me-2"></i>Monitoring Dewan Guru (Teungku)
        </h4>
        <p class="text-muted small mb-0">Laporan pimpinan mengenai profil, status kepegawaian, kualifikasi pendidikan, dan kitab kuning asuhan dewan guru.</p>
    </div>
    <div>
        <a href="<?= base_url('admin/guru/ekspor_edatuda'); ?>" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-medium">
            <i class="bi bi-download me-1"></i>Unduh Format EDATUDA Dinas
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Total Dewan Guru</div>
            <div class="fs-4 fw-bold text-dark mt-1"><?= $stats['guru_total']; ?> <span class="fs-6 fw-normal text-muted">Teungku</span></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Status Guru PNS</div>
            <div class="fs-4 fw-bold text-primary mt-1"><?= $guru_pns; ?> <span class="fs-6 fw-normal text-muted">Guru</span></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Status Guru Non-PNS</div>
            <div class="fs-4 fw-bold text-secondary mt-1"><?= $guru_non_pns; ?> <span class="fs-6 fw-normal text-muted">Guru</span></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="text-muted small fw-medium">Kategori Pengajar</div>
            <div class="fs-5 fw-bold text-success mt-1">Salafiyah Mu'tabarah</div>
        </div>
    </div>
</div>

<div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-person-lines-fill text-success me-2"></i>Daftar Guru / Teungku Pengajar Dayah</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="small text-muted text-uppercase">
                    <th class="ps-4">No</th>
                    <th>Nama Lengkap Guru / Teungku</th>
                    <th>NIK / No Induk</th>
                    <th>Pendidikan</th>
                    <th>Status</th>
                    <th>Kitab / Pelajaran Asuhan</th>
                    <th>Asal Daerah</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($guru_list)): ?>
                    <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data guru.</td></tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($guru_list as $g): ?>
                        <tr>
                            <td class="ps-4 text-muted small"><?= $no++; ?></td>
                            <td class="fw-bold text-dark">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                        T
                                    </div>
                                    <span><?= htmlspecialchars($g->nama); ?></span>
                                </div>
                            </td>
                            <td class="font-monospace small text-muted"><?= htmlspecialchars($g->nik ?: ($g->no_induk ?: '-')); ?></td>
                            <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($g->pendidikan_terakhir ?: '-'); ?></span></td>
                            <td>
                                <span class="badge <?= $g->status_pns === 'PNS' ? 'bg-primary-subtle text-primary' : 'bg-secondary-subtle text-secondary'; ?> rounded-pill px-2 py-0.5">
                                    <?= $g->status_pns; ?>
                                </span>
                            </td>
                            <td class="small fw-semibold text-dark"><?= htmlspecialchars($g->mata_pelajaran ?: '-'); ?></td>
                            <td class="small text-muted"><?= htmlspecialchars($g->asal_kabupaten ?: '-'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
