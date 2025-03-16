@extends('layouts.layout')

@section('title', 'Live Chat')

@section('content')
<link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">

<div class="chat-container">
    <div class="chat-box" id="chat-box">
        <div class="bot-message">Halo! Ada yang bisa saya bantu?</div>
    </div>
    <div class="chat-input">
        <input type="text" id="user-input" placeholder="Ketik pesan..." />
        <button onclick="sendMessage()">Kirim</button>
    </div>
</div>

<script src="{{ asset('js/chatbot.js') }}"></script>
@endsection
