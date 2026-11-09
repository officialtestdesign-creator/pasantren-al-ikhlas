<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-journal-bookmark-fill text-success me-2"></i>Kurikulum Kitab Kuning & Bidang Studi
        </h4>
        <p class="text-muted small mb-0">Kelola master kajian kitab kuning salafiyah dan pemetaan mata pelajaran beserta Teungku pengasuh per kelas.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambahBidangStudi">
            <i class="bi bi-plus-lg me-1"></i>Tambah Master Kitab / Bidang Studi
        </button>
    </div>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Pemetaan Kurikulum Per Kelas -->
    <div class="col-lg-7">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div>
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-diagram-2-fill text-success me-2"></i>Pemetaan Kitab Per Kelas</h6>
                    <small class="text-muted">Pilih ruang kelas untuk melihat dan mengatur kitab yang diajarkan</small>
                </div>
                <form method="GET" action="<?= base_url('admin/kurikulum'); ?>" class="d-flex align-items-center gap-2">
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
                            Jenjang: <?= $selected_kelas->nama_jenjang; ?>
                        </span>
                        <span class="small text-muted">Wali Kelas: <strong><?= $selected_kelas->nama_wali ?: 'Belum ditentukan'; ?></strong></span>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-medium" data-bs-toggle="modal" data-bs-target="#modalPetakanKitab">
                        <i class="bi bi-plus-circle me-1"></i>Tugaskan Kitab ke Kelas Ini
                    </button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-4" style="width: 50px;">No</th>
                            <th>Mata Pelajaran / Kitab Kuning</th>
                            <th>Teungku Pengasuh</th>
                            <th>Keterangan</th>
                            <th class="text-end pe-4" style="width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($kurikulum_kelas)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-book fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                    Belum ada kitab yang dipetakan untuk kelas ini.<br>
                                    <button type="button" class="btn btn-sm btn-success rounded-pill px-3 mt-2" data-bs-toggle="modal" data-bs-target="#modalPetakanKitab">
                                        <i class="bi bi-plus-lg me-1"></i>Petakan Kitab Pertama
                                    </button>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($kurikulum_kelas as $kur): ?>
                                <tr>
                                    <td class="ps-4 text-muted small"><?= $no++; ?></td>
                                    <td>
                                        <span class="fw-bold text-dark fs-6 d-block"><?= htmlspecialchars($kur->nama_bidang_studi); ?></span>
                                    </td>
                                    <td>
                                        <?php if ($kur->nama_guru): ?>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 26px; height: 26px; font-size: 0.75rem;">
                                                    T
                                                </div>
                                                <span class="text-dark small fw-medium"><?= htmlspecialchars($kur->nama_guru); ?></span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted small fst-italic">Belum Ditugaskan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="small text-muted"><?= htmlspecialchars($kur->keterangan ?: '-'); ?></td>
                                    <td class="text-end pe-4">
                                        <a href="<?= base_url('admin/kurikulum/hapus_pemetaan/' . $kur->id); ?>" 
                                           class="btn btn-sm btn-outline-danger rounded-circle p-1" 
                                           style="width: 28px; height: 28px;"
                                           data-name="Kitab <?= htmlspecialchars($kur->nama_kitab); ?>"
                                           data-sub="Kelas: <?= htmlspecialchars($kur->nama_kelas); ?> &bull; Pengajar: <?= htmlspecialchars($kur->nama_guru ?: '-'); ?>"
                                           data-title="Hapus Pemetaan Kitab"
                                           title="Hapus Pemetaan">
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
    </div>

    <!-- Kolom Kanan: Master Daftar Bidang Studi / Kitab Kuning -->
    <div class="col-lg-5">
        <div class="card-custom bg-white border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-collection-fill text-warning me-2"></i>Master Kitab Kuning</h6>
                    <small class="text-muted"><?= count($bidang_studi_list); ?> Bidang Studi Tersedia</small>
                </div>
                <span class="badge bg-warning bg-opacity-10 text-dark border border-warning border-opacity-25 px-2.5 py-1 rounded-pill small">
                    Standar Salafiyah
                </span>
            </div>
            <div class="table-responsive" style="max-height: 580px; overflow-y: auto;">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light sticky-top">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-3" style="width: 60px;">Urut</th>
                            <th>Nama Bidang Studi / Kitab</th>
                            <th class="text-end pe-3" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bidang_studi_list as $bs): ?>
                            <tr>
                                <td class="ps-3 text-muted small"><span class="badge bg-light text-secondary border"><?= $bs->urutan; ?></span></td>
                                <td class="fw-semibold text-dark"><?= htmlspecialchars($bs->nama); ?></td>
                                <td class="text-end pe-3">
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-0.5 btn-edit-bs" 
                                            data-id="<?= $bs->id; ?>" 
                                            data-nama="<?= htmlspecialchars($bs->nama); ?>" 
                                            data-urutan="<?= $bs->urutan; ?>" 
                                            title="Edit">
                                        <i class="bi bi-pencil" style="font-size: 0.75rem;"></i>
                                    </button>
                                    <a href="<?= base_url('admin/kurikulum/hapus_bidang_studi/' . $bs->id); ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-pill px-2 py-0.5" 
                                       data-name="Bidang Studi <?= htmlspecialchars($bs->nama); ?>"
                                       data-sub="Urutan: <?= htmlspecialchars($bs->urutan); ?>"
                                       data-title="Hapus Bidang Studi"
                                       title="Hapus">
                                        <i class="bi bi-trash" style="font-size: 0.75rem;"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Bidang Studi -->
