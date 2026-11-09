<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? html_escape($title) : 'Panel Sistem Dayah'; ?> - <?= html_escape($profil->nama_dayah ?? 'LPI Dayah Al-Ikhlas'); ?></title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Amiri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        :root {
            --primary-emerald: #065f46;
            --primary-dark: #022c22;
            --primary-light: #059669;
            --primary-accent: #10b981;
            --accent-gold: #d97706;
            --accent-gold-light: #fef3c7;
            --sidebar-bg: #032b21;
            --sidebar-hover: #064e3b;
            --sidebar-active: #047857;
            --body-bg: #f8fafc;
            --card-border: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--body-bg);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar-wrapper {
            height: 100vh;
            height: 100dvh;
            max-height: 100vh;
            max-height: 100dvh;
            width: 270px;
            background: linear-gradient(180deg, #02281e 0%, #043d30 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.12);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #sidebar-wrapper .brand-header {
            flex-shrink: 0;
            padding: 1.2rem 1.15rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.01em;
            line-height: 1.25;
        }

        .brand-sub {
            font-size: 0.72rem;
            color: #a7f3d0;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .sidebar-menu {
            flex: 1 1 auto;
            min-height: 0;
            padding: 0.85rem 0.75rem 2rem;
            overflow-y: auto !important;
            overflow-x: hidden;
            overscroll-behavior: contain;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: rgba(52, 211, 153, 0.4) rgba(0, 0, 0, 0.15);
        }

        /* Custom Sleek Scrollbar */
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 4px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(52, 211, 153, 0.35);
            border-radius: 4px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(52, 211, 153, 0.65);
        }

        .sidebar-footer-user {
            flex-shrink: 0;
            padding: 0.85rem 1.1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(0, 0, 0, 0.25);
        }

        .menu-header {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
            color: #6ee7b7;
            padding: 0.8rem 0.75rem 0.4rem;
            opacity: 0.8;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.9rem;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            margin-bottom: 0.2rem;
        }

        .sidebar-link i {
            font-size: 1.15rem;
            color: #94a3b8;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            transform: translateX(3px);
        }

        .sidebar-link:hover i {
            color: #34d399;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, #059669 0%, #10b981 100%);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }

        .sidebar-link.active i {
            color: #ffffff;
        }

        /* High-Contrast Modern Sidebar Logout Button */
        .sidebar-link-logout {
            margin-top: 0.6rem;
            color: #ffe4e6 !important;
            background: rgba(244, 63, 94, 0.12) !important;
            border: 1px solid rgba(244, 63, 94, 0.28) !important;
            border-radius: 0.6rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.01em;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .sidebar-link-logout i {
            color: #fb7185 !important;
            font-size: 1.15rem !important;
            transition: all 0.25s ease !important;
        }

        .sidebar-link-logout:hover {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 50%, #be123c 100%) !important;
            color: #ffffff !important;
            border-color: transparent !important;
            box-shadow: 0 4px 16px rgba(225, 29, 72, 0.4) !important;
            transform: translateX(4px) !important;
        }

        .sidebar-link-logout:hover i {
            color: #ffffff !important;
        }

        /* Docked Sidebar Footer Logout Action */
        .btn-sidebar-footer-logout {
            width: 34px;
            height: 34px;
            border-radius: 0.55rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(244, 63, 94, 0.15);
            color: #fda4af !important;
            border: 1px solid rgba(244, 63, 94, 0.32);
            text-decoration: none !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
        }

        .btn-sidebar-footer-logout:hover {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important;
            color: #ffffff !important;
            border-color: transparent !important;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.45);
            transform: scale(1.06);
        }

        /* Page Content Area */
        #page-content-wrapper {
            margin-left: 270px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .top-navbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid var(--card-border);
            padding: 0 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        /* Badge Role */
        .badge-role-admin {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
        }
        .badge-role-bendahara {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: white;
        }
        .badge-role-pimpinan {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
        }

        /* Cards & Metrics */
        .metric-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 0.85rem;
            padding: 1.4rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .metric-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.06);
        }

        .metric-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .metric-val {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1.2;
            color: #0f172a;
        }

        .metric-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Data Tables Modern */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-custom th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.9rem 1.1rem;
            border-bottom: 1px solid var(--card-border);
            border-top: none;
        }

        .table-custom td {
            padding: 0.9rem 1.1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.88rem;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 0.85rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            overflow: hidden;
        }

        .card-custom .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--card-border);
            padding: 1.1rem 1.4rem;
            font-weight: 700;
            font-size: 1rem;
            color: #0f172a;
            display: flex;
            align-items: center;
        }

        /* ========================================================
           Modern SweetAlert2 UI (Islamic Emerald & Crimson Theme)
           ======================================================== */
        .swal2-container.swal2-backdrop-show {
            backdrop-filter: blur(8px) !important;
            -webkit-backdrop-filter: blur(8px) !important;
            background: rgba(15, 23, 42, 0.55) !important;
        }

        .swal2-custom-delete-popup {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            border-radius: 1.5rem !important;
            padding: 2rem 1.75rem 1.75rem !important;
            box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
            border: none !important;
            background: #ffffff !important;
            max-width: 460px !important;
            width: 92% !important;
            overflow: hidden !important;
        }

        .swal2-custom-delete-popup .swal2-html-container {
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
        }

        /* Pulsing Radar Danger Hero Icon */
        .swal2-danger-pulse-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 1.25rem;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            color: #ef4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            position: relative;
            box-shadow: 0 0 0 8px rgba(239, 68, 68, 0.12), 0 10px 25px -5px rgba(239, 68, 68, 0.3);
            animation: swalDangerPulse 2s infinite ease-in-out;
        }

        @keyframes swalDangerPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.35), 0 10px 25px -5px rgba(239, 68, 68, 0.3);
                transform: scale(0.98);
            }
            70% {
                box-shadow: 0 0 0 18px rgba(239, 68, 68, 0), 0 10px 25px -5px rgba(239, 68, 68, 0.3);
                transform: scale(1.02);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0), 0 10px 25px -5px rgba(239, 68, 68, 0.3);
                transform: scale(0.98);
            }
        }

        /* Action Buttons */
        .swal2-custom-actions {
            display: flex !important;
            gap: 0.75rem !important;
            margin: 1.5rem 0 0 0 !important;
            width: 100% !important;
            justify-content: center !important;
        }

        .swal2-custom-btn-cancel {
            flex: 1 !important;
            background: #f1f5f9 !important;
            color: #475569 !important;
            border: 1px solid #cbd5e1 !important;
            padding: 0.75rem 1.25rem !important;
            font-size: 0.92rem !important;
            font-weight: 600 !important;
            border-radius: 50rem !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer !important;
            outline: none !important;
            text-align: center !important;
        }

        .swal2-custom-btn-cancel:hover {
            background: #e2e8f0 !important;
            color: #1e293b !important;
            transform: translateY(-1px) !important;
        }

        .swal2-custom-btn-delete {
            flex: 1.35 !important;
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 50%, #be123c 100%) !important;
            color: #ffffff !important;
            border: none !important;
            padding: 0.75rem 1.25rem !important;
            font-size: 0.92rem !important;
            font-weight: 700 !important;
            border-radius: 50rem !important;
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35) !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer !important;
            outline: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.4rem !important;
            text-align: center !important;
        }

        .swal2-custom-btn-delete:hover {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%) !important;
            box-shadow: 0 6px 20px rgba(225, 29, 72, 0.5) !important;
            transform: translateY(-1px) !important;
        }

        /* Modern Toast Notification Styling */
        .swal2-toast-modern {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            border-radius: 1.25rem !important;
            padding: 0.85rem 1.15rem !important;
            background: rgba(255, 255, 255, 0.96) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.18), 0 0 0 1px rgba(0, 0, 0, 0.06) !important;
            border-left-width: 5px !important;
            border-left-style: solid !important;
        }

        .swal2-toast-modern.swal2-toast-delete {
            border-left-color: #f43f5e !important;
        }

        .swal2-toast-modern.swal2-toast-success {
            border-left-color: #10b981 !important;
        }

        .swal2-toast-modern.swal2-toast-warning {
            border-left-color: #f59e0b !important;
        }

        .swal2-toast-modern.swal2-toast-error {
            border-left-color: #ef4444 !important;
        }

        .swal2-toast-modern .swal2-timer-progress-bar {
            height: 3px !important;
            border-radius: 0 0 1.25rem 1.25rem !important;
        }

        .swal2-toast-delete .swal2-timer-progress-bar {
            background: linear-gradient(to right, #f43f5e, #be123c) !important;
        }

        .swal2-toast-success .swal2-timer-progress-bar {
            background: linear-gradient(to right, #10b981, #047857) !important;
        }

        .swal2-toast-warning .swal2-timer-progress-bar {
            background: linear-gradient(to right, #f59e0b, #d97706) !important;
        }

        .swal2-toast-error .swal2-timer-progress-bar {
            background: linear-gradient(to right, #ef4444, #b91c1c) !important;
        }
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            height: 100dvh;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            z-index: 1045;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-backdrop.show {
            display: block;
            opacity: 1;
        }

        /* Custom Sleek Scrollbar for Responsive Tables */
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Desktop Collapsible Sidebar */
        @media (min-width: 992px) {
            body.sidebar-collapsed #sidebar-wrapper {
                transform: translateX(-100%);
                box-shadow: none;
            }
            body.sidebar-collapsed #page-content-wrapper {
                margin-left: 0 !important;
            }
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                width: 285px;
                max-width: 85vw;
                left: 0;
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #sidebar-wrapper.toggled {
                transform: translateX(0);
                box-shadow: 10px 0 35px rgba(0, 0, 0, 0.45);
            }
            #page-content-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
            }
            .top-navbar {
                padding: 0 1rem;
            }
            main.p-4 {
                padding: 1rem 0.85rem !important;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Wrapper -->
    <div id="sidebar-wrapper">
        <div class="brand-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2.5">
                <div class="bg-success text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981, #047857) !important;">
                    <i class="bi bi-bank fs-5"></i>
                </div>
                <div>
                    <div class="brand-title">Al-Ikhlas</div>
                    <div class="brand-sub">Al-Aziziyah Samalanga</div>
                </div>
            </div>
            <!-- Mobile Close Button -->
            <button type="button" class="btn btn-sm text-white-50 d-lg-none p-1 border-0" id="sidebarCloseBtn" aria-label="Tutup Menu">
                <i class="bi bi-x-lg fs-5"></i>
            </button>
        </div>

        <?php 
            $curr_role = user_role();
            $curr_uri = uri_string();
        ?>

        <div class="sidebar-menu">
            <div class="menu-header">Menu Utama</div>
            
            <?php if ($curr_role === 'admin'): ?>
                <a href="<?= base_url('admin/dashboard'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/dashboard') !== false || $curr_uri === 'admin' ? 'active' : ''; ?>">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard Admin</span>
                </a>
                <div class="menu-header">Kesiswaan & Pengajar</div>
                <a href="<?= base_url('admin/santri'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/santri') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Santri</span>
                </a>
                <a href="<?= base_url('admin/guru'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/guru') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-person-video3"></i>
                    <span>Data Dewan Guru</span>
                </a>
                <a href="<?= base_url('admin/pendaftaran'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/pendaftaran') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Pendaftaran Baru</span>
                </a>

                <div class="menu-header">Akademik</div>
                <a href="<?= base_url('admin/jenjang'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/jenjang') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>Jenjang & Kelas</span>
                </a>
                <a href="<?= base_url('admin/kurikulum'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/kurikulum') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Kitab & Kurikulum</span>
                </a>
                <a href="<?= base_url('admin/jadwal'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/jadwal') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-calendar-week-fill"></i>
                    <span>Jadwal Kegiatan</span>
                </a>
                <a href="<?= base_url('admin/fasilitas'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/fasilitas') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-buildings-fill"></i>
                    <span>Master Fasilitas</span>
                </a>

                <div class="menu-header">Keuangan & Sistem</div>
                <a href="<?= base_url('admin/pembayaran'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/pembayaran') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-cash-stack"></i>
                    <span>Pembayaran SPP</span>
                </a>
                <a href="<?= base_url('admin/laporan'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/laporan') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    <span>Laporan & Ekspor Dinas</span>
                </a>
                <a href="<?= base_url('admin/pengaturan'); ?>" class="sidebar-link <?= strpos($curr_uri, 'admin/pengaturan') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-sliders"></i>
                    <span>Profil & Pengaturan</span>
                </a>

            <?php elseif ($curr_role === 'bendahara'): ?>
                <a href="<?= base_url('bendahara/dashboard'); ?>" class="sidebar-link <?= strpos($curr_uri, 'bendahara/dashboard') !== false || $curr_uri === 'bendahara' ? 'active' : ''; ?>">
                    <i class="bi bi-wallet2"></i>
                    <span>Dashboard Keuangan</span>
                </a>
                <div class="menu-header">Transaksi SPP</div>
                <a href="<?= base_url('bendahara/spp'); ?>" class="sidebar-link <?= strpos($curr_uri, 'bendahara/spp') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-credit-card-2-back-fill"></i>
                    <span>Input Pembayaran SPP</span>
                </a>
                <a href="<?= base_url('bendahara/kartu_spp'); ?>" class="sidebar-link <?= strpos($curr_uri, 'bendahara/kartu_spp') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Kartu SPP Santri</span>
                </a>
                <a href="<?= base_url('bendahara/tunggakan'); ?>" class="sidebar-link <?= strpos($curr_uri, 'bendahara/tunggakan') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-exclamation-octagon-fill"></i>
                    <span>Rekap Tunggakan</span>
                </a>
                <a href="<?= base_url('bendahara/laporan'); ?>" class="sidebar-link <?= strpos($curr_uri, 'bendahara/laporan') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-printer-fill"></i>
                    <span>Laporan Kas & Kuitansi</span>
                </a>

            <?php elseif ($curr_role === 'pimpinan'): ?>
                <a href="<?= base_url('pimpinan/dashboard'); ?>" class="sidebar-link <?= strpos($curr_uri, 'pimpinan/dashboard') !== false || $curr_uri === 'pimpinan' ? 'active' : ''; ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard Eksekutif</span>
                </a>
                <div class="menu-header">Monitoring</div>
                <a href="<?= base_url('pimpinan/rekap_santri'); ?>" class="sidebar-link <?= strpos($curr_uri, 'pimpinan/rekap_santri') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-pie-chart-fill"></i>
                    <span>Demografi Santri</span>
                </a>
                <a href="<?= base_url('pimpinan/rekap_guru'); ?>" class="sidebar-link <?= strpos($curr_uri, 'pimpinan/rekap_guru') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-person-vcard-fill"></i>
                    <span>Data Dewan Guru</span>
                </a>
                <a href="<?= base_url('pimpinan/rekap_keuangan'); ?>" class="sidebar-link <?= strpos($curr_uri, 'pimpinan/rekap_keuangan') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Arus Penerimaan Dayah</span>
                </a>
                <a href="<?= base_url('pimpinan/laporan_dinas'); ?>" class="sidebar-link <?= strpos($curr_uri, 'pimpinan/laporan_dinas') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    <span>Laporan Format Dinas</span>
                </a>
            <?php endif; ?>

            <div class="menu-header">Navigasi Luar</div>
            <a href="<?= base_url(); ?>" target="_blank" class="sidebar-link">
                <i class="bi bi-globe"></i>
                <span>Lihat Web Publik</span>
            </a>
            <a href="<?= base_url('logout'); ?>" class="sidebar-link sidebar-link-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar (Logout)</span>
            </a>
        </div>

        <!-- Sidebar Footer User Info (Docked & Non-shrinkable) -->
        <div class="sidebar-footer-user d-flex align-items-center gap-3">
            <div class="rounded-circle bg-emerald text-white d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; background-color: #059669; flex-shrink: 0;">
                <?= strtoupper(substr(user_name(), 0, 1)); ?>
            </div>
            <div class="overflow-hidden flex-grow-1">
                <div class="text-white text-truncate fw-semibold" style="font-size: 0.85rem;"><?= html_escape(user_name()); ?></div>
                <div class="text-white-50 small" style="font-size: 0.72rem; text-transform: capitalize;"><?= html_escape(user_role()); ?></div>
            </div>
            <a href="<?= base_url('logout'); ?>" class="btn-sidebar-footer-logout" title="Keluar / Logout">
                <i class="bi bi-box-arrow-right fs-6"></i>
            </a>
        </div>
    </div>

    <!-- Mobile Drawer Backdrop Overlay -->
    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

    <!-- Page Content Wrapper -->
    <div id="page-content-wrapper">
        <!-- Top Navigation -->
        <nav class="top-navbar">
            <div class="d-flex align-items-center gap-2 gap-sm-3">
                <button class="btn btn-light border shadow-sm px-2.5 py-1.5 rounded-3" id="sidebarToggle" aria-label="Buka / Tutup Sidebar" title="Buka / Tutup Sidebar (Lebarkan Layar)">
                    <i class="bi bi-list fs-5 text-dark"></i>
                </button>
                <div>
                    <h5 class="mb-0 fw-bold text-dark fs-6 fs-md-5"><?= isset($title) ? html_escape($title) : 'Dashboard'; ?></h5>
                    <small class="text-muted d-none d-sm-inline">Tahun Ajaran: <strong><?= html_escape($tahun_ajaran_aktif->nama ?? '2026/2027'); ?></strong></small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2 gap-sm-3">
                <!-- Role Badge -->
                <span class="badge rounded-pill px-2.5 px-sm-3 py-1.5 py-sm-2 <?= 'badge-role-' . user_role(); ?>">
                    <i class="bi bi-shield-check me-1"></i> <?= strtoupper(user_role()); ?>
                </span>

                <!-- Quick Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2 py-1 px-2.5 rounded-pill shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; background: #047857; font-size: 0.8rem;">
                            <?= strtoupper(substr(user_name(), 0, 1)); ?>
                        </div>
                        <span class="d-none d-md-inline fw-semibold" style="font-size: 0.85rem;"><?= html_escape(user_name()); ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                        <li class="px-3 py-2 border-bottom">
                            <div class="fw-bold text-dark"><?= html_escape(user_name()); ?></div>
                            <small class="text-muted"><?= html_escape(user_data('username')); ?> (<?= ucfirst(user_role()); ?>)</small>
                        </li>
                        <li><a class="dropdown-item py-2" href="<?= base_url(); ?>" target="_blank"><i class="bi bi-globe me-2 text-muted"></i> Halaman Publik</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="<?= base_url('logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Body Content -->
        <main class="p-4 flex-grow-1">
            <?= get_alert(); ?>
            <?php if (isset($content_view)) $this->load->view($content_view); ?>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-top py-3 px-4 text-muted d-flex flex-wrap justify-content-between align-items-center" style="font-size: 0.82rem;">
            <div>&copy; <?= date('Y'); ?> <strong><?= html_escape($profil->nama_dayah ?? 'LPI Dayah Al-Ikhlas Al-Aziziyah'); ?></strong>. Hak cipta dilindungi.</div>
            <div class="text-muted">Sistem Informasi Manajemen Terpadu Dayah &bull; Samalanga, Bireuen</div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Mobile Drawer Controls
            const sidebar = document.getElementById('sidebar-wrapper');
            const toggleBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('sidebarCloseBtn');
            const backdrop = document.getElementById('sidebarBackdrop');

            function openSidebar() {
                sidebar.classList.add('toggled');
                backdrop.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('toggled');
                backdrop.classList.remove('show');
                document.body.style.overflow = '';
            }

            // Restore desktop sidebar collapsed preference
            if (window.innerWidth >= 992 && localStorage.getItem('dayah_sidebar_collapsed') === 'true') {
                document.body.classList.add('sidebar-collapsed');
            }

            toggleBtn?.addEventListener('click', function(e) {
                e.stopPropagation();
                if (window.innerWidth < 992) {
                    if (sidebar.classList.contains('toggled')) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                } else {
                    document.body.classList.toggle('sidebar-collapsed');
                    const isCollapsed = document.body.classList.contains('sidebar-collapsed');
                    localStorage.setItem('dayah_sidebar_collapsed', isCollapsed ? 'true' : 'false');
                }
            });

            closeBtn?.addEventListener('click', closeSidebar);
            backdrop?.addEventListener('click', closeSidebar);

            // Automatically close sidebar on mobile when a link is clicked
            sidebar.querySelectorAll('.sidebar-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('toggled');
                    backdrop.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });

            // Premium Toast Notification for Session Flashdata
            <?php 
                $alert_msg = $this->session->flashdata('alert_message');
                $alert_type = $this->session->flashdata('alert_type') ?: 'info';
            ?>
            <?php if (!empty($alert_msg)): ?>
                (function() {
                    const alertMsg = <?= json_encode(strip_tags($alert_msg)); ?>;
                    const alertType = '<?= $alert_type; ?>';
                    const isDelete = /hapus|dihapus|batal/i.test(alertMsg);

                    // Optional subtle audio chime
                    try {
                        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                        const osc = audioCtx.createOscillator();
                        const gain = audioCtx.createGain();
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(isDelete ? 440 : 587.33, audioCtx.currentTime); // A4 or D5
                        osc.frequency.exponentialRampToValueAtTime(isDelete ? 330 : 880, audioCtx.currentTime + 0.2);
                        gain.gain.setValueAtTime(0.04, audioCtx.currentTime);
                        gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.25);
                        osc.connect(gain);
                        gain.connect(audioCtx.destination);
                        osc.start();
                        osc.stop(audioCtx.currentTime + 0.25);
                    } catch(e) {}

                    let toastClass = 'swal2-toast-modern ';
                    let iconHtml = '';
                    let titleText = 'Pemberitahuan';

                    if (isDelete) {
                        toastClass += 'swal2-toast-delete';
                        titleText = 'Data Berhasil Dihapus';
                        iconHtml = `
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background: #ffe4e6; color: #e11d48; font-size: 1.15rem; box-shadow: 0 4px 10px rgba(225, 29, 72, 0.2);">
                                <i class="bi bi-trash-fill"></i>
                            </div>`;
                    } else if (alertType === 'success') {
                        toastClass += 'swal2-toast-success';
                        titleText = 'Berhasil Disimpan';
                        iconHtml = `
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background: #d1fae5; color: #059669; font-size: 1.25rem; box-shadow: 0 4px 10px rgba(5, 150, 105, 0.2);">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>`;
                    } else if (alertType === 'danger' || alertType === 'error') {
                        toastClass += 'swal2-toast-error';
                        titleText = 'Terjadi Kesalahan';
                        iconHtml = `
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background: #fee2e2; color: #dc2626; font-size: 1.25rem; box-shadow: 0 4px 10px rgba(220, 38, 38, 0.2);">
                                <i class="bi bi-exclamation-octagon-fill"></i>
                            </div>`;
                    } else {
                        toastClass += 'swal2-toast-warning';
                        titleText = 'Perhatian';
                        iconHtml = `
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background: #fef3c7; color: #d97706; font-size: 1.25rem; box-shadow: 0 4px 10px rgba(217, 119, 6, 0.2);">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>`;
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            popup: toastClass
                        },
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });

                    Toast.fire({
                        html: `
                            <div class="d-flex align-items-center gap-3 py-1">
                                ${iconHtml}
                                <div class="flex-grow-1 text-start">
                                    <div class="d-flex align-items-center justify-content-between mb-0.5">
                                        <span class="fw-bold text-dark" style="font-size: 0.92rem;">${titleText}</span>
                                        <span class="badge text-secondary border bg-light py-0.5 px-2 ms-2" style="font-size: 0.65rem; font-weight: 600;">Sistem</span>
                                    </div>
                                    <div class="text-secondary" style="font-size: 0.83rem; line-height: 1.4;">${alertMsg}</div>
                                </div>
                            </div>
                        `
                    });
                })();
            <?php endif; ?>
        });

        // Universal SweetAlert2 Delete Interceptor (Modern High-End Confirmation UI)
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('a[href*="/hapus/"], a[href*="/hapus_"], a[onclick*="confirm"], button[onclick*="confirm"], .btn-delete, [data-confirm-delete]');
            if (btn) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();

                const targetUrl = btn.getAttribute('href') || btn.getAttribute('data-href');
                const customTitle = btn.getAttribute('data-title') || 'Konfirmasi Hapus Data';
                
                // Helper to clean HTML string
                function escapeHtml(str) {
                    if (!str) return '';
                    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                }

                // 1. Primary: Explicit data-name attribute
                let itemName = btn.getAttribute('data-name');
                let itemSub = btn.getAttribute('data-sub') || '';

                // 2. Parse from inline onclick confirm message if available
                if (!itemName) {
                    const onclickStr = btn.getAttribute('onclick') || '';
                    const match = onclickStr.match(/confirm\s*\(\s*['"](?:Apakah Anda yakin ingin menghapus (?:data santri|data dewan guru|data formulir pendaftaran|data formulir|data|berkas pendaftaran|akun pengguna|transaksi)?\s*)?([^?]+?)(?:\?.*)?['"]\s*\)/i);
                    if (match && match[1]) {
                        const parsed = match[1].trim();
                        if (parsed.length > 2 && !parsed.startsWith('Hapus ')) {
                            itemName = parsed;
                        }
                    }
                }

                // 3. Parse from table row if inside a table (strictly skipping single-letter initial avatars!)
                if (!itemName || itemName.length <= 2) {
                    const tr = btn.closest('tr');
                    if (tr) {
                        // Look through all cells, find text elements that are not avatar circles
                        const candidates = tr.querySelectorAll('.fw-bold, .fw-semibold, td:nth-child(3), td:nth-child(2)');
                        for (let el of candidates) {
                            if (el.closest('.avatar-initial') || el.classList.contains('avatar-initial') || el.closest('.rounded-circle')) {
                                continue;
                            }
                            const txt = el.innerText.trim().split('\n')[0];
                            if (txt.length > 2 && !/^[A-Z]$/.test(txt)) {
                                itemName = txt;
                                break;
                            }
                        }

                        // Try to find sub info (NIS, NIK, etc.)
                        if (!itemSub) {
                            const subEl = tr.querySelector('.font-monospace, small.text-muted, td:nth-child(2) small');
                            if (subEl) itemSub = subEl.innerText.trim().split('\n')[0];
                        }
                    }
                }

                // 4. Parse from card header if inside a detail card
                if (!itemName || itemName.length <= 2) {
                    const card = btn.closest('.card, .card-custom');
                    if (card) {
                        const titleEl = card.querySelector('h1, h2, h3, h4, h5, .fw-bold');
                        if (titleEl && !titleEl.closest('.avatar-initial')) {
                            itemName = titleEl.innerText.trim().split('\n')[0];
                        }
                    }
                }

                if (!itemName || itemName.length <= 2) {
                    itemName = 'Data yang dipilih';
                }

                Swal.fire({
                    html: `
                        <div class="swal2-danger-pulse-icon">
                            <i class="bi bi-trash3-fill"></i>
                        </div>
                        <div class="text-center">
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-1 mb-2.5 fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="bi bi-shield-exclamation me-1"></i> TINDAKAN PERMANEN
                            </span>
                            <h4 class="fw-bold text-dark mb-1" style="font-size: 1.3rem; letter-spacing: -0.3px;">Hapus Data Ini?</h4>
                            <p class="text-secondary small mb-3">Apakah Anda yakin ingin menghapus data berikut dari sistem?</p>

                            <!-- Target Entity Card -->
                            <div class="text-start p-3 rounded-3 mb-3" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-left: 4.5px solid #ef4444;">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="badge bg-danger text-white rounded-pill px-2 py-0.5" style="font-size: 0.68rem; font-weight: 700; letter-spacing: 0.4px;">
                                        TARGET
                                    </span>
                                    <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.72rem;">${escapeHtml(customTitle.replace('Konfirmasi Hapus ', ''))}</span>
                                </div>
                                <div class="fw-bold text-dark fs-6 mt-1 text-truncate" title="${escapeHtml(itemName)}">
                                    <i class="bi bi-file-earmark-person-fill text-danger me-1.5 opacity-75"></i>${escapeHtml(itemName)}
                                </div>
                                ${itemSub ? `<div class="text-muted small mt-1 font-monospace" style="font-size: 0.8rem;"><i class="bi bi-tag-fill me-1 text-secondary opacity-75"></i>${escapeHtml(itemSub)}</div>` : ''}
                            </div>

                            <!-- Warning notice -->
                            <div class="p-2.5 rounded-3 text-start small d-flex align-items-center gap-2 mb-1" style="background: #fffbeb; border: 1px solid #fde68a; color: #92400e;">
                                <i class="bi bi-exclamation-triangle-fill text-warning fs-5 flex-shrink-0"></i>
                                <div style="font-size: 0.82rem; line-height: 1.35;">
                                    Data ini akan <strong>dihapus permanen</strong>. Berkas lampiran dan riwayat terkait tidak dapat dipulihkan kembali.
                                </div>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: '<i class="bi bi-trash3-fill"></i> Ya, Hapus Sekarang',
                    cancelButtonText: '<i class="bi bi-x-lg"></i> Batal',
                    customClass: {
                        popup: 'swal2-custom-delete-popup',
                        actions: 'swal2-custom-actions',
                        confirmButton: 'swal2-custom-btn-delete',
                        cancelButton: 'swal2-custom-btn-cancel'
                    },
                    buttonsStyling: false,
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: '<div class="fw-bold text-dark fs-5 pt-2">Menghapus Data...</div>',
                            html: '<div class="text-muted small pb-2">Sistem sedang membersihkan data dan berkas terkait.</div>',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal2-custom-delete-popup text-center'
                            },
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        if (targetUrl && targetUrl !== '#' && targetUrl !== 'javascript:void(0);') {
                            window.location.href = targetUrl;
                        } else if (btn.form) {
                            btn.form.submit();
                        }
                    }
                });
            }
        }, true);
    </script>
</body>
</html>
