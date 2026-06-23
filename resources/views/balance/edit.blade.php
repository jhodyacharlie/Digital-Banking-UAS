@extends('layouts.digeboy')

@section('title', 'Edit Balance - Digeboy')
@section('heading', 'Edit Balance')
@section('subtitle', 'Perbarui saldo account nasabah Digeboy.')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Form Edit Balance</h2>
            <p class="panel-caption">Saldo tersimpan dalam format angka dan ditampilkan sebagai rupiah.</p>
        </div>
        <a class="btn btn-secondary" href="{{ route('balances.index') }}">Kembali</a>
    </div>

    <form class="form" action="{{ route('balances.update', $balance) }}" method="POST">
        @csrf
        @method('PUT')
        @include('balance.form')
        <button class="btn btn-primary" type="submit">Update Balance</button>
    </form>
</section>
@endsection
