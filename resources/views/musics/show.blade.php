@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
    
    .music-hero {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        padding: 3rem 2rem;
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .music-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: rotate 8s linear infinite;
        pointer-events: none;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .album-art {
        width: 200px;
        height: 200px;
        background: linear-gradient(45deg, #ff6b6b, #feca57, #48dbfb, #ff9ff3);
        border-radius: 20px;
        margin: 0 auto 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
        animation: pulse 3s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .song-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .song-artist {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .detail-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
    }
    
    .detail-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .detail-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }
    
    .detail-value {
        font-size: 1.2rem;
        font-weight: 600;
        color: white;
    }
    
    .action-section {
        text-align: center;
        margin-top: 2rem;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-edit {
        background: linear-gradient(45deg, #feca57, #ff9ff3);
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(254, 202, 87, 0.4);
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(254, 202, 87, 0.6);
        color: white;
    }
    
    .btn-delete {
        background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    }
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.6);
    }
    
    .floating-notes {
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
        animation: float 8s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.1; }
        50% { transform: translateY(-30px) rotate(10deg); opacity: 0.3; }
    }
    
    .wave-animation {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="%23ffffff" fill-opacity="0.1"/></svg>') repeat-x;
        animation: wave 3s ease-in-out infinite;
        pointer-events: none;
    }
    
    @keyframes wave {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(-25px); }
    }
    
    @media (max-width: 768px) {
        .song-title {
            font-size: 2rem;
        }
        
        .album-art {
            width: 150px;
            height: 150px;
            font-size: 3rem;
        }
        
        .details-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-edit, .btn-delete {
            width: 200px;
            justify-content: center;
        }
    }
</style>

<div class="floating-notes">
    <div class="floating-note" style="top: 5%; left: 5%; animation-delay: 0s;">🎵</div>
    <div class="floating-note" style="top: 15%; right: 10%; animation-delay: 1s;">🎶</div>
    <div class="floating-note" style="top: 25%; left: 15%; animation-delay: 2s;">🎼</div>
    <div class="floating-note" style="bottom: 20%; right: 5%; animation-delay: 3s;">🎤</div>
    <div class="floating-note" style="bottom: 35%; left: 8%; animation-delay: 4s;">🎧</div>
    <div class="floating-note" style="top: 35%; right: 20%; animation-delay: 5s;">🎹</div>
</div>

<a href="{{ route('musics.index') }}" class="back-btn">
    ⬅️ Back to Collection
</a>

<div class="music-hero">
    <div class="wave-animation"></div>
    <div class="album-art">
        🎵
    </div>
    <h1 class="song-title">{{ $music->title }}</h1>
    <p class="song-artist">by {{ $music->artist }}</p>
</div>

<div class="details-grid">
    <div class="detail-card">
        <span class="detail-icon">💿</span>
        <div class="detail-label">Album</div>
        <div class="detail-value">{{ $music->album ?? 'Unknown Album' }}</div>
    </div>
    
    <div class="detail-card">
        <span class="detail-icon">📅</span>
        <div class="detail-label">Year</div>
        <div class="detail-value">{{ $music->year ?? 'Unknown' }}</div>
    </div>
    
    <div class="detail-card">
        <span class="detail-icon">🎭</span>
        <div class="detail-label">Genre</div>
        <div class="detail-value">{{ $music->genre ?? 'Unknown Genre' }}</div>
    </div>
    
    <div class="detail-card">
        <span class="detail-icon">⏱️</span>
        <div class="detail-label">Duration</div>
        <div class="detail-value">{{ $music->duration ?? 'Unknown' }}</div>
    </div>
</div>

<div class="action-section">
    <div class="action-buttons">
        <a href="{{ route('musics.edit', $music->id) }}" class="btn-edit">
            ✏️ Edit Music
        </a>
        
        <form action="{{ route('musics.destroy', $music->id) }}" method="POST" style="display:inline" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="button" class="btn-delete" onclick="confirmDelete()">
                🗑️ Delete Music
            </button>
        </form>
    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('🗑️ Are you sure you want to delete "{{ $music->title }}"?\n\nThis action cannot be undone!')) {
        document.getElementById('deleteForm').submit();
    }
}

// Add some interactive elements
document.addEventListener('DOMContentLoaded', function() {
    const albumArt = document.querySelector('.album-art');
    const detailCards = document.querySelectorAll('.detail-card');
    
    // Album art click interaction
    albumArt.addEventListener('click', function() {
        this.style.animation = 'none';
        setTimeout(() => {
            this.style.animation = 'pulse 1s ease-in-out';
        }, 10);
    });
    
    // Detail cards hover sound effect (visual feedback)
    detailCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.animation = 'pulse 0.5s ease-in-out';
        });
        
        card.addEventListener('animationend', function() {
            this.style.animation = '';
        });
    });
});
</script>

@endsection