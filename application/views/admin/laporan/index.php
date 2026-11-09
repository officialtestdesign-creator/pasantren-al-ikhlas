<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-file-earmark-spreadsheet-fill text-success me-2"></i>Pusat Laporan & Ekspor Format Dinas Dayah
        </h4>
        <p class="text-muted small mb-0">Portal komprehensif pelaporan kelembagaan, rekapitulasi data santri, dewan guru EDATUDA, dan ekspor ke Dinas Pendidikan Dayah.</p>
    </div>
</div>

<!-- 4 Official Export Action Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card-custom bg-white p-3.5 border-0 shadow-sm rounded-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="badge bg-emerald-subtle text-emerald px-2.5 py-1 rounded-pill small fw-semibold">Format Dinas</span>
                    <i class="bi bi-people-fill text-success fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Data Santri Aktif</h6>
                <p class="text-muted small mb-3">Ekspor seluruh biodata santri lengkap NIK, tempat/tgl lahir, orang tua, dan asal daerah.</p>
            </div>
            <div class="d-flex flex-column gap-1.5">
                <a href="<?= base_url('pimpinan/laporan_dinas/santri_excel'); ?>" class="btn btn-success btn-sm rounded-pill w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5">
                    <i class="bi bi-file-earmark-excel-fill"></i> Unduh Excel (.xls)
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/santri_pdf'); ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Cetak / Simpan PDF
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-custom bg-white p-3.5 border-0 shadow-sm rounded-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="badge bg-primary-subtle text-primary px-2.5 py-1 rounded-pill small fw-semibold">Format EDATUDA</span>
                    <i class="bi bi-person-video3 text-primary fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Data Dewan Guru</h6>
                <p class="text-muted small mb-3">Ekspor dewan guru / teungku pengasuh kitab kuning sesuai template resmi EDATUDA Dinas.</p>
            </div>
            <div class="d-flex flex-column gap-1.5">
                <a href="<?= base_url('pimpinan/laporan_dinas/guru_excel'); ?>" class="btn btn-primary btn-sm rounded-pill w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5">
                    <i class="bi bi-file-earmark-excel-fill"></i> Unduh Excel (.xls)
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/guru_pdf'); ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Cetak / Simpan PDF
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-custom bg-white p-3.5 border-0 shadow-sm rounded-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="badge bg-warning-subtle text-warning-emphasis px-2.5 py-1 rounded-pill small fw-semibold">Pendataan Dayah</span>
                    <i class="bi bi-bank2 text-warning fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Ringkasan Dayah</h6>
                <p class="text-muted small mb-3">Ringkasan profil dayah, perbandingan santri dalam/luar daerah, dan rekap per rombel.</p>
            </div>
            <div class="d-flex flex-column gap-1.5">
                <a href="<?= base_url('pimpinan/laporan_dinas/pendataan_excel'); ?>" class="btn btn-warning btn-sm rounded-pill w-100 fw-semibold text-dark d-flex align-items-center justify-content-center gap-1.5">
                    <i class="bi bi-file-earmark-excel-fill"></i> Unduh Excel (.xls)
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/pendataan_pdf'); ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Cetak / Simpan PDF
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-custom bg-white p-3.5 border-0 shadow-sm rounded-3 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="badge bg-info-subtle text-info px-2.5 py-1 rounded-pill small fw-semibold">Keuangan Kas</span>
                    <i class="bi bi-cash-stack text-info fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Laporan Buku Kas</h6>
                <p class="text-muted small mb-3">Rekapitulasi riwayat transaksi penerimaan kas SPP bulanan dan sumbangan dayah.</p>
            </div>
            <a href="<?= base_url('bendahara/laporan/ekspor_csv'); ?>" class="btn btn-outline-info btn-sm rounded-pill w-100 fw-medium">
                <i class="bi bi-download me-1"></i>Unduh Buku Kas SPP
            </a>
        </div>
    </div>
</div>

