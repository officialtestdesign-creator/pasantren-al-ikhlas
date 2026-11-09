<?php $is_edit = isset($g); ?>
<div class="container-fluid px-0">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?= base_url('admin/guru'); ?>" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div>
            <h4 class="fw-bold text-dark mb-0"><?= $is_edit ? 'Ubah Data Guru: ' . html_escape($g->nama) : 'Tambah Dewan Guru / Teungku Baru'; ?></h4>
            <small class="text-muted"><?= $is_edit ? 'Perbarui data kepegawaian, kontak, atau mata pelajaran yang diampu' : 'Input data asatidz/asatidzah ke database Dayah Al-Ikhlas'; ?></small>
        </div>
    </div>

    <div class="card card-custom">
        <form action="<?= $is_edit ? base_url('admin/guru/update/' . $g->id) : base_url('admin/guru/simpan'); ?>" method="POST" enctype="multipart/form-data" class="p-4 p-lg-5">
            
            <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">
                <i class="bi bi-person-badge me-2"></i>1. Identitas & Kepegawaian Guru
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Nomor Induk Guru / Pegawai</label>
                    <input type="text" name="no_induk" class="form-control font-monospace fw-bold" value="<?= set_value('no_induk', $is_edit ? $g->no_induk : $auto_no_induk); ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" maxlength="16" class="form-control" placeholder="16 digit angka" value="<?= set_value('nik', $is_edit ? $g->nik : ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control fw-bold" placeholder="Contoh: Tgk. H. ..." value="<?= set_value('nama', $is_edit ? $g->nama : ''); ?>" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" <?= set_select('jenis_kelamin', 'L', $is_edit && $g->jenis_kelamin === 'L'); ?>>Laki-laki (Teungku/Ustadz)</option>
                        <option value="P" <?= set_select('jenis_kelamin', 'P', $is_edit && $g->jenis_kelamin === 'P'); ?>>Perempuan (Ustazah)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir', $is_edit ? $g->tempat_lahir : ''); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir', $is_edit ? $g->tanggal_lahir : ''); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan_terakhir" class="form-control" placeholder="Ma'had Aly / S1 / Ulya" value="<?= set_value('pendidikan_terakhir', $is_edit ? $g->pendidikan_terakhir : ''); ?>">
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Status PNS <span class="text-danger">*</span></label>
                    <select name="status_pns" class="form-select" required>
                        <option value="NON PNS" <?= set_select('status_pns', 'NON PNS', $is_edit && $g->status_pns === 'NON PNS'); ?>>NON PNS</option>
                        <option value="PNS" <?= set_select('status_pns', 'PNS', $is_edit && $g->status_pns === 'PNS'); ?>>PNS</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Status Kepegawaian <span class="text-danger">*</span></label>
                    <select name="status_tetap" class="form-select" required>
                        <option value="TETAP" <?= set_select('status_tetap', 'TETAP', $is_edit && $g->status_tetap === 'TETAP'); ?>>TETAP</option>
                        <option value="TIDAK TETAP" <?= set_select('status_tetap', 'TIDAK TETAP', $is_edit && $g->status_tetap === 'TIDAK TETAP'); ?>>TIDAK TETAP</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Status Keaktifan</label>
                    <select name="aktif" class="form-select">
                        <option value="1" <?= set_select('aktif', '1', $is_edit && $g->aktif == 1); ?>>Aktif Mengajar</option>
                        <option value="0" <?= set_select('aktif', '0', $is_edit && $g->aktif == 0); ?>>Non-Aktif</option>
                    </select>
                </div>

                <div class="col-md-8">
                    <label class="form-label small fw-bold text-secondary">Mata Pelajaran / Kitab Yang Diasuh</label>
                    <input type="text" name="mata_pelajaran" class="form-control" placeholder="Contoh: Fiqih, Nahwu, Hadits (teks bebas sesuai format Dinas)" value="<?= set_value('mata_pelajaran', $is_edit ? $g->mata_pelajaran : ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Foto Pengajar (JPG/PNG)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
            </div>

            <h5 class="fw-bold text-secondary mb-3 pb-2 border-bottom">
                <i class="bi bi-geo-alt me-2"></i>2. Asal Daerah & Kontak
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Desa / Gampong Asal</label>
                    <input type="text" name="asal_desa" class="form-control" value="<?= set_value('asal_desa', $is_edit ? $g->asal_desa : ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Kecamatan Asal</label>
                    <input type="text" name="asal_kecamatan" class="form-control" value="<?= set_value('asal_kecamatan', $is_edit ? $g->asal_kecamatan : ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Kabupaten / Kota Asal</label>
                    <input type="text" name="asal_kabupaten" class="form-control" value="<?= set_value('asal_kabupaten', $is_edit ? $g->asal_kabupaten : 'Bireuen'); ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Alamat Domisili Lengkap</label>
                    <input type="text" name="alamat_domisili" class="form-control" placeholder="Alamat tinggal saat ini" value="<?= set_value('alamat_domisili', $is_edit ? $g->alamat_domisili : ''); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">No. Handphone / WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" value="<?= set_value('no_hp', $is_edit ? $g->no_hp : ''); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@dayah.com" value="<?= set_value('email', $is_edit ? $g->email : ''); ?>">
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="<?= base_url('admin/guru'); ?>" class="btn btn-outline-secondary px-4 rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-5 py-2.5 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-check-lg me-1"></i> <?= $is_edit ? 'Simpan Perubahan Data' : 'Simpan Data Dewan Guru'; ?>
                </button>
            </div>
        </form>
    </div>
</div>
