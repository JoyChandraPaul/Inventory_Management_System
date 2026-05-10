<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="/images/logo.png">

        <title>Shopno</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            :root { --sidebar-width: 260px; }
            body { background: #f5f6fa; }
            .admin-shell { min-height: 100vh; display: grid; grid-template-columns: var(--sidebar-width) 1fr; }
            .admin-sidebar { background: #111827; color: #e5e7eb; }
            .admin-sidebar a { color: inherit; text-decoration: none; }
            .admin-sidebar .nav-link { color: #cbd5e1; border-radius: .5rem; padding: .55rem .75rem; }
            .admin-sidebar .nav-link.active, .admin-sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,.08); }
            .admin-topbar { background: #fff; border-bottom: 1px solid rgba(0,0,0,.06); }
            @media (max-width: 991.98px) {
                .admin-shell { grid-template-columns: 1fr; }
                .admin-sidebar { display: none; }
            }
            @media print {
                body { background: #fff !important; }
                .admin-shell { display: block !important; }
                .admin-sidebar, .admin-topbar, .no-print { display: none !important; }
                main.container-fluid { padding: 0 !important; }
                .card { box-shadow: none !important; border: 0 !important; }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <div class="admin-shell">
            <aside class="admin-sidebar p-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="fw-semibold">Shopno</div>
                </div>

                <div class="small text-uppercase text-secondary-emphasis mb-2" style="color: rgba(255,255,255,.6) !important;">
                    Menu
                </div>
                <nav class="nav flex-column gap-1">
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                    <a class="nav-link @if(request()->routeIs('categories.*')) active @endif" href="{{ route('categories.index') }}">Categories</a>
                    <a class="nav-link @if(request()->routeIs('products.*')) active @endif" href="{{ route('products.index') }}">Products</a>
                    <a class="nav-link @if(request()->routeIs('customers.*')) active @endif" href="{{ route('customers.index') }}">Customers</a>
                    <a class="nav-link @if(request()->routeIs('sales.*')) active @endif" href="{{ route('sales.index') }}">Sales</a>
                </nav>
            </aside>

            <div class="d-flex flex-column">
                <header class="admin-topbar">
                    <div class="container-fluid py-2 px-3 d-flex align-items-center justify-content-between">
                        <div class="fw-semibold">
                            @yield('page_title', 'Dashboard')
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>

                <main class="container-fluid p-3">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>
