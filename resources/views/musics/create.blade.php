@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 2rem;
        color: white;
    }
    
    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(45deg, #fff, #f0f8ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 1rem;
    }
    
    .back-btn {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }
    
    .back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
    }
    
    .form-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        color: white;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .form-control:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .input-icon {
        position: relative;
    }
    
    .input-icon .form-control {
        padding-left: 45px;
    }
    
    .input-icon::before {
        content: attr(data-icon);
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        z-index: 10;
    }
    
    .btn-save {
        background: linear-gradient(45deg, #ff6b6b, #feca57);
        border: none;
        color: white;
        padding: 14px 30px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.6);
    }
    
    .alert {
        background: rgba(239, 68, 68, 0.2);
        border: 1px solid rgba(239, 68, 68, 0.4);
        color: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
    }
    
    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .duration-helper {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 0.3rem;
    }
    
    @media (max-width: 768px) {
        .form-container {
            margin: 0 1rem;
            padding: 1.5rem;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .page-title {
            font-size: 2rem;
        }
    }
    
    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }
    
    .floating-note {
        position: absolute;
        color: rgba(255, 255, 255, 0.1);
        font-size: 2rem;
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
</style>

<div class="floating-elements">
    <div class="floating-note" style="top: 10%; left: 10%; animation-delay: 0s;">🎵</div>
    <div class="floating-note" style="top: 20%; right: 15%; animation-delay: 1s;">🎶</div>
    <div class="floating-note" style="bottom: 30%; left: 5%; animation-delay: 2s;">🎼</div>
    <div class="floating-note" style="bottom: 10%; right: 10%; animation-delay: 3s;">🎤</div>
</div>

<a href="{{ route('musics.index') }}" class="back-btn">
    ⬅️ Back to Collection
</a>

<div class="page-header">
    <h1 class="page-title">🎵 Add New Music</h1>
    <p class="page-subtitle">Add your favorite track to the collection</p>
</div>

<div class="form-container">
    @if ($errors->any())
        <div class="alert">
            <strong>⚠️ Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('musics.store') }}" method="POST" id="musicForm">
        @csrf
        
        <div class="form-group">
            <label class="form-label">🎵 Title *</label>
            <div class="input-icon" data-icon="🎵">
                <input type="text" name="title" class="form-control" 
                       value="{{ old('title') }}" 
                       placeholder="Enter song title" 
                       required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">👤 Artist *</label>
            <div class="input-icon" data-icon="👤">
                <input type="text" name="artist" class="form-control" 
                       value="{{ old('artist') }}" 
                       placeholder="Enter artist name" 
                       required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">💿 Album</label>
            <div class="input-icon" data-icon="💿">
                <input type="text" name="album" class="form-control" 
                       value="{{ old('album') }}" 
                       placeholder="Enter album name (optional)">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">📅 Year</label>
                <div class="input-icon" data-icon="📅">
                    <input type="number" name="year" class="form-control" 
                           value="{{ old('year') }}" 
                           placeholder="2024" 
                           min="1900" 
                           max="{{ date('Y') }}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">🎭 Genre</label>
                <div class="input-icon" data-icon="🎭">
                    <input type="text" name="genre" class="form-control" 
                           value="{{ old('genre') }}" 
                           placeholder="Rock, Pop, Jazz...">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">⏱️ Duration</label>
            <div class="input-icon" data-icon="⏱️">
                <input type="text" name="duration" class="form-control" 
                       value="{{ old('duration') }}" 
                       placeholder="03:45" 
                       pattern="^([0-9]{1,2}:)?[0-5]?[0-9]:[0-5][0-9]$">
            </div>
            <div class="duration-helper">
                Format: MM:SS or HH:MM:SS (e.g., 03:45 or 01:23:45)
            </div>
        </div>

        <button type="submit" class="btn-save">
            💾 Save Music
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('musicForm');
    const inputs = form.querySelectorAll('.form-control');
    
    // Add focus effects
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
    
    // Duration input validation
    const durationInput = document.querySelector('input[name="duration"]');
    durationInput.addEventListener('input', function() {
        let value = this.value.replace(/[^0-9:]/g, '');
        
        // Auto-format duration
        if (value.length === 2 && !value.includes(':')) {
            value += ':';
        } else if (value.length === 4 && value.split(':').length === 2) {
            const parts = value.split(':');
            if (parseInt(parts[1]) >= 60) {
                parts[1] = '59';
                value = parts.join(':');
            }
        }
        
        this.value = value;
    });
    
    // Form submission animation
    form.addEventListener('submit', function() {
        const submitBtn = this.querySelector('.btn-save');
        submitBtn.innerHTML = '⏳ Saving...';
        submitBtn.style.background = 'linear-gradient(45deg, #6c757d, #adb5bd)';
    });
});
</script>

@endsection