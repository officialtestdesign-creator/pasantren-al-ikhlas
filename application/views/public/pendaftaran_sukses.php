<div class="py-5 bg-light">
    <div class="container py-lg-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden text-center p-4 p-lg-5">
                    <div class="mx-auto rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2.5rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <h3 class="fw-bold text-dark mb-2">Pendaftaran Berhasil Dikirim!</h3>
                    <p class="text-muted mb-4" style="max-width: 580px; margin: 0 auto;">
                        Alhamdulillah, formulir pendaftaran calon santri baru di <strong><?= html_escape($profil->nama_dayah ?? 'LPI Dayah Al-Ikhlas'); ?></strong> telah kami terima.
                    </p>

                    <!-- Registration Number Box -->
                    <div class="p-4 rounded-4 bg-light border border-success border-opacity-25 mb-4 mx-auto" style="max-width: 480px;">
                        <span class="small text-uppercase text-muted fw-bold d-block mb-1">Nomor Registrasi / Pendaftaran Anda:</span>
                        <div class="display-6 fw-bold text-success letter-spacing-1"><?= html_escape($pendaftar->no_pendaftaran); ?></div>
                        <small class="text-secondary d-block mt-1">Simpan nomor ini untuk memeriksa status penerimaan Anda</small>
                    </div>

                    <!-- Summary Table -->
                    <div class="table-responsive text-start mb-4 mx-auto" style="max-width: 550px;">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td class="bg-light text-muted fw-semibold" style="width: 40%;">Nama Calon Santri</td>
                                    <td class="fw-bold text-dark"><?= html_escape($pendaftar->nama); ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-light text-muted fw-semibold">Jenjang Tujuan</td>
                                    <td class="fw-semibold text-primary"><?= html_escape($pendaftar->nama_jenjang ?: 'Jenjang Santri'); ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-light text-muted fw-semibold">Jenis Kelamin</td>
                                    <td><?= $pendaftar->jenis_kelamin === 'L' ? 'Laki-laki (Santriwan)' : 'Perempuan (Santriwati)'; ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-light text-muted fw-semibold">Tempat, Tanggal Lahir</td>
                                    <td><?= html_escape($pendaftar->tempat_lahir); ?>, <?= format_tanggal_indo($pendaftar->tanggal_lahir); ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-light text-muted fw-semibold">Nama Orang Tua</td>
                                    <td><?= html_escape($pendaftar->nama_ayah); ?> / <?= html_escape($pendaftar->nama_ibu); ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-light text-muted fw-semibold">Status Pendaftaran</td>
                                    <td>
                                        <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill">
                                            <i class="bi bi-hourglass-split me-1"></i> Menunggu Verifikasi Panitia
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Berkas Persyaratan Terunggah -->
                    <div class="text-start mb-4 mx-auto" style="max-width: 550px;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="small fw-bold text-uppercase text-secondary">
                                <i class="bi bi-paperclip me-1 text-success"></i> Berkas Persyaratan Terunggah
                            </span>
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
                                'foto' => array('label' => 'Pas Foto Santri (3x4 / 2x3)', 'icon' => 'bi-person-bounding-box'),
                                'kk' => array('label' => 'Fotokopi Kartu Keluarga (KK)', 'icon' => 'bi-file-earmark-person'),
                                'ktp_ortu' => array('label' => 'Fotokopi KTP Orang Tua/Wali', 'icon' => 'bi-card-heading'),
                                'ijazah' => array('label' => 'Fotokopi Ijazah / SKL Terakhir', 'icon' => 'bi-award')
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
                                <div class="col-12">
                                    <div class="p-2.5 px-3 rounded-3 border bg-white d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi <?= $is_uploaded ? 'bi-check-circle-fill text-success' : 'bi-dash-circle text-muted'; ?> fs-5"></i>
                                            <div>
                                                <div class="fw-semibold text-dark small mb-0"><?= $dok['label']; ?></div>
                                                <small class="text-muted" style="font-size: 0.75rem;">
                                                    <?= $is_uploaded ? '<span class="text-success">Sudah diunggah</span>' : '<span class="text-muted">Belum ada file digital (dapat diserahkan fisik)</span>'; ?>
                                                </small>
                                            </div>
                                        </div>
                                        <?php if ($is_uploaded): ?>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 btn-preview-public" 
                                                    data-title="<?= html_escape($dok['label']); ?>" 
                                                    data-url="<?= $file_url; ?>" 
                                                    data-type="<?= $is_img ? 'image' : 'pdf'; ?>">
                                                <i class="bi bi-eye me-1"></i> Lihat
                                            </button>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border rounded-pill px-2.5 py-1">Fisik</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="<?= base_url('pendaftaran/bukti/' . $pendaftar->no_pendaftaran); ?>" target="_blank" class="btn btn-warning btn-lg fw-bold px-4 py-2.5 rounded-pill text-dark shadow-sm">
                            <i class="bi bi-printer-fill me-1"></i> Cetak Bukti Pendaftaran (PDF)
                        </a>
                        <a href="<?= base_url('pendaftaran/cek_status?keyword=' . urlencode($pendaftar->no_pendaftaran)); ?>" class="btn btn-outline-success btn-lg fw-semibold px-4 py-2.5 rounded-pill">
                            <i class="bi bi-search me-1"></i> Cek Status Terkini
                        </a>
                        <a href="<?= base_url(); ?>" class="btn btn-light btn-lg border fw-semibold px-4 py-2.5 rounded-pill text-secondary">
                            <i class="bi bi-house me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PREVIEW BERKAS (PUBLIC) -->
<div class="modal fade" id="modalLihatBerkasPublic" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom px-4 py-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-check text-success fs-5"></i>
                    <h6 class="modal-title fw-bold text-dark mb-0" id="publicPreviewTitle">Lihat Berkas Terunggah</h6>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="#" id="publicPreviewDownload" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Layar Penuh
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 text-center bg-light" style="min-height: 400px; max-height: 75vh; overflow: auto;">
                <div id="publicPreviewContainer" class="p-3 d-flex align-items-center justify-content-center h-100"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewButtons = document.querySelectorAll('.btn-preview-public');
    const modalEl = document.getElementById('modalLihatBerkasPublic');
    if (!modalEl) return;
    const modalInstance = new bootstrap.Modal(modalEl);
    const titleEl = document.getElementById('publicPreviewTitle');
    const downloadEl = document.getElementById('publicPreviewDownload');
    const containerEl = document.getElementById('publicPreviewContainer');

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
