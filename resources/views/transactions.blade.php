<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Transaction History</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">History</p>
                <h1>Transaction history</h1>
                <p>Semua riwayat pembayaran yang tersimpan untuk akun login saat ini.</p>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('payment.index') }}" class="ghost-button light">Transfer baru</a>
                <a href="{{ route('dashboard') }}" class="ghost-button light">Dashboard</a>
            </div>
        </header>

        <section class="panel history-panel">
            @forelse($payments as $payment)
                @php
                    $statusClass = \Illuminate\Support\Str::slug($payment->status ?? 'pending');
                @endphp
                <div class="history-row">
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
                    Belum ada transaksi. Buat transfer baru untuk mengisi history.
                </div>
            @endforelse
        </section>
    </main>
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
