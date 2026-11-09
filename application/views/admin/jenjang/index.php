<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-mortarboard-fill text-success me-2"></i>Manajemen Jenjang & Kelas Dayah
        </h4>
        <p class="text-muted small mb-0">Kelola jenjang pendidikan (Tajhizi s/d Ma'had Aly), pembagian ruang kelas, dan penugasan wali kelas Teungku.</p>
    </div>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-3 shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambahJenjang">
            <i class="bi bi-plus-circle me-1"></i>Tambah Jenjang
        </button>
        <button type="button" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
            <i class="bi bi-plus-lg me-1"></i>Buka Kelas Baru
        </button>
    </div>
</div>

<!-- Metrics Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-medium">Total Jenjang</div>
                    <div class="fs-4 fw-bold text-dark mt-1"><?= count($jenjang_list); ?> <span class="fs-6 fw-normal text-muted">Tingkat</span></div>
                </div>
                <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success fs-4">
                    <i class="bi bi-layers-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-medium">Total Rombel / Kelas</div>
                    <div class="fs-4 fw-bold text-dark mt-1"><?= $total_kelas; ?> <span class="fs-6 fw-normal text-muted">Ruang</span></div>
                </div>
                <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary fs-4">
                    <i class="bi bi-door-open-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-medium">Santri di Rombel</div>
                    <div class="fs-4 fw-bold text-dark mt-1"><?= $total_santri_terdaftar; ?> <span class="fs-6 fw-normal text-muted">Santri</span></div>
                </div>
                <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning fs-4">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-custom p-3 bg-white border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-medium">Tahun Ajaran Aktif</div>
                    <div class="fs-5 fw-bold text-emerald mt-1"><?= $ta_aktif ? $ta_aktif->nama : '2026/2027'; ?></div>
                </div>
                <div class="rounded-3 p-3 bg-info bg-opacity-10 text-info fs-4">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jenjang Summary Pills -->
<div class="card-custom bg-white p-3 mb-4 border-0 shadow-sm rounded-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
        <span class="fw-bold text-dark small"><i class="bi bi-bookmark-check-fill text-success me-1"></i> Struktur Jenjang Salafiyah:</span>
        <form method="GET" action="<?= base_url('admin/jenjang'); ?>" class="d-flex align-items-center gap-2">
            <label class="small text-muted mb-0">Tahun Ajaran:</label>
            <select name="tahun_ajaran_id" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 140px;">
                <?php foreach ($ta_list as $ta): ?>
                    <option value="<?= $ta->id; ?>" <?= $ta->id == $ta_id_selected ? 'selected' : ''; ?>>
                        <?= $ta->nama; ?> <?= $ta->aktif ? '(Aktif)' : ''; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <?php foreach ($jenjang_list as $j): ?>
            <?php 
                $has_kelas = 0;
                foreach ($kelas_list as $kls) {
                    if ($kls->jenjang_id == $j->id) $has_kelas++;
                }
            ?>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-medium d-flex align-items-center gap-2">
                <span class="badge rounded-circle bg-success text-white px-2 py-1"><?= $j->urutan; ?></span>
                <span class="fw-bold"><?= $j->nama; ?></span>
                <?php if ($has_kelas == 0): ?>
                    <a href="<?= base_url('admin/jenjang/hapus_jenjang/' . $j->id); ?>" 
                       class="text-danger p-0 ms-1 text-decoration-none" 
                       data-name="Jenjang <?= htmlspecialchars($j->nama); ?>"
                       data-sub="Tingkat <?= $j->urutan; ?> &bull; Belum Ada Rombel"
                       data-title="Hapus Jenjang Pendidikan"
                       title="Hapus Jenjang">
                        <i class="bi bi-x-circle-fill"></i>
                    </a>
                <?php endif; ?>
            </span>
        <?php endforeach; ?>
    </div>
</div>

<!-- Data Table Rombongan Belajar / Kelas -->
<div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-diagram-3-fill text-success me-2"></i>Daftar Kelas & Wali Kelas Dayah</h6>
        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2.5 py-1.5 rounded-pill small">
            Tahun Ajaran: <?= $ta_aktif ? $ta_aktif->nama : '-'; ?>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="small text-muted text-uppercase">
                    <th class="ps-4" style="width: 60px;">No</th>
                    <th>Nama Kelas / Rombel</th>
                    <th>Jenjang</th>
                    <th>Wali Kelas (Teungku)</th>
                    <th class="text-center">Kapasitas / Santri</th>
                    <th class="text-center">Putra (L)</th>
                    <th class="text-center">Putri (P)</th>
                    <th class="text-end pe-4" style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kelas_list)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-door-closed fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            Belum ada kelas yang terdaftar pada tahun ajaran ini.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($kelas_list as $k): ?>
                        <tr>
                            <td class="ps-4 text-muted small"><?= $no++; ?></td>
                            <td>
                                <a href="<?= base_url('admin/jenjang/detail_kelas/' . $k->id); ?>" class="fw-bold text-dark text-decoration-none">
                                    <i class="bi bi-folder2-open text-primary me-1.5"></i><?= htmlspecialchars($k->nama_kelas); ?>
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-emerald-subtle text-emerald px-2.5 py-1 rounded-pill fw-semibold">
                                    <?= htmlspecialchars($k->nama_jenjang ?: '-'); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($k->nama_wali): ?>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 26px; height: 26px; font-size: 0.75rem;">
                                            T
                                        </div>
                                        <span class="text-dark small fw-medium"><?= htmlspecialchars($k->nama_wali); ?></span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted small fst-italic">Belum Ditentukan</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary bg-opacity-10 text-dark px-2.5 py-1 rounded-pill fw-bold">
                                    <?= (int)$k->total_santri; ?> Santri
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">
                                    <?= (int)$k->total_putra; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill small">
                                    <?= (int)$k->total_putri; ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="<?= base_url('admin/jenjang/detail_kelas/' . $k->id); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-2.5 py-1" title="Lihat Santri">
                                        <i class="bi bi-people"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2.5 py-1 btn-edit-kelas" 
                                            data-id="<?= $k->id; ?>" 
                                            data-nama="<?= htmlspecialchars($k->nama_kelas); ?>" 
                                            data-jenjang="<?= $k->jenjang_id; ?>" 
                                            data-wali="<?= $k->wali_kelas_id; ?>" 
                                            title="Edit Kelas">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="<?= base_url('admin/jenjang/hapus_kelas/' . $k->id); ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-pill px-2.5 py-1" 
                                       data-name="Kelas <?= htmlspecialchars($k->nama_kelas); ?>"
                                       data-sub="Jenjang: <?= htmlspecialchars($k->nama_jenjang ?: '-'); ?> &bull; Wali: <?= htmlspecialchars($k->nama_wali ?: 'Belum Ada'); ?>"
                                       data-title="Hapus Data Kelas"
                                       title="Hapus Kelas">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Kelas -->
