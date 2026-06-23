@extends('layouts.digeboy')

@section('title', 'Account - Digeboy')
@section('heading', 'Account Digeboy')
@section('subtitle', 'Kelola data rekening nasabah dengan tampilan rapi, modern, dan mudah dibaca.')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Daftar Account</h2>
            <p class="panel-caption">{{ $accounts->count() }} rekening terdaftar di Digeboy.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('accounts.create') }}">+ Tambah Account</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No. Account</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $account)
                    <tr>
                        <td><strong>{{ $account->account_number }}</strong></td>
                        <td>{{ $account->account_name }}</td>
                        <td><span class="badge">{{ $account->account_type }}</span></td>
                        <td><span class="badge {{ $account->status === 'Aktif' ? 'badge-active' : '' }}">{{ $account->status }}</span></td>
                        <td>Rp {{ number_format(optional($account->balance)->amount ?? 0, 0, ',', '.') }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-secondary" href="{{ route('accounts.edit', $account) }}">Edit</a>
                                <form action="{{ route('accounts.destroy', $account) }}" method="POST" onsubmit="return confirm('Hapus account ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="6">Belum ada account. Tambahkan rekening pertama untuk Digeboy.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
