<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TAFTA - Sistem Manajemen Kalibrasi & Maintenance') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            --secondary-gradient: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
            --accent-gradient: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            --dark-bg: #0f172a;
            --card-bg: rgba(255, 255, 255, 0.95);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--dark-bg);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: var(--dark-bg);
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            opacity: 0.1;
            animation: gradientShift 8s ease-in-out infinite;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: var(--primary-gradient);
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: -10s;
        }

        @keyframes gradientShift {
            0%, 100% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(5px) translateY(-5px); }
            50% { transform: translateX(-5px) translateY(5px); }
            75% { transform: translateX(5px) translateY(5px); }
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(30px) rotate(240deg); }
            100% { transform: translateY(0px) rotate(360deg); }
        }

        /* Navigation */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: rgba(15, 23, 42, 0.95);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            padding: 120px 0 80px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            color: white;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            animation: slideInUp 0.8s ease-out;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            animation: slideInUp 0.8s ease-out 0.2s both;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2.5rem;
            max-width: 600px;
            animation: slideInUp 0.8s ease-out 0.4s both;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            animation: slideInUp 0.8s ease-out 0.6s both;
        }

        .hero-visual {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: slideInRight 1s ease-out 0.8s both;
        }

        .hero-icon-container {
            position: relative;
            width: 300px;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-icon-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            border-radius: 50%;
            opacity: 0.2;
            animation: pulse 4s ease-in-out infinite;
        }

        .hero-icon {
            font-size: 120px;
            color: white;
            z-index: 2;
            animation: floatSlow 6s ease-in-out infinite;
        }

        /* Buttons */
        .btn-primary-custom {
            background: var(--primary-gradient);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 50px;
            padding: 1rem 2rem;
            font-weight: 600;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: white;
            color: var(--text-primary);
            border-color: white;
            transform: translateY(-2px);
        }

        /* Feature Cards */
        .features-section {
            padding: 100px 0;
            background: linear-gradient(180deg, transparent 0%, rgba(255,255,255,0.02) 100%);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-gradient);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .feature-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            border-radius: 20px;
            opacity: 0.3;
            filter: blur(20px);
            z-index: -1;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 0;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-icon {
            font-size: 3rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            text-align: center;
        }

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.2; }
            50% { transform: scale(1.1); opacity: 0.3; }
        }

        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Responsive Design */
        
        /* Large Desktop */
        @media (min-width: 1400px) {
            .container {
                max-width: 1320px;
            }
            
            .hero-title {
                font-size: 4rem;
            }
            
            .hero-subtitle {
                font-size: 1.4rem;
            }
            
            .feature-card {
                padding: 2.5rem;
            }
        }
        
        /* Desktop */
        @media (min-width: 992px) and (max-width: 1399px) {
            .hero-title {
                font-size: 3.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.3rem;
            }
        }
        
        /* Tablet */
        @media (min-width: 768px) and (max-width: 991px) {
            .hero-section {
                padding: 100px 0 80px;
            }
            
            .hero-title {
                font-size: 3rem;
                line-height: 1.2;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .feature-card {
                padding: 2rem;
                margin-bottom: 2rem;
            }
            
            .stat-card {
                margin-bottom: 2rem;
            }
            
            .btn-primary-custom,
            .btn-outline-custom {
                padding: 12px 24px;
                font-size: 1rem;
            }
            
            .hero-icon-container {
                width: 250px;
                height: 250px;
            }
        }
        
        /* Mobile Large */
        @media (min-width: 576px) and (max-width: 767px) {
            .hero-section {
                padding: 80px 0 60px;
                text-align: center;
            }
            
            .hero-title {
                font-size: 2.8rem;
                line-height: 1.2;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
                margin-bottom: 2rem;
            }
            
            .hero-badge {
                font-size: 0.85rem;
                padding: 8px 16px;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .feature-card {
                padding: 1.8rem;
                margin-bottom: 1.5rem;
            }
            
            .feature-icon {
                width: 60px;
                height: 60px;
            }
            
            .stat-card {
                margin-bottom: 1.5rem;
                padding: 1.5rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
            
            .hero-icon-container {
                width: 200px;
                height: 200px;
            }
            
            .hero-icon {
                font-size: 80px;
            }
            
            .btn-primary-custom,
            .btn-outline-custom {
                padding: 12px 20px;
                font-size: 0.95rem;
                width: 100%;
                margin-bottom: 1rem;
            }
            
            .navbar-brand {
                font-size: 1.4rem;
            }
        }
        
        /* Mobile Small */
        @media (max-width: 575px) {
            .hero-section {
                padding: 70px 0 50px;
                text-align: center;
            }
            
            .hero-title {
                font-size: 2.2rem;
                line-height: 1.3;
                margin-bottom: 1rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
                line-height: 1.6;
            }
            
            .hero-badge {
                font-size: 0.8rem;
                padding: 6px 12px;
                margin-bottom: 1.5rem;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .feature-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
                text-align: center;
            }
            
            .feature-icon {
                width: 50px;
                height: 50px;
                margin: 0 auto 1rem;
            }
            
            .feature-title {
                font-size: 1.1rem;
            }
            
            .feature-description {
                font-size: 0.9rem;
            }
            
            .stat-card {
                margin-bottom: 1.5rem;
                padding: 1.2rem;
                text-align: center;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .stat-label {
                font-size: 0.9rem;
            }
            
            .hero-icon-container {
                width: 150px;
                height: 150px;
            }
            
            .hero-icon {
                font-size: 60px;
            }
            
            .btn-primary-custom,
            .btn-outline-custom {
                padding: 12px 16px;
                font-size: 0.9rem;
                width: 100%;
                margin-bottom: 1rem;
            }
            
            .navbar-brand {
                font-size: 1.3rem;
            }
            
            .navbar-toggler {
                padding: 4px 8px;
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
            }
            
            .cta-section {
                padding: 60px 0;
            }
            
            .stats-section {
                padding: 60px 0;
            }
            
            .features-section {
                padding: 60px 0;
            }
            
            /* Hide some floating shapes on mobile for better performance */
            .shape:nth-child(n+3) {
                display: none;
            }
        }
        
        /* Extra Small Mobile */
        @media (max-width: 375px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 0.95rem;
            }
            
            .feature-card {
                padding: 1.2rem;
            }
            
            .stat-card {
                padding: 1rem;
            }
            
            .btn-primary-custom,
            .btn-outline-custom {
                padding: 10px 14px;
                font-size: 0.85rem;
            }
            
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
        
        /* Landscape Mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .hero-section {
                padding: 40px 0 30px;
            }
            
            .hero-title {
                font-size: 2rem;
                margin-bottom: 0.5rem;
            }
            
            .hero-subtitle {
                font-size: 0.95rem;
                margin-bottom: 1.5rem;
            }
            
            .hero-icon-container {
                display: none;
            }
        }
        
        /* High DPI Displays */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .feature-icon,
            .stat-icon {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }
        
        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            
            .shape {
                animation: none !important;
            }
            
            .animated-bg::before {
                animation: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="ri-tools-line me-2"></i>TAFTA
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="ri-menu-line text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link text-white fw-500" href="{{ url('/dashboard') }}">
                                    <i class="ri-dashboard-line me-1"></i>Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white fw-500" href="{{ route('login') }}">
                                    <i class="ri-login-box-line me-1"></i>Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white fw-500" href="{{ route('register') }}">
                                        <i class="ri-user-add-line me-1"></i>Register
                                    </a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <i class="ri-star-fill"></i>
                            <span>Sistem Terintegrasi Terdepan</span>
                        </div>
                        <h1 class="hero-title">
                            Revolusi Manajemen<br>
                            <span style="background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Kalibrasi & Maintenance</span>
                        </h1>
                        <p class="hero-subtitle">
                            Platform all-in-one untuk mengelola kalibrasi, maintenance, dan instalasi alat ukur dengan teknologi terdepan dan interface yang intuitif.
                        </p>
                        <div class="hero-buttons">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">
                                        <i class="ri-dashboard-line me-2"></i>Masuk Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary-custom">
                                        <i class="ri-rocket-line me-2"></i>Mulai Sekarang
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-custom">
                                            <i class="ri-user-add-line me-2"></i>Daftar Gratis
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="hero-icon-container">
                            <div class="hero-icon-bg"></div>
                            <i class="ri-tools-line hero-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Fitur Unggulan</h2>
                <p class="section-subtitle">
                    Solusi komprehensif yang dirancang khusus untuk memudahkan manajemen alat ukur dan kalibrasi dengan teknologi terdepan
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-tools-line text-white" style="font-size: 28px;"></i>
                        </div>
                        <h4 class="feature-title">Manajemen Kalibrasi</h4>
                        <p class="feature-description">Kelola jadwal kalibrasi, data alat ukur, dan hasil kalibrasi dengan sistem yang terintegrasi dan otomatis.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-settings-3-line text-white" style="font-size: 28px;"></i>
                        </div>
                        <h4 class="feature-title">Maintenance Tracking</h4>
                        <p class="feature-description">Pantau status maintenance alat ukur dan jadwal perawatan secara real-time dengan notifikasi cerdas.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-install-line text-white" style="font-size: 28px;"></i>
                        </div>
                        <h4 class="feature-title">Instalasi Alat</h4>
                        <p class="feature-description">Dokumentasi lengkap proses instalasi dan setup alat ukur baru dengan panduan step-by-step.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-file-text-line text-white" style="font-size: 28px;"></i>
                        </div>
                        <h4 class="feature-title">Laporan Kalibrasi</h4>
                        <p class="feature-description">Generate laporan kalibrasi otomatis dengan perhitungan akurat, validasi data, dan format standar industri.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-file-list-3-line text-white" style="font-size: 28px;"></i>
                        </div>
                        <h4 class="feature-title">Laporan Maintenance</h4>
                        <p class="feature-description">Dokumentasi lengkap aktivitas maintenance dengan tracking history perbaikan dan analisis performa.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-search-line text-white" style="font-size: 28px;"></i>
                        </div>
                        <h4 class="feature-title">Pencarian Cerdas</h4>
                        <p class="feature-description">Temukan data dengan cepat menggunakan AI-powered search yang powerful dan intuitif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-tools-line"></i>
                        </div>
                        <div class="stat-number" data-count="100">0</div>
                        <div class="stat-label">Alat Terkelola</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-calendar-check-line"></i>
                        </div>
                        <div class="stat-number" data-count="500">0</div>
                        <div class="stat-label">Kalibrasi Terselesaikan</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-file-text-line"></i>
                        </div>
                        <div class="stat-number" data-count="1000">0</div>
                        <div class="stat-label">Laporan Generated</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="ri-user-line"></i>
                        </div>
                        <div class="stat-number" data-count="50">0</div>
                        <div class="stat-label">Pengguna Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="text-center">
                        <h2 class="section-title mb-4">Siap Memulai Revolusi?</h2>
                        <p class="section-subtitle mb-5">
                            Bergabunglah dengan ribuan profesional yang telah mempercayai TAFTA untuk mengelola sistem kalibrasi dan maintenance mereka.
                        </p>
                        <div class="d-flex flex-wrap gap-3 justify-content-center">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">
                                        <i class="ri-dashboard-line me-2"></i>Masuk Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary-custom">
                                        <i class="ri-rocket-line me-2"></i>Mulai Sekarang
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-custom">
                                            <i class="ri-user-add-line me-2"></i>Daftar Gratis
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                        <div class="mt-4">
                            <small class="text-white-50">
                                <i class="ri-shield-check-line me-1"></i>
                                Silahkan Daftar Gratis Untuk Coba Aplikasi
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="ri-tools-line" style="font-size: 1.5rem; background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-0 fw-bold">TAFTA</h6>
                            <small class="text-white-50">Sistem Manajemen Kalibrasi & Maintenance</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <p class="text-white-50 mb-0">
                        © {{ date('Y') }} TAFTA. Dibuat dengan <i class="ri-heart-fill text-danger"></i> untuk Indonesia
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current) + '+';
            }, 16);
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Animate feature cards
                    if (entry.target.classList.contains('feature-card')) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                    
                    // Animate stat counters
                    if (entry.target.classList.contains('stat-card')) {
                        const counter = entry.target.querySelector('.stat-number');
                        if (counter && !counter.classList.contains('animated')) {
                            counter.classList.add('animated');
                            animateCounter(counter);
                        }
                    }
                }
            });
        }, observerOptions);

        // Initialize animations when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Observe feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                observer.observe(card);
            });

            // Observe stat cards
            document.querySelectorAll('.stat-card').forEach(card => {
                observer.observe(card);
            });

            // Add hover effects to buttons
            document.querySelectorAll('.btn-primary-custom, .btn-outline-custom').forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Parallax effect for floating shapes
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const shapes = document.querySelectorAll('.shape');
                
                shapes.forEach((shape, index) => {
                    const speed = 0.5 + (index * 0.1);
                    shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
                });
            });

            // Add loading animation
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.transition = 'opacity 0.5s ease';
                document.body.style.opacity = '1';
            }, 100);
        });

        // Add click ripple effect
        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
            circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
            circle.classList.add('ripple');

            const ripple = button.getElementsByClassName('ripple')[0];
            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);
        }

        // Apply ripple effect to buttons
        document.querySelectorAll('.btn-primary-custom, .btn-outline-custom').forEach(btn => {
            btn.addEventListener('click', createRipple);
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .btn-primary-custom, .btn-outline-custom {
                position: relative;
                overflow: hidden;
            }
            
            .ripple {
                position: absolute;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
