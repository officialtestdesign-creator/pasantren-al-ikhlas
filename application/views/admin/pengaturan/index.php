<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-sliders text-success me-2"></i>Profil Lembaga & Pengaturan Sistem
        </h4>
        <p class="text-muted small mb-0">Kelola identitas kelembagaan Dayah Al-Ikhlas, tahun ajaran aktif, master tarif pembayaran, dan akun pengguna sistem.</p>
    </div>
</div>

<!-- Navigation Tabs -->
<ul class="nav nav-pills custom-pills mb-4 bg-white p-2 rounded-3 shadow-sm border">
    <li class="nav-item">
        <a class="nav-link <?= $active_tab === 'profil' ? 'active' : ''; ?> fw-medium" href="<?= base_url('admin/pengaturan?tab=profil'); ?>">
            <i class="bi bi-bank2 me-1.5"></i>Profil Kelembagaan Dayah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $active_tab === 'tahun_ajaran' ? 'active' : ''; ?> fw-medium" href="<?= base_url('admin/pengaturan?tab=tahun_ajaran'); ?>">
            <i class="bi bi-calendar-check me-1.5"></i>Tahun Ajaran
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $active_tab === 'tarif' ? 'active' : ''; ?> fw-medium" href="<?= base_url('admin/pengaturan?tab=tarif'); ?>">
            <i class="bi bi-tags me-1.5"></i>Master Tarif Pembayaran
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $active_tab === 'pengguna' ? 'active' : ''; ?> fw-medium" href="<?= base_url('admin/pengaturan?tab=pengguna'); ?>">
            <i class="bi bi-people-gear me-1.5"></i>Akun & Hak Akses
        </a>
    </li>
</ul>

