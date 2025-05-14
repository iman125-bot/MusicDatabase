@extends('layouts.app')

@section('content')
    <h1>{{ $music['title'] }}</h1>
    <p><strong>Artist:</strong> {{ $music['artist'] }}</p>
    <p><strong>Album:</strong> {{ $music['album'] ?? '-' }}</p>
    <p><strong>Year:</strong> {{ $music['year'] ?? '-' }}</p>
    <p><strong>Genre:</strong> {{ $music['genre'] ?? '-' }}</p>
    <p><strong>Duration:</strong> {{ $music['duration'] ?? '-' }}</p>

    <a href="{{ route('musics.edit', $music['id']) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('musics.destroy', $music['id']) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection