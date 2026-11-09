<div class="py-5 bg-light">
    <div class="container py-lg-3">
        <!-- Header -->
        <div class="text-center mb-5" style="max-width: 750px; margin: 0 auto;">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-success bg-opacity-10 text-success fw-bold small text-uppercase mb-2">
                <i class="bi bi-pencil-square"></i> Penerimaan Santri Baru Online
            </div>
            <h2 class="fw-bold text-dark mb-2">Formulir Pendaftaran Calon Santri</h2>
            <p class="text-muted">
                Tahun Ajaran <strong><?= html_escape($tahun_ajaran_aktif->nama ?? '2026/2027'); ?></strong> &bull; LPI Dayah Al-Ikhlas Al-Aziziyah, Samalanga, Bireuen
            </p>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <a href="<?= base_url('pendaftaran/cek_status'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="bi bi-search me-1"></i> Sudah Mendaftar? Cek Status Di Sini
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?= get_alert(); ?>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                <i class="bi bi-mortarboard-fill fs-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Isi Formulir Pendaftaran Secara Lengkap</h5>
                                <small class="text-muted">Pastikan data yang diisi sesuai dengan dokumen kependudukan resmi (KK / KTP / Ijazah).</small>
                            </div>
                        </div>
                    </div>

                    <form action="<?= base_url('pendaftaran/simpan'); ?>" method="POST" enctype="multipart/form-data" class="p-4 p-lg-5">
                        
                        <!-- BAGIAN 1: DATA CALON SANTRI -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <span class="badge bg-success rounded-circle px-2.5 py-1">1</span>
                                <h5 class="fw-bold text-dark mb-0">Data Diri Calon Santri</h5>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold text-secondary small">Nama Lengkap Santri <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control form-control-lg rounded-3" placeholder="Contoh: Muhammad Al-Fatih" value="<?= set_value('nama'); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary small">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="text" name="nik" maxlength="16" class="form-control form-control-lg rounded-3" placeholder="16 digit sesuai Kartu Keluarga" value="<?= set_value('nik'); ?>">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary small">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select form-select-lg rounded-3" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" <?= set_select('jenis_kelamin', 'L'); ?>>Laki-laki (Santriwan)</option>
                                        <option value="P" <?= set_select('jenis_kelamin', 'P'); ?>>Perempuan (Santriwati)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary small">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control form-control-lg rounded-3" placeholder="Contoh: Bireuen" value="<?= set_value('tempat_lahir'); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary small">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control form-control-lg rounded-3" value="<?= set_value('tanggal_lahir'); ?>" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary small">Anak Ke</label>
                                    <input type="number" min="1" name="anak_ke" class="form-control rounded-3" placeholder="1" value="<?= set_value('anak_ke'); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary small">Dari Jumlah Saudara</label>
                                    <input type="number" min="1" name="jumlah_saudara" class="form-control rounded-3" placeholder="3" value="<?= set_value('jumlah_saudara'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Asal Sekolah Terakhir</label>
                                    <input type="text" name="asal_sekolah" class="form-control rounded-3" placeholder="Contoh: SDN 1 Samalanga / MTsN ..." value="<?= set_value('asal_sekolah'); ?>">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-secondary small">Jenjang Pendidikan Tujuan <span class="text-danger">*</span></label>
                                    <select name="jenjang_tujuan_id" class="form-select form-select-lg rounded-3 border-success" required>
                                        <option value="">-- Pilih Tingkat / Jenjang Pengajian --</option>
                                        <?php if (!empty($jenjang_list)): ?>
                                            <?php foreach ($jenjang_list as $j): ?>
                                                <option value="<?= $j->id; ?>" <?= set_select('jenjang_tujuan_id', $j->id); ?>>
                                                    Jenjang <?= html_escape($j->nama); ?> <?= $j->keterangan ? ' - ' . html_escape($j->keterangan) : ''; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <small class="text-muted">Tersedia jenjang: Tajhizi (Persiapan), Ula, Wustha, Ulya, dan Ma'had Aly.</small>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 2: ALAMAT ASAL -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <span class="badge bg-success rounded-circle px-2.5 py-1">2</span>
                                <h5 class="fw-bold text-dark mb-0">Alamat Tempat Tinggal / Asal Santri</h5>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Gampong / Desa / Dusun <span class="text-danger">*</span></label>
                                    <input type="text" name="asal_gampong" class="form-control rounded-3" placeholder="Contoh: Sangso" value="<?= set_value('asal_gampong'); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" name="asal_kecamatan" class="form-control rounded-3" placeholder="Contoh: Samalanga" value="<?= set_value('asal_kecamatan'); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Kabupaten / Kota <span class="text-danger">*</span></label>
                                    <input type="text" name="asal_kabupaten" class="form-control rounded-3" placeholder="Contoh: Bireuen" value="<?= set_value('asal_kabupaten'); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Provinsi</label>
                                    <input type="text" name="asal_provinsi" class="form-control rounded-3" placeholder="Aceh" value="<?= set_value('asal_provinsi', 'Aceh'); ?>">
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 3: DATA ORANG TUA / WALI -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <span class="badge bg-success rounded-circle px-2.5 py-1">3</span>
                                <h5 class="fw-bold text-dark mb-0">Data Orang Tua & Wali</h5>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Nama Ayah Kandung <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_ayah" class="form-control rounded-3" placeholder="Nama ayah sesuai KK" value="<?= set_value('nama_ayah'); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" class="form-control rounded-3" placeholder="Petani / Wiraswasta / PNS / Pedagang" value="<?= set_value('pekerjaan_ayah'); ?>">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Nama Ibu Kandung <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_ibu" class="form-control rounded-3" placeholder="Nama ibu sesuai KK" value="<?= set_value('nama_ibu'); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" class="form-control rounded-3" placeholder="Mengurus Rumah Tangga / PNS / Pedagang" value="<?= set_value('pekerjaan_ibu'); ?>">
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label fw-semibold text-secondary small">Alamat Domisili Orang Tua</label>
                                    <input type="text" name="alamat_ortu" class="form-control rounded-3" placeholder="Alamat lengkap tempat tinggal orang tua saat ini" value="<?= set_value('alamat_ortu'); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary small">No. Handphone / WhatsApp Orang Tua <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp_ortu" class="form-control rounded-3" placeholder="08xxxxxxxxxx" value="<?= set_value('no_hp_ortu'); ?>" required>
                                </div>

                                <!-- Wali (Opsional) -->
                                <div class="col-12 mt-4">
                                    <a class="btn btn-sm btn-light border text-secondary" data-bs-toggle="collapse" href="#collapseWali" role="button" aria-expanded="false">
                                        <i class="bi bi-plus-circle me-1"></i> Tambahkan Data Wali (Opsional jika diasuh oleh wali)
                                    </a>
                                </div>
                                <div class="collapse col-12" id="collapseWali">
                                    <div class="p-3 bg-light rounded-3 border mt-2">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold text-secondary small">Nama Wali</label>
                                                <input type="text" name="nama_wali" class="form-control rounded-3" placeholder="Nama lengkap wali" value="<?= set_value('nama_wali'); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold text-secondary small">Pekerjaan Wali</label>
                                                <input type="text" name="pekerjaan_wali" class="form-control rounded-3" placeholder="Pekerjaan wali" value="<?= set_value('pekerjaan_wali'); ?>">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label fw-semibold text-secondary small">Alamat Wali</label>
                                                <input type="text" name="alamat_wali" class="form-control rounded-3" placeholder="Alamat wali" value="<?= set_value('alamat_wali'); ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold text-secondary small">No. HP / WhatsApp Wali</label>
                                                <input type="text" name="no_hp_wali" class="form-control rounded-3" placeholder="08xxxxxxxxxx" value="<?= set_value('no_hp_wali'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 4: PIHAK PENDAFTAR -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <span class="badge bg-success rounded-circle px-2.5 py-1">4</span>
                                <h5 class="fw-bold text-dark mb-0">Pihak yang Mendaftarkan</h5>
                            </div>

                            <p class="text-muted small">Jika pendaftaran diisi langsung oleh orang tua kandung, isian ini boleh dikosongkan (akan otomatis disamakan dengan data Ayah).</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Nama Pendaftar</label>
                                    <input type="text" name="pendaftar_nama" class="form-control rounded-3" placeholder="Nama yang mengurus pendaftaran" value="<?= set_value('pendaftar_nama'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">No. HP Pendaftar</label>
                                    <input type="text" name="pendaftar_no_hp" class="form-control rounded-3" placeholder="08xxxxxxxxxx" value="<?= set_value('pendaftar_no_hp'); ?>">
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 5: UNGGAH BERKAS -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <span class="badge bg-success rounded-circle px-2.5 py-1">5</span>
                                <h5 class="fw-bold text-dark mb-0">Unggah Berkas Persyaratan (Foto / Dokumen)</h5>
                            </div>

                            <div class="alert alert-info border-0 rounded-3 small mb-4">
                                <i class="bi bi-info-circle-fill me-1"></i> Berkas dapat berupa file gambar (<strong>JPG, JPEG, PNG</strong>) atau dokumen <strong>PDF</strong>. Maksimal 4 MB per berkas. Jika belum siap, berkas juga dapat diserahkan langsung ke sekretariat dayah saat verifikasi.
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="form-label fw-bold text-dark small mb-1">
                                            <i class="bi bi-person-bounding-box text-success me-1"></i> Pas Foto Santri (3x4 / 2x3)
                                        </label>
                                        <p class="text-muted small mb-2">Foto formal santri berpakaian rapi / muslim</p>
                                        <input type="file" name="berkas_foto" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="form-label fw-bold text-dark small mb-1">
                                            <i class="bi bi-file-earmark-person text-primary me-1"></i> Fotokopi Kartu Keluarga (KK)
                                        </label>
                                        <p class="text-muted small mb-2">Foto / scan kartu keluarga yang jelas</p>
                                        <input type="file" name="berkas_kk" class="form-control" accept="image/*,application/pdf">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="form-label fw-bold text-dark small mb-1">
                                            <i class="bi bi-card-heading text-warning me-1"></i> Fotokopi KTP Orang Tua / Wali
                                        </label>
                                        <p class="text-muted small mb-2">Foto / scan KTP Ayah atau Ibu</p>
                                        <input type="file" name="berkas_ktp" class="form-control" accept="image/*,application/pdf">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-white h-100 shadow-sm">
                                        <label class="form-label fw-bold text-dark small mb-1">
                                            <i class="bi bi-award text-danger me-1"></i> Ijazah / SKL / Rapor Terakhir
                                        </label>
                                        <p class="text-muted small mb-2">Ijazah sekolah asal atau surat keterangan lulus</p>
                                        <input type="file" name="berkas_ijazah" class="form-control" accept="image/*,application/pdf">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pernyataan & Tombol Submit -->
                        <div class="p-4 bg-light rounded-4 border mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkPernyataan" required>
                                <label class="form-check-label text-secondary small" for="checkPernyataan">
                                    Dengan ini saya menyatakan bahwa data yang diisikan adalah benar dan sah. Saya bersedia mengikuti seluruh tata tertib dan peraturan yang berlaku di <strong><?= html_escape($profil->nama_dayah ?? 'LPI Dayah Al-Ikhlas Al-Aziziyah'); ?></strong>.
                                </label>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <a href="<?= base_url(); ?>" class="btn btn-outline-secondary px-4 py-2.5 rounded-pill">
                                <i class="bi bi-arrow-left me-1"></i> Batal / Kembali
                            </a>
                            <button type="submit" class="btn btn-primary-dayah px-5 py-3 rounded-pill fw-bold fs-6 shadow">
                                <i class="bi bi-send-check-fill me-2"></i> Kirim Formulir Pendaftaran Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
