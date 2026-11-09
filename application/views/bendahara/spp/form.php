<div class="container-fluid px-0">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?= base_url('bendahara/spp'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div>
            <h4 class="fw-bold text-dark mb-0">Input Pembayaran Kas & SPP</h4>
            <small class="text-muted">Catat penerimaan uang SPP bulanan, uang pendaftaran, atau sumbangan santri dayah</small>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom">
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-credit-card-2-back-fill text-success fs-5"></i>
                            <span class="fw-bold fs-6">Formulir Kas Masuk</span>
                        </div>
                        <span class="badge bg-light text-secondary border font-monospace">
                            Kuitansi Baru: <?= html_escape($auto_kuitansi); ?>
                        </span>
                    </div>
                </div>

                <form action="<?= base_url('bendahara/spp/simpan'); ?>" method="POST" class="p-4 p-lg-5">
                    
                    <!-- Pilih Santri -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Pilih Santri Yang Membayar <span class="text-danger">*</span></label>
                        <select name="santri_id" class="form-select form-select-lg rounded-3 border-success" required>
                            <option value="">-- Cari / Pilih Santri Berdasarkan Nama atau NIS --</option>
                            <?php if (!empty($santri_list)): ?>
                                <?php foreach ($santri_list as $sl): ?>
                                    <option value="<?= $sl->id; ?>" <?= $santri_id_selected == $sl->id ? 'selected' : ''; ?>>
                                        <?= html_escape($sl->nama); ?> (NIS: <?= html_escape($sl->no_induk); ?> &bull; <?= html_escape($sl->nama_kelas ?: 'Belum Ada Kelas'); ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <small class="text-muted">Pilih santri aktif yang akan dicatat pembayarannya.</small>
                    </div>

                    <!-- Jenis Pembayaran -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Pos Jenis Pembayaran <span class="text-danger">*</span></label>
                            <select name="jenis_pembayaran_id" id="selectJenis" class="form-select rounded-3" onchange="handleJenisChange()" required>
                                <?php if (!empty($jenis_list)): ?>
                                    <?php foreach ($jenis_list as $jl): ?>
                                        <option value="<?= $jl->id; ?>" data-nominal="<?= (float)$jl->nominal; ?>" data-periode="<?= $jl->periode; ?>">
                                            <?= html_escape($jl->nama); ?> (Tarif: <?= format_rupiah($jl->nominal); ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Tanggal Pembayaran <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_bayar" class="form-control rounded-3" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <!-- Pilihan Bulan & Tahun (Untuk SPP Bulanan) -->
                    <div class="p-3 bg-light rounded-4 border mb-4" id="boxBulan">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Bulan Pembayaran SPP</label>
                                <select name="bulan" id="selectBulan" class="form-select rounded-3">
                                    <?php for ($m = 1; $m <= 12; $m++): ?>
                                        <option value="<?= $m; ?>" <?= $bulan_selected == $m ? 'selected' : ''; ?>>
                                            Bulan <?= nama_bulan($m); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Tahun Pembayaran SPP</label>
                                <select name="tahun" class="form-select rounded-3">
                                    <?php for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++): ?>
                                        <option value="<?= $y; ?>" <?= $tahun_selected == $y ? 'selected' : ''; ?>><?= $y; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Pilihan Tahap (Untuk Sumbangan Wajib) -->
                    <div class="p-3 bg-light rounded-4 border mb-4" id="boxTahap" style="display: none;">
                        <label class="form-label small fw-bold text-secondary">Tahap Sumbangan</label>
                        <select name="tahap" class="form-select rounded-3">
                            <option value="1">Tahap 1</option>
                            <option value="2">Tahap 2</option>
                            <option value="3">Tahap 3</option>
                            <option value="4">Tahap 4</option>
                        </select>
                    </div>

                    <!-- Jumlah Pembayaran (Rupiah) -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Jumlah Uang Diterima (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text fw-bold bg-light">Rp</span>
                            <input type="number" name="jumlah" id="inputJumlah" class="form-control fw-bold text-success" value="150000" min="1000" required>
                        </div>
                        <small class="text-muted">Nominal dapat disesuaikan jika santri membayar dengan tarif khusus atau sumbangan sukarela.</small>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Catatan / Keterangan Tambahan (Opsional)</label>
                        <input type="text" name="keterangan" class="form-control rounded-3" placeholder="Contoh: Lunas via transfer / Tunai oleh wali">
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-3 border-top">
                        <a href="<?= base_url('bendahara/spp'); ?>" class="btn btn-outline-secondary px-4 rounded-pill">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" name="submit_action" value="simpan_kembali" class="btn btn-outline-success px-4 py-2.5 rounded-pill fw-semibold shadow-sm">
                                <i class="bi bi-check-lg me-1"></i> Simpan Saja (Buku Kas)
                            </button>
                            <button type="submit" name="submit_action" value="simpan_cetak" class="btn btn-success px-4 py-2.5 rounded-pill fw-bold shadow">
                                <i class="bi bi-printer-fill me-1"></i> Simpan & Cetak Kuitansi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function handleJenisChange() {
        const select = document.getElementById('selectJenis');
        const selected = select.options[select.selectedIndex];
        const nominal = selected.getAttribute('data-nominal');
        const periode = selected.getAttribute('data-periode');

        // Update nominal input
        if (nominal) {
            document.getElementById('inputJumlah').value = nominal;
        }

        const boxBulan = document.getElementById('boxBulan');
        const boxTahap = document.getElementById('boxTahap');

        if (periode === 'bulanan') {
            boxBulan.style.display = 'block';
            boxTahap.style.display = 'none';
        } else if (periode === 'per_tahap') {
            boxBulan.style.display = 'none';
            boxTahap.style.display = 'block';
        } else {
            boxBulan.style.display = 'none';
            boxTahap.style.display = 'none';
        }
    }

    // Call on page load
    document.addEventListener('DOMContentLoaded', handleJenisChange);
</script>
