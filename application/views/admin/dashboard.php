<div class="container-fluid px-0">
    <!-- Welcome Header Banner -->
    <div class="card card-custom mb-4 border-0 text-white" style="background: linear-gradient(135deg, #065f46 0%, #047857 60%, #022c22 100%);">
        <div class="card-body p-4 p-lg-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-semibold mb-2">
                    <i class="bi bi-shield-check me-1"></i> Mode Administrator
                </span>
                <h3 class="fw-bold mb-1">Ahlan wa Sahlan, <?= html_escape(user_name()); ?>!</h3>
                <p class="mb-0 text-white-50" style="max-width: 600px;">
                    Selamat datang di Panel Administrasi LPI Dayah Al-Ikhlas Al-Aziziyah. Kelola pendaftaran santri, data akademik, dan rekapitulasi data dayah dengan mudah dan terpadu.
                </p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= base_url('admin/santri/tambah'); ?>" class="btn btn-light fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-person-plus text-success"></i> Tambah Santri
                </a>
                <a href="<?= base_url('admin/pembayaran'); ?>" class="btn btn-warning fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-cash-stack"></i> Input SPP
                </a>
            </div>
        </div>
    </div>

    <!-- Metric KPI Cards -->
    <div class="row g-3 mb-4">
        <!-- Santri Aktif -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-success bg-opacity-10 text-success">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Total Aktif</span>
                </div>
                <div class="metric-val"><?= number_format($stats['santri_total'] ?? 0); ?></div>
                <div class="metric-label d-flex justify-content-between mt-1">
                    <span>Santri Dayah</span>
                    <span class="text-success fw-semibold">
                        <i class="bi bi-gender-male"></i> <?= $stats['santri_putra'] ?? 0; ?> | <i class="bi bi-gender-female"></i> <?= $stats['santri_putri'] ?? 0; ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Dewan Guru -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-person-video3"></i>
                    </div>
                    <span class="badge bg-light text-secondary border">Tenaga Pendidik</span>
                </div>
                <div class="metric-val"><?= number_format($stats['guru_total'] ?? 0); ?></div>
                <div class="metric-label mt-1">Dewan Guru & Asatidz</div>
            </div>
        </div>

        <!-- Pendaftar Baru -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <?php if (($stats['pendaftar_baru'] ?? 0) > 0): ?>
                        <span class="badge bg-danger text-white rounded-pill">Perlu Verifikasi</span>
                    <?php else: ?>
                        <span class="badge bg-light text-secondary border">Terkini</span>
                    <?php endif; ?>
                </div>
                <div class="metric-val"><?= number_format($stats['pendaftar_baru'] ?? 0); ?></div>
                <div class="metric-label mt-1">Calon Santri Menunggu</div>
            </div>
        </div>

        <!-- SPP Bulan Ini -->
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="metric-icon-box bg-info bg-opacity-10 text-info">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <span class="badge bg-light text-secondary border"><?= nama_bulan(date('m')); ?> <?= date('Y'); ?></span>
                </div>
                <div class="metric-val text-dark" style="font-size: 1.45rem;">
                    <?= format_rupiah($stats['spp_bulan_ini'] ?? 0); ?>
                </div>
                <div class="metric-label mt-1">Penerimaan SPP Bulan Ini</div>
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts Grid -->
    <div class="card card-custom mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-lightning-charge-fill text-warning"></i>
                <span>Akses Cepat Pengelolaan</span>
            </div>
        </div>
        <div class="card-body p-3 p-lg-4">
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('admin/santri'); ?>" class="p-3 d-block rounded-3 border bg-light text-decoration-none text-dark hover-shadow transition">
                        <i class="bi bi-person-vcard text-success fs-2 mb-2 d-block"></i>
                        <span class="fw-bold d-block small">Data Induk Santri</span>
                        <span class="text-muted" style="font-size: 0.75rem;">Biodata, kelas, mutasi</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('admin/guru'); ?>" class="p-3 d-block rounded-3 border bg-light text-decoration-none text-dark hover-shadow transition">
                        <i class="bi bi-person-badge text-primary fs-2 mb-2 d-block"></i>
                        <span class="fw-bold d-block small">Dewan Guru (Teungku)</span>
                        <span class="text-muted" style="font-size: 0.75rem;">Format EDATUDA Dinas</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('admin/pendaftaran'); ?>" class="p-3 d-block rounded-3 border bg-light text-decoration-none text-dark hover-shadow transition">
                        <i class="bi bi-clipboard-check text-warning fs-2 mb-2 d-block"></i>
                        <span class="fw-bold d-block small">Verifikasi Pendaftar</span>
                        <span class="text-muted" style="font-size: 0.75rem;">Aksi 'Jadikan Santri'</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('admin/laporan'); ?>" class="p-3 d-block rounded-3 border bg-light text-decoration-none text-dark hover-shadow transition">
                        <i class="bi bi-file-earmark-arrow-down text-danger fs-2 mb-2 d-block"></i>
                        <span class="fw-bold d-block small">Format Dinas Dayah</span>
                        <span class="text-muted" style="font-size: 0.75rem;">Ekspor Excel & Ringkasan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column: Recent Registrations & Recent SPP Payments -->
    <div class="row g-4 mb-4">
        <!-- Recent Registrations -->
        <div class="col-lg-6">
            <div class="card card-custom h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-clock-history text-success"></i>
                        <span>Pendaftaran Santri Terbaru</span>
                    </div>
                    <a href="<?= base_url('admin/pendaftaran'); ?>" class="small text-decoration-none text-success fw-semibold">
                        Lihat Semua <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>No. Daftar</th>
                                <th>Nama Calon Santri</th>
                                <th>JK</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_pendaftar)): ?>
                                <?php foreach ($recent_pendaftar as $p): ?>
                                    <tr>
                                        <td><span class="badge bg-light text-dark border"><?= html_escape($p->no_pendaftaran); ?></span></td>
                                        <td class="fw-semibold text-dark"><?= html_escape($p->nama); ?></td>
                                        <td>
                                            <span class="badge <?= $p->jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger'; ?> bg-opacity-10 <?= $p->jenis_kelamin === 'L' ? 'text-primary' : 'text-danger'; ?>">
                                                <?= $p->jenis_kelamin; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php 
                                                $badge_class = 'bg-warning text-dark';
                                                if ($p->status === 'diterima') $badge_class = 'bg-success text-white';
                                                if ($p->status === 'ditolak') $badge_class = 'bg-danger text-white';
                                                if ($p->status === 'cadangan') $badge_class = 'bg-info text-dark';
                                            ?>
                                            <span class="badge <?= $badge_class; ?> rounded-pill text-capitalize">
                                                <?= $p->status; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/pendaftaran/detail/' . $p->id); ?>" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2" style="font-size: 0.75rem;">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        Belum ada data pendaftar baru.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent SPP Payments -->
        <div class="col-lg-6">
            <div class="card card-custom h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-receipt text-primary"></i>
                        <span>Pembayaran SPP Terkini</span>
                    </div>
                    <a href="<?= base_url('admin/pembayaran'); ?>" class="small text-decoration-none text-primary fw-semibold">
                        Semua Transaksi <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Kuitansi</th>
                                <th>Nama Santri</th>
                                <th>Bulan / Jenis</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_pembayaran)): ?>
                                <?php foreach ($recent_pembayaran as $pb): ?>
                                    <tr>
                                        <td><span class="badge bg-light text-secondary border"><?= html_escape($pb->no_kuitansi ?: '-'); ?></span></td>
                                        <td class="fw-semibold text-dark"><?= html_escape($pb->nama_santri ?: 'Santri #' . $pb->santri_id); ?></td>
                                        <td>
                                            <?= $pb->bulan ? nama_bulan($pb->bulan) . ' ' . $pb->tahun : html_escape($pb->nama_jenis); ?>
                                        </td>
                                        <td class="fw-bold text-success"><?= format_rupiah($pb->jumlah); ?></td>
                                        <td class="text-muted small"><?= format_tanggal_indo($pb->tanggal_bayar); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-wallet2 fs-3 d-block mb-1"></i>
                                        Belum ada catatan pembayaran.
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
