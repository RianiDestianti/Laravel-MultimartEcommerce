@extends('layouts.layout')

@section('title', 'Isi Saldo')

@section('content')
<div class="container mt-5">
    <h2>💰 Isi Saldo Manual</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('saldo.isi') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nominal" class="form-label">Masukkan Nominal (Rp)</label>
            <input type="number" name="nominal" class="form-control" required min="1000">
        </div>
        <button type="submit" class="btn btn-primary">Tambah Saldo</button>
    </form>

    <div class="mt-4">
        <h4>Saldo Kamu Saat Ini: <span class="text-success">Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</span></h4>
    </div>
</div>
@endsection
