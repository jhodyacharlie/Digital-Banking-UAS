@extends('layouts.digeboy')

@section('title', 'Tambah Balance - Digeboy')
@section('heading', 'Tambah Balance')
@section('subtitle', 'Masukkan saldo awal atau saldo terbaru untuk account Digeboy.')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Form Balance</h2>
            <p class="panel-caption">Pilih account lalu isi jumlah saldo.</p>
        </div>
        <a class="btn btn-secondary" href="{{ route('balances.index') }}">Kembali</a>
    </div>

    <form class="form" action="{{ route('balances.store') }}" method="POST">
        @csrf
        @include('balance.form')
        <button class="btn btn-primary" type="submit">Simpan Balance</button>
    </form>
</section>
@endsection
