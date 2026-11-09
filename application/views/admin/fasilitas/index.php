<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-buildings-fill text-success me-2"></i>Data Master Fasilitas Dayah
        </h4>
        <p class="text-muted small mb-0">Kelola sarana prasarana, gedung asrama, mushalla, dan bilik halaqah yang ditampilkan di sistem informasi &amp; promosi publik.</p>
    </div>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <a href="<?= base_url(); ?>#fasilitas" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 shadow-sm fw-medium">
            <i class="bi bi-eye me-1"></i>Lihat di Web Publik
        </a>
        <button type="button" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambahFasilitas">
            <i class="bi bi-plus-lg me-1"></i>Tambah Fasilitas Baru
        </button>
    </div>
</div>

<!-- Metrics Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-medium">Total Fasilitas Terdata</div>
                    <div class="fs-4 fw-bold text-dark mt-1"><?= count($fasilitas_list); ?> <span class="fs-6 fw-normal text-muted">Sarana</span></div>
                </div>
                <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success fs-4">
                    <i class="bi bi-buildings"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-medium">Publikasi Portal Web</div>
                    <div class="fs-4 fw-bold text-success mt-1">Aktif <span class="fs-6 fw-normal text-muted">&bull; Tayang di Beranda</span></div>
                </div>
                <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary fs-4">
                    <i class="bi bi-broadcast"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-xl-4">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-medium">Media Dokumentasi</div>
                    <div class="fs-4 fw-bold text-warning mt-1">Lengkap <span class="fs-6 fw-normal text-muted">&bull; Disertai Foto</span></div>
                </div>
                <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning fs-4">
                    <i class="bi bi-images"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Flash Messages -->
<?php if ($this->session->flashdata('alert_type') && $this->session->flashdata('alert_message')): ?>
    <div class="alert alert-<?= $this->session->flashdata('alert_type'); ?> alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-info-circle-fill"></i>
            <div><?= $this->session->flashdata('alert_message'); ?></div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Grid Daftar Fasilitas -->
