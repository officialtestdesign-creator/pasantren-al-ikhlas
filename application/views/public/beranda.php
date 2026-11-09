<!-- Hero Section -->
<section id="beranda" class="position-relative text-white py-5 py-lg-6" style="background: radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.28) 0%, transparent 55%), linear-gradient(135deg, #022c22 0%, #064e3b 45%, #03231a 100%);">
    <div class="container py-2 py-lg-4">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3.5 py-1.5 rounded-pill bg-warning shadow-sm mb-3" style="color: #000000 !important;">
                    <i class="bi bi-megaphone-fill" style="color: #000000 !important;"></i>
                    <span class="small fw-bold" style="color: #000000 !important; letter-spacing: 0.01em;">Penerimaan Santri Baru TA <?= html_escape($tahun_ajaran_aktif->nama ?? '2026/2027'); ?> Telah Dibuka</span>
                </div>
                <h1 class="display-5 fw-bold mb-3 text-white" style="line-height: 1.25; letter-spacing: -0.02em;">
                    Membina Generasi <span class="text-warning">Faqih Fiddin</span> &amp; Berakhlaqul Karimah
                </h1>
                <p class="lead text-white-50 mb-4 pe-lg-4" style="font-size: 1.08rem; line-height: 1.75;">
                    LPI Dayah Al-Ikhlas Al-Aziziyah menyelenggarakan pendidikan salafiyah murni berbasis kajian kitab kuning terpadu di Kota Santri Samalanga, Kabupaten Bireuen, Aceh.
                </p>
                <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 gap-sm-3 mb-3">
                    <a href="<?= base_url('pendaftaran'); ?>" class="btn btn-warning btn-lg fw-bold px-4 py-2.5 rounded-pill shadow d-inline-flex align-items-center justify-content-center gap-2 text-dark">
                        <i class="bi bi-pencil-square"></i> Daftar Santri Baru Online
                    </a>
                    <a href="#profil" class="btn btn-outline-light btn-lg fw-semibold px-4 py-2.5 rounded-pill d-inline-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-info-circle"></i> Profil Dayah
                    </a>
                    <a href="<?= base_url('pendaftaran/cek_status'); ?>" class="btn btn-sm btn-link text-white-50 text-decoration-none d-inline-flex align-items-center justify-content-center gap-1.5 px-3 py-2">
                        <i class="bi bi-search text-warning"></i> Cek Status Pendaftaran
                    </a>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="position-relative">
                    <div class="rounded-4 overflow-hidden shadow-lg border border-white border-opacity-20 position-relative hover-lift">
                        <img src="<?= base_url('img/gedung_utama.jpeg'); ?>" alt="Gedung Utama Dayah Al-Ikhlas" class="img-fluid w-100 object-fit-cover" style="height: 380px; max-height: 55vw;">
                        <div class="position-absolute bottom-0 start-0 end-0 p-3 p-sm-4 bg-dark bg-opacity-75 backdrop-blur text-white">
                            <div class="fw-bold fs-6">Gedung Pembelajaran &amp; Asrama Dayah</div>
                            <small class="text-white-50"><i class="bi bi-geo-alt-fill text-warning me-1"></i> Gampong Sangso, Samalanga, Bireuen</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats Bar -->
<section id="statistik" class="py-4 py-lg-5 bg-white border-bottom shadow-sm">
    <div class="container">
        <div class="row g-3 g-lg-4 text-center justify-content-center">
            <div class="col-6 col-lg-3">
                <div class="p-3 p-lg-4 rounded-4 border bg-light h-100 hover-lift">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success mb-2" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="fs-2 fw-bold text-success mb-0"><?= number_format($stats['santri_total'] ?? 0); ?>+</div>
                    <div class="text-muted small fw-bold text-uppercase mt-1" style="font-size: 0.76rem; letter-spacing: 0.05em;">Santri Aktif</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-3 p-lg-4 rounded-4 border bg-light h-100 hover-lift">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mb-2" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="bi bi-person-video3"></i>
                    </div>
                    <div class="fs-2 fw-bold text-primary mb-0"><?= number_format($stats['guru_total'] ?? 0); ?>+</div>
                    <div class="text-muted small fw-bold text-uppercase mt-1" style="font-size: 0.76rem; letter-spacing: 0.05em;">Dewan Guru / Asatidz</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-3 p-lg-4 rounded-4 border bg-light h-100 hover-lift">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning mb-2" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="fs-2 fw-bold text-warning mb-0">5</div>
                    <div class="text-muted small fw-bold text-uppercase mt-1" style="font-size: 0.76rem; letter-spacing: 0.05em;">Jenjang Pendidikan</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-3 p-lg-4 rounded-4 border bg-light h-100 hover-lift">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger mb-2" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div class="fs-2 fw-bold text-danger mb-0"><?= html_escape($profil->tahun_berdiri ?? '2007'); ?></div>
                    <div class="text-muted small fw-bold text-uppercase mt-1" style="font-size: 0.76rem; letter-spacing: 0.05em;">Tahun Berdiri</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profil & Sambutan Section -->