<div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="<?= base_url('admin/jenjang/simpan_kelas'); ?>" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-plus-circle text-success me-2"></i>Buka Kelas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Tingkat / Jenjang Pendidikan <span class="text-danger">*</span></label>
                        <select name="jenjang_id" class="form-select" required>
                            <option value="">-- Pilih Jenjang --</option>
                            <?php foreach ($jenjang_list as $j): ?>
                                <option value="<?= $j->id; ?>"><?= $j->nama; ?> (Tingkat <?= $j->urutan; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Kelas / Rombongan Belajar <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: Ula 1 C, Wustha 2 B" required>
                        <div class="form-text small">Gunakan penamaan seragam sesuai format dayah.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Wali Kelas (Dewan Guru / Teungku)</label>
                        <select name="wali_kelas_id" class="form-select">
                            <option value="">-- Pilih Wali Kelas (Opsional) --</option>
                            <?php foreach ($guru_list as $g): ?>
                                <option value="<?= $g->id; ?>"><?= htmlspecialchars($g->nama); ?> (<?= $g->status_tetap ?: 'Teungku'; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" class="form-select" required>
                            <?php foreach ($ta_list as $ta): ?>
                                <option value="<?= $ta->id; ?>" <?= $ta->id == $ta_id_selected ? 'selected' : ''; ?>>
                                    <?= $ta->nama; ?> <?= $ta->aktif ? '(Aktif)' : ''; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kelas -->
<div class="modal fade" id="modalEditKelas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form id="formEditKelas" action="" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-pencil-square text-success me-2"></i>Edit Data Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Tingkat / Jenjang Pendidikan <span class="text-danger">*</span></label>
                        <select name="jenjang_id" id="edit_jenjang_id" class="form-select" required>
                            <?php foreach ($jenjang_list as $j): ?>
                                <option value="<?= $j->id; ?>"><?= $j->nama; ?> (Tingkat <?= $j->urutan; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Kelas / Rombongan Belajar <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" id="edit_nama_kelas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Wali Kelas (Dewan Guru / Teungku)</label>
                        <select name="wali_kelas_id" id="edit_wali_kelas_id" class="form-select">
                            <option value="">-- Pilih Wali Kelas (Opsional) --</option>
                            <?php foreach ($guru_list as $g): ?>
                                <option value="<?= $g->id; ?>"><?= htmlspecialchars($g->nama); ?></option>
                            <?php endforeach; ?>
                        </select>
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

<!-- Modal Tambah Jenjang -->
<div class="modal fade" id="modalTambahJenjang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="<?= base_url('admin/jenjang/simpan_jenjang'); ?>" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-layers-fill text-success me-2"></i>Tambah Jenjang Pendidikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Jenjang <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Tahfizh Khusus, Pascasarjana" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Urutan Tingkat</label>
                        <input type="number" name="urutan" class="form-control" value="<?= count($jenjang_list) + 1; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Keterangan / Deskripsi</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Keterangan kurikulum atau fokus jenjang..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan Jenjang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.btn-edit-kelas');
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const jenjang = this.getAttribute('data-jenjang');
            const wali = this.getAttribute('data-wali');

            document.getElementById('edit_nama_kelas').value = nama;
            document.getElementById('edit_jenjang_id').value = jenjang;
            document.getElementById('edit_wali_kelas_id').value = wali || '';
            document.getElementById('formEditKelas').action = '<?= base_url("admin/jenjang/update_kelas/"); ?>' + id;

            const modal = new bootstrap.Modal(document.getElementById('modalEditKelas'));
            modal.show();
        });
    });
});
</script>
