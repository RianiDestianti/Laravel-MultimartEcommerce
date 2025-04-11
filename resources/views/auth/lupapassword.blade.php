@extends('layouts.layout')

@section('content')
<h2>Lupa Password</h2>
<form action="{{ route('lupa.password.cek') }}" method="post">
    @csrf
    <label>Email</label>
    <input type="email" name="email" class="form-control mb-2" required>
    
    <button class="btn btn-primary">Lanjut</button>
</form>
@endsection
