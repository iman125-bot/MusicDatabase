@extends('layouts.app')

@section('content')
<style>
.add-music-card {
  max-width: 420px;
  margin: 3.5rem auto 2.5rem auto;
  background: var(--card-bg-light);
  color: var(--text-light);
  border-radius: 18px;
  box-shadow: 0 4px 32px rgba(30,185,84,0.13);
  padding: 2.5rem 2rem 2rem 2rem;
  display: flex;
  flex-direction: column;
  gap: 0.7rem;
  transition: background 0.3s, color 0.3s;
}
body.dark .add-music-card {
  background: var(--card-bg-dark);
  color: var(--text-dark);
}
.add-music-card label {
  font-weight: 500;
  font-size: 0.98rem;
  margin-bottom: 0.18rem;
  margin-top: 0.5rem;
  display: block;
  letter-spacing: 0.5px;
  text-align: left;
}
.add-music-card input[type="text"],
.add-music-card input[type="number"],
.add-music-card input[type="file"] {
  width: 100%;
  padding: 0.6rem 0.9rem;
  border-radius: 7px;
  border: 1.2px solid #bbb;
  font-size: 1rem;
  margin-bottom: 0.1rem;
  background: rgba(255,255,255,0.13);
  color: inherit;
  transition: border 0.2s;
  box-sizing: border-box;
}
body.dark .add-music-card input {
  background: rgba(30,30,30,0.13);
  color: #fff;
}
.add-music-card input:focus {
  border-color: var(--primary);
  outline: none;
}
.add-music-card button[type="submit"] {
  background: var(--primary);
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 0.9rem 0;
  font-size: 1.1rem;
  font-weight: bold;
  margin-top: 1.2rem;
  margin-bottom: 0.2rem;
  cursor: pointer;
  width: 100%;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 2px 12px rgba(30,185,84,0.13);
  display: block;
}
.add-music-card button[type="submit"]:hover {
  background: #14833b;
  transform: translateY(-2px) scale(1.03);
}
.add-music-card .preview-img {
  display: block;
  max-width: 120px;
  max-height: 120px;
  border-radius: 10px;
  margin: 0.7rem auto 0.2rem auto;
  box-shadow: 0 2px 8px rgba(30,185,84,0.13);
}
.add-music-card .form-title {
  font-size: 1.3rem;
  font-weight: bold;
  margin-bottom: 0.7rem;
  letter-spacing: 2px;
  text-align: center;
}
.add-music-card .form-group {
  display: flex;
  flex-direction: column;
  gap: 0.1rem;
  margin-bottom: 0.2rem;
}
.add-music-card select {
  width: 100%;
  padding: 0.6rem 0.9rem;
  border-radius: 7px;
  border: 1.2px solid #bbb;
  font-size: 1rem;
  background: #181818 !important;
  color: #fff !important;
  transition: border 0.2s;
  box-sizing: border-box;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}
.add-music-card select option {
  background: #181818;
  color: #fff;
}
.add-music-card select:focus {
  border-color: var(--primary);
  outline: none;
}
</style>
<div class="add-music-card">
  <div class="form-title">Add New Music</div>
  @if ($errors->any())
    <div style="color:#c00;background:#fee;padding:0.7rem 1rem;border-radius:8px;">
      <strong>Please fix the following errors:</strong>
      <ul style="margin:0.5rem 0 0 1.2rem;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="{{ route('musics.store') }}" method="POST" id="musicForm" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" value="{{ old('title') }}" required>
    </div>
    <div class="form-group">
      <label>Artist</label>
      <input type="text" name="artist" value="{{ old('artist') }}" required>
    </div>
    <div class="form-group">
      <label>Album</label>
      <input type="text" name="album" value="{{ old('album') }}">
    </div>
    <div class="form-group">
      <label>Year</label>
      <input type="number" name="year" value="{{ old('year') }}">
    </div>
    <div class="form-group">
      <label>Genre</label>
      <select name="genre" id="genre-select" onchange="toggleGenreInput(this)" style="width:100%;padding:0.6rem 0.9rem;border-radius:7px;border:1.2px solid #bbb;font-size:1rem;background:rgba(255,255,255,0.13);color:inherit;">
        <option value="">-- Pilih Genre --</option>
        <option value="Pop" {{ old('genre')=='Pop' ? 'selected' : '' }}>Pop</option>
        <option value="Rock" {{ old('genre')=='Rock' ? 'selected' : '' }}>Rock</option>
        <option value="Jazz" {{ old('genre')=='Jazz' ? 'selected' : '' }}>Jazz</option>
        <option value="Hip-Hop" {{ old('genre')=='Hip-Hop' ? 'selected' : '' }}>Hip-Hop</option>
        <option value="EDM" {{ old('genre')=='EDM' ? 'selected' : '' }}>EDM</option>
        <option value="R&B" {{ old('genre')=='R&B' ? 'selected' : '' }}>R&B</option>
        <option value="Dangdut" {{ old('genre')=='Dangdut' ? 'selected' : '' }}>Dangdut</option>
        <option value="K-Pop" {{ old('genre')=='K-Pop' ? 'selected' : '' }}>K-Pop</option>
        <option value="Electropop" {{ old('genre')=='Electropop' ? 'selected' : '' }}>Electropop</option>
        <option value="Lainnya" {{ old('genre') && !in_array(old('genre'), ['Pop','Rock','Jazz','Hip-Hop','EDM','R&B','Dangdut','K-Pop']) ? 'selected' : '' }}>Lainnya</option>
      </select>
      <input type="text" name="genre" id="genre-input" placeholder="Genre lain..." style="display:none;margin-top:0.3rem;" value="{{ old('genre') && !in_array(old('genre'), ['Pop','Rock','Jazz','Hip-Hop','EDM','R&B','Dangdut','K-Pop']) ? old('genre') : '' }}">
    </div>
    <div class="form-group">
      <label>Duration (MM:SS)</label>
      <input type="text" name="duration" value="{{ old('duration') }}" placeholder="00:03:45">
    </div>
    <div class="form-group">
      <label>Cover Image</label>
      <input type="file" name="cover_image" accept="image/*" onchange="previewCover(event)">
      <img id="cover-preview" class="preview-img" style="display:none;"/>
    </div>
    <div class="form-group">
      <label>Music File</label>
      <input type="file" name="music_file" accept="audio/mp3,audio/wav">
    </div>
    <button type="submit">Save Music</button>
  </form>
</div>
<script>
function previewCover(event) {
  const img = document.getElementById('cover-preview');
  const file = event.target.files[0];
  if(file) {
    img.src = URL.createObjectURL(file);
    img.style.display = 'block';
  } else {
    img.style.display = 'none';
  }
}
function toggleGenreInput(sel) {
  const input = document.getElementById('genre-input');
  if(sel.value === 'Lainnya') {
    input.style.display = 'block';
    input.required = true;
    input.name = 'genre';
    sel.name = '';
  } else {
    input.style.display = 'none';
    input.required = false;
    input.name = '';
    sel.name = 'genre';
  }
}
// On page load, show input if needed
window.addEventListener('DOMContentLoaded', function() {
  const sel = document.getElementById('genre-select');
  if(sel.value === 'Lainnya') toggleGenreInput(sel);
});
</script>
@endsection