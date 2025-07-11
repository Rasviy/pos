<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel POS') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vite Assets -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f7fc;
        }

        .navbar {
            background: linear-gradient(45deg, #909096, #37395b);
        }

        .navbar-brand,
        .nav-link,
        .dropdown-toggle {
            color: white !important;
            font-weight: bold;
        }

        .nav-link:hover,
        .dropdown-menu a:hover {
            color: #ffc107 !important;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .btn-outline-primary:hover {
            background-color: #4f5170;
            color: white !important;
        }

        main {
            padding: 2rem 1rem;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left -->
                <ul class="navbar-nav me-auto"></ul>

                <!-- Right -->
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

    <main>
        <div class="container mb-4">
            <div class="row">
                <div class="col-12 d-flex flex-wrap">
                    <a href="{{ route('home') }}" wire:navigate
                       class="btn {{ request()->routeIs('home') ? 'btn-primary' : 'btn-outline-primary' }}">
                        Beranda
                    </a>

                    @if(Auth::user()->peran == 'admin')
                        <a href="{{ route('user') }}" wire:navigate
                           class="btn {{ request()->routeIs('user') ? 'btn-primary' : 'btn-outline-primary' }}">
                            Pengguna
                        </a>
                        <a href="{{ route('produk') }}" wire:navigate
                           class="btn {{ request()->routeIs('produk') ? 'btn-primary' : 'btn-outline-primary' }}">
                            Produk
                        </a>
                    @endif

                    <a href="{{ route('transaksi') }}" wire:navigate
                       class="btn {{ request()->routeIs('transaksi') ? 'btn-primary' : 'btn-outline-primary' }}">
                        Transaksi
                    </a>
                    <a href="{{ route('laporan') }}" wire:navigate
                       class="btn {{ request()->routeIs('laporan') ? 'btn-primary' : 'btn-outline-primary' }}">
                        Laporan
                    </a>
                </div>
            </div>
        </div>

        {{ $slot }}
    </main>
</div>
</body>
</html>
