<!DOCTYPE html>
<html>
<head>
    <title>Upload Gambar</title>
</head>
<body>
    <h2>Form Upload Gambar</h2>

    <!-- Pesan sukses -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Form Upload -->
    <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Judul:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Pilih Gambar:</label><br>
        <input type="file" name="image" required><br><br>

        <button type="submit">Upload</button>
    </form>

    <!-- Preview Gambar -->
    @if(isset($image))
        <h3>Gambar yang baru diupload:</h3>
        <p><strong>{{ $image->title }}</strong></p>
        <img src="{{ asset('storage/' . $image->image_path) }}" width="200" alt="Uploaded Image"><br><br>

        <!-- Form Hapus Gambar -->
        <form action="{{ route('upload.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="color: red;">Hapus Gambar</button>
        </form>
    @endif

</body>
</html>
