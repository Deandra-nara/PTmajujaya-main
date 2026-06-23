<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - PT. Maju Jaya</title>

    <!-- Google Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
    <!-- Animate.css for subtle entry effects -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --bg-dark: #0f172a;
            --card-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --input-bg: #334155;
            --border-color: #475569;
        }

        body.login-page {
            background: radial-gradient(circle at 10% 20%, rgb(15, 23, 42) 0%, rgb(30, 41, 59) 90.1%) !important;
            font-family: 'Outfit', sans-serif !important;
            color: var(--text-main) !important;
            height: 100vh !important;
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            overflow: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
            position: relative !important;
        }

        /* Abstract Background Glow Elements */
        .glow-bubble-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0) 70%);
            top: -100px;
            left: -100px;
            z-index: 1;
            pointer-events: none;
        }

        .glow-bubble-2 {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(29, 78, 216, 0.12) 0%, rgba(29, 78, 216, 0) 70%);
            bottom: -150px;
            right: -100px;
            z-index: 1;
            pointer-events: none;
        }

        /* Centering Wrapper */
        .login-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            z-index: 10;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Dual-Panel Login Container */
        .login-container {
            width: 960px;
            height: 580px;
            display: flex;
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            margin: 0 !important;
        }


        /* Left Column: Hero Panel */
        .hero-panel {
            flex: 1.1;
            background: linear-gradient(135deg, rgba(29, 78, 216, 0.9) 0%, rgba(30, 58, 138, 0.95) 100%);
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            border-right: 1px solid var(--border-color);
        }

        .hero-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.02) 10px, rgba(255,255,255,0.02) 20px);
            pointer-events: none;
        }

        .hero-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 3;
        }

        .hero-brand i {
            font-size: 2.2rem;
            color: #60a5fa;
            text-shadow: 0 0 15px rgba(96, 165, 250, 0.5);
        }

        .hero-brand h2 {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .hero-brand h2 span {
            color: #60a5fa;
        }

        .hero-content {
            z-index: 3;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .hero-content h1 {
            font-size: 2.4rem;
            font-weight: 800;
            line-height: 1.25;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .hero-content p {
            color: #93c5fd;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            color: #e0f2fe;
            font-size: 0.9rem;
        }

        .feature-item i {
            color: #60a5fa;
            font-size: 1rem;
        }

        .hero-footer {
            z-index: 3;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            color: #93c5fd;
            font-size: 0.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* CSS Vector Visual: Dynamic Sports Car & Road */
        .car-vector-container {
            position: absolute;
            bottom: 40px;
            right: -20px;
            opacity: 0.15;
            pointer-events: none;
            width: 320px;
            height: 120px;
            z-index: 2;
        }

        .car-body {
            position: absolute;
            width: 250px;
            height: 40px;
            background: #ffffff;
            border-radius: 20px 80px 20px 10px;
            bottom: 30px;
            right: 20px;
        }

        .car-top {
            position: absolute;
            width: 140px;
            height: 35px;
            background: transparent;
            border: 6px solid #ffffff;
            border-bottom: none;
            border-radius: 60px 80px 0 0;
            bottom: 60px;
            right: 60px;
        }

        .road-line {
            position: absolute;
            width: 300px;
            height: 4px;
            background: linear-gradient(90deg, transparent 0%, #ffffff 50%, transparent 100%);
            bottom: 20px;
            right: 0;
        }

        /* Right Column: Login Panel */
        .login-panel {
            flex: 0.9;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--card-bg);
            position: relative;
        }

        .login-header {
            margin-bottom: 32px;
        }

        .login-header h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin: 0;
        }

        /* Modern Form Elements */
        .form-group label {
            color: var(--text-main) !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            margin-bottom: 8px !important;
            display: block;
        }

        .input-group {
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .input-group .form-control {
            background: transparent !important;
            border: none !important;
            color: var(--text-main) !important;
            height: 46px !important;
            padding-left: 16px !important;
            font-size: 0.95rem;
        }

        .input-group .form-control::placeholder {
            color: #64748b;
        }

        .input-group .form-control:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        .input-group-text {
            background: transparent !important;
            border: none !important;
            color: var(--text-muted) !important;
            padding-right: 16px !important;
        }

        /* Breathtaking Login Button */
        .btn-login {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%) !important;
            border: none !important;
            color: #ffffff !important;
            height: 48px;
            border-radius: 12px !important;
            font-size: 1rem !important;
            font-weight: 700 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
            background: linear-gradient(90deg, #4f46e5 0%, var(--primary) 100%) !important;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Alert Banner Redesign */
        .alert-danger {
            background: rgba(239, 68, 68, 0.15) !important;
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
            color: #fca5a5 !important;
            border-radius: 12px !important;
            font-size: 0.85rem !important;
            padding: 12px 16px !important;
            margin-bottom: 24px;
        }

        .alert-danger .close {
            color: #ffffff !important;
            opacity: 0.8;
            text-shadow: none;
        }

        .login-footer {
            margin-top: 32px;
            text-align: center;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }

        .login-footer span {
            color: var(--text-muted);
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Responsive Layout Updates */
        @media (max-width: 992px) {
            .login-container {
                width: 440px;
                height: auto;
            }
            .hero-panel {
                display: none;
            }
            .login-panel {
                flex: 1;
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                width: 90%;
            }
            .login-panel {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">

    <!-- Ambient Glow Backgrounds -->
    <div class="glow-bubble-1"></div>
    <div class="glow-bubble-2"></div>

    <div class="login-wrapper">
        <!-- Main Dynamic Login Card Box Container -->
        <div class="login-container animate__animated animate__zoomIn">
        
        <!-- Left Column: Hero Brand Panel -->
        <div class="hero-panel">
            <div class="hero-brand">
               <i class="fas fa-laptop"></i>
                <h2>PT.<span>Maju Jaya</span></h2>
            </div>
            
            <div class="hero-content">
                <h1>electronik terpercaya.</h1>
                <p> mudahnya bertransaksi.</p>
                
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>berbagai macam barang</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Garansi terjamin</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Kualitas barang terjamin</span>
                </div>
            </div>
            
            <div class="hero-footer">
                <span>© <?= date('Y') ?> Maju jaya .</span>
                <span>v2.1 Stable</span>
            </div>

        </div>

        <!-- Right Column: Login Core Form Panel -->
        <div class="login-panel">
            <div class="login-header">
                <h3>Selamat Datang</h3>
                <p>Silahkan masuk ke dalam akun Anda.</p>
            </div>

            <!-- Error Alerts display -->
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible animate__animated animate__shakeX">
                    <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-ban mr-2"></i> <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('auth/login') ?>" method="post">
                <!-- Username field -->
                <div class="form-group mb-3">
                    <label>USERNAME ADMIN</label>
                    <div class="input-group">
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda..." required autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password field -->
                <div class="form-group mb-4">
                    <label>PASSWORD AKUN</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda..." required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <button type="submit" class="btn btn-login btn-block">
                    <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                </button>
            </form>

            <div class="login-footer">
                <span>Akses Khusus Admin, Sales, & Manager</span>
            </div>
        </div>
    </div>

<!-- jQuery -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js') ?>"></script>

<script>
    // Smooth loading spinner action trigger on form submit
    $('form').on('submit', function() {
        $('.btn-login').prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin mr-1"></i> Memvalidasi Sesi...');
    });
</script>
</body>
</html>