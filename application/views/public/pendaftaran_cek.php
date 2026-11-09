<div class="py-5 bg-light">
    <div class="container py-lg-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center mb-4">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill fw-bold text-uppercase mb-2">Layanan Calon Santri</span>
                    <h3 class="fw-bold text-dark mb-1">Cek Status Pendaftaran Santri Baru</h3>
                    <p class="text-muted small">Masukkan Nomor Pendaftaran (misal: PSB-2026-0001) atau NIK Santri untuk memeriksa status verifikasi penerimaan.</p>
                </div>

                <?= get_alert(); ?>

                <!-- Search Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <form action="<?= base_url('pendaftaran/cek_status'); ?>" method="GET">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Nomor Pendaftaran atau NIK Calon Santri</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                                    <input type="text" name="keyword" class="form-control border-start-0" placeholder="Contoh: PSB-2026-0001 atau NIK 16 digit" value="<?= html_escape($keyword ?? ''); ?>" required autofocus>
                                    <button class="btn btn-success fw-bold px-4" type="submit">Cari Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Result Card -->
                <?php if (!empty($hasil)): ?>
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="small text-muted d-block">Hasil Pencarian:</span>
                                <h5 class="fw-bold text-dark mb-0"><?= html_escape($hasil->nama); ?></h5>
                            </div>
                            <?php 
                                $status_badge = 'bg-warning text-dark';
                                $status_icon = 'bi-hourglass-split';
                                if ($hasil->status === 'diterima') {
                                    $status_badge = 'bg-success text-white';
                                    $status_icon = 'bi-check-circle-fill';
                                } elseif ($hasil->status === 'ditolak') {
                                    $status_badge = 'bg-danger text-white';
                                    $status_icon = 'bi-x-circle-fill';
                                } elseif ($hasil->status === 'cadangan') {
                                    $status_badge = 'bg-info text-dark';
                                    $status_icon = 'bi-pause-circle-fill';
                                }
                            ?>
                            <span class="badge <?= $status_badge; ?> px-3 py-2 rounded-pill fs-6">
                                <i class="bi <?= $status_icon; ?> me-1"></i> <?= strtoupper($hasil->status); ?>
                            </span>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Nomor Registrasi</small>
                                    <span class="fw-bold text-dark"><?= html_escape($hasil->no_pendaftaran); ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Jenjang Tujuan</small>
                                    <span class="fw-semibold text-primary">Jenjang <?= html_escape($hasil->nama_jenjang ?: '-'); ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Tanggal Pendaftaran</small>
                                    <span><?= format_tanggal_indo($hasil->tanggal_daftar, true); ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Asal Daerah</small>
                                    <span><?= html_escape($hasil->asal_kabupaten ?: '-'); ?>, <?= html_escape($hasil->asal_provinsi ?: 'Aceh'); ?></span>
                                </div>
                            </div>

                            <?php if (!empty($hasil->catatan)): ?>
                                <div class="p-3 bg-light rounded-3 border mb-3">
                                    <small class="text-muted fw-bold d-block mb-1"><i class="bi bi-chat-left-text me-1"></i> Catatan Dari Panitia Dayah:</small>
                                    <div class="text-secondary"><?= nl2br(html_escape($hasil->catatan)); ?></div>
                                </div>
                            <?php endif; ?>

                            <!-- Status Berkas Lampiran -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <small class="fw-bold text-uppercase text-secondary">
                                        <i class="bi bi-paperclip me-1 text-success"></i> Kelengkapan Berkas Terunggah:
                                    </small>
                                    <span class="badge bg-light text-dark border">
                                        <?= !empty($berkas) ? count($berkas) : 0; ?> / 4 Dokumen
                                    </span>
                                </div>

                                <?php
                                    $berkas_map = array();
                                    if (!empty($berkas)) {
                                        foreach ($berkas as $item) {
                                            $berkas_map[$item->jenis_berkas] = $item;
                                        }
                                    }

                                    $list_dokumen = array(
                                        'foto' => array('label' => 'Pas Foto Santri', 'icon' => 'bi-person-bounding-box'),
                                        'kk' => array('label' => 'Kartu Keluarga (KK)', 'icon' => 'bi-file-earmark-person'),
                                        'ktp_ortu' => array('label' => 'KTP Orang Tua/Wali', 'icon' => 'bi-card-heading'),
                                        'ijazah' => array('label' => 'Ijazah / SKL Terakhir', 'icon' => 'bi-award')
                                    );
                                ?>

                                <div class="row g-2">
                                    <?php foreach ($list_dokumen as $key => $dok): ?>
                                        <?php 
                                            $b = isset($berkas_map[$key]) ? $berkas_map[$key] : null;
                                            $is_uploaded = !empty($b) && !empty($b->nama_file);
                                            $file_url = $is_uploaded ? base_url('uploads/berkas/' . rawurlencode($b->nama_file)) : '';
                                            $ext = $is_uploaded ? strtolower(pathinfo($b->nama_file, PATHINFO_EXTENSION)) : '';
                                            $is_img = in_array($ext, array('jpg', 'jpeg', 'png', 'webp', 'gif'));
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="p-2.5 px-3 rounded-3 border bg-light d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-2 overflow-hidden">
                                                    <i class="bi <?= $is_uploaded ? 'bi-check-circle-fill text-success' : 'bi-dash-circle text-muted'; ?> fs-5 flex-shrink-0"></i>
                                                    <div class="text-truncate">
                                                        <div class="fw-semibold text-dark small mb-0 text-truncate"><?= $dok['label']; ?></div>
                                                        <small class="text-muted" style="font-size: 0.72rem;">
                                                            <?= $is_uploaded ? '<span class="text-success">Terunggah</span>' : '<span class="text-secondary">Belum ada</span>'; ?>
                                                        </small>
                                                    </div>
                                                </div>
                                                <?php if ($is_uploaded): ?>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-success rounded-pill px-2.5 py-1 btn-preview-cek ms-2 flex-shrink-0" 
                                                            data-title="<?= html_escape($dok['label']); ?>" 
                                                            data-url="<?= $file_url; ?>" 
                                                            data-type="<?= $is_img ? 'image' : 'pdf'; ?>"
                                                            style="font-size: 0.78rem;">
                                                        <i class="bi bi-eye me-1"></i> Lihat
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 pt-2 border-top">
                                <a href="<?= base_url('pendaftaran/bukti/' . $hasil->no_pendaftaran); ?>" target="_blank" class="btn btn-warning fw-semibold rounded-pill px-4 text-dark shadow-sm">
                                    <i class="bi bi-printer me-1"></i> Cetak Bukti Pendaftaran
                                </a>
                                <a href="<?= base_url('pendaftaran'); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="bi bi-pencil-square me-1"></i> Daftar Calon Lain
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="text-center">
                    <a href="<?= base_url(); ?>" class="text-decoration-none small text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PREVIEW BERKAS CEK STATUS -->
<div class="modal fade" id="modalLihatBerkasCek" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom px-4 py-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-check text-success fs-5"></i>
                    <h6 class="modal-title fw-bold text-dark mb-0" id="cekPreviewTitle">Lihat Berkas Terunggah</h6>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="#" id="cekPreviewDownload" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Layar Penuh
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 text-center bg-light" style="min-height: 400px; max-height: 75vh; overflow: auto;">
                <div id="cekPreviewContainer" class="p-3 d-flex align-items-center justify-content-center h-100"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewButtons = document.querySelectorAll('.btn-preview-cek');
    const modalEl = document.getElementById('modalLihatBerkasCek');
    if (!modalEl) return;
    const modalInstance = new bootstrap.Modal(modalEl);
    const titleEl = document.getElementById('cekPreviewTitle');
    const downloadEl = document.getElementById('cekPreviewDownload');
    const containerEl = document.getElementById('cekPreviewContainer');

    previewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const title = this.dataset.title || 'Berkas Terunggah';
            const url = this.dataset.url;
            const type = this.dataset.type;

            titleEl.textContent = title;
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

            modalInstance.show();
        });
    });
});
</script>
