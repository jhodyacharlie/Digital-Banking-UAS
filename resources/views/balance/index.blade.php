@extends('layouts.digeboy')

@section('title', 'Balance - Digeboy')
@section('heading', 'Balance Digeboy')
@section('subtitle', 'Pantau saldo tiap account dengan format rupiah dan relasi langsung ke data rekening.')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Daftar Balance</h2>
            <p class="panel-caption">{{ $balances->count() }} saldo account tercatat.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('balances.create') }}">+ Tambah Balance</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Account</th>
                    <th>Nomor</th>
                    <th>Saldo</th>
                    <th>Transaksi Terakhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($balances as $balance)
                    <tr>
                        <td>{{ $balance->account->account_name ?? '-' }}</td>
                        <td><strong>{{ $balance->account->account_number ?? '-' }}</strong></td>
                        <td>Rp {{ number_format($balance->amount, 0, ',', '.') }}</td>
                        <td>{{ $balance->last_transaction_at ? $balance->last_transaction_at->format('d M Y') : '-' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-secondary" href="{{ route('balances.edit', $balance) }}">Edit</a>
                                <form action="{{ route('balances.destroy', $balance) }}" method="POST" onsubmit="return confirm('Hapus balance ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="5">Belum ada data balance. Tambahkan saldo awal untuk account.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
