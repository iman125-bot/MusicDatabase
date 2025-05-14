@extends('layouts.app')

@section('content')
    <h1>Music Collection</h1>
    <a href="{{ route('musics.create') }}" class="btn btn-primary mb-3">Add New Music</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Album</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($musics as $music)
            <tr>
                <td>{{ $music->title }}</td>  <!-- Perhatikan -> bukan [''] -->
                <td>{{ $music->artist }}</td>
                <td>{{ $music->album ?? '-' }}</td>
                <td>{{ $music->year ?? '-' }}</td>
                <td>
                    <a href="{{ route('musics.show', $music->id) }}" class="btn btn-info">View</a>
                    <!-- ... -->
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
@endsection