<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BPS Kota Pasuruan')</title>
	<link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bps-blue: #1e3c72;
            --bps-blue-light: #5e82c2ff;
            --bps-orange: #FF8C00;
            --bps-orange-light: #FFB84D;
        }
        
            .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 500;
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
        
       .card-header-bps {
            background: linear-gradient(135deg, var(--bps-blue) 0%, var(--bps-blue-light) 100%);
            color: white;
            font-weight: 600;
            padding: 1rem;
            font-size: 1.05rem;
            text-align: center;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding-bottom: 1rem;
            min-height: 100px;
            max-width: 500px;
            margin: auto;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;

        }
          .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(45deg, var(--bps-blue-light) 0%, var(--bps-blue) 100%);">
    <div class="container">
       <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
    <img src="{{ asset('img/logo.png') }}" alt="Logo 1" height="40">
    <img src="{{ asset('img/kopas.png') }}" alt="Logo 2" height="50">
    <img src="{{ asset('img/uniwara.png') }}" alt="Logo 3" height="50">
		</a>

       <ul class="navbar-nav ms-auto flex-row">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('pemutakhiran.index') }}">Pemutakhiran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('pendataan.index') }}">Pendataan</a>
            </li>
        </ul>
    </div>
</nav>


    <!-- Main Content -->
    <div class="container mt-4 mb-5 px-4">
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
    @stack('scripts')
</body>
</html>