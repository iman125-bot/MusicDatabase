@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success text-center">
        ✅ {{ session('success') }}
    </div>
@endif

@if($musics->count() > 0)
    @foreach($musics as $genre => $genreMusics)
        <section class="music-genre-section">
            <div class="music-genre-title">{{ $genre }}</div>
            <div class="music-grid">
                @foreach($genreMusics as $music)
                    <div class="music-card">
                        @if($music->cover_image)
                            <img src="{{ asset('storage/' . $music->cover_image) }}" alt="cover" style="width:100%;max-width:180px;border-radius:12px;margin-bottom:0.7rem;">
                        @endif
                        <div class="music-title">{{ $music->title }}</div>
                        <div class="music-artist">{{ $music->artist }}</div>
                        <div class="music-album">{{ $music->album ?? 'Unknown Album' }}</div>
                        <div class="music-year">{{ $music->year ?? '' }}</div>
                        @if($music->file_path)
                            <audio controls style="width:100%;margin:0.5rem 0 0.2rem 0;">
                                <source src="{{ asset('storage/' . $music->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif
                        <div class="music-actions">
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