<div class="modal fade" id="modalTambahBidangStudi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="<?= base_url('admin/kurikulum/simpan_bidang_studi'); ?>" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-plus-circle text-success me-2"></i>Tambah Master Kitab Kuning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Bidang Studi / Kitab <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Fiqih (Fathul Qarib), Nahwu (Al-Jurumiyah)" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nomor Urut Tampil</label>
                        <input type="number" name="urutan" class="form-control" value="<?= count($bidang_studi_list) + 1; ?>" required>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan Kitab</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Bidang Studi -->
<div class="modal fade" id="modalEditBidangStudi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form id="formEditBidangStudi" action="" method="POST">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-pencil-square text-success me-2"></i>Edit Master Kitab</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Bidang Studi / Kitab <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="edit_bs_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nomor Urut Tampil</label>
                        <input type="number" name="urutan" id="edit_bs_urutan" class="form-control" required>
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

<!-- Modal Petakan Kitab ke Kelas -->
<div class="modal fade" id="modalPetakanKitab" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="<?= base_url('admin/kurikulum/simpan_pemetaan'); ?>" method="POST">
                <input type="hidden" name="kelas_id" value="<?= $kelas_id_selected; ?>">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="bi bi-link-45deg text-success me-2"></i>Tugaskan Kitab ke Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Kelas Tujuan</label>
                        <input type="text" class="form-control bg-light" value="<?= $selected_kelas ? htmlspecialchars($selected_kelas->nama_kelas) . ' (' . $selected_kelas->nama_jenjang . ')' : ''; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Bidang Studi / Kitab Kuning <span class="text-danger">*</span></label>
                        <select name="bidang_studi_id" class="form-select" required>
                            <option value="">-- Pilih Kitab / Bidang Studi --</option>
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
                                <option value="<?= $g->id; ?>"><?= htmlspecialchars($g->nama); ?> (<?= $g->status_tetap ?: 'Teungku'; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Keterangan / Kitab Pegangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Kitab Matan Taqrib Bab Ibadah">
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 fw-medium">Simpan ke Kurikulum</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.btn-edit-bs');
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const urutan = this.getAttribute('data-urutan');

            document.getElementById('edit_bs_nama').value = nama;
            document.getElementById('edit_bs_urutan').value = urutan;
            document.getElementById('formEditBidangStudi').action = '<?= base_url("admin/kurikulum/update_bidang_studi/"); ?>' + id;

            const modal = new bootstrap.Modal(document.getElementById('modalEditBidangStudi'));
            modal.show();
        });
    });
});
</script>
