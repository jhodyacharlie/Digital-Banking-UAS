<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Notifications</title>
</head>

<body class="page-body">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Notifications</p>
                <h1>Daftar notifikasi</h1>
                <p>Informasi terbaru yang terhubung dengan akun login Anda.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ghost-button light">Kembali dashboard</a>
        </header>

        <section class="panel history-panel">
            @forelse($notifications as $notification)
                <div class="history-row">
                    <div>
                        <strong>{{ $notification->title }}</strong>
                        <p>{{ $notification->message }}</p>
                    </div>
                    <span class="status-pill status-{{ $notification->status }}">{{ ucfirst($notification->status) }}</span>
                </div>
            @empty
                <div class="empty-state">
                    Belum ada notifikasi untuk akun ini.
                </div>
            @endforelse
        </section>
    </main>
</body>

</html>
