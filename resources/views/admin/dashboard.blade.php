<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-center text-primary">👋 Halo, Admin!</h3>
        <p class="text-center text-muted">Silakan kelola produk dan pengguna di bawah ini.</p>

        <h4 class="mt-4">🔧 Manajemen Pengguna</h4>
        <div class="d-grid gap-2">
            <a href="{{ route('admin.loggedin_users') }}" class="btn btn-info">👀 Lihat Pengguna</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">🚫 Blokir Pengguna</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">🗑 Hapus Pengguna</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
