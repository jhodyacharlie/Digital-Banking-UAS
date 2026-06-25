<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Transfer & Payment</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Transfer</p>
                <h1>Buat transfer baru</h1>
                <p>Kirim dana, buat payment, dan pantau status transaksi dari dashboard yang sama.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ghost-button light">Kembali dashboard</a>
        </header>

        <section class="form-grid">
            <form class="panel form-panel" action="{{ route('payment.store') }}" method="POST">
                @csrf

                <div>
                    <p class="eyebrow">Payment</p>
                    <h2>Detail transfer</h2>
                </div>

                <label for="receiver">
                    Nama penerima
                    <input id="receiver" type="text" name="receiver" value="{{ old('receiver') }}" placeholder="Contoh: Raka Pratama" required>
                </label>
                @error('receiver')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <label for="amount">
                    Nominal
                    <input id="amount" type="number" name="amount" min="1000" step="1000" value="{{ old('amount') }}" placeholder="Contoh: 50000" required>
                </label>
                @error('amount')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <label for="description">
                    Catatan
                    <textarea id="description" name="description" placeholder="Contoh: pembayaran invoice">{{ old('description') }}</textarea>
                </label>
                @error('description')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <button class="primary-action" type="submit">Kirim payment</button>
            </form>

            <aside class="panel help-panel">
                <p class="eyebrow">Balance</p>
                <h2>Rp {{ number_format($availableBalance, 0, ',', '.') }}</h2>
                <p>Saldo tersedia akan menjadi acuan sebelum membuat transfer baru.</p>

                <div class="security-summary">
                    <span>Status terakhir</span>
                    <strong>{{ $payments->first()?->status ?? 'Belum ada' }}</strong>
                    <a href="{{ route('status.index') }}">Lihat status transaksi</a>
                </div>
            </aside>
        </section>

        <section class="panel history-panel" style="margin-top: 18px;">
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Riwayat singkat</p>
                    <h2>Payment terbaru</h2>
                </div>
                <a href="{{ route('transactions.index') }}">Lihat history</a>
            </div>

            @forelse ($payments as $payment)
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
                <div class="empty-state">Belum ada payment. Transfer pertama Anda akan muncul di sini.</div>
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
