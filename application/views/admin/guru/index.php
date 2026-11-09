<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Dewan Guru (Teungku Dayah)</h4>
            <p class="text-muted small mb-0">Manajemen tenaga pendidik, ustadz/ustazah pengasuh kitab kuning, status kepegawaian, dan data EDATUDA Dinas.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('admin/guru/ekspor_edatuda'); ?>" class="btn btn-outline-success fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-file-earmark-spreadsheet"></i> Ekspor Format EDATUDA
            </a>
            <a href="<?= base_url('admin/guru/tambah'); ?>" class="btn btn-primary fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-person-plus-fill"></i> Tambah Dewan Guru
            </a>
        </div>
    </div>

    <!-- Counters -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Total Pengajar</div>
                        <div class="fs-4 fw-bold text-success"><?= number_format($count_total); ?></div>
                    </div>
                    <i class="bi bi-people-fill text-success fs-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card card-custom p-3 border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Guru Aktif</div>
                        <div class="fs-4 fw-bold text-primary"><?= number_format($count_aktif); ?></div>
                    </div>
                    <i class="bi bi-person-check-fill text-primary fs-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card card-custom p-3 border-start border-4 border-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Status Non PNS</div>
                        <div class="fs-4 fw-bold text-warning"><?= number_format($count_non_pns); ?></div>
                    </div>
                    <i class="bi bi-person-vcard text-warning fs-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card card-custom p-3 border-start border-4 border-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Status PNS</div>
                        <div class="fs-4 fw-bold text-info"><?= number_format($count_pns); ?></div>
                    </div>
                    <i class="bi bi-award-fill text-info fs-2 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-3">
            <form action="<?= base_url('admin/guru'); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-2">
                    <select name="status_pns" class="form-select form-select-sm">
                        <option value="">-- Status PNS --</option>
                        <option value="NON PNS" <?= ($filter['status_pns'] ?? '') === 'NON PNS' ? 'selected' : ''; ?>>Non PNS</option>
                        <option value="PNS" <?= ($filter['status_pns'] ?? '') === 'PNS' ? 'selected' : ''; ?>>PNS</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status_tetap" class="form-select form-select-sm">
                        <option value="">-- Kepegawaian --</option>
                        <option value="TETAP" <?= ($filter['status_tetap'] ?? '') === 'TETAP' ? 'selected' : ''; ?>>Tetap</option>
                        <option value="TIDAK TETAP" <?= ($filter['status_tetap'] ?? '') === 'TIDAK TETAP' ? 'selected' : ''; ?>>Tidak Tetap</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="jenis_kelamin" class="form-select form-select-sm">
                        <option value="">-- Semua JK --</option>
                        <option value="L" <?= ($filter['jenis_kelamin'] ?? '') === 'L' ? 'selected' : ''; ?>>Laki-laki (L)</option>
                        <option value="P" <?= ($filter['jenis_kelamin'] ?? '') === 'P' ? 'selected' : ''; ?>>Perempuan (P)</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari nama teungku, NIK, kitab, daerah..." value="<?= html_escape($filter['keyword'] ?? ''); ?>">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <a href="<?= base_url('admin/guru'); ?>" class="btn btn-sm btn-outline-secondary" title="Reset">
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
                <i class="bi bi-person-video3 text-primary"></i>
                <span>Daftar Dewan Guru & Pengasuh</span>
                <span class="badge bg-light text-dark border ms-2"><?= count($guru_list); ?> Guru</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">Foto</th>
                        <th>No. Induk & NIK</th>
                        <th>Nama Dewan Guru</th>
                        <th class="text-center">JK</th>
                        <th>Mata Pelajaran / Kitab</th>
                        <th>Status / Pend.</th>
                        <th>Kontak & Alamat</th>
                        <th>Keaktifan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($guru_list)): ?>
                        <?php foreach ($guru_list as $row): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row->foto) && file_exists(FCPATH . 'uploads/berkas/' . $row->foto)): ?>
                                        <img src="<?= base_url('uploads/berkas/' . $row->foto); ?>" class="rounded-circle object-fit-cover border" style="width: 40px; height: 40px;" alt="Foto">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                            <?= strtoupper(substr($row->nama, 0, 1)); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace fw-bold"><?= html_escape($row->no_induk); ?></span>
                                    <small class="text-muted d-block"><?= html_escape($row->nik ?: '-'); ?></small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($row->nama); ?></div>
                                    <small class="text-muted"><?= html_escape($row->tempat_lahir ?: '-'); ?>, <?= format_tanggal_indo($row->tanggal_lahir); ?></small>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $row->jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger'; ?> bg-opacity-10 <?= $row->jenis_kelamin === 'L' ? 'text-primary' : 'text-danger'; ?>">
                                        <?= $row->jenis_kelamin; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-success small"><?= html_escape($row->mata_pelajaran ?: 'Pengajar Kitab'); ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><?= html_escape($row->status_pns); ?></span>
                                    <span class="badge bg-light text-primary border"><?= html_escape($row->status_tetap); ?></span>
                                    <small class="text-muted d-block mt-0.5"><?= html_escape($row->pendidikan_terakhir ?: '-'); ?></small>
                                </td>
                                <td>
                                    <div class="small fw-semibold"><i class="bi bi-telephone me-1 text-success"></i><?= html_escape($row->no_hp ?: '-'); ?></div>
                                    <small class="text-muted"><?= html_escape($row->asal_kabupaten ?: '-'); ?></small>
                                </td>
                                <td>
                                    <span class="badge <?= $row->aktif ? 'bg-success text-white' : 'bg-secondary text-white'; ?> rounded-pill px-2.5 py-1">
                                        <?= $row->aktif ? 'Aktif' : 'Non-Aktif'; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('admin/guru/detail/' . $row->id); ?>" class="btn btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/guru/edit/' . $row->id); ?>" class="btn btn-outline-warning" title="Ubah">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/guru/hapus/' . $row->id); ?>" 
                                           data-name="<?= html_escape($row->nama); ?>" 
                                           data-sub="NIP/No: <?= html_escape($row->no_induk); ?> &bull; <?= html_escape($row->mata_pelajaran ?: 'Dewan Guru'); ?>" 
                                           data-title="Hapus Data Dewan Guru"
                                           class="btn btn-outline-danger" 
                                           title="Hapus Guru">
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
                                Belum ada data dewan guru yang sesuai filter.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
