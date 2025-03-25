<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blokir Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-center text-primary">🚫 Blokir Pengguna</h3>
        <p class="text-center text-muted">Kelola status pengguna di sini.</p>

        @if(isset($users) && $users->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_blocked == 1)
                            <span class="text-danger">Diblokir hingga {{ $user->blocked_until ?? 'selamanya' }}</span>
                        @else
                            <span class="text-success">Aktif</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.toggleBlock', $user->id) }}" method="POST">
                            @csrf
                            <label for="blocked_until_{{ $user->id }}">Durasi Blokir (hari):</label>
                            <input type="number" id="blocked_until_{{ $user->id }}" name="blocked_until" min="1" class="form-control mb-2" placeholder="Opsional">
                            <button type="submit" class="btn btn-danger">
                                {{ $user->is_blocked == 1 ? 'Buka Blokir' : 'Blokir' }}
                            </button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       

        @else
            <p class="text-muted text-center">Tidak ada pengguna yang terdaftar.</p>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
