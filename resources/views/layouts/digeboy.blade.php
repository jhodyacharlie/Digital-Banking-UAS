<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Digeboy Digital Banking')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Digital Banking Dashboard</p>
                <h1>@yield('heading')</h1>
                <p>@yield('subtitle')</p>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('dashboard') }}" class="ghost-button light">Dashboard</a>
                <a href="{{ route('payment.index') }}" class="ghost-button light">Transfer</a>
                <a href="{{ route('settings.index') }}" class="ghost-button light">Settings</a>
            </div>
        </header>

        @yield('content')
    </main>

    <!-- SKRIP ANTI-INSPECT START -->
    <script>
        // 1. Blokir Klik Kanan
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // 2. Blokir Shortcut Keyboard Inspect (F12, Ctrl+Shift+I, dll)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12') e.preventDefault();
            if (e.ctrlKey && e.shiftKey && e.key === 'I') e.preventDefault();
            if (e.ctrlKey && e.shiftKey && e.key === 'J') e.preventDefault();
            if (e.ctrlKey && e.key === 'u') e.preventDefault();
            if (e.ctrlKey && e.shiftKey && e.key === 'C') e.preventDefault();
        });

        // 3. Trik Hancurkan Layar Jika Inspect Dibuka Paksa
        setInterval(function() {
            const startTime = performance.now();
            debugger; 
            const endTime = performance.now();
            if (endTime - startTime > 100) {
                document.body.innerHTML = "<h1 style='text-align:center;margin-top:20%;font-family:sans-serif;'>Akses Ditolak! Tolong tutup Inspect Element Anda.</h1>";
            }
        }, 1000);
    </script>
    <!-- SKRIP ANTI-INSPECT END -->
</body>

</html>
