<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <a href="<?= base_url('admin/jenjang'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Jenjang & Kelas
            </a>
            <span class="badge bg-emerald-subtle text-emerald px-2.5 py-1 rounded-pill fw-semibold">
                Jenjang <?= htmlspecialchars($kelas->nama_jenjang); ?>
            </span>
        </div>
        <h4 class="fw-bold text-dark mb-0">
            Daftar Santri Kelas: <?= htmlspecialchars($kelas->nama_kelas); ?>
        </h4>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('admin/santri/tambah?kelas_id=' . $kelas->id); ?>" class="btn btn-success btn-sm rounded-pill px-3 fw-medium">
            <i class="bi bi-person-plus-fill me-1"></i>Tambah Santri ke Kelas Ini
        </a>
    </div>
</div>

<div class="card-custom bg-white p-3 mb-4 border-0 shadow-sm rounded-3">
    <div class="row align-items-center g-3">
        <div class="col-md-4">
            <span class="text-muted small d-block">Wali Kelas Pengampu:</span>
            <span class="fw-bold text-dark fs-6">
                <i class="bi bi-person-badge text-success me-1"></i><?= $kelas->nama_wali ? htmlspecialchars($kelas->nama_wali) : 'Belum Ditentukan'; ?>
            </span>
        </div>
        <div class="col-md-4">
            <span class="text-muted small d-block">Jumlah Santri Aktif:</span>
            <span class="fw-bold text-dark fs-6">
                <i class="bi bi-people-fill text-primary me-1"></i><?= count($santri_list); ?> Santri Terdaftar
            </span>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="<?= base_url('admin/santri/kenaikan_kelas?kelas_asal=' . $kelas->id); ?>" class="btn btn-outline-warning btn-sm rounded-pill px-3 fw-medium text-dark">
                <i class="bi bi-box-arrow-up-right me-1"></i>Kenaikan Kelas Massal
            </a>
        </div>
    </div>
</div>

<div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-list-check text-success me-2"></i>Daftar Santri Terdaftar</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="small text-muted text-uppercase">
                    <th class="ps-4" style="width: 50px;">No</th>
                    <th>NIS</th>
                    <th>Nama Santri</th>
                    <th>L/P</th>
                    <th>Tempat, Tgl Lahir</th>
                    <th>Asal Kabupaten</th>
                    <th>Status</th>
                    <th class="text-end pe-4" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($santri_list)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            Belum ada santri aktif di kelas ini.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($santri_list as $s): ?>
                        <tr>
                            <td class="ps-4 text-muted small"><?= $no++; ?></td>
                            <td><span class="badge bg-light text-dark border font-monospace"><?= htmlspecialchars($s->no_induk); ?></span></td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($s->nama); ?></td>
                            <td>
                                <span class="badge <?= $s->jenis_kelamin === 'L' ? 'bg-primary-subtle text-primary' : 'bg-danger-subtle text-danger'; ?> rounded-pill px-2 py-1">
                                    <?= $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'; ?>
                                </span>
                            </td>
                            <td class="small text-muted"><?= htmlspecialchars($s->tempat_lahir); ?>, <?= format_tanggal($s->tanggal_lahir); ?></td>
                            <td class="small text-dark"><?= htmlspecialchars($s->asal_kabupaten ?: '-'); ?></td>
                            <td>
                                <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1 fw-semibold">
                                    Aktif
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="<?= base_url('admin/santri/detail/' . $s->id); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-2.5 py-1" title="Lihat Profil">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
