<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('admin/santri'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div>
                <h4 class="fw-bold text-dark mb-0"><?= html_escape($s->nama); ?></h4>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <span class="badge bg-light text-dark border font-monospace">NIS: <?= html_escape($s->no_induk); ?></span>
                    <span class="badge bg-success bg-opacity-10 text-success text-capitalize"><?= html_escape($s->status); ?></span>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('admin/santri/cetak_kartu/' . $s->id); ?>" target="_blank" class="btn btn-outline-secondary fw-semibold shadow-sm">
                <i class="bi bi-printer me-1"></i> Cetak Kartu Biodata
            </a>
            <a href="<?= base_url('admin/santri/edit/' . $s->id); ?>" class="btn btn-warning fw-semibold shadow-sm text-dark">
                <i class="bi bi-pencil me-1"></i> Ubah Data
            </a>
            <a href="<?= base_url('admin/santri/hapus/' . $s->id); ?>" 
               class="btn btn-outline-danger fw-semibold shadow-sm"
               data-name="<?= html_escape($s->nama); ?>"
               data-sub="NIS: <?= html_escape($s->no_induk); ?> &bull; NIK: <?= html_escape($s->nik ?: '-'); ?>"
               data-title="Hapus Data Santri"
               title="Hapus Santri">
                <i class="bi bi-trash me-1"></i> Hapus Santri
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Summary Left Column -->
        <div class="col-lg-4">
            <div class="card card-custom text-center p-4 mb-4">
                <div class="mx-auto mb-3">
                    <?php if (!empty($s->foto) && file_exists(FCPATH . 'uploads/berkas/' . $s->foto)): ?>
                        <img src="<?= base_url('uploads/berkas/' . $s->foto); ?>" class="rounded-4 object-fit-cover shadow-sm border" style="width: 140px; height: 160px;" alt="Foto Santri">
                    <?php else: ?>
                        <div class="rounded-4 bg-success text-white d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 140px; height: 160px; font-size: 3.5rem;">
                            <?= strtoupper(substr($s->nama, 0, 1)); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <h5 class="fw-bold text-dark mb-1"><?= html_escape($s->nama); ?></h5>
                <p class="text-muted small mb-3">NIK: <?= html_escape($s->nik ?: '-'); ?></p>

                <div class="p-3 bg-light rounded-3 border text-start mb-3" style="font-size: 0.88rem;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jenjang:</span>
                        <span class="fw-bold text-success"><?= html_escape($s->nama_jenjang ?: '-'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Kelas:</span>
                        <span class="fw-bold text-dark"><?= html_escape($s->nama_kelas ?: 'Belum Ada Kelas'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Wali Kelas:</span>
                        <span class="fw-semibold text-secondary"><?= html_escape($s->nama_wali_kelas ?: '-'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Tahun Masuk:</span>
                        <span class="fw-semibold"><?= html_escape($s->tahun_masuk ?: '-'); ?></span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="<?= base_url('bendahara/kartu_spp/detail/' . $s->id); ?>" class="btn btn-outline-success btn-sm rounded-pill fw-semibold">
                        <i class="bi bi-credit-card-2-front me-1"></i> Buka Kartu SPP Digital
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Right Column -->
        <div class="col-lg-8">
            <!-- Biodata Lengkap -->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-lines-fill text-success"></i>
                        <span>Biodata Lengkap Santri</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Jenis Kelamin</small>
                            <span class="fw-semibold text-dark"><?= $s->jenis_kelamin === 'L' ? 'Laki-laki (Santriwan)' : 'Perempuan (Santriwati)'; ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Tempat, Tanggal Lahir</small>
                            <span class="fw-semibold text-dark"><?= html_escape($s->tempat_lahir); ?>, <?= format_tanggal_indo($s->tanggal_lahir); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Anak Ke / Saudara</small>
                            <span>Anak ke-<?= $s->anak_ke ?: '-'; ?> dari <?= $s->jumlah_saudara ?: '-'; ?> bersaudara</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Asal Sekolah Terakhir</small>
                            <span><?= html_escape($s->asal_sekolah ?: '-'); ?></span>
                        </div>
                        <div class="col-12 border-top pt-3">
                            <small class="text-muted d-block">Alamat Asal Lengkap</small>
                            <span class="fw-semibold text-dark">
                                Gampong <?= html_escape($s->asal_gampong ?: '-'); ?>, 
                                Kec. <?= html_escape($s->asal_kecamatan ?: '-'); ?>, 
                                Kab. <?= html_escape($s->asal_kabupaten ?: '-'); ?>, 
                                Prov. <?= html_escape($s->asal_provinsi ?: 'Aceh'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orang Tua & Kontak -->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-people text-warning"></i>
                        <span>Orang Tua & Wali</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Nama Ayah</small>
                            <span class="fw-bold text-dark"><?= html_escape($s->nama_ayah); ?></span>
                            <small class="text-muted d-block">Pekerjaan: <?= html_escape($s->pekerjaan_ayah ?: '-'); ?></small>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Nama Ibu</small>
                            <span class="fw-bold text-dark"><?= html_escape($s->nama_ibu); ?></span>
                            <small class="text-muted d-block">Pekerjaan: <?= html_escape($s->pekerjaan_ibu ?: '-'); ?></small>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">No. HP / WhatsApp Orang Tua</small>
                            <span class="fw-bold text-success"><i class="bi bi-whatsapp me-1"></i><?= html_escape($s->no_hp_ortu ?: '-'); ?></span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Alamat Orang Tua</small>
                            <span><?= html_escape($s->alamat_ortu ?: '-'); ?></span>
                        </div>
                        <?php if (!empty($s->nama_wali)): ?>
                            <div class="col-12 border-top pt-2">
                                <small class="text-muted d-block">Nama Wali</small>
                                <span><?= html_escape($s->nama_wali); ?> (<?= html_escape($s->pekerjaan_wali ?: '-'); ?>) &bull; HP: <?= html_escape($s->no_hp_wali ?: '-'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pembayaran SPP Terakhir -->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-receipt text-primary"></i>
                        <span>Riwayat Pembayaran Keuangan</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>No. Kuitansi</th>
                                <th>Jenis / Periode</th>
                                <th>Jumlah</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayat_pembayaran)): ?>
                                <?php foreach ($riwayat_pembayaran as $p): ?>
                                    <tr>
                                        <td><span class="badge bg-light text-dark border"><?= html_escape($p->no_kuitansi ?: '-'); ?></span></td>
                                        <td><?= $p->bulan ? 'SPP ' . nama_bulan($p->bulan) . ' ' . $p->tahun : html_escape($p->nama_jenis); ?></td>
                                        <td class="fw-bold text-success"><?= format_rupiah($p->jumlah); ?></td>
                                        <td class="text-muted small"><?= format_tanggal_indo($p->tanggal_bayar); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Belum ada riwayat pembayaran tercatat untuk santri ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Santri -->
<div class="modal fade" id="modalHapusSantri" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom bg-danger bg-opacity-10">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus Data Santri
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-dark mb-2">Apakah Anda yakin ingin menghapus data santri ini secara permanen?</p>
                <div class="p-3 bg-light rounded-3 border mb-3">
                    <div class="fw-bold text-dark fs-6"><?= html_escape($s->nama); ?></div>
                    <small class="text-muted font-monospace">NIS: <?= html_escape($s->no_induk); ?> &bull; NIK: <?= html_escape($s->nik ?: '-'); ?></small>
                </div>
                <div class="alert alert-warning small mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill fs-5 text-warning flex-shrink-0"></i>
                    <span>Tindakan ini akan menghapus biodata santri dan riwayat pembayaran terkait dari database.</span>
                </div>
            </div>
            <div class="modal-footer border-top bg-light">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('admin/santri/hapus/' . $s->id); ?>" class="btn btn-danger btn-sm rounded-pill px-4 fw-medium shadow-sm">
                    <i class="bi bi-trash me-1"></i>Ya, Hapus Data Santri
                </a>
            </div>
        </div>
    </div>
</div>
