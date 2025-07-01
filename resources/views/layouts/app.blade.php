<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel POS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f7fc;
        }

        .navbar {
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
        }

        .navbar-brand, .nav-link, .dropdown-toggle {
            color: white !important;
            font-weight: 600;
        }

        .nav-link:hover, .dropdown-menu a:hover {
            color: #ffc107 !important;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        main {
            padding: 2rem 1rem;
            min-height: 85vh;
        }

        footer {
            background-color: #4e54c8;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f4f7fc;
    }

    .navbar {
        background: linear-gradient(45deg, #4e54c8, #8f94fb);
    }

    .navbar-brand, .nav-link, .dropdown-toggle {
        color: white !important;
        font-weight: 600;
    }

    .nav-link:hover, .dropdown-menu a:hover {
        color: #ffc107 !important;
    }

    .dropdown-menu {
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0,0,0,0.1);
    }

    main {
        padding: 2rem 1rem;
        min-height: 85vh;
    }

    footer {
        background-color: #4e54c8;
        color: white;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }

    .dashboard-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        background: white;
        padding: 2rem;
    }

    .dashboard-header {
        font-size: 1.5rem;
        font-weight: bold;
        color: #4e54c8;
    }

    .custom-nav .btn {
        border-radius: 12px;
        margin-right: 10px;
        font-weight: 600;
        padding: 8px 16px;
        transition: all 0.3s ease-in-out;
    }

    .custom-nav .btn:hover {
        background-color: #4e54c8;
        color: white;
    }


    </style>
</head>
<body>
    <div id="app">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel POS') }}
                </a>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto">
                        {{-- Tempat menu tambahan jika perlu --}}
                    </ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer>
            &copy; {{ date('Y') }} Laravel POS App — Developed by Rasvyy
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
