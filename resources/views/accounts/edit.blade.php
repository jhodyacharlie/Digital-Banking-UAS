@extends('layouts.digeboy')

@section('title', 'Edit Account - Digeboy')
@section('heading', 'Edit Account')
@section('subtitle', 'Perbarui detail rekening nasabah Digeboy.')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Form Edit Account</h2>
            <p class="panel-caption">Pastikan nomor account tetap unik.</p>
        </div>
        <a class="btn btn-secondary" href="{{ route('accounts.index') }}">Kembali</a>
    </div>

    <form class="form" action="{{ route('accounts.update', $account) }}" method="POST">
        @csrf
        @method('PUT')
        @include('accounts.form')
        <button class="btn btn-primary" type="submit">Update Account</button>
    </form>
</section>
@endsection
