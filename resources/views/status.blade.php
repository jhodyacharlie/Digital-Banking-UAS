<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Status Transaksi</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Status</p>
                <h1>Status pembayaran</h1>
                <p>Pantau status transaksi dan payment terbaru yang dibuat dari menu Transfer.</p>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('payment.index') }}" class="ghost-button light">Buat Payment</a>
                <a href="{{ route('dashboard') }}" class="ghost-button light">Dashboard</a>
            </div>
        </header>

        @if (session('success'))
            <div class="notice success">{{ session('success') }}</div>
        @endif

        <section class="panel">
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Daftar payment</p>
                    <h2>{{ $payments->count() }} transaksi tercatat</h2>
                </div>
            </div>

            @forelse($payments as $payment)
                @php
                    $currentStatus = $payment->statuses->last()?->status ?? $payment->status;
                    $statusClass = \Illuminate\Support\Str::slug($currentStatus ?? 'pending');
                @endphp
                <div class="history-row">
                    <div class="transaction-main">
                        <span class="transaction-dot"></span>
                        <div>
                            <strong>Payment #{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</strong>
                            <p>{{ $payment->created_at?->format('d M Y, H:i') ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="transaction-amount">
                        <strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong>
                        <span class="status-pill status-{{ $statusClass }}">{{ $currentStatus }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-state">Belum ada payment yang tersimpan.</div>
            @endforelse
        </section>
    </main>
</body>

</html>
