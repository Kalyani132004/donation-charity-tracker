<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — KindTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
</head>
<body>
    <div class="app-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <span class="brand-mark">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 22c-3.5-2.3-7-5-7-8.8 0-2.3 1.8-4 4-4 1.4 0 2.6.7 3 1.8.4-1.1 1.6-1.8 3-1.8 2.2 0 4 1.7 4 4 0 3.8-3.5 6.5-7 8.8z" fill="currentColor"/>
                        <path d="M18 34c-8 0-12-6-12-13 4 3 8 5 12 6.5z" fill="#C99A4A"/>
                        <path d="M22 34c8 0 12-6 12-13-4 3-8 5-12 6.5z" fill="#C99A4A"/>
                    </svg>
                </span>
                <span class="brand-word">KindTrack</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('donors.index') }}" class="nav-link {{ request()->routeIs('donors.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Donors
                </a>
                <a href="{{ route('donations.index') }}" class="nav-link {{ request()->routeIs('donations.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin"></i> Donations
                </a>
                <a href="{{ route('causes.index') }}" class="nav-link {{ request()->routeIs('causes.*') ? 'active' : '' }}">
                    <i class="bi bi-flag"></i> Causes
                </a>
                <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i> Reports
                </a>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i> Staff Users
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="main-content">
            <header class="topbar">
                <button class="btn btn-sm btn-outline-secondary d-lg-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                <button class="btn btn-sm btn-outline-secondary me-2" id="darkModeToggle" title="Toggle dark mode">
                    <i class="bi bi-moon-stars" id="darkModeIcon"></i>
                </button>
                <div class="topbar-user dropdown">
                    <a href="#" class="dropdown-toggle text-decoration-none text-dark d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        @if (auth()->user()->photoUrl())
                            <img src="{{ auth()->user()->photoUrl() }}" alt="{{ auth()->user()->name }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                        @else
                            <i class="bi bi-person-circle fs-4"></i>
                        @endif
                        <span class="d-none d-sm-inline">
                            {{ auth()->user()->name }}
                            <small class="text-muted d-block text-capitalize">{{ auth()->user()->role }}</small>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </header>

            <main class="page-content">
                <x-alert type="success" :message="session('success')" />
                <x-alert type="danger" :message="session('error')" />
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Dark mode
        const darkToggle = document.getElementById('darkModeToggle');
        const darkIcon = document.getElementById('darkModeIcon');

        function applyTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            darkIcon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
        }

        applyTheme(localStorage.getItem('theme') || 'light');

        darkToggle?.addEventListener('click', function () {
            const current = document.documentElement.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            applyTheme(next);
        });
    </script>
    @stack('scripts')
</body>
</html>
