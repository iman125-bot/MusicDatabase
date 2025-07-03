@extends('layouts.app')

@section('content')
<style>
.home-hero {
  max-width: 600px;
  margin: 4rem auto 3rem auto;
  text-align: center;
  padding: 2.5rem 2rem 2rem 2rem;
  background: var(--card-bg-light);
  color: var(--text-light);
  border-radius: 22px;
  box-shadow: 0 4px 32px rgba(30,185,84,0.13);
  transition: background 0.3s, color 0.3s;
  animation: fadeInUp 1.2s;
}
body.dark .home-hero {
  background: var(--card-bg-dark);
  color: var(--text-dark);
}
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}
.home-title {
  font-size: 2.5rem;
  font-weight: bold;
  margin-bottom: 1.2rem;
  letter-spacing: 2px;
  text-shadow: 0 2px 8px rgba(0,0,0,0.13);
}
.home-desc {
  font-size: 1.15rem;
  margin-bottom: 2.2rem;
  color: #888;
}
.home-btns {
  display: flex;
  gap: 1.2rem;
  justify-content: center;
  flex-wrap: wrap;
}
.home-btns a {
  background: var(--primary);
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 0.9rem 2.2rem;
  font-size: 1.1rem;
  font-weight: bold;
  text-decoration: none;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 2px 12px rgba(30,185,84,0.13);
  display: inline-block;
}
.home-btns a:hover {
  background: #14833b;
  transform: translateY(-2px) scale(1.03);
}
.home-logout-btn {
  position: fixed;
  left: 2.2rem;
  bottom: 2.2rem;
  z-index: 100;
  background: var(--primary);
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 0.7rem 1.5rem;
  font-size: 1rem;
  font-weight: bold;
  box-shadow: 0 2px 12px rgba(30,185,84,0.13);
  cursor: pointer;
  transition: background 0.2s, transform 0.2s;
}
.home-logout-btn:hover {
  background: #14833b;
  transform: translateY(-2px) scale(1.03);
}
.home-mode-btn {
  position: fixed;
  right: 2.2rem;
  bottom: 2.2rem;
  z-index: 100;
  background: var(--card-bg-dark);
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 48px;
  height: 48px;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 12px rgba(30,185,84,0.13);
  cursor: pointer;
  transition: background 0.2s, transform 0.2s;
}
.home-mode-btn:hover {
  background: var(--primary);
  color: #fff;
  transform: scale(1.08);
}
@media (max-width: 700px) {
  .home-logout-btn { left: 1rem; bottom: 1rem; padding: 0.6rem 1.1rem; font-size: 0.95rem; }
  .home-mode-btn { right: 1rem; bottom: 1rem; width: 40px; height: 40px; font-size: 1.2rem; }
}
</style>
<div class="home-hero">
  <div class="home-title">Welcome to Your Music Collection</div>
  <div class="home-desc">
    Simpan, dengarkan, dan kelola koleksi musik favoritmu dengan tampilan modern dan fitur seperti Spotify.<br>
    Mulai tambahkan lagu atau lihat koleksi pribadimu!
  </div>
  <div class="home-btns">
    <a href="{{ route('musics.index') }}">🎵 My Collections</a>
    <a href="{{ route('musics.create') }}">➕ Add Music</a>
  </div>
</div>
<form action="{{ route('logout') }}" method="POST" style="margin:0;">
  @csrf
  <button type="submit" class="home-logout-btn">Logout</button>
</form>
<button class="home-mode-btn" id="home-mode-switcher" aria-label="Switch mode">🌙</button>
<script>
// Mode switcher untuk home
const btn = document.getElementById('home-mode-switcher');
function setMode(dark) {
  if (dark) {
    document.body.classList.add('dark');
    btn.textContent = '☀️';
    localStorage.setItem('mode', 'dark');
  } else {
    document.body.classList.remove('dark');
    btn.textContent = '🌙';
    localStorage.setItem('mode', 'light');
  }
}
btn.addEventListener('click', function() {
  setMode(!document.body.classList.contains('dark'));
});
setMode(localStorage.getItem('mode') === 'dark');
</script>
@endsection 