<section id="profil" class="py-5 bg-light">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold text-uppercase">Mengenal Dayah</span>
            <h2 class="fw-bold mt-2 text-dark">Profil Lembaga Pendidikan Islam</h2>
            <div class="mx-auto bg-success rounded-pill" style="width: 60px; height: 3px;"></div>
        </div>

        <div class="row g-4 g-lg-5 align-items-center">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                    <img src="<?= base_url('\img\pimpinan_dayah.jpg'); ?>" alt="Pimpinan Dayah" class="img-fluid w-100 object-fit-cover" style="height: 380px;">
                    <div class="card-body p-4 text-center bg-white">
                        <span class="badge bg-warning bg-opacity-15 text-warning-emphasis px-2.5 py-1 rounded-pill small fw-semibold mb-2">Pimpinan Dayah</span>
                        <h5 class="fw-bold mb-1 text-dark"><?= html_escape($profil->nama_pimpinan ?? 'Pimpinan Dayah'); ?></h5>
                        <p class="text-muted small mb-0">LPI Dayah Al-Ikhlas Al-Aziziyah Samalanga</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <h3 class="fw-bold mb-3 text-dark">Sejarah &amp; Identitas Kelembagaan</h3>
                <p class="text-secondary" style="line-height: 1.85; font-size: 0.98rem;">
                    <?= nl2br(html_escape($profil->sejarah ?: 'LPI Dayah Al-Ikhlas Al-Aziziyah didirikan pada tahun 2007 di Gampong Sangso, Kecamatan Samalanga, Kabupaten Bireuen. Sebagai salah satu dayah salafiyah di bawah naungan tradisi keilmuan Al-Aziziyah, dayah ini konsisten memadukan pengajian kitab kuning standar dengan pembentukan karakter santri yang mandiri, taat beribadah, dan berkhidmat kepada masyarakat.')); ?>
                </p>

                <div class="row g-3 mt-2" id="visi-misi">
                    <div class="col-sm-6">
                        <div class="p-3.5 p-lg-4 bg-white rounded-4 border h-100 shadow-sm hover-lift">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="bi bi-compass-fill fs-5"></i>
                                </div>
                                <h6 class="fw-bold mb-0 text-dark">Visi Dayah</h6>
                            </div>
                            <p class="text-secondary small mb-0" style="line-height: 1.7;">
                                <?= html_escape($profil->visi ?: 'Mewujudkan generasi santri yang berakhlak mulia, berilmu amaliyah, dan berpegang teguh pada Al-Qur\'an dan As-Sunnah.'); ?>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="p-3.5 p-lg-4 bg-white rounded-4 border h-100 shadow-sm hover-lift">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="bi bi-bullseye fs-5"></i>
                                </div>
                                <h6 class="fw-bold mb-0 text-dark">Misi Dayah</h6>
                            </div>
                            <p class="text-secondary small mb-0" style="line-height: 1.7;">
                                <?= html_escape($profil->misi ?: 'Menyelenggarakan pengajian kitab kuning berjenjang, membiasakan disiplin ibadah berjamaah, dan menumbuhkan kecintaan pada ilmu-ilmu syar\'i.'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jenjang & Kurikulum -->
<section id="kurikulum" class="py-5 bg-white">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Pendidikan Salafiyah</span>
            <h2 class="fw-bold mt-2 text-dark">Jenjang Pendidikan &amp; Bidang Studi</h2>
            <div class="mx-auto bg-primary rounded-pill" style="width: 60px; height: 3px;"></div>
            <p class="text-muted mt-3 mx-auto" style="max-width: 650px;">
                Tingkat pengajian disusun secara berjenjang dan sistematis, membimbing santri dari dasar kaidah hingga pendalaman kitab-kitab induk mu'tabarah.
            </p>
        </div>

        <!-- Responsive Jenjang Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 g-lg-4 mb-5">
            <?php 
                $jenjang_icons = array(
                    'Tajhizi' => 'bi-book-half',
                    'Ula' => 'bi-journal-text',
                    'Wustha' => 'bi-journal-richtext',
                    'Ulya' => 'bi-mortarboard',
                    'Ma\'had Aly' => 'bi-award'
                );
                $jenjang_level = array(
                    'Tajhizi' => 'Kelas Persiapan',
                    'Ula' => 'Tingkat Pertama',
                    'Wustha' => 'Tingkat Menengah',
                    'Ulya' => 'Tingkat Atas',
                    'Ma\'had Aly' => 'Pendidikan Tinggi'
                );
            ?>
            <?php if (!empty($jenjang_list)): ?>
                <?php foreach ($jenjang_list as $j): ?>
                    <div class="col">
                        <div class="card h-100 border text-center p-3 p-lg-4 rounded-4 shadow-sm hover-lift bg-white">
                            <div class="mx-auto my-2 rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 58px; height: 58px; font-size: 1.5rem;">
                                <i class="bi <?= isset($jenjang_icons[$j->nama]) ? $jenjang_icons[$j->nama] : 'bi-journal-bookmark'; ?>"></i>
                            </div>
                            <span class="badge bg-light text-muted border my-1 mx-auto" style="font-size: 0.72rem;">
                                <?= $jenjang_level[$j->nama] ?? 'Tingkat Pengajian'; ?>
                            </span>
                            <h5 class="fw-bold text-dark mb-1 fs-6 mt-1"><?= html_escape($j->nama); ?></h5>
                            <p class="text-muted small mb-0" style="font-size: 0.8rem; line-height: 1.5;"><?= html_escape($j->keterangan ?: 'Tingkat pengajian jenjang ' . $j->nama); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted py-4">Data jenjang pendidikan belum terisi.</div>
            <?php endif; ?>
        </div>

        <!-- 19 Disiplin Ilmu Kitab Kuning - Structured Thematic Categories -->
        <div class="p-4 p-lg-5 rounded-4 bg-light border shadow-sm" id="kurikulum-kitab">
            <div class="text-center mb-4">
                <span class="badge bg-warning bg-opacity-15 text-warning-emphasis px-3 py-1.5 rounded-pill fw-bold text-uppercase small">Kurikulum Kitab Kuning</span>
                <h4 class="fw-bold text-dark mt-2 mb-2">19 Disiplin Ilmu Mu'tabarah</h4>
                <p class="text-muted mx-auto mb-0" style="max-width: 680px; font-size: 0.94rem;">
                    Kurikulum terstruktur berbasis kitab kuning salafiyah yang dipelajari secara bertahap oleh seluruh santriwan dan santriwati:
                </p>
            </div>

            <div class="row g-3 g-md-4">
                <!-- Kategori 1: Al-Qur'an & Tafsir -->
                <div class="col-md-6 col-lg-4">
                    <div class="p-3.5 bg-white rounded-3 border h-100">
                        <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <i class="bi bi-book-half text-success fs-5"></i>
                            <strong class="text-dark small">Al-Qur'an &amp; Tafsir</strong>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5">
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Al-Qur'an</span>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Tafsir</span>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Ilmu Tafsir</span>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Tahfizh</span>
                        </div>
                    </div>
                </div>

                <!-- Kategori 2: Qawa'id & Bahasa Arab -->
                <div class="col-md-6 col-lg-4">
                    <div class="p-3.5 bg-white rounded-3 border h-100">
                        <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <i class="bi bi-translate text-primary fs-5"></i>
                            <strong class="text-dark small">Kaidah &amp; Bahasa Arab</strong>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Nahwu</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Saraf</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Balaghah</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Ma'ani</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Mantek</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Bayan</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Imlak/Insyak</span>
                        </div>
                    </div>
                </div>

                <!-- Kategori 3: Fiqih & Ushul -->
                <div class="col-md-6 col-lg-4">
                    <div class="p-3.5 bg-white rounded-3 border h-100">
                        <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <i class="bi bi-shield-check text-warning fs-5"></i>
                            <strong class="text-dark small">Fiqih &amp; Ushul Fiqh</strong>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5">
                            <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Fiqih Syafi'iyah</span>
                            <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Usul Fiqh</span>
                        </div>
                    </div>
                </div>

                <!-- Kategori 4: Hadits & Sunnah -->
                <div class="col-md-6 col-lg-6">
                    <div class="p-3.5 bg-white rounded-3 border h-100">
                        <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <i class="bi bi-journal-bookmark text-info fs-5"></i>
                            <strong class="text-dark small">Hadits &amp; Musthalah Hadits</strong>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5">
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Hadits Nabawi</span>
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Mustahalah Hadits</span>
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Ilmu Hadits</span>
                        </div>
                    </div>
                </div>

                <!-- Kategori 5: Tauhid, Akhlaq & Tarikh -->
                <div class="col-md-12 col-lg-6">
                    <div class="p-3.5 bg-white rounded-3 border h-100">
                        <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <i class="bi bi-heart-pulse text-danger fs-5"></i>
                            <strong class="text-dark small">Aqidah, Tasawuf &amp; Sejarah</strong>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5">
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Tauhid (Ahlussunnah wal Jama'ah)</span>
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Akhlaq / Tasawuf</span>
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 py-1.5 px-2.5 rounded-pill fw-medium">Tarikh Islam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Dayah -->
<section id="fasilitas" class="py-5 bg-light">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold text-uppercase">Sarana Prasarana</span>
            <h2 class="fw-bold mt-2 text-dark">Fasilitas &amp; Lingkungan Dayah</h2>
            <div class="mx-auto bg-warning rounded-pill" style="width: 60px; height: 3px;"></div>
            <p class="text-muted mt-3 mx-auto small" style="max-width: 650px;">
                Fasilitas lengkap dan representatif untuk menunjang kenyamanan ibadah, pengajian kitab kuning, dan kehidupan santri salafiyah.
            </p>
        </div>

        <div class="row g-3 g-md-4">
            <?php if (!empty($fasilitas_list)): ?>
                <?php foreach ($fasilitas_list as $f): ?>
                    <?php 
                        $has_photo = !empty($f->foto) && file_exists(FCPATH . $f->foto);
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift bg-white">
                            <?php if ($has_photo): ?>
                                <div class="position-relative">
                                    <img src="<?= base_url($f->foto); ?>" alt="<?= html_escape($f->nama); ?>" class="card-img-top object-fit-cover w-100" style="height: clamp(190px, 25vw, 230px);" loading="lazy">
                                    <span class="badge bg-dark bg-opacity-75 position-absolute top-0 end-0 m-3 px-2.5 py-1.5 rounded-pill small">
                                        <i class="bi bi-patch-check-fill text-warning me-1"></i>Fasilitas Dayah
                                    </span>
                                </div>
                            <?php else: ?>
                                <!-- Foto kosong (akan ditambahkan kemudian) -->
                                <div class="position-relative d-flex flex-column align-items-center justify-content-center bg-light border-bottom text-muted" style="height: clamp(170px, 22vw, 210px); background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;">
                                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                                        <i class="bi bi-camera text-secondary fs-4"></i>
                                    </div>
                                    <span class="small fw-semibold text-secondary">Foto Belum Ditambahkan</span>
                                    <span class="text-muted" style="font-size: 0.72rem;">Dokumentasi akan segera menyusul</span>
                                    <span class="badge bg-secondary bg-opacity-75 position-absolute top-0 end-0 m-3 px-2.5 py-1.5 rounded-pill small">
                                        <i class="bi bi-clock me-1"></i>Belum Ada Foto
                                    </span>
                                </div>
                            <?php endif; ?>
                            <div class="card-body p-3.5 p-sm-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold text-dark mb-2" style="font-size: 1.08rem;"><?= html_escape($f->nama); ?></h5>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;"><?= nl2br(html_escape($f->deskripsi)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted py-4">Belum ada data fasilitas yang ditambahkan.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Jadwal Kegiatan Santri & Peraturan -->
<section id="jadwal" class="py-5 bg-white">
    <div class="container py-lg-4">
        <div class="row g-4 g-lg-5">
            <!-- Jadwal Kegiatan -->
            <div class="col-lg-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-clock-fill fs-5"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-0">Jadwal Rutinitas Santri</h3>
                </div>
                <p class="text-muted mb-4 small">Aktivitas harian teratur membentuk kedisiplinan dan keberkahan waktu para santri:</p>

                <div class="list-group list-group-flush border rounded-4 overflow-hidden shadow-sm">
                    <div class="list-group-item d-flex justify-content-between align-items-center p-3 bg-light fw-bold text-dark">
                        <span>Waktu Kegiatan</span>
                        <span>Deskripsi Rutinitas</span>
                    </div>
                    <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 p-3">
                        <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2.5 py-1.5 font-monospace">04.30 - 06.00</span>
                        <span class="fw-semibold text-dark">Bangun Pagi, Shalat Subuh Berjamaah &amp; Pengajian Subuh</span>
                    </div>
                    <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 p-3">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary fw-bold px-2.5 py-1.5 font-monospace">06.00 - 07.30</span>
                        <span class="text-secondary">Mandi, Sarapan Pagi &amp; Persiapan Halaqah Belajar</span>
                    </div>
                    <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 p-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-2.5 py-1.5 font-monospace">08.00 - 11.30</span>
                        <span class="fw-semibold text-dark">Pengajian Pagi / Sesi Belajar Kitab Kuning Per Kelas</span>
                    </div>
                    <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 p-3">
                        <span class="badge bg-warning bg-opacity-10 text-warning-emphasis fw-bold px-2.5 py-1.5 font-monospace">12.30 - 14.30</span>
                        <span class="text-secondary">Shalat Dzuhur Berjamaah, Makan Siang &amp; Istirahat (Qailulah)</span>
                    </div>
                    <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 p-3">
                        <span class="badge bg-info bg-opacity-10 text-info fw-bold px-2.5 py-1.5 font-monospace">16.00 - 17.30</span>
                        <span class="text-secondary">Shalat Ashar Berjamaah &amp; Pengajian Sore / Mudaratsah</span>
                    </div>
                    <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 p-3">
                        <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2.5 py-1.5 font-monospace">18.30 - 20.30</span>
                        <span class="fw-semibold text-dark">Shalat Maghrib, Dalail Khairat / Wirid, Shalat Isya Berjamaah</span>
                    </div>
                    <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 p-3">
                        <span class="badge bg-dark bg-opacity-10 text-dark fw-bold px-2.5 py-1.5 font-monospace">20.30 - 22.30</span>
                        <span class="text-secondary">Pengajian Malam, Musyawarah Pelajaran &amp; Istirahat Tidur</span>
                    </div>
                </div>
            </div>

            <!-- Peraturan & Tata Tertib -->
            <div class="col-lg-6" id="peraturan">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-shield-check fs-5"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-0">Tata Tertib &amp; Peraturan</h3>
                </div>
                <p class="text-muted mb-4 small">Ketertiban yang ditaati seluruh santriwan dan santriwati demi kenyamanan dan berkah:</p>

                <div class="accordion shadow-sm rounded-4 overflow-hidden border" id="accPeraturan">
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#col1">
                                <i class="bi bi-book me-2 text-success"></i> Bidang Pendidikan &amp; Pengajian
                            </button>
                        </h2>
                        <div id="col1" class="accordion-collapse collapse show" data-bs-parent="#accPeraturan">
                            <div class="accordion-body text-secondary small" style="line-height: 1.75;">
                                Santri wajib mengikuti seluruh sesi pengajian sesuai kelas dan jadwal yang ditetapkan, membawa kitab dan peralatan tulis, serta tidak meninggalkan ruangan pengajian tanpa izin tertulis dari teungku pengasuh.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#col2">
                                <i class="bi bi-people me-2 text-primary"></i> Bidang Jamaah &amp; Ibadah
                            </button>
                        </h2>
                        <div id="col2" class="accordion-collapse collapse" data-bs-parent="#accPeraturan">
                            <div class="accordion-body text-secondary small" style="line-height: 1.75;">
                                Seluruh santri diwajibkan melaksanakan shalat fardhu lima waktu secara berjamaah di mushalla tepat waktu dan mengenakan busana muslim yang rapi, bersih, dan menutup aurat.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#col3">
                                <i class="bi bi-megaphone me-2 text-warning"></i> Bidang Hubungan Masyarakat &amp; Izin
                            </button>
                        </h2>
                        <div id="col3" class="accordion-collapse collapse" data-bs-parent="#accPeraturan">
                            <div class="accordion-body text-secondary small" style="line-height: 1.75;">
                                Kunjungan orang tua/wali santri dilayani pada hari dan jam yang telah ditentukan di kantor sekretariat. Santri yang berhalangan atau memiliki urusan keluarga mendesak wajib memperoleh surat izin resmi dari bagian keamanan/kesantrian.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Pendaftaran Santri Baru -->
<section id="pendaftaran" class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);">
    <div class="container py-lg-4 text-center">
        <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold text-uppercase mb-3" style="color: #000000 !important;">Informasi Pendaftaran Santri Baru</span>
        <h2 class="display-6 fw-bold mb-3 text-white">Penerimaan Santri Baru TA <?= html_escape($tahun_ajaran_aktif->nama ?? '2026/2027'); ?></h2>
        <p class="lead text-white-50 mx-auto mb-5" style="max-width: 680px; font-size: 1.05rem; line-height: 1.75;">
            Bergabunglah bersama keluarga besar LPI Dayah Al-Ikhlas Al-Aziziyah. Siapkan berkas persyaratan berupa Pas Foto 3x4, Fotokopi Kartu Keluarga (KK), KTP Orang Tua/Wali, dan Ijazah/SKL terakhir.
        </p>

        <div class="row g-4 justify-content-center text-start mb-5">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-15 h-100 hover-lift">
                    <div class="text-warning fs-3 mb-2"><i class="bi bi-file-earmark-check"></i></div>
                    <span class="badge bg-warning bg-opacity-25 text-warning px-2 py-0.5 rounded small fw-bold mb-2">Langkah 1</span>
                    <h5 class="fw-bold text-white">Siapkan Berkas</h5>
                    <p class="text-white-50 small mb-0">Pas foto, fotokopi KK, KTP orang tua, dan ijazah/surat keterangan lulus terakhir.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-15 h-100 hover-lift">
                    <div class="text-warning fs-3 mb-2"><i class="bi bi-pencil-square"></i></div>
                    <span class="badge bg-warning bg-opacity-25 text-warning px-2 py-0.5 rounded small fw-bold mb-2">Langkah 2</span>
                    <h5 class="fw-bold text-white">Isi Formulir Online</h5>
                    <p class="text-white-50 small mb-0">Mengisi biodata santri, orang tua/wali, jenjang tujuan, dan mengunggah dokumen persyaratan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-15 h-100 hover-lift">
                    <div class="text-warning fs-3 mb-2"><i class="bi bi-printer"></i></div>
                    <span class="badge bg-warning bg-opacity-25 text-warning px-2 py-0.5 rounded small fw-bold mb-2">Langkah 3</span>
                    <h5 class="fw-bold text-white">Bukti &amp; Verifikasi</h5>
                    <p class="text-white-50 small mb-0">Mendapatkan nomor pendaftaran resmi dan konfirmasi penerimaan dari panitia dayah.</p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 gap-sm-3 justify-content-center mx-auto" style="max-width: 820px;">
            <a href="<?= base_url('pendaftaran'); ?>" class="btn btn-warning btn-lg fw-bold px-4 py-2.5 py-sm-3 rounded-pill shadow-lg text-dark d-inline-flex align-items-center justify-content-center">
                <i class="bi bi-pencil-square me-1.5"></i> Formulir Online
            </a>
            <a href="<?= base_url('pendaftaran/cek_status'); ?>" class="btn btn-outline-light btn-lg fw-semibold px-4 py-2.5 py-sm-3 rounded-pill d-inline-flex align-items-center justify-content-center">
                <i class="bi bi-search me-1.5"></i> Cek Status
            </a>
            <a href="tel:<?= html_escape($profil->no_hp ?? ''); ?>" class="btn btn-outline-light btn-lg fw-semibold px-4 py-2.5 py-sm-3 rounded-pill d-inline-flex align-items-center justify-content-center">
                <i class="bi bi-whatsapp me-1.5"></i> Hubungi Panitia
            </a>
        </div>
    </div>
</section>
