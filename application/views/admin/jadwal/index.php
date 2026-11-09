<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-calendar-week-fill text-success me-2"></i>Jadwal Kegiatan & Pelajaran Dayah
        </h4>
        <p class="text-muted small mb-0">Atur jadwal rutinitas harian santri (ibadah & halaqah) dan jadwal pengajian mingguan per ruang kelas.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <?php if ($active_tab === 'belajar'): ?>
            <a href="<?= base_url('admin/jadwal/cetak?jenis=belajar&kelas_id=' . $kelas_id_selected); ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                <i class="bi bi-printer me-1"></i>Cetak Jadwal Kelas
            </a>
            <button type="button" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambahJadwalBelajar">
                <i class="bi bi-plus-lg me-1"></i>Tambah Jadwal Kelas
            </button>
        <?php else: ?>
            <a href="<?= base_url('admin/jadwal/cetak?jenis=kegiatan'); ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                <i class="bi bi-printer me-1"></i>Cetak Jadwal Harian
            </a>
            <button type="button" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambahJadwalKegiatan">
                <i class="bi bi-plus-lg me-1"></i>Tambah Kegiatan Harian
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Navigation Tabs -->
<ul class="nav nav-pills custom-pills mb-4 bg-white p-2 rounded-3 shadow-sm border">
    <li class="nav-item">
        <a class="nav-link <?= $active_tab === 'kegiatan' ? 'active' : ''; ?> fw-medium" href="<?= base_url('admin/jadwal?tab=kegiatan'); ?>">
            <i class="bi bi-clock-history me-1.5"></i>Jadwal Kegiatan Harian Santri (Rutinitas)
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $active_tab === 'belajar' ? 'active' : ''; ?> fw-medium" href="<?= base_url('admin/jadwal?tab=belajar'); ?>">
            <i class="bi bi-journal-text me-1.5"></i>Jadwal Belajar Mengajar per Kelas
        </a>
    </li>
</ul>

