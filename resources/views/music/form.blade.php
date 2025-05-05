<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $music['title'] ?? old('title') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Artist</label>
            <input type="text" name="artist" class="form-control" value="{{ $music['artist'] ?? old('artist') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Album</label>
            <input type="text" name="album" class="form-control" value="{{ $music['album'] ?? old('album') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ $music['year'] ?? old('year') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" value="{{ $music['genre'] ?? old('genre') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Duration (HH:MM:SS)</label>
            <input type="text" name="duration" class="form-control" value="{{ $music['duration'] ?? old('duration') }}" placeholder="00:03:45">
        </div>
    </div>
</div>