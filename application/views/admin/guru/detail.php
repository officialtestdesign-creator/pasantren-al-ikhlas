<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('admin/guru'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div>
                <h4 class="fw-bold text-dark mb-0"><?= html_escape($g->nama); ?></h4>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <span class="badge bg-light text-dark border font-monospace"><?= html_escape($g->no_induk); ?></span>
                    <span class="badge bg-primary bg-opacity-10 text-primary"><?= html_escape($g->status_tetap); ?></span>
                    <span class="badge <?= $g->aktif ? 'bg-success text-white' : 'bg-secondary text-white'; ?>">
                        <?= $g->aktif ? 'Aktif' : 'Non-Aktif'; ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/guru/edit/' . $g->id); ?>" class="btn btn-warning fw-semibold shadow-sm text-dark">
                <i class="bi bi-pencil me-1"></i> Ubah Data
            </a>
            <a href="<?= base_url('admin/guru/hapus/' . $g->id); ?>" 
               data-name="<?= html_escape($g->nama); ?>" 
               data-sub="NIP/No: <?= html_escape($g->no_induk); ?> &bull; <?= html_escape($g->mata_pelajaran ?: 'Dewan Guru'); ?>" 
               data-title="Hapus Data Dewan Guru"
               class="btn btn-outline-danger shadow-sm">
                <i class="bi bi-trash me-1"></i> Hapus
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Photo & Summary Left Column -->
        <div class="col-lg-4">
            <div class="card card-custom text-center p-4 mb-4">
                <div class="mx-auto mb-3">
                    <?php if (!empty($g->foto) && file_exists(FCPATH . 'uploads/berkas/' . $g->foto)): ?>
                        <img src="<?= base_url('uploads/berkas/' . $g->foto); ?>" class="rounded-4 object-fit-cover shadow-sm border" style="width: 140px; height: 160px;" alt="Foto Guru">
                    <?php else: ?>
                        <div class="rounded-4 bg-primary text-white d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 140px; height: 160px; font-size: 3.5rem;">
                            <?= strtoupper(substr($g->nama, 0, 1)); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <h5 class="fw-bold text-dark mb-1"><?= html_escape($g->nama); ?></h5>
                <p class="text-muted small mb-3">NIK: <?= html_escape($g->nik ?: '-'); ?></p>

                <div class="p-3 bg-light rounded-3 border text-start mb-3" style="font-size: 0.88rem;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status PNS:</span>
                        <span class="fw-bold text-dark"><?= html_escape($g->status_pns); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Kepegawaian:</span>
                        <span class="fw-semibold text-primary"><?= html_escape($g->status_tetap); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Pendidikan:</span>
                        <span class="fw-semibold"><?= html_escape($g->pendidikan_terakhir ?: '-'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">No. HP / WA:</span>
                        <span class="fw-bold text-success"><i class="bi bi-whatsapp me-1"></i><?= html_escape($g->no_hp ?: '-'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Right Column -->
        <div class="col-lg-8">
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-lines-fill text-primary"></i>
                        <span>Informasi Pribadi & Kontak Pengasuh</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Jenis Kelamin</small>
                            <span class="fw-semibold text-dark"><?= $g->jenis_kelamin === 'L' ? 'Laki-laki (Teungku)' : 'Perempuan (Ustazah)'; ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Tempat, Tanggal Lahir</small>
                            <span class="fw-semibold text-dark"><?= html_escape($g->tempat_lahir ?: '-'); ?>, <?= format_tanggal_indo($g->tanggal_lahir); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Mata Pelajaran / Kitab Yang Diasuh</small>
                            <span class="fw-bold text-success"><?= html_escape($g->mata_pelajaran ?: 'Pengajar Kitab'); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Alamat Email</small>
                            <span><?= html_escape($g->email ?: '-'); ?></span>
                        </div>
                        <div class="col-12 border-top pt-3">
                            <small class="text-muted d-block">Alamat Domisili & Asal</small>
                            <span class="fw-semibold text-dark">
                                <?= html_escape($g->alamat_domisili ?: '-'); ?> (Asal: Desa <?= html_escape($g->asal_desa ?: '-'); ?>, Kec. <?= html_escape($g->asal_kecamatan ?: '-'); ?>, Kab. <?= html_escape($g->asal_kabupaten ?: '-'); ?>)
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amanah Wali Kelas -->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-mortarboard text-success"></i>
                        <span>Amanah Pembina / Wali Kelas</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($kelas_wali)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($kelas_wali as $kw): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                        <span class="fw-bold text-dark"><?= html_escape($kw->nama_kelas); ?></span>
                                    </div>
                                    <a href="<?= base_url('admin/santri?kelas_id=' . $kw->id); ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                        Lihat Santri Kelas Ini
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-muted small">
                            Saat ini belum ditetapkan sebagai wali kelas dari rombongan belajar manapun.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
