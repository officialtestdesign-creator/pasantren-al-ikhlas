<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Rekapitulasi Tunggakan SPP Santri</h4>
            <p class="text-muted small mb-0">Daftar santri aktif yang belum melunasi iuran SPP pada bulan dan tahun tertentu.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('bendahara/spp'); ?>" class="btn btn-outline-secondary fw-semibold shadow-sm">
                <i class="bi bi-wallet2 me-1"></i> Buku Kas
            </a>
            <a href="<?= base_url('bendahara/spp/input'); ?>" class="btn btn-success fw-bold shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Input Pembayaran
            </a>
        </div>
    </div>

    <!-- Counters -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-4">
            <div class="card card-custom p-3 border-start border-4 border-danger">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Santri Menunggak</div>
                        <div class="fs-3 fw-bold text-danger"><?= number_format($total_menunggak); ?> Santri</div>
                    </div>
                    <i class="bi bi-person-x-fill text-danger fs-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="card card-custom p-3 border-start border-4 border-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Estimasi Total Tertunggak</div>
                        <div class="fs-3 fw-bold text-warning"><?= format_rupiah($total_nominal_tunggakan); ?></div>
                    </div>
                    <i class="bi bi-cash-stack text-warning fs-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="card card-custom p-3 border-start border-4 border-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-semibold">Periode Tagihan</div>
                        <div class="fs-4 fw-bold text-dark"><?= nama_bulan($bulan); ?> <?= $tahun; ?></div>
                    </div>
                    <i class="bi bi-calendar-check text-info fs-2 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-3">
            <form action="<?= base_url('bendahara/tunggakan'); ?>" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Bulan Tagihan</label>
                    <select name="bulan" class="form-select form-select-sm">
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <option value="<?= $m; ?>" <?= $bulan == $m ? 'selected' : ''; ?>>
                                Bulan <?= nama_bulan($m); ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Tahun Tagihan</label>
                    <select name="tahun" class="form-select form-select-sm">
                        <?php for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++): ?>
                            <option value="<?= $y; ?>" <?= $tahun == $y ? 'selected' : ''; ?>><?= $y; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-secondary mb-1">Filter Kelas</label>
                    <select name="kelas_id" class="form-select form-select-sm">
                        <option value="">-- Semua Kelas --</option>
                        <?php if (!empty($kelas_list)): ?>
                            <?php foreach ($kelas_list as $kl): ?>
                                <option value="<?= $kl->id; ?>" <?= $kelas_id == $kl->id ? 'selected' : ''; ?>>
                                    <?= html_escape($kl->nama_kelas); ?> (Jenjang <?= html_escape($kl->nama_jenjang); ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold w-100" style="margin-top: 25px;">
                        <i class="bi bi-filter"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tunggakan Table Card -->
    <div class="card card-custom">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                <span class="fw-bold">Santri Belum Membayar SPP Bulan <?= nama_bulan($bulan); ?> <?= $tahun; ?></span>
            </div>
            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1.5 rounded-pill">
                <?= count($tunggakan_list); ?> Menunggak
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Kelas / Jenjang</th>
                        <th>Nama Orang Tua</th>
                        <th>No. WhatsApp Ortu</th>
                        <th>Nominal SPP</th>
                        <th class="text-center">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tunggakan_list)): ?>
                        <?php foreach ($tunggakan_list as $row): ?>
                            <?php
                                // WhatsApp reminder text
                                $nama_clean = html_escape($row->nama);
                                $wa_pesan = "Assalamu'alaikum Wr. Wb. Bpk/Ibu wali dari ananda {$nama_clean}. Kami dari Bendahara LPI Dayah Al-Ikhlas Al-Aziziyah mengingatkan iuran SPP bulan " . nama_bulan($bulan) . " {$tahun} sebesar " . format_rupiah($tarif_spp) . ". Terima kasih.";
                                $wa_phone = preg_replace('/[^0-9]/', '', $row->no_hp_ortu ?? '');
                                if (substr($wa_phone, 0, 1) === '0') {
                                    $wa_phone = '62' . substr($wa_phone, 1);
                                }
                            ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace fw-bold"><?= html_escape($row->no_induk); ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($row->nama); ?></div>
                                    <small class="text-muted"><?= html_escape($row->asal_kabupaten ?: '-'); ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><?= html_escape($row->nama_kelas ?: '-'); ?></span>
                                    <small class="text-muted d-block"><?= html_escape($row->nama_jenjang ?: '-'); ?></small>
                                </td>
                                <td>
                                    <div class="small fw-semibold"><?= html_escape($row->nama_ayah); ?></div>
                                </td>
                                <td>
                                    <?php if (!empty($row->no_hp_ortu)): ?>
                                        <a href="https://wa.me/<?= $wa_phone; ?>?text=<?= urlencode($wa_pesan); ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2.5 py-0.5" style="font-size: 0.8rem;">
                                            <i class="bi bi-whatsapp me-1"></i> <?= html_escape($row->no_hp_ortu); ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">Tidak ada nomor</span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-bold text-danger">
                                    <?= format_rupiah($tarif_spp); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('bendahara/spp/input?santri_id=' . $row->id . '&bulan=' . $bulan . '&tahun=' . $tahun); ?>" class="btn btn-primary fw-semibold px-2.5" title="Input Pembayaran">
                                            <i class="bi bi-cash me-1"></i> Bayar
                                        </a>
                                        <a href="<?= base_url('bendahara/kartu_spp/detail/' . $row->id); ?>" class="btn btn-outline-secondary" title="Buka Kartu">
                                            <i class="bi bi-credit-card-2-front"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-success">
                                <i class="bi bi-check-circle fs-2 d-block mb-2"></i>
                                <div class="fw-bold">Alhamdulillah! Tidak ada tunggakan SPP.</div>
                                <small class="text-muted">Semua santri pada filter ini telah melunasi iuran SPP bulan <?= nama_bulan($bulan); ?> <?= $tahun; ?>.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