<div class="row g-4 mb-4">
    <?php if (!empty($fasilitas_list)): ?>
        <?php foreach ($fasilitas_list as $f): ?>
            <?php 
                $has_photo = !empty($f->foto) && file_exists(FCPATH . $f->foto);
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white hover-lift">
                    <?php if ($has_photo): ?>
                        <div class="position-relative">
                            <img src="<?= base_url($f->foto); ?>" alt="<?= html_escape($f->nama); ?>" class="w-100 object-fit-cover" style="height: 200px;">
                            <span class="badge bg-dark bg-opacity-75 position-absolute top-0 start-0 m-3 px-2.5 py-1.5 rounded-pill small">
                                <i class="bi bi-sort-numeric-down me-1"></i>Urutan #<?= (int)$f->urutan; ?>
                            </span>
                            <div class="position-absolute top-0 end-0 m-3 d-flex gap-1">
                                <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0;" title="Edit Fasilitas" data-bs-toggle="modal" data-bs-target="#modalEditFasilitas<?= $f->id; ?>">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0;" title="Hapus Fasilitas" data-bs-toggle="modal" data-bs-target="#modalHapusFasilitas<?= $f->id; ?>">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="position-relative d-flex flex-column align-items-center justify-content-center bg-light border-bottom text-muted" style="height: 200px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;">
                            <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                                <i class="bi bi-camera text-secondary fs-4"></i>
                            </div>
                            <span class="small fw-semibold text-secondary">Foto Belum Ditambahkan</span>
                            <button type="button" class="btn btn-sm btn-outline-success rounded-pill mt-2 px-3 shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalEditFasilitas<?= $f->id; ?>" style="font-size: 0.78rem;">
                                <i class="bi bi-plus-circle me-1"></i>Tambah Foto Sekarang
                            </button>
                            <span class="badge bg-secondary bg-opacity-75 position-absolute top-0 start-0 m-3 px-2.5 py-1.5 rounded-pill small">
                                <i class="bi bi-sort-numeric-down me-1"></i>Urutan #<?= (int)$f->urutan; ?>
                            </span>
                            <div class="position-absolute top-0 end-0 m-3 d-flex gap-1">
                                <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0;" title="Edit Fasilitas" data-bs-toggle="modal" data-bs-target="#modalEditFasilitas<?= $f->id; ?>">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0;" title="Hapus Fasilitas" data-bs-toggle="modal" data-bs-target="#modalHapusFasilitas<?= $f->id; ?>">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="fw-bold text-dark mb-2"><?= html_escape($f->nama); ?></h5>
                            <p class="text-secondary small mb-3" style="line-height: 1.65;"><?= nl2br(html_escape($f->deskripsi)); ?></p>
                        </div>
                        <div class="pt-3 border-top d-flex justify-content-between align-items-center text-muted" style="font-size: 0.78rem;">
                            <span>
                                <?php if ($has_photo): ?>
                                    <i class="bi bi-image text-success me-1"></i><?= html_escape(basename($f->foto)); ?>
                                <?php else: ?>
                                    <i class="bi bi-camera text-muted me-1"></i>Tanpa foto
                                <?php endif; ?>
                            </span>
                            <span class="badge <?= $has_photo ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-15 text-warning-emphasis'; ?>">
                                <?= $has_photo ? 'Lengkap' : 'Menunggu Foto'; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Fasilitas -->
            <div class="modal fade" id="modalEditFasilitas<?= $f->id; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $f->id; ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                        <form action="<?= base_url('admin/fasilitas/update/' . $f->id); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-header bg-primary text-white py-3 px-4">
                                <h5 class="modal-title fw-bold" id="modalEditLabel<?= $f->id; ?>">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Data Fasilitas
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label fw-bold text-dark small">Nama Fasilitas / Sarana <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control" value="<?= html_escape($f->nama); ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold text-dark small">Urutan Tampil</label>
                                        <input type="number" name="urutan" class="form-control" value="<?= (int)$f->urutan; ?>" min="0">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold text-dark small">Deskripsi Fasilitas <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" class="form-control" rows="3" required><?= html_escape($f->deskripsi); ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold text-dark small">Pilih Foto dari Direktori img/</label>
                                        <select name="preset_foto" class="form-select">
                                            <option value="">-- Tetap Gunakan Foto Saat Ini / Jangan Ubah --</option>
                                            <?php foreach ($preset_images as $path => $label): ?>
                                                <option value="<?= $path; ?>" <?= $f->foto === $path ? 'selected' : ''; ?>>
                                                    <?= $label; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold text-dark small">Atau Unggah Foto Baru dari Komputer</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                        <div class="form-text">Format: JPG, PNG, WEBP. Maksimal 4 MB.</div>
                                    </div>
                                    <?php if ($has_photo): ?>
                                        <div class="col-12 mt-2">
                                            <div class="p-2 border rounded-3 bg-light d-flex align-items-center justify-content-between gap-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="<?= base_url($f->foto); ?>" alt="Preview" class="rounded object-fit-cover" style="width: 70px; height: 50px;">
                                                    <div class="small text-muted">
                                                        <div class="fw-semibold text-dark">Foto Terpasang:</div>
                                                        <div class="text-truncate" style="max-width: 320px;"><?= html_escape($f->foto); ?></div>
                                                    </div>
                                                </div>
                                                <div class="form-check pe-2">
                                                    <input class="form-check-input" type="checkbox" name="hapus_foto" value="1" id="hapusFoto<?= $f->id; ?>">
                                                    <label class="form-check-label text-danger small fw-semibold" for="hapusFoto<?= $f->id; ?>">
                                                        <i class="bi bi-trash me-1"></i>Kosongkan Foto
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-12 mt-2">
                                            <div class="alert alert-warning py-2 px-3 small mb-0 d-flex align-items-center gap-2">
                                                <i class="bi bi-info-circle-fill"></i>
                                                <div>Fasilitas ini belum memiliki foto. Anda dapat memilih salah satu foto dari direktori <code>img/</code> di atas atau mengunggah foto baru.</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="modal-footer bg-light px-4 py-3">
                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus Fasilitas -->
            <div class="modal fade" id="modalHapusFasilitas<?= $f->id; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="modal-header bg-danger text-white py-3 px-4">
                            <h5 class="modal-title fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 text-center">
                            <div class="text-danger fs-1 mb-2"><i class="bi bi-trash3-fill"></i></div>
                            <h5 class="fw-bold text-dark mb-2">Hapus Fasilitas Ini?</h5>
                            <p class="text-muted small mb-0">Apakah Anda yakin ingin menghapus data fasilitas <strong>"<?= html_escape($f->nama); ?>"</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                        <div class="modal-footer bg-light px-4 py-3 justify-content-center">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <a href="<?= base_url('admin/fasilitas/hapus/' . $f->id); ?>" class="btn btn-danger rounded-pill px-4">
                                <i class="bi bi-trash-fill me-1"></i>Ya, Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                <div class="fs-1 text-muted mb-3"><i class="bi bi-buildings"></i></div>
                <h5 class="fw-bold text-dark">Belum Ada Data Fasilitas</h5>
                <p class="text-muted small mb-3">Tambahkan fasilitas pertama Anda untuk ditampilkan pada sistem informasi dan promosi dayah.</p>
                <div>
                    <button type="button" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambahFasilitas">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Fasilitas Sekarang
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah Fasilitas Baru -->
<div class="modal fade" id="modalTambahFasilitas" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form action="<?= base_url('admin/fasilitas/simpan'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-success text-white py-3 px-4">
                    <h5 class="modal-title fw-bold" id="modalTambahLabel">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Fasilitas Dayah Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-dark small">Nama Fasilitas / Sarana <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Gedung Asrama Santri Baru" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control" value="<?= count($fasilitas_list) + 1; ?>" min="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small">Deskripsi Fasilitas <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan spesifikasi, fungsi, dan kondisi fasilitas ini..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small">Pilih Foto dari Direktori img/ (Opsional)</label>
                            <select name="preset_foto" class="form-select">
                                <option value="">-- Biarkan Kosong (Foto akan ditambahkan nanti) --</option>
                                <?php foreach ($preset_images as $path => $label): ?>
                                    <option value="<?= $path; ?>">
                                        <?= $label; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small">Atau Unggah Foto Sendiri dari Komputer</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <div class="form-text">Format didukung: JPG, PNG, WEBP. Maksimal ukuran file 4 MB. Jika belum ada foto, kosongkan saja dan dapat ditambahkan nanti.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>Simpan Fasilitas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