<!-- Detailed Data Previews -->
<div class="row g-4 mb-4">
    <!-- Rekap Rombel / Kelas -->
    <div class="col-lg-8">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-diagram-3-fill text-success me-2"></i>Rekapitulasi Jumlah Santri per Rombel / Kelas</h6>
                <span class="badge bg-secondary bg-opacity-10 text-dark small px-2 py-1 rounded-pill">View: v_jumlah_santri_per_kelas</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-4">No</th>
                            <th>Jenjang</th>
                            <th>Nama Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th class="text-center">Putra (L)</th>
                            <th class="text-center">Putri (P)</th>
                            <th class="text-center pe-4">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rekap_kelas)): ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data rombel kelas.</td></tr>
                        <?php else: ?>
                            <?php $no = 1; $total_all = 0; foreach ($rekap_kelas as $rk): $total_all += (int)$rk->jumlah; ?>
                                <tr>
                                    <td class="ps-4 text-muted small"><?= $no++; ?></td>
                                    <td><span class="badge bg-emerald-subtle text-emerald rounded-pill px-2 py-0.5 small"><?= $rk->jenjang; ?></span></td>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($rk->nama_kelas); ?></td>
                                    <td class="small text-muted"><?= htmlspecialchars($rk->tahun_ajaran); ?></td>
                                    <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-0.5"><?= (int)$rk->laki_laki; ?></span></td>
                                    <td class="text-center"><span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-0.5"><?= (int)$rk->perempuan; ?></span></td>
                                    <td class="text-center pe-4 fw-bold text-dark"><?= (int)$rk->jumlah; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-light fw-bold">
                                <td colspan="6" class="text-end ps-4">TOTAL KESELURUHAN SANTRI:</td>
                                <td class="text-center pe-4 text-success fs-6"><?= $total_all; ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Asal Daerah Santri (Dinas Requirement) -->
    <div class="col-lg-4">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-geo-fill text-danger me-2"></i>Sebaran Wilayah Asal Santri</h6>
            </div>
            <div class="p-3">
                <div class="d-flex align-items-center justify-content-between p-2.5 rounded-3 bg-light mb-2">
                    <span class="small fw-medium text-dark"><i class="bi bi-check-circle-fill text-success me-1.5"></i>Dalam Kab. Bireuen</span>
                    <span class="badge bg-success rounded-pill px-2.5 py-1 fw-bold"><?= $santri_dalam_kab; ?> Santri</span>
                </div>
                <div class="d-flex align-items-center justify-content-between p-2.5 rounded-3 bg-light mb-3">
                    <span class="small fw-medium text-dark"><i class="bi bi-globe-americas text-primary me-1.5"></i>Luar Kab. Bireuen</span>
                    <span class="badge bg-primary rounded-pill px-2.5 py-1 fw-bold"><?= $santri_luar_kab; ?> Santri</span>
                </div>

                <div class="small fw-bold text-muted text-uppercase mb-2">Top Kabupaten/Kota Asal:</div>
                <ul class="list-group list-group-flush small">
                    <?php foreach ($wilayah_list as $w): ?>
                        <li class="list-group-item px-1 py-1.5 d-flex align-items-center justify-content-between border-0">
                            <span class="text-dark"><i class="bi bi-dot text-secondary"></i><?= htmlspecialchars($w->kabupaten); ?></span>
                            <span class="fw-bold text-secondary"><?= $w->total; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-mortarboard text-primary me-2"></i>Status Kepegawaian Guru</h6>
            </div>
            <div class="p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="small text-muted">Guru Berstatus PNS</span>
                    <span class="badge bg-primary px-2.5 py-1 rounded-pill"><?= $guru_pns; ?> Guru</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="small text-muted">Guru Berstatus Non-PNS</span>
                    <span class="badge bg-secondary px-2.5 py-1 rounded-pill"><?= $guru_non_pns; ?> Guru</span>
                </div>
            </div>
        </div>
    </div>
</div>
