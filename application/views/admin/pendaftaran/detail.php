<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('admin/pendaftaran'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div>
                <h4 class="fw-bold text-dark mb-0"><?= html_escape($p->nama); ?></h4>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <span class="badge bg-light text-dark border font-monospace"><?= html_escape($p->no_pendaftaran); ?></span>
                    <span class="text-muted small">&bull; Terdaftar <?= format_tanggal_indo($p->tanggal_daftar, true); ?></span>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('pendaftaran/bukti/' . $p->no_pendaftaran); ?>" target="_blank" class="btn btn-outline-secondary fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-printer"></i> Cetak Bukti
            </a>
            <a href="<?= base_url('admin/pendaftaran/hapus/' . $p->id); ?>" 
               data-name="<?= html_escape($p->nama); ?>"
               data-sub="No. Reg: <?= html_escape($p->no_pendaftaran); ?> &bull; Jenjang: <?= html_escape($p->nama_jenjang ?: '-'); ?>"
               data-title="Hapus Data Calon Santri"
               class="btn btn-outline-danger fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="bi bi-trash"></i> Hapus Pendaftaran
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- LEFT COLUMN: BIODATA & BERKAS -->
        <div class="col-lg-8">
            <!-- Data Diri Calon Santri -->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-badge text-success"></i>
                        <span>A. Data Calon Santri</span>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1.5 rounded-pill">
                        Jenjang <?= html_escape($p->nama_jenjang ?: '-'); ?>
                    </span>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Nama Lengkap</small>
                            <span class="fw-bold text-dark fs-6"><?= html_escape($p->nama); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">NIK (Nomor Induk Kependudukan)</small>
                            <span class="fw-semibold text-secondary font-monospace"><?= html_escape($p->nik ?: '-'); ?></span>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-muted d-block">Jenis Kelamin</small>
                            <span><?= $p->jenis_kelamin === 'L' ? 'Laki-laki (Santriwan)' : 'Perempuan (Santriwati)'; ?></span>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-muted d-block">Tempat, Tanggal Lahir</small>
                            <span><?= html_escape($p->tempat_lahir); ?>, <?= format_tanggal_indo($p->tanggal_lahir); ?></span>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-muted d-block">Anak Ke / Saudara</small>
                            <span>Ke-<?= $p->anak_ke ?: '-'; ?> dari <?= $p->jumlah_saudara ?: '-'; ?> bersaudara</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Asal Sekolah Terakhir</small>
                            <span><?= html_escape($p->asal_sekolah ?: '-'); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Tahun Ajaran</small>
                            <span><?= html_escape($p->nama_tahun_ajaran ?: '2026/2027'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat Asal -->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt text-primary"></i>
                        <span>B. Alamat Asal Santri</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Gampong / Desa</small>
                            <span class="fw-semibold text-dark"><?= html_escape($p->asal_gampong ?: '-'); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Kecamatan</small>
                            <span class="fw-semibold text-dark"><?= html_escape($p->asal_kecamatan ?: '-'); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Kabupaten / Kota</small>
                            <span class="fw-semibold text-dark"><?= html_escape($p->asal_kabupaten ?: '-'); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Provinsi</small>
                            <span class="fw-semibold text-dark"><?= html_escape($p->asal_provinsi ?: 'Aceh'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orang Tua & Wali -->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-people text-warning"></i>
                        <span>C. Data Orang Tua & Wali</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Nama Ayah Kandung</small>
                            <span class="fw-semibold text-dark"><?= html_escape($p->nama_ayah); ?></span>
                            <small class="text-muted d-block">Pekerjaan: <?= html_escape($p->pekerjaan_ayah ?: '-'); ?></small>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Nama Ibu Kandung</small>
                            <span class="fw-semibold text-dark"><?= html_escape($p->nama_ibu); ?></span>
                            <small class="text-muted d-block">Pekerjaan: <?= html_escape($p->pekerjaan_ibu ?: '-'); ?></small>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Alamat Orang Tua</small>
                            <span><?= html_escape($p->alamat_ortu ?: '-'); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">No. HP / WhatsApp Orang Tua</small>
                            <span class="fw-bold text-success"><i class="bi bi-whatsapp me-1"></i><?= html_escape($p->no_hp_ortu); ?></span>
                        </div>

                        <?php if (!empty($p->nama_wali)): ?>
                            <div class="col-12 pt-3 border-top">
                                <span class="badge bg-light text-secondary border mb-2">Data Wali Santri</span>
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">Nama Wali</small>
                                        <span class="fw-semibold text-dark"><?= html_escape($p->nama_wali); ?> (<?= html_escape($p->pekerjaan_wali ?: '-'); ?>)</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">No. HP Wali</small>
                                        <span><?= html_escape($p->no_hp_wali ?: '-'); ?></span>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted d-block">Alamat Wali</small>
                                        <span><?= html_escape($p->alamat_wali ?: '-'); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Berkas Persyaratan Terunggah -->
            <div class="card card-custom mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-paperclip text-info"></i>
                        <span>D. Berkas & Dokumen Terunggah</span>
                    </div>
                    <span class="badge bg-light text-dark border">
                        <?= count($berkas); ?> / 4 Berkas
                    </span>
                </div>
                <div class="card-body p-4">
                    <?php
                        // Index berkas berdasarkan jenis
                        $berkas_by_type = array();
                        if (!empty($berkas)) {
                            foreach ($berkas as $item) {
                                $berkas_by_type[$item->jenis_berkas] = $item;
                            }
                        }

                        $master_berkas = array(
                            'foto' => array(
                                'title'       => 'Pas Foto Santri',
                                'sub'         => 'Ukuran 3x4 / 2x3',
                                'icon'        => 'bi-person-bounding-box',
                                'badge_color' => 'success',
                                'accept'      => 'image/*'
                            ),
                            'kk' => array(
                                'title'       => 'Kartu Keluarga (KK)',
                                'sub'         => 'Foto / Scan Resmi',
                                'icon'        => 'bi-file-earmark-person',
                                'badge_color' => 'primary',
                                'accept'      => 'image/*,application/pdf'
                            ),
                            'ktp_ortu' => array(
                                'title'       => 'KTP Orang Tua/Wali',
                                'sub'         => 'Ayah atau Ibu Kandung',
                                'icon'        => 'bi-card-heading',
                                'badge_color' => 'warning',
                                'accept'      => 'image/*,application/pdf'
                            ),
                            'ijazah' => array(
                                'title'       => 'Ijazah / SKL Terakhir',
                                'sub'         => 'Sekolah Asal Santri',
                                'icon'        => 'bi-award',
                                'badge_color' => 'danger',
                                'accept'      => 'image/*,application/pdf'
                            )
                        );
                    ?>

                    <div class="row g-3">
                        <?php foreach ($master_berkas as $type_key => $meta): ?>
                            <?php 
                                $b = isset($berkas_by_type[$type_key]) ? $berkas_by_type[$type_key] : null;
                                $has_file = false;
                                $file_exists = false;
                                $file_url = '';
                                $is_image = false;

                                if ($b && !empty($b->nama_file)) {
                                    $has_file = true;
                                    $file_path = FCPATH . 'uploads/berkas/' . $b->nama_file;
                                    $file_exists = file_exists($file_path);
                                    $file_url = base_url('uploads/berkas/' . rawurlencode($b->nama_file));
                                    $ext = strtolower(pathinfo($b->nama_file, PATHINFO_EXTENSION));
                                    $is_image = in_array($ext, array('jpg', 'jpeg', 'png', 'webp', 'gif'));
                                }
                            ?>
                            <div class="col-sm-6 col-md-3">
                                <div class="border rounded-3 p-3 text-center h-100 bg-light d-flex flex-column justify-content-between position-relative shadow-sm">
                                    <div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="badge bg-<?= $meta['badge_color']; ?> bg-opacity-10 text-<?= $meta['badge_color']; ?> border border-<?= $meta['badge_color']; ?> border-opacity-25 rounded-pill px-2 py-0.5" style="font-size: 0.72rem;">
                                                <i class="bi <?= $meta['icon']; ?> me-1"></i> <?= $meta['title']; ?>
                                            </span>
                                            <?php if ($has_file && $file_exists): ?>
                                                <span class="badge bg-success rounded-pill" title="Berkas terunggah & siap dilihat">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </span>
                                            <?php elseif ($has_file && !$file_exists): ?>
                                                <span class="badge bg-warning text-dark rounded-pill" title="Data tercatat tapi file fisik tidak ada di disk">
                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary bg-opacity-25 text-secondary rounded-pill" title="Belum diunggah">
                                                    <i class="bi bi-dash-circle"></i>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Preview Box -->
                                        <?php if ($has_file && $file_exists): ?>
                                            <?php if ($is_image): ?>
                                                <div class="rounded-2 overflow-hidden mb-2 border bg-white position-relative" style="height: 120px;">
                                                    <img src="<?= $file_url; ?>" alt="<?= $meta['title']; ?>" class="img-fluid w-100 h-100 object-fit-cover">
                                                </div>
                                            <?php else: ?>
                                                <div class="rounded-2 bg-white d-flex flex-column align-items-center justify-content-center mb-2 border" style="height: 120px;">
                                                    <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 2.5rem;"></i>
                                                    <small class="text-muted font-monospace mt-1" style="font-size: 0.7rem; max-width: 90%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <?= html_escape($b->nama_file); ?>
                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                        <?php elseif ($has_file && !$file_exists): ?>
                                            <div class="rounded-2 bg-white d-flex flex-column align-items-center justify-content-center mb-2 border border-warning" style="height: 120px;">
                                                <i class="bi bi-exclamation-circle text-warning fs-2 mb-1"></i>
                                                <small class="text-warning fw-bold" style="font-size: 0.72rem;">File Fisik Tidak Ada</small>
                                                <small class="text-muted" style="font-size: 0.68rem;">Perlu diunggah ulang</small>
                                            </div>
                                        <?php else: ?>
                                            <div class="rounded-2 bg-white d-flex flex-column align-items-center justify-content-center mb-2 border border-dashed" style="height: 120px;">
                                                <i class="bi bi-cloud-arrow-up text-muted fs-2 mb-1"></i>
                                                <small class="text-muted" style="font-size: 0.72rem;">Belum Diunggah</small>
                                                <small class="text-secondary" style="font-size: 0.68rem;"><?= $meta['sub']; ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex flex-column gap-1.5 mt-2">
                                        <?php if ($has_file && $file_exists): ?>
                                            <div class="d-flex gap-1">
                                                <button type="button" 
                                                        class="btn btn-sm btn-primary flex-grow-1 rounded-pill btn-preview-berkas" 
                                                        data-title="<?= html_escape($meta['title']); ?>" 
                                                        data-url="<?= $file_url; ?>" 
                                                        data-type="<?= $is_image ? 'image' : 'pdf'; ?>"
                                                        data-filename="<?= html_escape($b->nama_file); ?>">
                                                    <i class="bi bi-eye me-1"></i> Lihat
                                                </button>
                                                <a href="<?= $file_url; ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 31px; height: 31px; padding: 0; display: inline-flex; align-items: center; justify-content: center;" title="Buka di tab baru">
                                                    <i class="bi bi-box-arrow-up-right" style="font-size: 0.75rem;"></i>
                                                </a>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center px-1">
                                                <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 text-secondary btn-reupload-berkas" data-type="<?= $type_key; ?>" data-title="<?= html_escape($meta['title']); ?>" style="font-size: 0.72rem;">
                                                    <i class="bi bi-pencil-square me-0.5"></i> Ganti
                                                </button>
                                                <a href="<?= base_url('admin/pendaftaran/hapus_berkas/' . $p->id . '/' . $b->id); ?>" 
                                                   onclick="return confirm('Apakah Anda yakin ingin menghapus berkas <?= html_escape($meta['title']); ?> ini?');" 
                                                   class="btn btn-link btn-sm text-decoration-none p-0 text-danger" 
                                                   style="font-size: 0.72rem;">
                                                    <i class="bi bi-trash3 me-0.5"></i> Hapus
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-sm btn-outline-success w-100 rounded-pill btn-reupload-berkas" data-type="<?= $type_key; ?>" data-title="<?= html_escape($meta['title']); ?>">
                                                <i class="bi bi-upload me-1"></i> Unggah Berkas
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: ACTIONS & SANTRI CONVERSION -->
        <div class="col-lg-4">
            
            <!-- PANEL: JADIKAN SANTRI -->
            <div class="card card-custom mb-4 border-2 <?= !empty($p->santri_id) ? 'border-success' : 'border-primary'; ?>">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-mortarboard-fill text-primary"></i>
                        <span>Aksi: Jadikan Santri</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($p->santri_id)): ?>
                        <div class="text-center py-3">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 58px; height: 58px; font-size: 1.8rem;">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <h5 class="fw-bold text-success mb-1">Resmi Menjadi Santri Aktif</h5>
                            <p class="text-muted small mb-3">Data pendaftar telah berhasil dipindahkan ke Buku Induk Santri.</p>
                            
                            <div class="p-3 bg-light rounded-3 border mb-3">
                                <small class="text-muted d-block">Nomor Induk Santri (NIS):</small>
                                <span class="fs-5 fw-bold text-dark font-monospace"><?= html_escape($p->nis_santri ?: '-'); ?></span>
                            </div>

                            <a href="<?= base_url('admin/santri'); ?>" class="btn btn-outline-success btn-sm rounded-pill w-100 fw-semibold">
                                <i class="bi bi-person-lines-fill me-1"></i> Lihat di Manajemen Santri
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-secondary small mb-3">
                            Tekan tombol di bawah untuk menyalin data calon santri secara otomatis ke <strong>Buku Induk Santri</strong> tanpa perlu memasukkan data ulang.
                        </p>

                        <form action="<?= base_url('admin/pendaftaran/jadikan_santri/' . $p->id); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memproses calon santri ini menjadi SANTRI RESMI Dayah Al-Ikhlas?');">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Nomor Induk Santri (NIS) <span class="text-danger">*</span></label>
                                <input type="text" name="no_induk" class="form-control rounded-3 font-monospace fw-bold text-dark" value="<?= html_escape($auto_nis); ?>" required>
                                <small class="text-muted" style="font-size: 0.75rem;">Saran otomatis berdasarkan tahun & urutan.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Penempatan Kelas <span class="text-danger">*</span></label>
                                <select name="kelas_id" class="form-select rounded-3" required>
                                    <option value="">-- Pilih Kelas Santri --</option>
                                    <?php if (!empty($kelas_list)): ?>
                                        <?php foreach ($kelas_list as $kl): ?>
                                            <option value="<?= $kl->id; ?>">
                                                <?= html_escape($kl->nama_kelas); ?> (Jenjang <?= html_escape($kl->nama_jenjang); ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-person-plus-fill"></i> Jadikan Santri Sekarang
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- PANEL: UBAH STATUS PENDAFTARAN -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-sliders text-warning"></i>
                        <span>Status & Verifikasi</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/pendaftaran/ubah_status/' . $p->id); ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Status Pendaftaran</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="menunggu" <?= $p->status === 'menunggu' ? 'selected' : ''; ?>>Menunggu Verifikasi</option>
                                <option value="diterima" <?= $p->status === 'diterima' ? 'selected' : ''; ?>>Diterima</option>
                                <option value="cadangan" <?= $p->status === 'cadangan' ? 'selected' : ''; ?>>Cadangan</option>
                                <option value="ditolak" <?= $p->status === 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Catatan Verifikasi Panitia</label>
                            <textarea name="catatan" rows="3" class="form-control rounded-3" placeholder="Catatan untuk santri / orang tua saat mengecek status (misal: Berkas KK belum lengkap / Jadwal wawancara tanggal ...)"><?= html_escape($p->catatan ?? ''); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> Perbarui Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Danger Zone: Hapus Pendaftaran -->
            <div class="card card-custom border-danger border-opacity-25">
                <div class="card-body p-3 text-center">
                    <small class="text-muted d-block mb-2">Ingin membatalkan atau menghapus formulir ini?</small>
                    <a href="<?= base_url('admin/pendaftaran/hapus/' . $p->id); ?>" 
                       data-name="<?= html_escape($p->nama); ?>"
                       data-sub="No. Reg: <?= html_escape($p->no_pendaftaran); ?> &bull; Jenjang: <?= html_escape($p->nama_jenjang ?: '-'); ?>"
                       data-title="Hapus Data Calon Santri"
                       class="btn btn-sm btn-outline-danger rounded-pill px-3">
                        <i class="bi bi-trash3 me-1"></i> Hapus Data Pendaftaran
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL PREVIEW BERKAS -->
<div class="modal fade" id="modalLihatBerkas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom px-4 py-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-text text-primary fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0" id="previewBerkasTitle">Preview Berkas</h6>
                        <small class="text-muted" id="previewBerkasFilename"></small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="#" id="previewBerkasDownload" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Layar Penuh
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 text-center bg-light" style="min-height: 420px; max-height: 75vh; overflow: auto;">
                <div id="previewBerkasContainer" class="p-3 d-flex align-items-center justify-content-center h-100">
                    <!-- Image or PDF iframe will be injected here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UNGGAH / GANTI BERKAS (ADMIN) -->
<div class="modal fade" id="modalUnggahBerkas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark mb-0">
                    <i class="bi bi-upload text-success me-1"></i> Unggah / Ganti Berkas Calon Santri
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/pendaftaran/unggah_berkas/' . $p->id); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <input type="hidden" name="jenis_berkas" id="modalUploadJenisBerkas" value="">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Target Dokumen</label>
                        <input type="text" id="modalUploadJenisLabel" class="form-control rounded-3 bg-light" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Pilih File Berkas <span class="text-danger">*</span></label>
                        <input type="file" name="file_berkas" id="modalUploadFileInput" class="form-control rounded-3" required>
                        <div class="form-text small">
                            Format didukung: <strong>JPG, JPEG, PNG, PDF</strong>. Ukuran maksimum: <strong>4 MB</strong>.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-3">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold rounded-pill px-4">
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Unggah Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handler Modal Preview Berkas
    const previewButtons = document.querySelectorAll('.btn-preview-berkas');
    const modalLihatBerkas = new bootstrap.Modal(document.getElementById('modalLihatBerkas'));
    const titleEl = document.getElementById('previewBerkasTitle');
    const filenameEl = document.getElementById('previewBerkasFilename');
    const downloadEl = document.getElementById('previewBerkasDownload');
    const containerEl = document.getElementById('previewBerkasContainer');

    previewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const title = this.dataset.title || 'Berkas';
            const url = this.dataset.url;
            const type = this.dataset.type;
            const filename = this.dataset.filename || '';

            titleEl.textContent = title;
            filenameEl.textContent = filename;
            downloadEl.href = url;

            containerEl.innerHTML = '';
            if (type === 'image') {
                const img = document.createElement('img');
                img.src = url;
                img.alt = title;
                img.className = 'img-fluid rounded-3 shadow-sm';
                img.style.maxHeight = '70vh';
                img.style.objectFit = 'contain';
                containerEl.appendChild(img);
            } else {
                const iframe = document.createElement('iframe');
                iframe.src = url;
                iframe.style.width = '100%';
                iframe.style.height = '65vh';
                iframe.style.border = 'none';
                iframe.className = 'rounded-3';
                containerEl.appendChild(iframe);
            }

            modalLihatBerkas.show();
        });
    });

    // Handler Modal Unggah Berkas
    const reuploadButtons = document.querySelectorAll('.btn-reupload-berkas');
    const modalUnggahBerkas = new bootstrap.Modal(document.getElementById('modalUnggahBerkas'));
    const jenisInput = document.getElementById('modalUploadJenisBerkas');
    const labelInput = document.getElementById('modalUploadJenisLabel');
    const fileInput = document.getElementById('modalUploadFileInput');

    reuploadButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            const title = this.dataset.title;

            jenisInput.value = type;
            labelInput.value = title;
            fileInput.value = '';

            if (type === 'foto') {
                fileInput.accept = 'image/*';
            } else {
                fileInput.accept = 'image/*,application/pdf';
            }

            modalUnggahBerkas.show();
        });
    });
});
</script>
