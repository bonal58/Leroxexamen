<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lerox Motoren') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Lerox Motoren') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('messages.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('scooters.index') }}">{{ __('messages.scooters') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('parts.index') }}">{{ __('messages.parts') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.index') }}">{{ __('messages.services') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">{{ __('messages.contact') }}</a>
                        </li>
                    </ul>
                    
                    <!-- Taalwisselaar -->
                    <div class="btn-group me-3">
                        <a href="{{ route('language.switch', 'nl') }}" class="btn btn-sm btn-outline-dark {{ app()->getLocale() == 'nl' ? 'active' : '' }}">NL</a>
                        <a href="{{ route('language.switch', 'en') }}" class="btn btn-sm btn-outline-dark {{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                    </div>
                    
                    <!-- Authenticatie Links -->
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">{{ __('messages.logout') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container py-4">
            @yield('content')
        </main>
        
        <footer class="bg-dark text-light py-4 mt-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h5 class="mb-3">{{ config('app.name', 'Lerox Motoren') }}</h5>
                        <p class="mb-0">{{ __('messages.scooter_specialist') }}</p>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h5 class="mb-3">{{ __('messages.contact') }}</h5>
                        <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i> {{ __('messages.street_address') }}, {{ __('messages.city') }}</p>
                        <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i> {{ __('messages.phone_number') }}</p>
                        <p class="mb-0"><i class="bi bi-envelope-fill me-2"></i> {{ __('messages.email_address') }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-3">{{ __('messages.quick_links') }}</h5>
                        <ul class="list-unstyled">
                            <li class="mb-1"><a href="{{ route('home') }}" class="text-light">{{ __('messages.home') }}</a></li>
                            <li class="mb-1"><a href="{{ route('scooters.index') }}" class="text-light">{{ __('messages.scooters') }}</a></li>
                            <li class="mb-1"><a href="{{ route('parts.index') }}" class="text-light">{{ __('messages.parts') }}</a></li>
                            <li class="mb-0"><a href="{{ route('contact') }}" class="text-light">{{ __('messages.contact') }}</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-3 bg-light">
                <div class="text-center">
                    <p class="mb-0">© {{ date('Y') }} {{ config('app.name', 'Lerox Motoren') }} - {{ __('messages.all_rights_reserved') }}</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Page-specifieke scripts -->
    @yield('scripts')
</body>
</html>
