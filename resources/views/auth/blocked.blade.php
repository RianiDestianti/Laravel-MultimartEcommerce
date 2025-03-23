<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Diblokir</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; margin-top: 50px; }
        .container { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background: #f8d7da; }
        h1 { color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚠️ Akun Anda Diblokir ⚠️</h1>
        <p>{{ $message }} <strong>{{ $blocked_until }}</strong>.</p>
        <p>Silakan coba login kembali setelah waktu tersebut atau hubungi admin.</p>
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</body>
</html>
