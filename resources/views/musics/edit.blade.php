@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ff6b6b 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }
    
    .container {
        padding: 2rem 1rem;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.8s ease-out;
    }
    
    .page-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        background: linear-gradient(45deg, #fff, #f0f8ff, #e6f3ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        letter-spacing: -1px;
    }
    
    .page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        font-weight: 300;
    }
    
    .form-container {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 24px;
        padding: 3rem;
        max-width: 650px;
        margin: 0 auto;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.2),
            0 8px 16px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out;
    }
    
    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    }
    
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .form-label {
        display: block;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        margin-bottom: 0.8rem;
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        width: 100%;
        padding: 16px 20px;
        background: rgba(255, 255, 255, 0.1);
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        box-sizing: border-box;
    }
    
    .form-control:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.4);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 
            0 0 0 3px rgba(255, 255, 255, 0.1),
            0 8px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .btn-update {
        background: linear-gradient(135deg, #ff6b6b 0%, #feca57 50%, #48cae4 100%);
        border: none;
        color: white;
        padding: 18px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
    }
    
    .btn-update::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-update:hover::before {
        left: 100%;
    }
    
    .btn-update:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 15px 40px rgba(255, 107, 107, 0.4);
    }
    
    .btn-update:active {
        transform: translateY(-2px) scale(0.98);
    }
    
    .alert {
        background: rgba(255, 99, 99, 0.15);
        border: 1px solid rgba(255, 99, 99, 0.3);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        animation: shake 0.5s ease-in-out;
    }
    
    .alert-danger {
        color: rgba(255, 255, 255, 0.95);
    }
    
    .alert strong {
        color: #fff;
        font-weight: 700;
    }
    
    .alert ul {
        margin: 0.5rem 0 0 0;
        padding-left: 1.5rem;
    }
    
    .alert li {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0.3rem;
    }
    
    /* Floating elements decoration */
    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }
    
    .floating-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        animation: float 6s ease-in-out infinite;
    }
    
    .floating-circle:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .floating-circle:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }
    
    .floating-circle:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
        }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .form-container {
            padding: 2rem 1.5rem;
            margin: 1rem;
        }
        
        .page-title {
            font-size: 2.2rem;
        }
        
        .btn-update {
            padding: 16px 30px;
            font-size: 1rem;
        }
    }
    
    /* Music note decorations */
    .music-notes {
        position: absolute;
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.1);
        animation: musicFloat 8s ease-in-out infinite;
    }
    
    .music-notes:nth-child(1) {
        top: 10%;
        right: 5%;
        animation-delay: 0s;
    }
    
    .music-notes:nth-child(2) {
        top: 30%;
        left: 5%;
        animation-delay: 3s;
    }
    
    .music-notes:nth-child(3) {
        bottom: 20%;
        right: 8%;
        animation-delay: 6s;
    }
    
    @keyframes musicFloat {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.1;
        }
        25% {
            opacity: 0.2;
        }
        50% {
            transform: translateY(-15px) rotate(5deg);
            opacity: 0.3;
        }
        75% {
            opacity: 0.2;
        }
    }
</style>

<!-- Floating decoration elements -->
<div class="floating-elements">
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
</div>

<div class="music-notes">♪</div>
<div class="music-notes">♫</div>
<div class="music-notes">♪</div>

<div class="container" style="position:relative;">
    <a href="{{ route('musics.index') }}" class="back-btn" style="position:absolute;left:0;top:0;margin:24px 0 0 0;background:rgba(255,255,255,0.2);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.3);color:white;padding:10px 20px;border-radius:25px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all 0.3s;font-weight:500;z-index:2;"><i class="fa fa-arrow-left"></i> Back to Collection</a>
    <div class="page-header">
        <h1 class="page-title">✏️ Edit Music</h1>
        <p class="page-subtitle">Update your music information</p>
    </div>

    <div class="form-container">
        <form action="{{ route('musics.update', $music->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $music->title) }}" required>
            </div>
            <div class="form-group">
                <label for="artist" class="form-label">Artist</label>
                <input type="text" id="artist" name="artist" class="form-control" value="{{ old('artist', $music->artist) }}" required>
            </div>
            <div class="form-group">
                <label for="album" class="form-label">Album</label>
                <input type="text" id="album" name="album" class="form-control" value="{{ old('album', $music->album) }}" required>
            </div>
            <div class="form-group">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" id="duration" name="duration" class="form-control" value="{{ old('duration', $music->duration) }}" placeholder="03:45" required>
            </div>
            <div class="form-group">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" id="genre" name="genre" class="form-control" value="{{ old('genre', $music->genre) }}" required>
            </div>
            <div class="form-group">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*">
                @if($music->cover_image)
                    <div><img src="{{ asset('storage/' . $music->cover_image) }}" alt="cover" style="max-width:100px;"></div>
                @endif
            </div>
            <div class="form-group">
                <label for="music_file" class="form-label">Music File</label>
                <input type="file" id="music_file" name="music_file" class="form-control" accept="audio/mp3,audio/wav">
                @if($music->file_path)
                    <div><audio controls src="{{ asset('storage/' . $music->file_path) }}" style="width:100px;"></audio></div>
                @endif
            </div>
            <button type="submit" class="btn-update">
                🎵 Update Music
            </button>
        </form>
    </div>
</div>

@endsection