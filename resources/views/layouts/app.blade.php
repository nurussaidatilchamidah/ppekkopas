<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Badan Pusat Statistik Kota Pasuruan')</title>
	<link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --bps-blue: #1e3c72;
            --bps-blue-light: #5e82c2;
            --bps-orange: #FF8C00;
            --bps-orange-light: #FFB84D;
        }
        
        .navbar-nav {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 500;
        }
            
        .nav-link {
            padding: 1rem 1rem;
            font-size: 1.1rem;
            font-weight: 500;
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-link a {
            text-decoration: none;
            color: #e3e7ebff;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link a:hover {
            color: #f5f2efff;
        }

        .nav-link a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: #ebeceeff;
            transition: width 0.3s ease;
        }

        .nav-link a:hover::after {
            width: 100%;
        }

        .btn-bps-primary {
            background: linear-gradient(135deg, var(--bps-blue) 0%, var(--bps-blue-light) 100%);
            border: none;
            color: white;
        }

        .btn-bps-primary:hover {
            filter: brightness(2.0);
        }

        .btn-bps-warning:hover {
            filter: brightness(1.5);
        }

        .btn-bps-warning {
            background: linear-gradient(135deg, var(--bps-orange) 0%, var(--bps-orange-light) 100%);
            border: none;
            color: white;
        }
        

          
                 @media (max-width: 768px) {
            .navbar-brand span {
              font-size: 1.0rem !important; /* Ukuran teks lebih kecil */
              line-height: 1.1;
            }

            .navbar-brand img {
              height: 35px !important; /* Logo lebih kecil */
            }

            .navbar-brand {
              gap: 0.5rem !important;
            }
          }
            
        .offcanvas-header .btn-close {
            z-index: 1060 !important; /* pastikan di atas */
            position: relative;
        }

body {
  padding-top: 70px; /* supaya konten tidak ketiban navbar */
}

.app-background {
    position: relative;
    margin: 0;
    min-height: 100vh;
    width: 100%;
     background: linear-gradient(
    to bottom,
    rgba(111, 150, 255, 0.5),  /* biru pudar transparan */
    rgba(255, 255, 255, 0.5),  /* putih transparan */
    rgba(255, 165, 0, 0.5)     /* oranye transparan */
  );
    background-attachment: fixed;
    background-size: cover;
    overflow: hidden; /* supaya blur nggak keluar area */
}

.app-background::before {
  content: "";
  position: fixed;
  inset: 0;
  z-index: -1; /* pastikan di belakang konten */
  pointer-events: none;
   background: inherit;
}






</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">    
        
    </style>
</head>
<body>
  <!-- Bootstrap 5 Offcanvas Navbar -->
<div class="app-background">  
<nav class="navbar navbar-expand-lg navbar-dark fixed-top"  style="background: linear-gradient(to left, #ff7b00, #ffae42);">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo + Teks + Logo lainnya -->
        <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center gap-3 text-decoration-none">
            <img src="{{ asset('img/logo.png') }}" alt="Logo BPS" height="40">

            <!-- Teks tetap tampil di semua ukuran -->
            <div class="d-block" style="line-height: 1;">
                <span style="font-family: Arial, sans-serif; font-style: italic; font-weight: bold; color: white; font-size: 1.3rem;">
                    BADAN PUSAT STATISTIK<br>KOTA PASURUAN
                </span>
            </div>

            <img src="{{ asset('img/kopas.png') }}" alt="Logo Kopas" height="50">
            <img src="{{ asset('img/uniwara.png') }}" alt="Logo Uniwara" height="50">
        </a>

        <!-- Toggle Sidebar -->
        <button class="btn btn-outline-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Normal menu di layar besar -->
        <div class="d-none d-lg-flex gap-3 nav-link">
            <a class="text-white fw-semibold me-4" href="{{ route('pemutakhiran.rekap') }}">Rekapitulasi</a>
            <a class="text-white fw-semibold me-4" href="{{ route('pemutakhiran.index') }}">Pemutakhiran</a>
            <a class="text-white fw-semibold" href="{{ route('pendataan.index') }}">Pendataan</a>
        </div>
    </div>
</nav>

<!-- Offcanvas Sidebar Menu (Mobile) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" style="font-size: 0.95rem;">Aplikasi Pendataan Potensi Ekonomi Kelurahan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link fw-semibold" style="font-size: 1.05rem;" href="{{ route('pemutakhiran.rekap') }}">Rekapitulasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold" style="font-size: 1.05rem;" href="{{ route('pemutakhiran.index') }}">Pemutakhiran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold" style="font-size: 1.05rem;" href="{{ route('pendataan.index') }}">Pendataan</a>
            </li>
        </ul>
    </div>
</div>

    <!-- Main Content -->
    
        <div class=" container mt-4 mb-5 px-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
        </div>
</div>

    <!-- Scripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
    @stack('scripts')
</body>
</html>