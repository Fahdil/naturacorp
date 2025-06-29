<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token --> 
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TechStore') }}</title>

     <!-- affichage du module 3d -->
     <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">




    <style>

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, rgb(87, 109, 90),  #1e293b);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #38bdf8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #0ea5e9;
        }

        .nav-link {
            font-size: 1.2rem;
            font-weight: 500;
            color:rgb(255, 255, 255);
            text-decoration: none;
            padding: 0.5rem 15px;
            border-radius: 6px;
            margin: 0 0.5rem;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background: #1e293b;
            color: #38bdf8;
        }

        /* Dropdown styles */
        .dropdown-menu {
            background: #1e293b;
            border: none;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
            width:100%;
        }

        .dropdown-item {
            padding: 10px 15px;
            font-size: 0.95rem;
            color: #94a3b8;
            text-decoration: none;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .dropdown-item:hover {
            background: #0f172a;
            color: #38bdf8;
        }

        /* Main content */
        .main-content {
            width: 100%;
            height: 100%; /* S'assurer que la hauteur du corps occupe toute la page */
            display: flex;
            flex-direction: column; /* Disposer les éléments en colonne */
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @guest
                           
                        @else


                       
                            <!-- Vérifier si l'utilisateur est admin -->
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif

                            <!-- Vérifier si l'utilisateur est admin -->
                        @if(Auth::user()->role === 'commercial')
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif

                            <!-- Vérifier si l'utilisateur est admin -->
                        @if(Auth::user()->role === 'owner')
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif


                                    <li>
                                       
                                        <form  class="dropdown-item" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                                            @csrf 
                                        </form> 
 
                                        <!-- Lien de déconnexion qui soumet le formulaire --> 
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">Déconnexion</a>
                               
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

    </div>






    @include('include.footer')

</body>
</html>




