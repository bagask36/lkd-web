<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TAFTA - Sistem Manajemen Kalibrasi & Maintenance') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }
        
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .stats-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .btn-outline-custom {
            border: 2px solid white;
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: white;
            color: #667eea;
        }
        
        .navbar-custom {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#">
                <i class="ri-tools-line me-2"></i>TAFTA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/dashboard') }}">
                                    <i class="ri-dashboard-line me-1"></i>Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">
                                    <i class="ri-login-box-line me-1"></i>Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">
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
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="mb-4">
                        <span class="badge bg-white text-primary px-3 py-2 rounded-pill mb-3">
                            <i class="ri-star-fill me-1"></i>Sistem Terintegrasi
                        </span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4">
                        Kelola Kalibrasi & Maintenance
                        <span class="text-gradient">Alat Ukur</span>
                    </h1>
                    <p class="lead mb-4">
                        Sistem manajemen terintegrasi untuk mengelola kalibrasi, maintenance, dan instalasi alat ukur dengan efisien dan akurat.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-custom btn-lg">
                                    <i class="ri-dashboard-line me-2"></i>Masuk Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-custom btn-lg">
                                    <i class="ri-login-box-line me-2"></i>Mulai Sekarang
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-custom btn-lg">
                                        <i class="ri-user-add-line me-2"></i>Daftar Akun
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <div class="floating-animation">
                            <i class="ri-tools-line" style="font-size: 200px; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Fitur Unggulan</h2>
                    <p class="lead text-muted">Sistem yang dirancang khusus untuk memudahkan manajemen alat ukur dan kalibrasi</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-tools-line text-white" style="font-size: 24px;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Manajemen Kalibrasi</h4>
                        <p class="text-muted">Kelola jadwal kalibrasi, data alat ukur, dan hasil kalibrasi dengan sistem yang terintegrasi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-settings-3-line text-white" style="font-size: 24px;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Maintenance Tracking</h4>
                        <p class="text-muted">Pantau status maintenance alat ukur dan jadwal perawatan secara real-time.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-install-line text-white" style="font-size: 24px;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Instalasi Alat</h4>
                        <p class="text-muted">Dokumentasi lengkap proses instalasi dan setup alat ukur baru.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-file-text-line text-white" style="font-size: 24px;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Laporan Kalibrasi</h4>
                        <p class="text-muted">Generate laporan kalibrasi otomatis dengan perhitungan akurat dan validasi data.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-file-list-3-line text-white" style="font-size: 24px;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Laporan Maintenance</h4>
                        <p class="text-muted">Dokumentasi lengkap aktivitas maintenance dengan tracking history perbaikan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="ri-search-line text-white" style="font-size: 24px;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Pencarian Cerdas</h4>
                        <p class="text-muted">Temukan data dengan cepat menggunakan fitur pencarian yang powerful dan intuitif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <i class="ri-tools-line mb-3" style="font-size: 48px; color: rgba(255,255,255,0.8);"></i>
                        <h3 class="display-4 fw-bold mb-2">100+</h3>
                        <p class="mb-0">Alat Terkelola</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <i class="ri-calendar-check-line mb-3" style="font-size: 48px; color: rgba(255,255,255,0.8);"></i>
                        <h3 class="display-4 fw-bold mb-2">500+</h3>
                        <p class="mb-0">Kalibrasi Terselesaikan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <i class="ri-file-text-line mb-3" style="font-size: 48px; color: rgba(255,255,255,0.8);"></i>
                        <h3 class="display-4 fw-bold mb-2">1000+</h3>
                        <p class="mb-0">Laporan Generated</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <i class="ri-user-line mb-3" style="font-size: 48px; color: rgba(255,255,255,0.8);"></i>
                        <h3 class="display-4 fw-bold mb-2">50+</h3>
                        <p class="mb-0">Pengguna Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-4">Siap Memulai?</h2>
                    <p class="lead text-muted mb-4">
                        Bergabunglah dengan sistem manajemen kalibrasi dan maintenance yang terpercaya.
                    </p>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-custom btn-lg me-3">
                                <i class="ri-dashboard-line me-2"></i>Masuk Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-custom btn-lg me-3">
                                <i class="ri-login-box-line me-2"></i>Login Sekarang
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-custom btn-lg me-3">
                                    <i class="ri-user-add-line me-2"></i>Daftar Gratis
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4" style="background: #2c3e50;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-white mb-0">
                        <i class="ri-tools-line me-2"></i>
                        <strong>TAFTA</strong> - Sistem Manajemen Kalibrasi & Maintenance
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-white-50 mb-0">
                        © {{ date('Y') }} TAFTA. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>
