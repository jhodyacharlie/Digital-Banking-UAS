<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Transfer Digital Banking</title>
</head>

<body class="page-body">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Transfer</p>
                <h1>Buat transfer baru</h1>
                <p>Masukkan nominal pembayaran. Data akan masuk ke histori dengan status Pending.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ghost-button light">Kembali dashboard</a>
        </header>

        <section class="form-grid">
            <form action="{{ route('payment.store') }}" method="POST" class="panel form-panel">
                @csrf

                <label for="amount">Nominal transfer</label>
                <input type="number" name="amount" id="amount" min="1" step="1000" placeholder="Contoh: 250000" value="{{ old('amount') }}" required>
                @error('amount')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <button type="submit" class="primary-action">Buat Transfer</button>
            </form>

            <aside class="panel help-panel">
                <h2>Catatan</h2>
                <p>Form ini sudah menyimpan ke tabel payments milik user yang sedang login.</p>
                <a href="{{ route('transactions.index') }}">Lihat transaction history</a>
            </aside>
        </section>
    </main>
</body>

</html>
