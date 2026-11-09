<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?= base_url('admin/santri'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div>
            <h4 class="fw-bold text-dark mb-0">Kenaikan Kelas & Mutasi Massal Santri</h4>
            <small class="text-muted">Proses kenaikan kelas santri secara serentak per rombongan belajar atau kelulusan alumni.</small>
        </div>
    </div>

    <!-- Pilih Kelas Asal -->
    <div class="card card-custom mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-funnel-fill text-primary"></i>
                <span>Langkah 1: Pilih Kelas Asal yang Akan Diproses</span>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="<?= base_url('admin/santri/kenaikan_kelas'); ?>" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Pilih Kelas Saat Ini</label>
                    <select name="kelas_asal_id" class="form-select form-select-lg" required>
                        <option value="">-- Pilih Rombongan Kelas Asal --</option>
                        <?php if (!empty($kelas_list)): ?>
                            <?php foreach ($kelas_list as $kl): ?>
                                <option value="<?= $kl->id; ?>" <?= $kelas_asal_id == $kl->id ? 'selected' : ''; ?>>
                                    <?= html_escape($kl->nama_kelas); ?> (Jenjang <?= html_escape($kl->nama_jenjang); ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                        <i class="bi bi-search me-1"></i> Tampilkan Santri
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Santri & Eksekusi Kenaikan -->
    <?php if ($kelas_asal_id): ?>
        <form action="<?= base_url('admin/santri/proses_kenaikan_kelas'); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memproses kenaikan kelas / kelulusan untuk seluruh santri yang dicentang?');">
            <input type="hidden" name="kelas_asal_id" value="<?= html_escape($kelas_asal_id); ?>">

            <div class="card card-custom mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check2-square text-success"></i>
                        <span>Langkah 2: Pilih Santri yang Memenuhi Syarat Kenaikan (<?= count($santri_list); ?> Santri)</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="toggleSelectAll()">
                            <i class="bi bi-check-all"></i> Centang / Batal Semua
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th>NIS</th>
                                <th>Nama Lengkap Santri</th>
                                <th class="text-center">JK</th>
                                <th>Asal Daerah</th>
                                <th>Tahun Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($santri_list)): ?>
                                <?php foreach ($santri_list as $s): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="santri_ids[]" value="<?= $s->id; ?>" class="form-check-input santri-check" checked>
                                        </td>
                                        <td class="font-monospace fw-bold"><?= html_escape($s->no_induk); ?></td>
                                        <td class="fw-semibold text-dark"><?= html_escape($s->nama); ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $s->jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger'; ?> bg-opacity-10 <?= $s->jenis_kelamin === 'L' ? 'text-primary' : 'text-danger'; ?>">
                                                <?= $s->jenis_kelamin; ?>
                                            </span>
                                        </td>
                                        <td><?= html_escape($s->asal_kabupaten ?: '-'); ?></td>
                                        <td><?= html_escape($s->tahun_masuk ?: '-'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Tidak ada santri aktif di kelas yang dipilih.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Langkah 3: Pilih Aksi dan Tujuan -->
            <?php if (!empty($santri_list)): ?>
                <div class="card card-custom p-4 border-2 border-primary mb-4">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-arrow-right-circle text-primary me-2"></i>Langkah 3: Tentukan Aksi Kenaikan / Kelulusan</h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Aksi yang Dijalankan</label>
                            <select name="aksi" id="selectAksi" class="form-select form-select-lg" onchange="checkAksi()">
                                <option value="pindah">Naikkan / Pindahkan ke Kelas Berikutnya</option>
                                <option value="lulus">Tamat Belajar (Ubah Status Menjadi Alumni)</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="boxKelasTujuan">
                            <label class="form-label small fw-bold text-secondary">Pilih Kelas Tujuan Baru <span class="text-danger">*</span></label>
                            <select name="kelas_tujuan_id" id="selectKelasTujuan" class="form-select form-select-lg">
                                <option value="">-- Pilih Kelas Tujuan --</option>
                                <?php if (!empty($kelas_list)): ?>
                                    <?php foreach ($kelas_list as $kl): ?>
                                        <?php if ($kl->id != $kelas_asal_id): ?>
                                            <option value="<?= $kl->id; ?>">
                                                <?= html_escape($kl->nama_kelas); ?> (Jenjang <?= html_escape($kl->nama_jenjang); ?>)
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill fw-bold shadow">
                            <i class="bi bi-check-circle-fill me-2"></i> Eksekusi Kenaikan Kelas Massal
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</div>

<script>
    function toggleSelectAll() {
        const checkboxes = document.querySelectorAll('.santri-check');
        const allChecked = Array.from(checkboxes).every(c => c.checked);
        checkboxes.forEach(c => c.checked = !allChecked);
    }

    function checkAksi() {
        const aksi = document.getElementById('selectAksi').value;
        const boxTujuan = document.getElementById('boxKelasTujuan');
        if (aksi === 'lulus') {
            boxTujuan.style.display = 'none';
        } else {
            boxTujuan.style.display = 'block';
        }
    }
</script>
