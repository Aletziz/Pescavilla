<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Gestión')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="vh-100 p-0">
    <!-- Mobile Menu Toggle Button -->
    <button class="btn btn-primary mobile-menu-toggle d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid bg-light min-vh-100">
        <div class="row min-vh-100 p-0">
            <!-- SIDEBAR DESKTOP -->
            <aside class="col-md-3 d-none d-md-flex flex-column p-0 position-sticky top-0 vh-100 overflow-auto">
                <div class="logo-container d-flex justify-content-center">
                    <img src="{{ asset('logo-lg.png') }}" alt="Logo" width="180" height="54" />
                </div>
                <nav class="nav nav-pills d-flex flex-column gap-1">
                    <span class="nav-title">Gestión</span>
                    <a href="{{ url('/ueb') }}" class="nav-link d-flex align-items-center side-nav-link {{ request()->is('ueb*') ? 'active' : '' }}" id="link-ueb">
                        <span>UEB</span>
                    </a>
                    <a href="{{ url('/embalse') }}" class="nav-link d-flex align-items-center side-nav-link {{ request()->is('embalse*') ? 'active' : '' }}" id="link-embalse">
                        <span>Embalse</span>
                    </a>
                    <a href="{{ url('/especie') }}" class="nav-link d-flex align-items-center side-nav-link {{ request()->is('especie*') ? 'active' : '' }}" id="link-especie">
                        <span>Especie</span>
                    </a>
                </nav>
            </aside>

            <!-- SIDEBAR MOBILE (Offcanvas) -->
            <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
                <div class="offcanvas-header">
                    <div class="logo-container d-flex justify-content-center w-100">
                        <img src="{{ asset('logo-lg.png') }}" alt="Logo" width="160" height="48" />
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <nav class="nav nav-pills d-flex flex-column gap-1 p-3">
                        <span class="nav-title">Gestión</span>
                        <a href="{{ url('/ueb') }}" class="nav-link d-flex align-items-center side-nav-link {{ request()->is('ueb*') ? 'active' : '' }}" data-bs-dismiss="offcanvas">
                            <span>UEB</span>
                        </a>
                        <a href="{{ url('/embalse') }}" class="nav-link d-flex align-items-center side-nav-link {{ request()->is('embalse*') ? 'active' : '' }}" data-bs-dismiss="offcanvas">
                            <span>Embalse</span>
                        </a>
                        <a href="{{ url('/especie') }}" class="nav-link d-flex align-items-center side-nav-link {{ request()->is('especie*') ? 'active' : '' }}" data-bs-dismiss="offcanvas">
                            <span>Especie</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- CONTENIDO PRINCIPAL -->
            <div class="col-12 col-md-9 p-0" id="main">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
