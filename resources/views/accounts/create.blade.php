@extends('layouts.digeboy')

@section('title', 'Tambah Account - Digeboy')
@section('heading', 'Tambah Account')
@section('subtitle', 'Buat data rekening baru untuk nasabah Digeboy.')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Form Account</h2>
            <p class="panel-caption">Isi data rekening dengan lengkap.</p>
        </div>
        <a class="btn btn-secondary" href="{{ route('accounts.index') }}">Kembali</a>
    </div>

    <form class="form" action="{{ route('accounts.store') }}" method="POST">
        @csrf
        @include('accounts.form')
        <button class="btn btn-primary" type="submit">Simpan Account</button>
    </form>
</section>
@endsection
