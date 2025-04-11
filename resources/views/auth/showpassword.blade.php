@extends('layouts.layout')

@section('content')
<h2>Password Anda</h2>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<p>Password yang terdaftar di akun Anda adalah: <strong>{{ $password }}</strong></p>

<a href="{{ route('login') }}">Kembali ke Login</a>
@endsection
