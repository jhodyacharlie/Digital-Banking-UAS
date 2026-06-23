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
</body>

</html>
