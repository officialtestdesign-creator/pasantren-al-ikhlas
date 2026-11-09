<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? html_escape($title) : 'Sistem Informasi dan Promosi LPI Dayah Al-Ikhlas Al-Aziziyah Samalanga'; ?></title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Amiri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #065f46;
            --primary-dark: #022c22;
            --primary-light: #059669;
            --accent-gold: #d97706;
            --accent-gold-light: #fef3c7;
            --surface-bg: #f8fafc;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 86px;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #1e293b;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* Top Utility Bar */
        .top-bar-public {
            background: #02231a !important;
            font-size: 0.81rem;
        }
        .top-bar-public a {
            transition: all 0.2s ease;
        }
        .top-bar-public a:hover {
            color: #ffffff !important;
        }
        .hover-gold:hover {
            color: #fbbf24 !important;
        }

        /* Navbar Styling */
        .navbar-public {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.07);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1030;
        }

        .navbar-public.scrolled {
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.08);
            background-color: rgba(255, 255, 255, 0.98);
        }

        .navbar-brand-badge {
            font-size: 0.63rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--primary);
            line-height: 1.1;
        }

        .navbar-brand-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--primary-dark);
            line-height: 1.25;
            letter-spacing: -0.01em;
        }

        .navbar-brand-sub {
            font-size: 0.7rem;
            letter-spacing: 0.01em;
            color: #64748b;
            font-weight: 500;
            line-height: 1.15;
        }

        .nav-link {
            font-weight: 600;
            color: #334155;
            padding: 0.48rem 0.7rem !important;
            font-size: 0.88rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .nav-link:hover, .nav-link:focus, .nav-link.show {
            color: var(--primary-light);
            background-color: rgba(5, 150, 105, 0.06);
        }

        /* Dropdown Menu Enhancements */
        .navbar-public .dropdown-menu {
            border-radius: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 16px 36px -4px rgba(0, 0, 0, 0.12);
            padding: 0.5rem;
            min-width: 270px;
        }

        .navbar-public .dropdown-item {
            padding: 0.55rem 0.75rem;
            border-radius: 0.65rem;
            transition: all 0.18s ease;
            color: #334155;
        }

        .navbar-public .dropdown-item:hover {
            background-color: rgba(5, 150, 105, 0.08);
            color: var(--primary-dark);
            transform: translateX(3px);
        }

        .dropdown-icon-box {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        @media (min-width: 992px) {
            .navbar-public .dropdown:hover > .dropdown-menu {
                display: block;
                margin-top: 0;
                animation: navDropdownFade 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            }
        }

        @keyframes navDropdownFade {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary-dayah {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            border: none;
            color: #ffffff !important;
            font-weight: 600;
            padding: 0.52rem 1.15rem;
            border-radius: 9999px;
            box-shadow: 0 3px 10px rgba(5, 150, 105, 0.25);
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-primary-dayah:hover {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(5, 150, 105, 0.35);
        }

        .btn-gold-outline {
            border: 1.5px solid var(--accent-gold);
            color: var(--accent-gold) !important;
            font-weight: 600;
            padding: 0.48rem 1.1rem;
            border-radius: 9999px;
            background: rgba(217, 119, 6, 0.04);
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-gold-outline:hover {
            background-color: var(--accent-gold);
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.25);
        }

        /* Mobile Nav Collapse Polish */
        @media (max-width: 991.98px) {
            #navMain {
                background: #ffffff;
                padding: 1.25rem 1rem;
                border-radius: 1rem;
                box-shadow: 0 14px 35px rgba(0, 0, 0, 0.12);
                margin-top: 0.75rem;
                border: 1px solid rgba(0, 0, 0, 0.08);
                max-height: calc(100vh - 84px);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
            #navMain .nav-link {
                padding: 0.65rem 0.9rem !important;
                border-bottom: 1px solid #f1f5f9;
            }
            #navMain .dropdown-menu {
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 0.75rem;
                box-shadow: none;
                margin: 0.4rem 0 0.6rem 0.5rem;
                padding: 0.4rem;
            }
            #navMain .dropdown-item {
                padding: 0.5rem 0.65rem;
            }
            .mobile-nav-btn-group {
                display: flex;
                flex-direction: column;
                gap: 0.6rem;
                margin-top: 0.85rem;
                padding-top: 0.85rem;
                border-top: 1px dashed #e2e8f0;
            }
            .mobile-nav-btn-group .btn {
                width: 100%;
                justify-content: center;
                padding: 0.65rem 1rem;
            }
        }

        /* Responsive Brand & Mobile Typography */
        .brand-icon-box {
            width: 44px;
            height: 44px;
            transition: all 0.2s ease;
        }

        @media (max-width: 575.98px) {
            .brand-icon-box {
                width: 38px !important;
                height: 38px !important;
            }
            .brand-icon-box i {
                font-size: 1.1rem !important;
            }
            .navbar-brand-badge {
                font-size: 0.54rem !important;
            }
            .navbar-brand-title {
                font-size: 0.88rem !important;
                line-height: 1.15;
            }
            .navbar-brand-sub {
                font-size: 0.62rem !important;
            }
            .display-5 {
                font-size: 2rem !important;
            }
            .display-6 {
                font-size: 1.65rem !important;
            }
            #btnBackToTop {
                bottom: 16px;
                right: 16px;
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }

        @media (max-width: 380px) {
            .navbar-brand-sub {
                display: none !important;
            }
            .navbar-brand-title {
                font-size: 0.8rem !important;
            }
        }

        @media (min-width: 992px) {
            #navMain.navbar-collapse {
                flex-wrap: nowrap !important;
            }
            #navMain .navbar-nav {
                flex-wrap: nowrap !important;
            }
        }

        /* Screen sizes 992px to 1366px: compact navbar buttons so Masuk Sistem is always visible */
        @media (min-width: 992px) and (max-width: 1366px) {
            .navbar-brand-badge {
                display: none !important;
            }
            .navbar-brand-sub {
                display: none !important;
            }
            .brand-icon-box {
                width: 36px !important;
                height: 36px !important;
            }
            .brand-icon-box i {
                font-size: 1.05rem !important;
            }
            .navbar-brand-title {
                font-size: 0.92rem !important;
                white-space: nowrap;
            }
            .nav-link {
                padding: 0.35rem 0.42rem !important;
                font-size: 0.81rem !important;
                white-space: nowrap;
            }
            .btn-primary-dayah, .btn-gold-outline {
                padding: 0.38rem 0.72rem !important;
                font-size: 0.79rem !important;
                white-space: nowrap;
            }
            .nav-btn-text-long {
                display: none;
            }
        }

        /* Card Hover Effects */
        .hover-lift {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.1) !important;
        }

        /* Footer */
        .footer-public {
            background: linear-gradient(180deg, #02281e 0%, #011611 100%);
            color: #cbd5e1;
            padding-top: 4.5rem;
            padding-bottom: 2rem;
        }

        .footer-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 1.25rem;
            letter-spacing: -0.01em;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 0.6rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .footer-link:hover {
            color: #34d399;
            transform: translateX(3px);
        }

        /* Back to top button */
        #btnBackToTop {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--primary-light);
            color: #ffffff;
            border: none;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.4);
            cursor: pointer;
            z-index: 1040;
            transition: all 0.25s ease;
        }

        #btnBackToTop:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.5);
        }
    </style>
