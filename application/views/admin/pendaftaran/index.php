<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Verifikasi Pendaftaran Santri Baru</h4>
            <p class="text-muted small mb-0">Kelola dan verifikasi berkas formulir calon santri baru yang masuk secara daring.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('pendaftaran'); ?>" target="_blank" class="btn btn-outline-success fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-box-arrow-up-right"></i> Buka Form Pendaftaran Publik
            </a>
        </div>
    </div>

    <!-- Status Tabs / Counters -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/pendaftaran?status=menunggu'); ?>" class="text-decoration-none">
                <div class="card card-custom p-3 border-start border-4 border-warning <?= ($filter['status'] ?? '') === 'menunggu' ? 'bg-warning bg-opacity-10' : ''; ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small fw-semibold">Menunggu Verifikasi</div>
                            <div class="fs-4 fw-bold text-warning"><?= number_format($count_menunggu); ?></div>
                        </div>
                        <i class="bi bi-hourglass-split text-warning fs-2 opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/pendaftaran?status=diterima'); ?>" class="text-decoration-none">
                <div class="card card-custom p-3 border-start border-4 border-success <?= ($filter['status'] ?? '') === 'diterima' ? 'bg-success bg-opacity-10' : ''; ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small fw-semibold">Diterima</div>
                            <div class="fs-4 fw-bold text-success"><?= number_format($count_diterima); ?></div>
                        </div>
                        <i class="bi bi-check-circle text-success fs-2 opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/pendaftaran?status=cadangan'); ?>" class="text-decoration-none">
                <div class="card card-custom p-3 border-start border-4 border-info <?= ($filter['status'] ?? '') === 'cadangan' ? 'bg-info bg-opacity-10' : ''; ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small fw-semibold">Cadangan</div>
                            <div class="fs-4 fw-bold text-info"><?= number_format($count_cadangan); ?></div>
                        </div>
                        <i class="bi bi-pause-circle text-info fs-2 opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/pendaftaran?status=ditolak'); ?>" class="text-decoration-none">
                <div class="card card-custom p-3 border-start border-4 border-danger <?= ($filter['status'] ?? '') === 'ditolak' ? 'bg-danger bg-opacity-10' : ''; ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small fw-semibold">Ditolak</div>
                            <div class="fs-4 fw-bold text-danger"><?= number_format($count_ditolak); ?></div>
                        </div>
                        <i class="bi bi-x-circle text-danger fs-2 opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-3">
            <form action="<?= base_url('admin/pendaftaran'); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">-- Semua Status --</option>
                        <option value="menunggu" <?= ($filter['status'] ?? '') === 'menunggu' ? 'selected' : ''; ?>>Menunggu Verifikasi</option>
                        <option value="diterima" <?= ($filter['status'] ?? '') === 'diterima' ? 'selected' : ''; ?>>Diterima</option>
                        <option value="cadangan" <?= ($filter['status'] ?? '') === 'cadangan' ? 'selected' : ''; ?>>Cadangan</option>
                        <option value="ditolak" <?= ($filter['status'] ?? '') === 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="jenjang_id" class="form-select form-select-sm">
                        <option value="">-- Semua Jenjang --</option>
                        <?php if (!empty($jenjang_list)): ?>
                            <?php foreach ($jenjang_list as $jl): ?>
                                <option value="<?= $jl->id; ?>" <?= ($filter['jenjang_id'] ?? '') == $jl->id ? 'selected' : ''; ?>>
                                    Jenjang <?= html_escape($jl->nama); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari nama santri, no. daftar, NIK, kota..." value="<?= html_escape($filter['keyword'] ?? ''); ?>">
                </div>

                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-success fw-semibold w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <a href="<?= base_url('admin/pendaftaran'); ?>" class="btn btn-sm btn-outline-secondary" title="Reset Filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card card-custom">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-list-check text-success"></i>
                <span>Daftar Pendaftar Calon Santri</span>
                <span class="badge bg-light text-dark border ms-2"><?= count($pendaftar_list); ?> Data</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>No. Pendaftaran</th>
                        <th>Nama Calon Santri</th>
                        <th class="text-center">JK</th>
                        <th>Jenjang Tujuan</th>
                        <th>Asal Daerah</th>
                        <th>Tgl Daftar</th>
                        <th>Status</th>
                        <th>Status Santri</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendaftar_list)): ?>
                        <?php foreach ($pendaftar_list as $row): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border fw-bold">
                                        <?= html_escape($row->no_pendaftaran); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($row->nama); ?></div>
                                    <small class="text-muted">NIK: <?= html_escape($row->nik ?: '-'); ?></small>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $row->jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger'; ?> bg-opacity-10 <?= $row->jenis_kelamin === 'L' ? 'text-primary' : 'text-danger'; ?>">
                                        <?= $row->jenis_kelamin; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-secondary">Jenjang <?= html_escape($row->nama_jenjang ?: '-'); ?></span>
                                </td>
                                <td>
                                    <div class="small"><?= html_escape($row->asal_kabupaten ?: '-'); ?></div>
                                    <small class="text-muted"><?= html_escape($row->asal_gampong ?: ''); ?></small>
                                </td>
                                <td>
                                    <small class="text-muted"><?= date('d/m/Y', strtotime($row->tanggal_daftar)); ?></small>
                                </td>
                                <td>
                                    <?php 
                                        $badge_cls = 'bg-warning text-dark';
                                        if ($row->status === 'diterima') $badge_cls = 'bg-success text-white';
                                        elseif ($row->status === 'ditolak') $badge_cls = 'bg-danger text-white';
                                        elseif ($row->status === 'cadangan') $badge_cls = 'bg-info text-dark';
                                    ?>
                                    <span class="badge <?= $badge_cls; ?> rounded-pill text-capitalize px-2.5 py-1">
                                        <?= $row->status; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($row->santri_id)): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2.5 py-1">
                                            <i class="bi bi-person-check-fill me-1"></i> Santri Aktif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border rounded-pill px-2.5 py-1">
                                            Belum Diproses
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-1.5">
                                        <a href="<?= base_url('admin/pendaftaran/detail/' . $row->id); ?>" class="btn btn-sm btn-primary rounded-pill px-2.5 py-1 shadow-sm" style="font-size: 0.8rem;">
                                            <i class="bi bi-eye-fill me-1"></i> Verifikasi
                                        </a>
                                         <a href="<?= base_url('admin/pendaftaran/hapus/' . $row->id); ?>" 
                                            data-name="<?= html_escape($row->nama); ?>" 
                                            data-sub="No. Reg: <?= html_escape($row->no_pendaftaran); ?> &bull; Jenjang: <?= html_escape($row->nama_jenjang ?: '-'); ?>" 
                                            data-title="Hapus Data Calon Santri"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1 shadow-sm" 
                                            title="Hapus Data Pendaftaran">
                                             <i class="bi bi-trash"></i>
                                         </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada formulir pendaftaran yang sesuai dengan filter.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
