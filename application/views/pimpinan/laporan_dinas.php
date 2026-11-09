<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-file-earmark-bar-graph-fill text-success me-2"></i>Laporan Format Dinas Pendidikan Dayah
        </h4>
        <p class="text-muted small mb-0">Dokumen dan berkas resmi untuk kebutuhan koordinasi dan pelaporan ke Dinas Pendidikan Dayah Aceh & Bireuen.</p>
    </div>
    <div>
        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill small">
            <i class="bi bi-shield-check me-1"></i>Hak Akses Pimpinan Terverifikasi
        </span>
    </div>
</div>

<!-- INFORMASI FORMAT DOKUMEN -->
<div class="alert alert-light border shadow-sm rounded-3 d-flex align-items-start gap-3 mb-4 py-3 px-4">
    <div class="text-success fs-3 flex-shrink-0 mt-1">
        <i class="bi bi-info-circle-fill"></i>
    </div>
    <div class="small text-secondary">
        <div class="fw-bold text-dark mb-1">Tersedia dalam Format Microsoft Excel (.xls) dan Cetak / Simpan PDF Resmi</div>
        <p class="mb-0">
            <strong>Format Excel (.xls):</strong> Berkas spreadsheet siap olah dengan format sel NIK dan NIS berupa teks presisi tanpa terpotong notasi ilmiah.<br>
            <strong>Format Cetak / PDF:</strong> Berkas dokumen formal dilengkapi Kop Surat Dayah, stempel, dan lembar tanda tangan pengesahan Pimpinan Dayah. Pada tampilan cetak, gunakan opsi <em>"Save as PDF / Simpan sebagai PDF"</em> untuk mengunduh dokumen.
        </p>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- KARTU 1: DATA SANTRI -->
    <div class="col-md-4">
        <div class="card-custom bg-white p-4 border-0 shadow-sm rounded-3 text-center h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="rounded-circle bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 65px; height: 65px;">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Data Santri Format Dinas</h5>
                <p class="text-muted small mb-3">Biodata santri aktif mencakup NIS, NIK 16 digit, tempat/tanggal lahir, orang tua, rombel kelas, dan asal daerah.</p>
            </div>
            <div class="d-flex flex-column gap-2 pt-2">
                <a href="<?= base_url('pimpinan/laporan_dinas/santri_excel'); ?>" class="btn btn-success btn-sm rounded-pill w-100 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-excel-fill"></i> Unduh Excel (.xls)
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/santri_pdf'); ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-semibold py-1.5 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Cetak / Simpan PDF
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/santri_csv'); ?>" class="text-muted small text-decoration-none mt-1">
                    <i class="bi bi-filetype-csv me-1"></i>Unduh CSV Alternatif
                </a>
            </div>
        </div>
    </div>

    <!-- KARTU 2: EDATUDA DEWAN GURU -->
    <div class="col-md-4">
        <div class="card-custom bg-white p-4 border-0 shadow-sm rounded-3 text-center h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 65px; height: 65px;">
                    <i class="bi bi-person-badge-fill fs-3"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">EDATUDA Dewan Guru</h5>
                <p class="text-muted small mb-3">Rekapitulasi resmi tenaga pendidik / teungku asatidz, status kepegawaian PNS/Yayasan, kitab kuning, dan domisili.</p>
            </div>
            <div class="d-flex flex-column gap-2 pt-2">
                <a href="<?= base_url('pimpinan/laporan_dinas/guru_excel'); ?>" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-excel-fill"></i> Unduh Excel (.xls)
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/guru_pdf'); ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-semibold py-1.5 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Cetak / Simpan PDF
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/guru_csv'); ?>" class="text-muted small text-decoration-none mt-1">
                    <i class="bi bi-filetype-csv me-1"></i>Unduh CSV Alternatif
                </a>
            </div>
        </div>
    </div>

    <!-- KARTU 3: RINGKASAN PENDATAAN DAYAH -->
    <div class="col-md-4">
        <div class="card-custom bg-white p-4 border-0 shadow-sm rounded-3 text-center h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 65px; height: 65px;">
                    <i class="bi bi-bank2 fs-3 text-dark"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Ringkasan Pendataan Dayah</h5>
                <p class="text-muted small mb-3">Data pokok identitas lembaga, izin operasional, rekap rombongan belajar (rombel), dan demografi santri.</p>
            </div>
            <div class="d-flex flex-column gap-2 pt-2">
                <a href="<?= base_url('pimpinan/laporan_dinas/pendataan_excel'); ?>" class="btn btn-warning btn-sm rounded-pill w-100 fw-bold py-2 shadow-sm text-dark d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-excel-fill"></i> Unduh Excel (.xls)
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/pendataan_pdf'); ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-semibold py-1.5 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Cetak / Simpan PDF
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas/pendataan_csv'); ?>" class="text-muted small text-decoration-none mt-1">
                    <i class="bi bi-filetype-csv me-1"></i>Unduh CSV Alternatif
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-table text-success me-2"></i>Pratinjau Data Santri per Rombongan Belajar (Rombel)</h6>
        <span class="badge bg-light text-muted border small"><?= count($rekap_kelas); ?> Rombel Terdata</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="small text-muted text-uppercase">
                    <th class="ps-4">No</th>
                    <th>Tingkat / Jenjang</th>
                    <th>Nama Rombel / Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th class="text-center">Laki-laki</th>
                    <th class="text-center">Perempuan</th>
                    <th class="text-center pe-4">Total Santri</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rekap_kelas)): ?>
                    <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data rombel.</td></tr>
                <?php else: ?>
                    <?php 
                    $no = 1; 
                    $tot_l = 0; $tot_p = 0; $tot_all = 0;
                    foreach ($rekap_kelas as $rk): 
                        $tot_l += (int)$rk->laki_laki;
                        $tot_p += (int)$rk->perempuan;
                        $tot_all += (int)$rk->jumlah;
                    ?>
                        <tr>
                            <td class="ps-4 text-muted small"><?= $no++; ?></td>
                            <td><span class="badge bg-emerald-subtle text-emerald rounded-pill px-2.5 py-1 fw-semibold"><?= $rk->jenjang; ?></span></td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($rk->nama_kelas); ?></td>
                            <td class="small text-muted"><?= htmlspecialchars($rk->tahun_ajaran); ?></td>
                            <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-0.5"><?= (int)$rk->laki_laki; ?></span></td>
                            <td class="text-center"><span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-0.5"><?= (int)$rk->perempuan; ?></span></td>
                            <td class="text-center pe-4 fw-bold text-dark"><?= (int)$rk->jumlah; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="table-light fw-bold">
                        <td colspan="4" class="ps-4 text-end pe-3">TOTAL KESELURUHAN:</td>
                        <td class="text-center text-primary"><?= $tot_l; ?></td>
                        <td class="text-center text-danger"><?= $tot_p; ?></td>
                        <td class="text-center pe-4 text-dark"><?= $tot_all; ?> Santri</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
