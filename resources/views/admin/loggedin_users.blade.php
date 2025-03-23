<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pengguna yang Pernah Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-center text-primary">📌 Pengguna yang Pernah Login</h3>

        <table class="table table-bordered table-striped mt-3">
            <thead class="table-primary">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Waktu Login Terakhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->last_login_at)
                                {{ \Carbon\Carbon::parse($user->last_login_at)->format('d M Y H:i') }}
                            @else
                                <span class="text-danger">Belum pernah login</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