</head>
<body>

    <!-- Top Utility Bar (Desktop / Tablet) -->
    <div class="top-bar-public bg-dark text-white-50 py-1.5 border-bottom border-light border-opacity-10 d-none d-lg-block" style="background: #02231a !important; font-size: 0.81rem;">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span class="text-white-50">
                    <i class="bi bi-geo-alt-fill text-warning me-1"></i> Gampong Sangso, Samalanga, Bireuen
                </span>
                <span class="text-white-50 opacity-25">|</span>
                <a href="tel:<?= html_escape($profil->no_hp ?? ''); ?>" class="text-white-50 text-decoration-none hover-white">
                    <i class="bi bi-telephone-fill text-success me-1"></i> <?= html_escape($profil->no_hp ?? '0812-xxxx-xxxx'); ?>
                </a>
                <span class="text-white-50 opacity-25">|</span>
                <a href="mailto:<?= html_escape($profil->email ?? 'dayah.alikhlas.aziziyah@gmail.com'); ?>" class="text-white-50 text-decoration-none hover-white">
                    <i class="bi bi-envelope-fill text-info me-1"></i> <?= html_escape($profil->email ?? 'dayah.alikhlas.aziziyah@gmail.com'); ?>
                </a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill shadow-sm" style="font-size: 0.75rem; color: #000000 !important;">
                    <i class="bi bi-megaphone-fill me-1" style="color: #000000 !important;"></i> Penerimaan Santri Baru TA <?= html_escape($tahun_ajaran_aktif->nama ?? '2026/2027'); ?> Telah Dibuka!
                </span>
                <a href="<?= base_url('pendaftaran/cek_status'); ?>" class="text-white text-decoration-none small fw-semibold hover-gold">
                    <i class="bi bi-search me-1 text-warning"></i> Cek Status Pendaftaran
                </a>
            </div>
        </div>
    </div>

    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-public sticky-top py-2.5 py-lg-3" id="navbarMain">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-2 gap-sm-3 text-decoration-none" href="<?= base_url(); ?>">
                <div class="brand-icon-box bg-success text-white rounded-3 d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%) !important;">
                    <i class="bi bi-bank fs-5"></i>
                </div>
                <div class="d-flex flex-column">
                    <div class="navbar-brand-badge">SISTEM INFORMASI &amp; PROMOSI</div>
                    <div class="navbar-brand-title">LPI Dayah Al-Ikhlas Al-Aziziyah</div>
                    <div class="navbar-brand-sub">
                        <i class="bi bi-geo-alt-fill text-success" style="font-size: 0.68rem;"></i> Samalanga, Kabupaten Bireuen
                    </div>
                </div>
            </a>

            <!-- Mobile Direct Actions & Toggler -->
            <div class="d-flex align-items-center gap-2 d-lg-none ms-auto">
                <?php if (is_logged_in()): ?>
                    <a class="btn btn-sm btn-primary-dayah d-inline-flex align-items-center gap-1 py-1.5 px-2.5 rounded-pill shadow-sm" href="<?= base_url(user_role()); ?>" style="font-size: 0.78rem;">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                <?php else: ?>
                    <a class="btn btn-sm btn-primary-dayah d-inline-flex align-items-center gap-1 py-1.5 px-2.5 rounded-pill shadow-sm" href="<?= base_url('login'); ?>" style="font-size: 0.78rem;">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk Sistem
                    </a>
                <?php endif; ?>

                <button class="navbar-toggler border-0 p-1.5 rounded-3 bg-light shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 mb-2 mb-lg-0">
                    <!-- 1. Beranda -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>#beranda">
                            <i class="bi bi-house-door text-success me-1"></i> Beranda
                        </a>
                    </li>

                    <!-- 2. Profil Dayah (Dropdown) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-building text-success me-1"></i> Profil
                        </a>
                        <ul class="dropdown-menu shadow-lg border-0 rounded-4 p-2">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#profil">
                                    <div class="dropdown-icon-box bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Sejarah &amp; Identitas</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Latar belakang pendirian sejak 2007</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#visi-misi">
                                    <div class="dropdown-icon-box bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-compass"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Visi &amp; Misi Dayah</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Arah pembinaan santri salafiyah</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#profil">
                                    <div class="dropdown-icon-box bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Pimpinan &amp; Dewan Guru</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Asatidz pengasuh &amp; pengajar</div>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1 opacity-50"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#statistik">
                                    <div class="dropdown-icon-box bg-secondary bg-opacity-10 text-secondary">
                                        <i class="bi bi-bar-chart-line"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Statistik &amp; Capaian</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Data santri, asatidz &amp; jenjang</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- 3. Pendidikan & Kurikulum (Dropdown) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-mortarboard text-success me-1"></i> Pendidikan
                        </a>
                        <ul class="dropdown-menu shadow-lg border-0 rounded-4 p-2">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#kurikulum">
                                    <div class="dropdown-icon-box bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-layers"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Jenjang Pendidikan</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Tajhizi, Ibtidaiyah, Tsanawiyah, Aliyah</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#kurikulum-kitab">
                                    <div class="dropdown-icon-box bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-journal-richtext"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Kurikulum Kitab Kuning</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">19 Disiplin ilmu mu'tabarah</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#jadwal">
                                    <div class="dropdown-icon-box bg-info bg-opacity-10 text-info">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Jadwal Harian Santri</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Aktivitas pengajian 24 jam</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#peraturan">
                                    <div class="dropdown-icon-box bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Tata Tertib &amp; Peraturan</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Kedisiplinan ibadah &amp; belajar</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- 4. Fasilitas -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>#fasilitas">
                            <i class="bi bi-grid text-success me-1"></i> Fasilitas
                        </a>
                    </li>

                    <!-- 5. Informasi PSB & Promosi (Dropdown) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-inline-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-patch-check-fill text-warning me-1"></i> Informasi PSB
                            <span class="badge bg-warning text-dark rounded-pill ms-1.5 fw-bold" style="font-size: 0.65rem; padding: 0.2rem 0.5rem;">Buka</span>
                        </a>
                        <ul class="dropdown-menu shadow-lg border-0 rounded-4 p-2">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url(); ?>#pendaftaran">
                                    <div class="dropdown-icon-box bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-info-circle"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Alur &amp; Persyaratan Berkas</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Dokumen &amp; tahapan pendaftaran</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url('pendaftaran'); ?>">
                                    <div class="dropdown-icon-box bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Formulir Pendaftaran Online</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Isi biodata calon santri baru</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2.5 py-2 px-2.5 rounded-3" href="<?= base_url('pendaftaran/cek_status'); ?>">
                                    <div class="dropdown-icon-box bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-search"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">Cek Status Pendaftaran</div>
                                        <div class="text-muted" style="font-size: 0.73rem;">Lacak proses verifikasi panitia</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- 6. Kontak & Lokasi -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>#kontak">
                            <i class="bi bi-geo-alt text-success me-1"></i> Kontak
                        </a>
                    </li>
                    
                    <!-- Desktop Actions -->
                    <li class="nav-item ms-lg-2 d-none d-lg-block flex-shrink-0">
                        <a class="btn btn-gold-outline d-inline-flex align-items-center gap-1.5" href="<?= base_url('pendaftaran'); ?>">
                            <i class="bi bi-pencil-square"></i> Daftar <span class="nav-btn-text-long">Santri</span>
                        </a>
                    </li>
                    <li class="nav-item ms-lg-1 d-none d-lg-block flex-shrink-0">
                        <?php if (is_logged_in()): ?>
                            <a class="btn btn-primary-dayah d-inline-flex align-items-center gap-1.5" href="<?= base_url(user_role()); ?>">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        <?php else: ?>
                            <a class="btn btn-primary-dayah d-inline-flex align-items-center gap-1.5" href="<?= base_url('login'); ?>">
                                <i class="bi bi-box-arrow-in-right"></i> Masuk <span class="nav-btn-text-long">Sistem</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <!-- Mobile Drawer Actions -->
                    <div class="mobile-nav-btn-group d-lg-none">
                        <a class="btn btn-gold-outline d-inline-flex align-items-center justify-content-center gap-2" href="<?= base_url('pendaftaran'); ?>">
                            <i class="bi bi-pencil-square"></i> Formulir Pendaftaran Santri
                        </a>
                        <a class="btn btn-outline-secondary d-inline-flex align-items-center justify-content-center gap-2" href="<?= base_url('pendaftaran/cek_status'); ?>">
                            <i class="bi bi-search"></i> Cek Status Pendaftaran
                        </a>
                        <?php if (!empty($profil->no_hp)): ?>
                            <a class="btn btn-outline-success d-inline-flex align-items-center justify-content-center gap-2" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $profil->no_hp); ?>" target="_blank">
                                <i class="bi bi-whatsapp"></i> Hubungi Panitia (WhatsApp)
                            </a>
                        <?php endif; ?>
                        <?php if (is_logged_in()): ?>
                            <a class="btn btn-primary-dayah d-inline-flex align-items-center justify-content-center gap-2" href="<?= base_url(user_role()); ?>">
                                <i class="bi bi-speedometer2"></i> Masuk Dashboard (<?= ucfirst(user_role()); ?>)
                            </a>
                        <?php else: ?>
                            <a class="btn btn-primary-dayah d-inline-flex align-items-center justify-content-center gap-2" href="<?= base_url('login'); ?>">
                                <i class="bi bi-lock-fill"></i> Masuk Sistem Dayah
                            </a>
                        <?php endif; ?>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php if (isset($content_view)) $this->load->view($content_view); ?>
    </main>

    <!-- Footer -->
    <footer class="footer-public" id="kontak">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-12 col-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-success text-white rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #10b981, #047857) !important;">
                            <i class="bi bi-bank fs-4"></i>
                        </div>
                        <div>
                            <div class="text-white fw-bold fs-5">LPI Dayah Al-Ikhlas Al-Aziziyah</div>
                            <small class="text-light opacity-75">Sistem Informasi &amp; Promosi Dayah Salafiyah</small>
                        </div>
                    </div>
                    <p class="text-white-50 pe-lg-4" style="line-height: 1.75; font-size: 0.92rem;">
                        Mendidik dan membina generasi berakhlak karimah, mendalami khazanah kitab kuning salafiyah, serta berpegang teguh pada tuntunan syariat Islam di bawah bimbingan para ulama dan dewan guru.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 py-2 px-3">
                            <i class="bi bi-calendar-check me-1"></i> Berdiri Sejak <?= html_escape($profil->tahun_berdiri ?? '2007'); ?>
                        </span>
                        <span class="badge bg-warning bg-opacity-25 text-warning border border-warning border-opacity-25 py-2 px-3">
                            <i class="bi bi-shield-check me-1"></i> Terakreditasi Dayah
                        </span>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-title">Tautan Cepat &amp; Navigasi</div>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url(); ?>#profil" class="footer-link"><i class="bi bi-chevron-right me-1 small"></i> Profil &amp; Sejarah</a></li>
                        <li><a href="<?= base_url(); ?>#visi-misi" class="footer-link"><i class="bi bi-chevron-right me-1 small"></i> Visi &amp; Misi Dayah</a></li>
                        <li><a href="<?= base_url(); ?>#kurikulum" class="footer-link"><i class="bi bi-chevron-right me-1 small"></i> Jenjang Pendidikan</a></li>
                        <li><a href="<?= base_url(); ?>#kurikulum-kitab" class="footer-link"><i class="bi bi-chevron-right me-1 small"></i> Kurikulum Kitab Kuning</a></li>
                        <li><a href="<?= base_url(); ?>#fasilitas" class="footer-link"><i class="bi bi-chevron-right me-1 small"></i> Fasilitas &amp; Asrama</a></li>
                        <li><a href="<?= base_url(); ?>#jadwal" class="footer-link"><i class="bi bi-chevron-right me-1 small"></i> Jadwal Kegiatan Santri</a></li>
                        <li><a href="<?= base_url(); ?>#peraturan" class="footer-link"><i class="bi bi-chevron-right me-1 small"></i> Tata Tertib Dayah</a></li>
                        <li><a href="<?= base_url('pendaftaran'); ?>" class="footer-link text-warning"><i class="bi bi-pencil-square me-1 small"></i> Pendaftaran Santri Baru Online</a></li>
                        <li><a href="<?= base_url('pendaftaran/cek_status'); ?>" class="footer-link text-warning"><i class="bi bi-search me-1 small"></i> Cek Status Pendaftaran</a></li>
                    </ul>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="footer-title">Kontak &amp; Lokasi Dayah</div>
                    <ul class="list-unstyled text-white-50" style="font-size: 0.9rem; line-height: 1.8;">
                        <li class="d-flex align-items-start gap-2 mb-2">
                            <i class="bi bi-geo-alt-fill text-success flex-shrink-0 mt-1"></i>
                            <span>Gampong Sangso, Kec. Samalanga, Kabupaten Bireuen, Provinsi Aceh - Kode Pos 24264</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-telephone-fill text-success flex-shrink-0"></i>
                            <span><?= html_escape($profil->no_hp ?? '0812-xxxx-xxxx'); ?></span>
                        </li>
                        <li class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-envelope-fill text-success flex-shrink-0"></i>
                            <span><?= html_escape($profil->email ?? 'dayah.alikhlas.aziziyah@gmail.com'); ?></span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-fill text-success flex-shrink-0"></i>
                            <span>Sekretariat: Setiap Hari 08.00 - 17.00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-top border-white border-opacity-10 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 text-white-50" style="font-size: 0.85rem;">
                <div>&copy; <?= date('Y'); ?> <strong>LPI Dayah Al-Ikhlas Al-Aziziyah</strong>. Semua hak cipta dilindungi.</div>
                <div>Sistem Informasi dan Promosi LPI Dayah Al-Ikhlas Al-Aziziyah &bull; Samalanga, Bireuen</div>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button type="button" id="btnBackToTop" title="Kembali ke Atas" aria-label="Kembali ke Atas">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scrolled shadow effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbarMain');
            const btnTop = document.getElementById('btnBackToTop');
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            if (window.scrollY > 300) {
                btnTop.style.display = 'flex';
            } else {
                btnTop.style.display = 'none';
            }
        });

        // Back to top click
        document.getElementById('btnBackToTop').addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Close mobile nav on link click (excluding dropdown toggles)
        document.querySelectorAll('#navMain .nav-link:not(.dropdown-toggle), #navMain .dropdown-item, .mobile-nav-btn-group a').forEach(function(link) {
            link.addEventListener('click', function() {
                const navCollapse = document.getElementById('navMain');
                if (navCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                    if (bsCollapse) bsCollapse.hide();
                }
            });
        });
    </script>
</body>
</html>
