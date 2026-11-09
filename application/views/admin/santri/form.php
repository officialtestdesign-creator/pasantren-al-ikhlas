<?php $is_edit = isset($s); ?>
<div class="container-fluid px-0">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?= base_url('admin/santri'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div>
            <h4 class="fw-bold text-dark mb-0"><?= $is_edit ? 'Ubah Data Santri: ' . html_escape($s->nama) : 'Tambah Data Santri Baru'; ?></h4>
            <small class="text-muted"><?= $is_edit ? 'Perbarui informasi biodata, kelas, atau status santri' : 'Input data santri baru secara manual ke Buku Induk Dayah'; ?></small>
        </div>
    </div>

    <div class="card card-custom">
        <form action="<?= $is_edit ? base_url('admin/santri/update/' . $s->id) : base_url('admin/santri/simpan'); ?>" method="POST" enctype="multipart/form-data" class="p-4 p-lg-5">
            
            <!-- 1. DATA PRIBADI SANTRI -->
            <h5 class="fw-bold text-success mb-3 pb-2 border-bottom">
                <i class="bi bi-person-vcard me-2"></i>1. Identitas Santri
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Nomor Induk Santri (NIS) <span class="text-danger">*</span></label>
                    <input type="text" name="no_induk" class="form-control font-monospace fw-bold" value="<?= set_value('no_induk', $is_edit ? $s->no_induk : $auto_nis); ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" maxlength="16" class="form-control" placeholder="16 digit angka" value="<?= set_value('nik', $is_edit ? $s->nik : ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Nama Lengkap Santri <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control fw-bold" placeholder="Nama lengkap santri" value="<?= set_value('nama', $is_edit ? $s->nama : ''); ?>" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" <?= set_select('jenis_kelamin', 'L', $is_edit && $s->jenis_kelamin === 'L'); ?>>Laki-laki (L)</option>
                        <option value="P" <?= set_select('jenis_kelamin', 'P', $is_edit && $s->jenis_kelamin === 'P'); ?>>Perempuan (P)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir', $is_edit ? $s->tempat_lahir : ''); ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir', $is_edit ? $s->tanggal_lahir : ''); ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Anak Ke / Dari Bersaudara</label>
                    <div class="input-group">
                        <input type="number" name="anak_ke" class="form-control" placeholder="Ke" value="<?= set_value('anak_ke', $is_edit ? $s->anak_ke : ''); ?>">
                        <span class="input-group-text">/</span>
                        <input type="number" name="jumlah_saudara" class="form-control" placeholder="Jml" value="<?= set_value('jumlah_saudara', $is_edit ? $s->jumlah_saudara : ''); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Asal Sekolah Terakhir</label>
                    <input type="text" name="asal_sekolah" class="form-control" placeholder="SD / SMP / MTsN ..." value="<?= set_value('asal_sekolah', $is_edit ? $s->asal_sekolah : ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Foto Santri (JPG/PNG)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <?php if ($is_edit && !empty($s->foto)): ?>
                        <small class="text-muted">File saat ini: <?= html_escape($s->foto); ?> (kosongkan jika tidak diubah)</small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 2. PENEMPATAN KELAS & STATUS -->
            <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">
                <i class="bi bi-mortarboard me-2"></i>2. Kelas & Status Keaktifan
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Penempatan Kelas Santri</label>
                    <select name="kelas_id" class="form-select">
                        <option value="">-- Belum Masuk Kelas --</option>
                        <?php if (!empty($kelas_list)): ?>
                            <?php foreach ($kelas_list as $kl): ?>
                                <option value="<?= $kl->id; ?>" <?= set_select('kelas_id', $kl->id, $is_edit && $s->kelas_id == $kl->id); ?>>
                                    <?= html_escape($kl->nama_kelas); ?> (Jenjang <?= html_escape($kl->nama_jenjang); ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Tahun Masuk Dayah</label>
                    <input type="number" name="tahun_masuk" class="form-control" value="<?= set_value('tahun_masuk', $is_edit ? $s->tahun_masuk : date('Y')); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Status Santri</label>
                    <select name="status" class="form-select">
                        <option value="aktif" <?= set_select('status', 'aktif', $is_edit && $s->status === 'aktif'); ?>>Aktif</option>
                        <option value="alumni" <?= set_select('status', 'alumni', $is_edit && $s->status === 'alumni'); ?>>Alumni (Tamat)</option>
                        <option value="keluar" <?= set_select('status', 'keluar', $is_edit && $s->status === 'keluar'); ?>>Keluar / Pindah</option>
                    </select>
                </div>
            </div>

            <!-- 3. ALAMAT ASAL -->
            <h5 class="fw-bold text-secondary mb-3 pb-2 border-bottom">
                <i class="bi bi-geo-alt me-2"></i>3. Alamat Asal Santri
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Gampong / Desa</label>
                    <input type="text" name="asal_gampong" class="form-control" value="<?= set_value('asal_gampong', $is_edit ? $s->asal_gampong : ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Kecamatan</label>
                    <input type="text" name="asal_kecamatan" class="form-control" value="<?= set_value('asal_kecamatan', $is_edit ? $s->asal_kecamatan : ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Kabupaten / Kota <span class="text-danger">*</span></label>
                    <input type="text" name="asal_kabupaten" class="form-control" value="<?= set_value('asal_kabupaten', $is_edit ? $s->asal_kabupaten : 'Bireuen'); ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Provinsi</label>
                    <input type="text" name="asal_provinsi" class="form-control" value="<?= set_value('asal_provinsi', $is_edit ? $s->asal_provinsi : 'Aceh'); ?>">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary">Alamat Domisili Lengkap</label>
                    <input type="text" name="alamat_domisili" class="form-control" placeholder="Dusun / Lorong / Jalan" value="<?= set_value('alamat_domisili', $is_edit ? $s->alamat_domisili : ''); ?>">
                </div>
            </div>

            <!-- 4. ORANG TUA & WALI -->
            <h5 class="fw-bold text-warning mb-3 pb-2 border-bottom">
                <i class="bi bi-people me-2"></i>4. Data Orang Tua & Wali
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Nama Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ayah" class="form-control" value="<?= set_value('nama_ayah', $is_edit ? $s->nama_ayah : ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" class="form-control" value="<?= set_value('pekerjaan_ayah', $is_edit ? $s->pekerjaan_ayah : ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Nama Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ibu" class="form-control" value="<?= set_value('nama_ibu', $is_edit ? $s->nama_ibu : ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu" class="form-control" value="<?= set_value('pekerjaan_ibu', $is_edit ? $s->pekerjaan_ibu : ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">No. HP / WhatsApp Orang Tua</label>
                    <input type="text" name="no_hp_ortu" class="form-control" value="<?= set_value('no_hp_ortu', $is_edit ? $s->no_hp_ortu : ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Alamat Orang Tua</label>
                    <input type="text" name="alamat_ortu" class="form-control" value="<?= set_value('alamat_ortu', $is_edit ? $s->alamat_ortu : ''); ?>">
                </div>

                <!-- Wali -->
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Nama Wali (Opsional)</label>
                    <input type="text" name="nama_wali" class="form-control" value="<?= set_value('nama_wali', $is_edit ? $s->nama_wali : ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" class="form-control" value="<?= set_value('pekerjaan_wali', $is_edit ? $s->pekerjaan_wali : ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">No. HP Wali</label>
                    <input type="text" name="no_hp_wali" class="form-control" value="<?= set_value('no_hp_wali', $is_edit ? $s->no_hp_wali : ''); ?>">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="<?= base_url('admin/santri'); ?>" class="btn btn-outline-secondary px-4 rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-success px-5 py-2.5 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-check-lg me-1"></i> <?= $is_edit ? 'Simpan Perubahan Data' : 'Simpan Data Santri Baru'; ?>
                </button>
            </div>
        </form>
    </div>
</div>
