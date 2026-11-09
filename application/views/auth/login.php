<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? html_escape($title) : 'Masuk ke Sistem'; ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #065f46;
            --primary-dark: #022c22;
            --primary-light: #10b981;
            --gold: #d97706;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 15% 20%, #064e3b 0%, #02281e 60%, #01140e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle Islamic Pattern Overlay */
        .bg-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 1.25rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            position: relative;
            z-index: 10;
        }

        .login-header {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            padding: 2.25rem 2rem 2rem;
            text-align: center;
            color: #ffffff;
            position: relative;
        }

        .login-icon-box {
            width: 68px;
            height: 68px;
            margin: 0 auto 1rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #fef3c7;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .form-control-custom {
            height: 50px;
            border-radius: 0.75rem;
            padding-left: 2.75rem;
            border: 1.5px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }

        .input-icon-box {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .btn-login {
            height: 50px;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            box-shadow: 0 8px 18px rgba(5, 150, 105, 0.35);
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(5, 150, 105, 0.45);
        }

        .role-pill {
            cursor: pointer;
            border-radius: 0.5rem;
            padding: 0.45rem 0.75rem;
            font-size: 0.78rem;
            font-weight: 600;
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            color: #475569;
            transition: all 0.2s;
        }

        .role-pill:hover {
            border-color: #059669;
            background: #ecfdf5;
            color: #065f46;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="bg-pattern"></div>

    <div class="login-card">
        <div class="login-header">
            <div class="login-icon-box">
                <i class="bi bi-bank"></i>
            </div>
            <h4 class="fw-bold mb-1">LPI Dayah Al-Ikhlas</h4>
            <div class="text-white-50 small">Al-Aziziyah &bull; Samalanga, Bireuen</div>
        </div>

        <div class="p-4 p-sm-4 pt-3">
            <div class="text-center mb-4">
                <h5 class="fw-bold text-dark mb-1">Masuk ke Sistem</h5>
                <p class="text-muted small mb-0">Silakan masukkan nama pengguna dan kata sandi Anda</p>
            </div>

            <?= get_alert(); ?>

            <form action="<?= base_url('auth/process'); ?>" method="POST" id="formLogin">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Username</label>
                    <div class="position-relative">
                        <i class="bi bi-person input-icon-box"></i>
                        <input type="text" name="username" id="inputUsername" class="form-control form-control-custom" placeholder="Masukkan username" required autofocus autocomplete="username">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label small fw-semibold text-secondary mb-0">Kata Sandi</label>
                        <a href="javascript:void(0)" onclick="togglePassword()" class="small text-decoration-none text-muted" id="btnTogglePass">
                            <i class="bi bi-eye"></i> Tampilkan
                        </a>
                    </div>
                    <div class="position-relative">
                        <i class="bi bi-shield-lock input-icon-box"></i>
                        <input type="password" name="password" id="inputPassword" class="form-control form-control-custom" placeholder="Masukkan kata sandi" required autocomplete="current-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 mb-4 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                    <span>Masuk ke Akun</span>
                </button>
            </form>

            <!-- Quick Demo Login Helper for Testing -->
            <div class="p-3 bg-light rounded-3 border border-light-subtle mb-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="small fw-bold text-secondary"><i class="bi bi-key-fill text-warning me-1"></i> Uji Coba Cepat (Akun Demo):</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="role-pill" onclick="quickFill('admin', 'admin123')">
                        <i class="bi bi-person-fill-gear text-success me-1"></i> Admin
                    </span>
                    <span class="role-pill" onclick="quickFill('bendahara', 'bendahara123')">
                        <i class="bi bi-wallet2 text-warning me-1"></i> Bendahara
                    </span>
                    <span class="role-pill" onclick="quickFill('pimpinan', 'pimpinan123')">
                        <i class="bi bi-award text-primary me-1"></i> Pimpinan
                    </span>
                </div>
            </div>

            <div class="text-center pt-2">
                <a href="<?= base_url(); ?>" class="text-decoration-none small text-muted d-inline-flex align-items-center gap-1 hover-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Beranda Publik
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function quickFill(user, pass) {
            document.getElementById('inputUsername').value = user;
            document.getElementById('inputPassword').value = pass;
            document.getElementById('inputPassword').type = 'text';
            setTimeout(() => {
                document.getElementById('inputPassword').type = 'password';
            }, 1200);
        }

        function togglePassword() {
            const input = document.getElementById('inputPassword');
            const btn = document.getElementById('btnTogglePass');
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = '<i class="bi bi-eye-slash"></i> Sembunyikan';
            } else {
                input.type = 'password';
                btn.innerHTML = '<i class="bi bi-eye"></i> Tampilkan';
            }
        }
    </script>
</body>
</html>
