<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Buku Induk Santri</h4>
            <p class="text-muted small mb-0">Kelola data seluruh santriwan dan santriwati aktif, alumni, mutasi kelas, dan cetak kartu biodata.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('admin/santri/ekspor_dinas'); ?>" class="btn btn-outline-success fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-file-earmark-excel"></i> Ekspor Format Dinas
            </a>
            <a href="<?= base_url('admin/santri/kenaikan_kelas'); ?>" class="btn btn-outline-primary fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-arrow-up-right-circle"></i> Kenaikan Kelas Massal
            </a>
            <a href="<?= base_url('admin/santri/tambah'); ?>" class="btn btn-success fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-person-plus-fill"></i> Tambah Santri
            </a>
        </div>
    </div>

    <!-- Summary Counters -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/santri?status=aktif'); ?>" class="text-decoration-none">
                <div class="card card-custom p-3 border-start border-4 border-success <?= ($filter['status'] ?? '') === 'aktif' ? 'bg-success bg-opacity-10' : ''; ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small fw-semibold">Santri Aktif</div>
                            <div class="fs-4 fw-bold text-success"><?= number_format($count_aktif); ?></div>
                        </div>
                        <i class="bi bi-people-fill text-success fs-2 opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <div class="card card-custom p-3 border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Putra & Putri</div>
                        <div class="fs-5 fw-bold text-dark">
                            <span class="text-primary"><i class="bi bi-gender-male"></i> <?= $count_putra; ?></span> / 
                            <span class="text-danger"><i class="bi bi-gender-female"></i> <?= $count_putri; ?></span>
                        </div>
                    </div>
                    <i class="bi bi-gender-ambiguous text-primary fs-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/santri?status=alumni'); ?>" class="text-decoration-none">
                <div class="card card-custom p-3 border-start border-4 border-info <?= ($filter['status'] ?? '') === 'alumni' ? 'bg-info bg-opacity-10' : ''; ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small fw-semibold">Alumni (Tamat)</div>
                            <div class="fs-4 fw-bold text-info"><?= number_format($count_alumni); ?></div>
                        </div>
                        <i class="bi bi-mortarboard-fill text-info fs-2 opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/santri?status=keluar'); ?>" class="text-decoration-none">
                <div class="card card-custom p-3 border-start border-4 border-secondary <?= ($filter['status'] ?? '') === 'keluar' ? 'bg-secondary bg-opacity-10' : ''; ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small fw-semibold">Mutasi / Keluar</div>
                            <div class="fs-4 fw-bold text-secondary"><?= number_format($count_keluar); ?></div>
                        </div>
                        <i class="bi bi-box-arrow-right text-secondary fs-2 opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-3">
            <form action="<?= base_url('admin/santri'); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="aktif" <?= ($filter['status'] ?? '') === 'aktif' ? 'selected' : ''; ?>>Santri Aktif</option>
                        <option value="alumni" <?= ($filter['status'] ?? '') === 'alumni' ? 'selected' : ''; ?>>Alumni</option>
                        <option value="keluar" <?= ($filter['status'] ?? '') === 'keluar' ? 'selected' : ''; ?>>Keluar / Pindah</option>
                        <option value="" <?= ($filter['status'] ?? '') === '' ? 'selected' : ''; ?>>Semua Status</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="kelas_id" class="form-select form-select-sm">
                        <option value="">-- Semua Kelas --</option>
                        <?php if (!empty($kelas_list)): ?>
                            <?php foreach ($kelas_list as $kl): ?>
                                <option value="<?= $kl->id; ?>" <?= ($filter['kelas_id'] ?? '') == $kl->id ? 'selected' : ''; ?>>
                                    <?= html_escape($kl->nama_kelas); ?> (Jenjang <?= html_escape($kl->nama_jenjang); ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="jenis_kelamin" class="form-select form-select-sm">
                        <option value="">-- Semua JK --</option>
                        <option value="L" <?= ($filter['jenis_kelamin'] ?? '') === 'L' ? 'selected' : ''; ?>>Laki-laki (L)</option>
                        <option value="P" <?= ($filter['jenis_kelamin'] ?? '') === 'P' ? 'selected' : ''; ?>>Perempuan (P)</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari nama santri, NIS, NIK, kota..." value="<?= html_escape($filter['keyword'] ?? ''); ?>">
                </div>

                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-success fw-semibold w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <a href="<?= base_url('admin/santri'); ?>" class="btn btn-sm btn-outline-secondary" title="Reset Filter">
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
                <i class="bi bi-people-fill text-success"></i>
                <span>Daftar Data Santri</span>
                <span class="badge bg-light text-dark border ms-2"><?= count($santri_list); ?> Santri</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">Foto</th>
                        <th>NIS & NIK</th>
                        <th>Nama Lengkap Santri</th>
                        <th class="text-center">JK</th>
                        <th>Kelas / Jenjang</th>
                        <th>Asal Daerah</th>
                        <th>Orang Tua / Wali</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($santri_list)): ?>
                        <?php foreach ($santri_list as $row): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row->foto) && file_exists(FCPATH . 'uploads/berkas/' . $row->foto)): ?>
                                        <img src="<?= base_url('uploads/berkas/' . $row->foto); ?>" class="rounded-circle object-fit-cover border" style="width: 40px; height: 40px;" alt="Foto">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
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
                                    <small class="text-muted"><?= html_escape($row->tempat_lahir); ?>, <?= format_tanggal_indo($row->tanggal_lahir); ?></small>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $row->jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger'; ?> bg-opacity-10 <?= $row->jenis_kelamin === 'L' ? 'text-primary' : 'text-danger'; ?>">
                                        <?= $row->jenis_kelamin; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= html_escape($row->nama_kelas ?: 'Belum Masuk Kelas'); ?></div>
                                    <small class="text-muted">Jenjang <?= html_escape($row->nama_jenjang ?: '-'); ?></small>
                                </td>
                                <td>
                                    <div class="small fw-semibold"><?= html_escape($row->asal_kabupaten ?: '-'); ?></div>
                                    <small class="text-muted"><?= html_escape($row->asal_gampong ?: ''); ?></small>
                                </td>
                                <td>
                                    <div class="small"><?= html_escape($row->nama_ayah); ?> / <?= html_escape($row->nama_ibu); ?></div>
                                    <small class="text-success"><i class="bi bi-whatsapp me-1"></i><?= html_escape($row->no_hp_ortu ?: '-'); ?></small>
                                </td>
                                <td>
                                    <?php 
                                        $status_badge = 'bg-success text-white';
                                        if ($row->status === 'alumni') $status_badge = 'bg-info text-dark';
                                        if ($row->status === 'keluar') $status_badge = 'bg-secondary text-white';
                                    ?>
                                    <span class="badge <?= $status_badge; ?> rounded-pill text-capitalize px-2.5 py-1">
                                        <?= $row->status; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('admin/santri/detail/' . $row->id); ?>" class="btn btn-outline-primary" title="Lihat Biodata">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/santri/cetak_kartu/' . $row->id); ?>" target="_blank" class="btn btn-outline-secondary" title="Cetak Kartu">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <a href="<?= base_url('admin/santri/edit/' . $row->id); ?>" class="btn btn-outline-warning" title="Ubah">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/santri/hapus/' . $row->id); ?>" 
                                           data-name="<?= html_escape($row->nama); ?>" 
                                           data-sub="NIS: <?= html_escape($row->no_induk); ?> &bull; Kelas: <?= html_escape($row->nama_kelas ?: 'Belum Masuk'); ?>" 
                                           data-title="Hapus Data Santri"
                                           class="btn btn-outline-danger" 
                                           title="Hapus Santri">
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
                                Belum ada data santri yang sesuai filter.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
