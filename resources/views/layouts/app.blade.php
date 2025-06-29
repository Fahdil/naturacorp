<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token --> 
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NaturaCorp') }}</title>

    <!-- Module 3D -->
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .navbar {
            background: linear-gradient(135deg, rgb(87, 109, 90), #1e293b);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #38bdf8;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #0ea5e9;
        }

        .nav-link {
            font-size: 1.2rem;
            font-weight: 500;
            color: white;
            padding: 0.5rem 15px;
            margin: 0 0.5rem;
            border-radius: 6px;
        }

        .nav-link:hover {
            background: #1e293b;
            color: #38bdf8;
        }

        .dropdown-menu {
            background: #1e293b;
            border: none;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        .dropdown-item {
            padding: 10px 15px;
            font-size: 0.95rem;
            color: #94a3b8;
        }

        .dropdown-item:hover {
            background: #0f172a;
            color: #38bdf8;
        }

        .main-content {
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            margin-bottom:2rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'NaturaCorp') }}
                </a>
                 <!-- Bouton Admin CRM -->
                <a href="{{ route('login') }}" >
                   <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAXCAYAAADgKtSgAAAAAXNSR0IArs4c6QAAAKZJREFUSEvtk9ENgCAMRI9NdBM3USdRJ9FNHEVHkUsg4QMoTSDxg/6WvN5di0HDMg3Z6PBour+LZQDwlhyCVvlpwQuAFcAlDdDCNwvcHVQcoIWTWzwgB5+sdeYbqxkA+6ykgxSc0EfK1PW53DH2Nqec9lPKQ1fcwaGFp4QTfLsmL4axVPlExWBO014LFXNAVrG3oYVzBx4u7lsLF4Hhgw6vcor/yfwDR9QUGO5fLHgAAAAASUVORK5CYII=" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('home'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
                            @endif
                            @if (Route::has('produit.index'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('produit.index') }}">Produit</a></li>
                            @endif
                            @if (Route::has('propos.index'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('propos.index') }}">À propos</a></li>
                            @endif
                            @if (Route::has('contact.index'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Contact</a></li>
                            @endif
                        @else
                            @php $role = Auth::user()->role; @endphp
                            @if ($role === 'admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                            @elseif ($role === 'commercial')
                                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.commercial') }}">Dashboard</a></li>
                            @elseif ($role === 'owner')
                                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.owner') }}">Dashboard</a></li>
                            @endif

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Déconnexion</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>

        @include('include.footer')
        @stack('scripts')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownToggle = document.querySelector('#navbarDropdown');
            const mainNavLinks = document.querySelectorAll('.navbar-nav > .nav-item:not(.dropdown)');

            dropdownToggle?.addEventListener('click', function () {
                const dropdownMenu = document.querySelector('.dropdown-menu');
                if (dropdownMenu?.classList.contains('show')) {
                    mainNavLinks.forEach(link => link.classList.remove('d-none'));
                } else {
                    mainNavLinks.forEach(link => link.classList.add('d-none'));
                }
            });

            document.addEventListener('click', function (event) {
                if (!dropdownToggle?.contains(event.target) &&
                    !document.querySelector('.dropdown-menu')?.contains(event.target)) {
                    mainNavLinks.forEach(link => link.classList.remove('d-none'));
                }
            });
        });
    </script>
</body>
</html>
