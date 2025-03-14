@extends('layouts.layout')

@section('content')
<h2>Login</h2>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<a href="{{ route('register') }}">Belum punya akun? Daftar</a>
@endsection
