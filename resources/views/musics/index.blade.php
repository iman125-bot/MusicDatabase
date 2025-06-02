@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .hero-section {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: center;
        color: white;
    }
    
    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(45deg, #fff, #f0f8ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
    }
    
    .search-container {
        position: relative;
        max-width: 400px;
        margin: 0 auto 2rem;
    }
    
    .search-input {
        width: 100%;
        padding: 12px 50px 12px 20px;
        border: none;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .search-input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.02);
    }
    
    .search-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.7);
    }
    
    .add-btn {
        background: linear-gradient(45deg, #ff6b6b, #feca57);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    }
    
    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.6);
        color: white;
    }
    
    .music-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .music-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .music-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s;
    }
    
    .music-card:hover::before {
        left: 100%;
    }
    
    .music-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
    }
    
    .music-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .music-artist {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 0.8rem;
        font-weight: 500;
    }
    
    .music-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }
    
    .music-album {
        flex: 1;
        margin-right: 1rem;
    }
    
    .music-year {
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }
    
    .btn-view {
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        flex: 1;
        text-align: center;
    }
    
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
        color: white;
    }
    
    .alert-success {
        background: rgba(72, 187, 120, 0.2);
        border: 1px solid rgba(72, 187, 120, 0.4);
        color: white;
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }
    
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        color: white;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        display: block;
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-top: 0.5rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .music-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="hero-section">
    <h1 class="hero-title">🎵 Music Collection</h1>
    <p class="hero-subtitle">Discover and manage your favorite tracks</p>
    
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search your music..." id="searchInput">
        <span class="search-icon">🔍</span>
    </div>
    
    <a href="{{ route('musics.create') }}" class="add-btn">
        ➕ Add New Music
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="stats-container">
    <div class="stat-card">
        <span class="stat-number">{{ count($musics) }}</span>
        <div class="stat-label">Total Tracks</div>
    </div>
    <div class="stat-card">
        <span class="stat-number">{{ $musics->unique('artist')->count() }}</span>
        <div class="stat-label">Artists</div>
    </div>
    <div class="stat-card">
        <span class="stat-number">{{ $musics->where('album', '!=', null)->where('album', '!=', '')->unique('album')->count() }}</span>
        <div class="stat-label">Albums</div>
    </div>
    <div class="stat-card">
        <span class="stat-number">{{ $musics->where('year', '!=', null)->avg('year') ? round($musics->where('year', '!=', null)->avg('year')) : '-' }}</span>
        <div class="stat-label">Avg Year</div>
    </div>
</div>

@if($musics->count() > 0)
    <div class="music-grid" id="musicGrid">
        @foreach($musics as $music)
        <div class="music-card" data-title="{{ strtolower($music->title) }}" data-artist="{{ strtolower($music->artist) }}" data-album="{{ strtolower($music->album ?? '') }}">
            <div class="music-title">🎶 {{ $music->title }}</div>
            <div class="music-artist">👤 {{ $music->artist }}</div>
            
            <div class="music-details">
                <div class="music-album">
                    📀 {{ $music->album ?? 'Unknown Album' }}
                </div>
                @if($music->year)
                    <div class="music-year">{{ $music->year }}</div>
                @endif
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('musics.show', $music->id) }}" class="btn-view">
                    👁️ View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-icon">🎵</div>
        <h3>No music found</h3>
        <p>Start building your collection by adding your first track!</p>
        <a href="{{ route('musics.create') }}" class="add-btn" style="margin-top: 1rem;">Add Your First Song</a>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const musicCards = document.querySelectorAll('.music-card');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        musicCards.forEach(card => {
            const title = card.dataset.title;
            const artist = card.dataset.artist;
            const album = card.dataset.album;
            
            if (title.includes(searchTerm) || artist.includes(searchTerm) || album.includes(searchTerm)) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s ease';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Add fade in animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
});
</script>

@endsection