<?php if ($active_tab === 'kegiatan'): ?>
    <!-- TAB 1: JADWAL KEGIATAN HARIAN -->
    <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
            <div>
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-sunrise text-warning me-2"></i>Rutinitas Harian Santri Dayah Al-Ikhlas</h6>
                <small class="text-muted">Jadwal ibadah, makan, sekolah, istirahat dan mudzakarah kitab kuning</small>
            </div>
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2.5 py-1 rounded-pill small">
                <?= count($jadwal_kegiatan); ?> Sesi Terdaftar
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="small text-muted text-uppercase">
                        <th class="ps-4" style="width: 60px;">Urut</th>
                        <th style="width: 180px;">Waktu (Jam)</th>
                        <th>Kegiatan Santri</th>
                        <th>Keterangan / Lokasi</th>
                        <th class="text-end pe-4" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jadwal_kegiatan)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada jadwal kegiatan harian.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($jadwal_kegiatan as $jk): ?>
                            <tr>
                                <td class="ps-4 text-muted small"><span class="badge bg-light text-secondary border"><?= $jk->urutan; ?></span></td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary font-monospace px-2.5 py-1.5 rounded-pill fw-bold">
                                        <i class="bi bi-clock me-1"></i><?= substr($jk->jam_mulai, 0, 5); ?> - <?= substr($jk->jam_selesai, 0, 5); ?> WIB
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark fs-6"><?= htmlspecialchars($jk->kegiatan); ?></span>
                                </td>
                                <td class="text-muted small">
                                    <i class="bi bi-geo-alt me-1 text-danger opacity-75"></i><?= htmlspecialchars($jk->keterangan ?: '-'); ?>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2.5 py-1 btn-edit-kegiatan"
                                            data-id="<?= $jk->id; ?>"
                                            data-mulai="<?= $jk->jam_mulai; ?>"
                                            data-selesai="<?= $jk->jam_selesai; ?>"
                                            data-kegiatan="<?= htmlspecialchars($jk->kegiatan); ?>"
                                            data-ket="<?= htmlspecialchars($jk->keterangan); ?>"
                                            data-urutan="<?= $jk->urutan; ?>"
                                            title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="<?= base_url('admin/jadwal/hapus_kegiatan/' . $jk->id); ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-pill px-2.5 py-1" 
                                       data-name="Kegiatan <?= htmlspecialchars($jk->kegiatan); ?>"
                                       data-sub="Waktu: <?= substr($jk->jam_mulai, 0, 5); ?> - <?= substr($jk->jam_selesai, 0, 5); ?> WIB &bull; <?= htmlspecialchars($jk->keterangan ?: '-'); ?>"
                                       data-title="Hapus Kegiatan Harian"
                                       title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php else: ?>
    <!-- TAB 2: JADWAL BELAJAR PER KELAS -->
    <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-calendar3 text-success me-2"></i>Jadwal Belajar Klasikal Per Ruang Kelas</h6>
                <small class="text-muted">Pilih kelas untuk mengatur waktu pengajian dan Teungku pengajar</small>
            </div>
            <form method="GET" action="<?= base_url('admin/jadwal'); ?>" class="d-flex align-items-center gap-2">
                <input type="hidden" name="tab" value="belajar">
                <select name="kelas_id" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 170px;">
                    <?php foreach ($kelas_list as $k): ?>
                        <option value="<?= $k->id; ?>" <?= $k->id == $kelas_id_selected ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($k->nama_kelas); ?> (<?= $k->nama_jenjang; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <?php if ($selected_kelas): ?>
            <div class="p-3 bg-light border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <span class="badge bg-emerald-subtle text-emerald px-2.5 py-1 rounded-pill fw-semibold me-2">
                        <?= $selected_kelas->nama_jenjang; ?> - <?= $selected_kelas->nama_kelas; ?>
                    </span>
                    <span class="small text-muted">Wali Kelas: <strong><?= $selected_kelas->nama_wali ?: 'Belum ditentukan'; ?></strong></span>
                </div>
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambahJadwalBelajar">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Jadwal Pelajaran
                </button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="small text-muted text-uppercase">
                        <th class="ps-4" style="width: 110px;">Hari</th>
                        <th style="width: 160px;">Jam</th>
                        <th>Kitab / Mata Pelajaran</th>
                        <th>Teungku Pengasuh</th>
                        <th class="text-end pe-4" style="width: 80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jadwal_belajar)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-journal-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada jadwal pengajian untuk kelas ini.<br>
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 mt-2" data-bs-toggle="modal" data-bs-target="#modalTambahJadwalBelajar">
                                    <i class="bi bi-plus-lg me-1"></i>Tambah Jadwal Pertama
                                </button>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($jadwal_belajar as $jb): ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-dark bg-opacity-75 text-white px-2.5 py-1 rounded-pill fw-bold">
                                        <?= $jb->hari; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="font-monospace small text-dark fw-bold">
                                        <i class="bi bi-clock me-1 text-muted"></i><?= substr($jb->jam_mulai, 0, 5); ?> - <?= substr($jb->jam_selesai, 0, 5); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark fs-6"><?= htmlspecialchars($jb->nama_bidang_studi); ?></span>
                                </td>
                                <td>
                                    <?php if ($jb->nama_guru): ?>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 24px; height: 24px; font-size: 0.7rem;">
                                                T
                                            </div>
                                            <span class="text-dark small fw-medium"><?= htmlspecialchars($jb->nama_guru); ?></span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small fst-italic">Belum Ditugaskan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('admin/jadwal/hapus_belajar/' . $jb->id); ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-circle p-1" 
                                       style="width: 28px; height: 28px;"
                                       data-name="Kitab <?= htmlspecialchars($jb->nama_kitab); ?> (<?= htmlspecialchars($jb->hari); ?>)"
                                       data-sub="Kelas: <?= htmlspecialchars($jb->nama_kelas); ?> &bull; Jam: <?= htmlspecialchars($jb->jam_mulai); ?> - <?= htmlspecialchars($jb->jam_selesai); ?>"
                                       data-title="Hapus Jadwal Pelajaran"
                                       title="Hapus">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<!-- Modal Tambah Jadwal Kegiatan Harian -->
<div class="modal fade" id="modalTambahJadwalKegiatan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="<?= base_url('admin/jadwal/simpan_kegiatan'); ?>" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-plus-circle text-success me-2"></i>Tambah Kegiatan Harian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Selesai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="kegiatan" class="form-control" placeholder="Contoh: Shalat Subuh & Wirid, Pengajian Kitab" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Keterangan / Lokasi</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Musalla Utama Dayah">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nomor Urut Tampil</label>
                        <input type="number" name="urutan" class="form-control" value="<?= count($jadwal_kegiatan) + 1; ?>">
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan Kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Jadwal Kegiatan -->
<div class="modal fade" id="modalEditJadwalKegiatan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form id="formEditKegiatan" action="" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-pencil-square text-success me-2"></i>Edit Kegiatan Harian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_mulai" id="edit_jam_mulai" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Selesai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_selesai" id="edit_jam_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="kegiatan" id="edit_kegiatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Keterangan / Lokasi</label>
                        <input type="text" name="keterangan" id="edit_keterangan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nomor Urut Tampil</label>
                        <input type="number" name="urutan" id="edit_urutan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Jadwal Belajar Kelas -->
<div class="modal fade" id="modalTambahJadwalBelajar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="<?= base_url('admin/jadwal/simpan_belajar'); ?>" method="POST">
                <input type="hidden" name="kelas_id" value="<?= $kelas_id_selected; ?>">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-plus-circle text-success me-2"></i>Tambah Jadwal Pelajaran Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Hari <span class="text-danger">*</span></label>
                        <select name="hari" class="form-select" required>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Ahad">Ahad</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat (Libur / Kajian Umum)</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_mulai" class="form-control" value="08:00" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Jam Selesai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_selesai" class="form-control" value="09:30" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Bidang Studi / Kitab Kuning <span class="text-danger">*</span></label>
                        <select name="bidang_studi_id" class="form-select" required>
                            <option value="">-- Pilih Kitab --</option>
                            <?php foreach ($bidang_studi_list as $bs): ?>
                                <option value="<?= $bs->id; ?>"><?= htmlspecialchars($bs->nama); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Teungku Pengampu</label>
                        <select name="guru_id" class="form-select">
                            <option value="">-- Pilih Guru / Teungku (Opsional) --</option>
                            <?php foreach ($guru_list as $g): ?>
                                <option value="<?= $g->id; ?>"><?= htmlspecialchars($g->nama); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.btn-edit-kegiatan');
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const mulai = this.getAttribute('data-mulai');
            const selesai = this.getAttribute('data-selesai');
            const kegiatan = this.getAttribute('data-kegiatan');
            const ket = this.getAttribute('data-ket');
            const urutan = this.getAttribute('data-urutan');

            document.getElementById('edit_jam_mulai').value = mulai.substring(0, 5);
            document.getElementById('edit_jam_selesai').value = selesai.substring(0, 5);
            document.getElementById('edit_kegiatan').value = kegiatan;
            document.getElementById('edit_keterangan').value = ket || '';
            document.getElementById('edit_urutan').value = urutan;
            document.getElementById('formEditKegiatan').action = '<?= base_url("admin/jadwal/update_kegiatan/"); ?>' + id;

            const modal = new bootstrap.Modal(document.getElementById('modalEditJadwalKegiatan'));
            modal.show();
        });
    });
});
</script>
