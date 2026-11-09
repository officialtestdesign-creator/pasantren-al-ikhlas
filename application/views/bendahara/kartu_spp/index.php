<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Kartu SPP Digital Santri</h4>
            <p class="text-muted small mb-0">Lihat status pelunasan iuran bulanan 12 bulan (Januari–Desember) per santri secara terpadu.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('bendahara/spp'); ?>" class="btn btn-outline-secondary fw-semibold shadow-sm">
                <i class="bi bi-wallet2 me-1"></i> Riwayat Buku Kas
            </a>
            <a href="<?= base_url('bendahara/spp/input'); ?>" class="btn btn-success fw-bold shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Input Pembayaran Baru
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-3">
            <form action="<?= base_url('bendahara/kartu_spp'); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <select name="kelas_id" class="form-select form-select-sm">
                        <option value="">-- Semua Kelas Santri --</option>
                        <?php if (!empty($kelas_list)): ?>
                            <?php foreach ($kelas_list as $kl): ?>
                                <option value="<?= $kl->id; ?>" <?= ($filter['kelas_id'] ?? '') == $kl->id ? 'selected' : ''; ?>>
                                    <?= html_escape($kl->nama_kelas); ?> (Jenjang <?= html_escape($kl->nama_jenjang); ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari nama santri, NIS, kota..." value="<?= html_escape($filter['keyword'] ?? ''); ?>">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="<?= base_url('bendahara/kartu_spp'); ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Santri List Card -->
    <div class="card card-custom">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-lines-fill text-success"></i>
                <span>Pilih Santri Untuk Membuka Kartu SPP</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Kelas / Jenjang</th>
                        <th>Orang Tua / HP</th>
                        <th>Asal Daerah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($santri_list)): ?>
                        <?php foreach ($santri_list as $s): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace fw-bold"><?= html_escape($s->no_induk); ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($s->nama); ?></div>
                                    <small class="text-muted"><?= $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'; ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold"><?= html_escape($s->nama_kelas ?: 'Belum Ada Kelas'); ?></span>
                                    <small class="text-muted d-block">Jenjang <?= html_escape($s->nama_jenjang ?: '-'); ?></small>
                                </td>
                                <td>
                                    <div><?= html_escape($s->nama_ayah); ?></div>
                                    <small class="text-success"><i class="bi bi-whatsapp me-1"></i><?= html_escape($s->no_hp_ortu ?: '-'); ?></small>
                                </td>
                                <td><?= html_escape($s->asal_kabupaten ?: '-'); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('bendahara/kartu_spp/detail/' . $s->id); ?>" class="btn btn-sm btn-primary rounded-pill px-3 fw-semibold shadow-sm">
                                        <i class="bi bi-credit-card-2-front me-1"></i> Buka Kartu SPP
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Tidak ada santri yang sesuai filter.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
