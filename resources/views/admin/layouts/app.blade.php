<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Mind Trainer</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">
    <header class="admin-header">
        <div class="admin-header-left">
            <button
                class="admin-menu-toggle"
                type="button"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="admin-sidebar"
                data-admin-menu-toggle
            >
                <span></span><span></span><span></span>
            </button>
            <a class="admin-brand" href="{{ route('admin.dashboard') }}"><span>M</span> <em>Mind Trainer Admin</em></a>
        </div>
        <div class="admin-header-actions">
            <a class="admin-action-btn" href="{{ route('home') }}" target="_blank">View site</a>
            <a class="admin-action-btn" href="{{ route('admin.profile.edit') }}">Change login</a>
            <form class="admin-inline-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="admin-action-btn" type="submit">Logout</button>
            </form>
        </div>
    </header>

    <div class="admin-shell">
        <div class="admin-sidebar-backdrop" data-admin-menu-backdrop hidden></div>
        @include('admin.partials.sidebar')
        <main class="admin-main">
            @if (session('success'))
                <div class="admin-alert">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
    <script>
        (() => {
            const toggle = document.querySelector('[data-admin-menu-toggle]');
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.querySelector('[data-admin-menu-backdrop]');
            if (!toggle || !sidebar) return;

            const setOpen = (open) => {
                document.body.classList.toggle('admin-nav-open', open);
                toggle.setAttribute('aria-expanded', String(open));
                toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
                if (backdrop) backdrop.hidden = !open;
            };

            toggle.addEventListener('click', () => setOpen(!document.body.classList.contains('admin-nav-open')));
            backdrop?.addEventListener('click', () => setOpen(false));
            sidebar.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setOpen(false)));
            window.addEventListener('resize', () => {
                if (window.matchMedia('(min-width: 901px)').matches) setOpen(false);
            });
        })();
    </script>
</body>
</html>
