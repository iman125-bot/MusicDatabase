@extends('layouts.app')

@section('content')
    <h1>Add New Music</h1>
    <form action="{{ route('musics.store') }}" method="POST">
        @csrf
        @include('musics.form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection