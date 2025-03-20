@extends('layouts.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Kelola Produk</a>
        


        
        <a href="{{ route('logout') }}" class="btn btn-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
