<!DOCTYPE html>
<html>
<head>
    <title>Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1 class="display-4 text-danger">Akses Ditolak</h1>
        <p class="lead">Maaf, Anda tidak memiliki izin untuk mengakses musik dengan genre ini.</p>
        <a href="{{ url('http://127.0.0.1:8000/musics') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
</body>
</html>