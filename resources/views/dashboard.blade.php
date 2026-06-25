@php
    $logoPath = asset('images/bank-logo.jpeg');
    $accountNumber = $user->no_card ?? $user->email;
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Dashboard Digital Banking</title>
</head>

<body class="theme-{{ session('theme', 'light') }}">
    <div class="app-shell">
        <aside class="sidebar">
            <div class="brand">
                <img src="{{ $logoPath }}" alt="Logo Digital Banking" class="brand-mark">
                <div>
                    <p>Digital Banking UAS</p>
                    <strong>Member Area</strong>
                </div>
            </div>

            <nav class="nav-menu" aria-label="Menu dashboard">
                <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('payment.index') }}">Transfer</a>
                <a class="nav-link" href="{{ route('transactions.index') }}">Transaction History</a>
                <a class="nav-link" href="{{ route('status.index') }}">Status Transaksi</a>
                <a class="nav-link" href="{{ route('notifications.index') }}">Notifications</a>
                <a class="nav-link" href="{{ route('settings.index') }}">Settings</a>
                <a class="nav-link" href="{{ route('balances.index') }}">Balance</a>
                <a class="nav-link" href="{{ route('accounts.index') }}">Account</a>
                <a class="nav-link" href="{{ route('security.index') }}">Security</a>
            </nav>

            <div class="sidebar-card">
                <span>Security score</span>
                <strong>{{ $securityScore }}%</strong>
                <p>{{ $user->email_verified_at ? 'Akun sudah terverifikasi.' : 'OTP aktif untuk menjaga login tetap aman.' }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">Keluar</button>
            </form>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div>
                    <p class="eyebrow">Selamat datang kembali</p>
                    <h1>{{ $user->name }}</h1>
                </div>
                <div class="topbar-actions">
                    <a href="{{ route('settings.index') }}" class="ghost-button">Tema {{ session('theme', 'light') === 'dark' ? 'Gelap' : 'Terang' }}</a>
                    <a href="{{ route('security.index') }}" class="ghost-button">Security</a>
                    <div class="account-chip">{{ $accountNumber }}</div>
                </div>
            </header>

            @if (session('success'))
                <div class="notice success">{{ session('success') }}</div>
            @endif

            <section class="hero-grid">
                <article class="balance-panel">
                    <div>
                        <p>Saldo tersedia</p>
                        <strong>Rp {{ number_format($availableBalance, 0, ',', '.') }}</strong>
                    </div>
                    <div class="balance-meta">
                        <span>Pengeluaran bulan ini: Rp {{ number_format($monthlyPayments, 0, ',', '.') }}</span>
                        <span>Total transaksi: {{ $paymentCount }}</span>
                        <span>Status akun: Aktif</span>
                    </div>
                </article>

                <div class="action-stack" aria-label="Akses cepat utama">
                    <a href="{{ route('payment.index') }}" class="action-card">
                        <strong>Transfer Baru</strong>
                        <span>Buat payment dan kirim dana</span>
                    </a>
                    <a href="{{ route('transactions.index') }}" class="action-card">
                        <strong>Transaction History</strong>
                        <span>Lihat semua histori pembayaran</span>
                    </a>
                    <a href="{{ route('notifications.index') }}" class="action-card">
                        <strong>Notifications</strong>
                        <span>Payment success dan login terbaru</span>
                    </a>
                </div>
            </section>

            <section class="stats-grid">
                <article class="stat-card">
                    <span>Status transaksi</span>
                    <strong>Rp {{ number_format($pendingPayments, 0, ',', '.') }}</strong>
                </article>
                <article class="stat-card">
                    <span>Notifikasi belum dibaca</span>
                    <strong>{{ $unreadNotifications }}</strong>
                </article>
                <article class="stat-card">
                    <span>Payment</span>
                    <strong>{{ $paymentCount }}</strong>
                </article>
                <article class="stat-card">
                    <span>Security score</span>
                    <strong>{{ $securityScore }}%</strong>
                </article>
            </section>

            <section class="content-grid">
                <article class="panel transaction-panel">
                    <div class="panel-header">
                        <div>
                            <p class="eyebrow">Aktivitas terbaru</p>
                            <h2>Transaksi Terbaru</h2>
                        </div>
                        <a href="{{ route('transactions.index') }}">Lihat semua</a>
                    </div>

                    @forelse ($payments as $payment)
                        @php
                            $statusClass = \Illuminate\Support\Str::slug($payment->status ?? 'pending');
                        @endphp
                        <div class="transaction-row">
                            <div class="transaction-main">
                                <span class="transaction-dot"></span>
                                <div>
                                    <strong>Transfer Digital Banking</strong>
                                    <p>{{ $payment->created_at?->format('d M Y, H:i') ?? '-' }} - Ref #{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                            <div class="transaction-amount">
                                <strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong>
                                <span class="status-pill status-{{ $statusClass }}">{{ $payment->status }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            Belum ada transaksi. Mulai transaksi pertama dari menu Transfer.
                        </div>
                    @endforelse
                </article>

                <aside class="panel insight-panel">
                    <div class="panel-header">
                        <div>
                            <p class="eyebrow">Pusat info</p>
                            <h2>Notifications</h2>
                        </div>
                        <a href="{{ route('notifications.index') }}">Buka</a>
                    </div>

                    <div class="notification-list">
                        @forelse ($recentNotifications as $notification)
                            <div class="notification-item">
                                <strong>{{ $notification->title }}</strong>
                                <p>{{ $notification->message }}</p>
                                <span>{{ ucfirst($notification->status) }}</span>
                            </div>
                        @empty
                            <div class="empty-state">
                                Belum ada notifikasi baru.
                            </div>
                        @endforelse
                    </div>

                    <div class="security-summary">
                        <span>Security check</span>
                        <strong>{{ $securityScore }}%</strong>
                        <a href="{{ route('security.index') }}">Kelola keamanan</a>
                    </div>
                </aside>
            </section>
        </main>
    </div>
    <script>
    document.addEventListener('contextmenu', function(e) { e.preventDefault(); });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'F12') e.preventDefault();
        if (e.ctrlKey && e.shiftKey && e.key === 'I') e.preventDefault();
        if (e.ctrlKey && e.shiftKey && e.key === 'J') e.preventDefault();
        if (e.ctrlKey && e.key === 'u') e.preventDefault();
        if (e.ctrlKey && e.shiftKey && e.key === 'C') e.preventDefault();
    });
    setInterval(function() {
        const startTime = performance.now();
        debugger; 
        const endTime = performance.now();
        if (endTime - startTime > 100) {
            document.body.innerHTML = "<h1 style='text-align:center;margin-top:20%;font-family:sans-serif;'>Akses Ditolak! Tolong tutup Inspect Element Anda.</h1>";
        }
    }, 1000);
</script>

</body>

</html>