<?php if ($active_tab === 'profil'): ?>
    <!-- TAB 1: PROFIL LEMBAGA -->
    <div class="card-custom bg-white border-0 shadow-sm rounded-3 p-4">
        <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">
            <i class="bi bi-info-circle-fill text-success me-2"></i>Informasi Kelembagaan Dayah
        </h6>
        <form action="<?= base_url('admin/pengaturan/simpan_profil'); ?>" method="POST">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-dark">Nama Resmi Dayah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_dayah" class="form-control" value="<?= htmlspecialchars($profil->nama_dayah ?? ''); ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-dark">Tahun Berdiri</label>
                    <input type="number" name="tahun_berdiri" class="form-control" value="<?= htmlspecialchars($profil->tahun_berdiri ?? ''); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-dark">Status Kelembagaan</label>
                    <input type="text" name="status_kelembagaan" class="form-control" value="<?= htmlspecialchars(($profil->status_kelembagaan ?? '') ?: 'Yayasan/Lembaga Pendidikan Islam'); ?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-dark">Nama Pimpinan Dayah (Abu/Ayah/Wadir)</label>
                    <input type="text" name="nama_pimpinan" class="form-control" value="<?= htmlspecialchars($profil->nama_pimpinan ?? ''); ?>" placeholder="Contoh: Tgk. H. Ibrahim, S.Pd.I">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-dark">Nomor Izin Operasional Dinas</label>
                    <input type="text" name="izin_operasional" class="form-control" value="<?= htmlspecialchars($profil->izin_operasional ?? ''); ?>" placeholder="Nomor SK Izin Operasional...">
                </div>
            </div>

            <h6 class="fw-bold text-dark mt-4 mb-3 border-bottom pb-2">
                <i class="bi bi-geo-alt-fill text-danger me-2"></i>Alamat & Kontak Resmi
            </h6>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-dark">Gampong / Desa</label>
                    <input type="text" name="gampong" class="form-control" value="<?= htmlspecialchars(($profil->gampong ?? '') ?: 'Sangso'); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-dark">Kemukiman</label>
                    <input type="text" name="kemukiman" class="form-control" value="<?= htmlspecialchars(($profil->kemukiman ?? '') ?: 'Samalanga'); ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold text-dark">Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control" value="<?= htmlspecialchars(($profil->kecamatan ?? '') ?: 'Samalanga'); ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold text-dark">Kabupaten</label>
                    <input type="text" name="kabupaten" class="form-control" value="<?= htmlspecialchars(($profil->kabupaten ?? '') ?: 'Bireuen'); ?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-dark">Nomor Kontak / WhatsApp Dayah</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($profil->no_hp ?? ''); ?>" placeholder="08xxxxxxxxxx">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-dark">Alamat Email Dayah</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($profil->email ?? ''); ?>" placeholder="dayah.alikhlas@gmail.com">
                </div>
            </div>

            <h6 class="fw-bold text-dark mt-4 mb-3 border-bottom pb-2">
                <i class="bi bi-compass-fill text-primary me-2"></i>Visi, Misi & Sejarah
            </h6>
            <div class="mb-3">
                <label class="form-label small fw-bold text-dark">Visi Dayah</label>
                <textarea name="visi" class="form-control" rows="2"><?= htmlspecialchars($profil->visi ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-dark">Misi Dayah</label>
                <textarea name="misi" class="form-control" rows="3"><?= htmlspecialchars($profil->misi ?? ''); ?></textarea>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-dark">Ringkasan Sejarah Berdirinya Dayah</label>
                <textarea name="sejarah" class="form-control" rows="3"><?= htmlspecialchars($profil->sejarah ?? ''); ?></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium shadow-sm">
                    <i class="bi bi-save me-1"></i>Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>

<?php elseif ($active_tab === 'tahun_ajaran'): ?>
    <!-- TAB 2: TAHUN AJARAN -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-calendar3 text-success me-2"></i>Daftar Tahun Ajaran Dayah</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th class="ps-4">No</th>
                                <th>Tahun Ajaran</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status Aktif</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($ta_list as $ta): ?>
                                <tr>
                                    <td class="ps-4 text-muted small"><?= $no++; ?></td>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($ta->nama ?? ''); ?></td>
                                    <td class="small text-muted"><?= $ta->tanggal_mulai ? format_tanggal($ta->tanggal_mulai) : '-'; ?></td>
                                    <td class="small text-muted"><?= $ta->tanggal_selesai ? format_tanggal($ta->tanggal_selesai) : '-'; ?></td>
                                    <td>
                                        <?php if ($ta->aktif): ?>
                                            <span class="badge bg-success rounded-pill px-2.5 py-1 fw-bold">
                                                <i class="bi bi-check2-circle me-1"></i>Aktif Berjalan
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary bg-opacity-25 text-secondary rounded-pill px-2 py-0.5">Tidak Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <?php if (!$ta->aktif): ?>
                                            <a href="<?= base_url('admin/pengaturan/set_tahun_ajaran_aktif/' . $ta->id); ?>" 
                                               class="btn btn-sm btn-outline-success rounded-pill px-3 py-1"
                                               onclick="return confirm('Alihkan tahun ajaran aktif ke <?= htmlspecialchars($ta->nama ?? ''); ?>?');">
                                                Aktifkan
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-custom bg-white border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-plus-circle text-success me-2"></i>Tambah Tahun Ajaran</h6>
                <form action="<?= base_url('admin/pengaturan/simpan_tahun_ajaran'); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Tahun Ajaran <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: 2027/2028" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill w-100 fw-medium">
                        Simpan Tahun Ajaran
                    </button>
                </form>
            </div>
        </div>
    </div>

<?php elseif ($active_tab === 'tarif'): ?>
    <!-- TAB 3: TARIF PEMBAYARAN -->
    <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-currency-dollar text-success me-2"></i>Master Tarif Pembayaran Dayah</h6>
            <small class="text-muted">Atur nominal tagihan SPP bulanan, biaya pendaftaran santri baru, dan sumbangan wajib.</small>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="small text-muted text-uppercase">
                        <th class="ps-4">No</th>
                        <th>Jenis Pembayaran</th>
                        <th>Periode Tagihan</th>
                        <th>Nominal Berlaku</th>
                        <th class="text-end pe-4" style="width: 250px;">Ubah Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($jenis_pembayaran as $jp): ?>
                        <tr>
                            <td class="ps-4 text-muted small"><?= $no++; ?></td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($jp->nama ?? ''); ?></td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-dark rounded-pill px-2 py-0.5">
                                    <?= ucfirst(str_replace('_', ' ', $jp->periode ?? '')); ?>
                                </span>
                            </td>
                            <td>
                                <span class="fs-6 fw-bold text-success font-monospace">
                                    <?= format_rupiah($jp->nominal); ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <form action="<?= base_url('admin/pengaturan/update_tarif'); ?>" method="POST" class="d-flex align-items-center justify-content-end gap-2">
                                    <input type="hidden" name="id" value="<?= $jp->id; ?>">
                                    <input type="number" name="nominal" class="form-control form-control-sm text-end" value="<?= (int)$jp->nominal; ?>" style="width: 130px;" required>
                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php elseif ($active_tab === 'pengguna'): ?>
    <!-- TAB 4: AKUN & HAK AKSES -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-white py-3 px-4 border-bottom">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-people-fill text-success me-2"></i>Daftar Pengguna Sistem</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th class="ps-4">No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Peran (Role)</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Ganti Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($user_list as $u): ?>
                                <tr>
                                    <td class="ps-4 text-muted small"><?= $no++; ?></td>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($u->nama ?? ''); ?></td>
                                    <td class="font-monospace small"><?= htmlspecialchars($u->username ?? ''); ?></td>
                                    <td>
                                        <?php if ($u->role === 'admin'): ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2.5 py-1 fw-bold">Admin</span>
                                        <?php elseif ($u->role === 'bendahara'): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 fw-bold">Bendahara</span>
                                        <?php elseif ($u->role === 'pimpinan'): ?>
                                            <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-2.5 py-1 fw-bold">Pimpinan</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary rounded-pill px-2 py-0.5"><?= $u->role; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2 py-0.5">Aktif</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex align-items-center justify-content-end gap-1.5">
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2.5 py-1 btn-pwd-user"
                                                    data-id="<?= $u->id; ?>"
                                                    data-nama="<?= htmlspecialchars($u->nama ?? ''); ?>">
                                                <i class="bi bi-key me-1"></i>Reset Password
                                            </button>
                                            <?php if ($u->id != user_id()): ?>
                                                <a href="<?= base_url('admin/pengaturan/hapus_user/' . $u->id); ?>" 
                                                   class="btn btn-sm btn-outline-danger rounded-circle p-1" 
                                                   style="width: 28px; height: 28px;"
                                                   data-name="<?= htmlspecialchars($u->nama ?? ''); ?> (<?= htmlspecialchars($u->username ?? ''); ?>)"
                                                   data-sub="Role: <?= strtoupper($u->role ?? ''); ?> &bull; Email: <?= htmlspecialchars($u->email ?? '-'); ?>"
                                                   data-title="Hapus Akun Pengguna"
                                                   title="Hapus Pengguna">
                                                    <i class="bi bi-trash" style="font-size: 0.75rem;"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-custom bg-white border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-plus-fill text-success me-2"></i>Tambah Akun Pengguna</h6>
                <form action="<?= base_url('admin/pengaturan/simpan_user'); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama staf/petugas" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control" placeholder="username_login" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Kata Sandi (Password) <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 4 karakter" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Peran / Hak Akses <span class="text-danger">*</span></label>
                        <select name="role" class="form-select" required>
                            <option value="admin">Administrator (Hak Penuh)</option>
                            <option value="bendahara">Bendahara (Keuangan & SPP)</option>
                            <option value="pimpinan">Pimpinan (Monitoring & Eksekutif)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill w-100 fw-medium">
                        Buat Pengguna Baru
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Reset Password -->
    <div class="modal fade" id="modalResetPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-3">
                <form action="<?= base_url('admin/pengaturan/ganti_password_user'); ?>" method="POST">
                    <input type="hidden" name="user_id" id="pwd_user_id">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title fw-bold text-dark"><i class="bi bi-key text-success me-2"></i>Reset Kata Sandi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-3">Masukkan kata sandi baru untuk pengguna: <strong id="pwd_nama_user" class="text-dark"></strong></p>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Kata Sandi Baru <span class="text-danger">*</span></label>
                            <input type="password" name="password_baru" class="form-control" placeholder="Minimal 4 karakter" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top bg-light">
                        <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan Password Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const pwdBtns = document.querySelectorAll('.btn-pwd-user');
        pwdBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                document.getElementById('pwd_user_id').value = id;
                document.getElementById('pwd_nama_user').textContent = nama;

                const modal = new bootstrap.Modal(document.getElementById('modalResetPassword'));
                modal.show();
            });
        });
    });
    </script>
<?php endif; ?>
