<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Settings</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Settings</p>
                <h1>Pengaturan tampilan</h1>
                <p>Ubah warna aplikasi dari terang ke gelap atau sebaliknya.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ghost-button light">Kembali dashboard</a>
        </header>

        @if (session('success'))
            <div class="notice success">{{ session('success') }}</div>
        @endif

        <section class="security-grid">
            <form class="panel form-panel" action="{{ route('settings.theme') }}" method="POST">
                @csrf

                <div>
                    <p class="eyebrow">Theme</p>
                    <h2>Mode warna</h2>
                </div>

                <div class="theme-options">
                    <label class="theme-card">
                        <input type="radio" name="theme" value="light" {{ $theme === 'light' ? 'checked' : '' }}>
                        <strong>Terang</strong>
                        <span>Dongker dan putih yang bersih.</span>
                    </label>
                    <label class="theme-card">
                        <input type="radio" name="theme" value="dark" {{ $theme === 'dark' ? 'checked' : '' }}>
                        <strong>Gelap</strong>
                        <span>Dongker pekat untuk tampilan malam.</span>
                    </label>
                </div>

                <button class="primary-action" type="submit">Simpan tema</button>
            </form>

            <aside class="panel help-panel">
                <p class="eyebrow">Account settings</p>
                <h2>Status preferensi</h2>
                <p>Tema aktif sekarang: <strong>{{ $theme === 'dark' ? 'Gelap' : 'Terang' }}</strong></p>

                <div class="settings-grid">
                    @forelse($settings as $setting)
                        <div class="mini-card">
                            <strong>{{ $setting->key }}</strong>
                            <p>{{ $setting->value }}</p>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada preferensi tersimpan.</div>
                    @endforelse
                </div>
            </aside>
        </section>
    </main>
</body>

</html>
