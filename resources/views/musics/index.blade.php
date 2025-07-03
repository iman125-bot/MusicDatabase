@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success text-center">
        ✅ {{ session('success') }}
    </div>
@endif

@if($musics->count() > 0)
    <div style="width:100%;display:flex;justify-content:center;margin:2.2rem 0 1.5rem 0;">
        <form action="" method="GET" style="display:flex;gap:0.7rem;align-items:center;max-width:420px;width:100%;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search music..." style="flex:1;padding:0.7rem 1.2rem;border-radius:22px;border:none;background:#232323;color:#fff;font-size:1.1rem;box-shadow:0 2px 8px rgba(0,0,0,0.10);outline:none;" autofocus>
            <button type="submit" style="background:#1db954;color:#fff;border:none;border-radius:22px;padding:0.7rem 1.7rem;font-size:1.1rem;font-weight:600;cursor:pointer;transition:background 0.2s;">Search</button>
        </form>
    </div>
    @foreach($musics as $genre => $genreMusics)
        <section class="music-genre-section">
            <div class="music-genre-title">{{ $genre }}</div>
            <div class="music-grid" style="justify-items:center;align-items:stretch;">
                @foreach($genreMusics as $music)
                    <div class="music-card" style="width:100%;max-width:320px;min-height:420px;display:flex;flex-direction:column;align-items:center;">
                        @if($music->cover_image)
                            <img src="{{ asset('storage/' . $music->cover_image) }}" alt="cover" style="width:100%;max-width:200px;aspect-ratio:1/1;border-radius:12px;margin-bottom:0.7rem;object-fit:cover;box-shadow:0 2px 12px rgba(0,0,0,0.13);">
                        @endif
                        <div class="music-title" style="text-align:center;width:100%;">{{ $music->title }}</div>
                        <div class="music-artist" style="text-align:center;width:100%;">{{ $music->artist }}</div>
                        <div class="music-album" style="text-align:center;width:100%;">{{ $music->album ?? 'Unknown Album' }}</div>
                        <div class="music-year" style="text-align:center;width:100%;">{{ $music->year ?? '' }}</div>
                        @if($music->file_path)
                            <audio controls style="width:100%;margin:0.5rem 0 0.2rem 0;max-width:180px;">
                                <source src="{{ asset('storage/' . $music->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif
                        <div class="music-actions" style="width:100%;justify-content:center;">
                            <a href="{{ route('musics.show', $music->id) }}">Detail</a>
                            <a href="{{ route('musics.edit', $music->id) }}">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
@else
    <div class="text-center py-5">
        <h4>No music found.</h4>
        <p>Start building your collection by adding your first track!</p>
        <a href="{{ route('musics.create') }}" class="btn btn-success mt-3">Add Your First Song</a>
    </div>
@endif

@endsection
