<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Security Center</title>
</head>

<body class="page-body">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Security</p>
                <h1>Security center</h1>
                <p>Ringkasan keamanan akun digital banking Anda.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ghost-button light">Kembali dashboard</a>
        </header>

        <section class="security-grid">
            <article class="panel security-score">
                <span>Security score</span>
                <strong>{{ $securityScore }}%</strong>
                <p>{{ $user->email_verified_at ? 'Email sudah terverifikasi.' : 'Email belum terverifikasi. Tambahkan fitur verifikasi agar score meningkat.' }}</p>
            </article>

            <article class="panel security-list">
                <h2>Account checks</h2>
                <div class="check-row">
                    <span>Email login</span>
                    <strong>{{ $user->email }}</strong>
                </div>
                <div class="check-row">
                    <span>No kartu</span>
                    <strong>{{ $user->no_card ?? '-' }}</strong>
                </div>
                <div class="check-row">
                    <span>Password</span>
                    <strong>Terenkripsi oleh Laravel Hash</strong>
                </div>
            </article>
        </section>
    </main>
</body>

</html>
