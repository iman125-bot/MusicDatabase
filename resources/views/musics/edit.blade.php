@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Music</h1>
    
    <form action="{{ route('musics.update', $music->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('musics.form')
        <button type="submit" class="btn btn-primary mt-3">Update Music</button>
    </form>
@endsection