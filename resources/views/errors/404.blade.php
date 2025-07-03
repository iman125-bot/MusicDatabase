@extends('layouts.app')
@section('content')
<style>
.error-hero {
  max-width: 480px;
  margin: 5rem auto 2.5rem auto;
  background: var(--card-bg-dark);
  color: var(--text-dark);
  border-radius: 22px;
  box-shadow: 0 4px 32px rgba(30,185,84,0.13);
  padding: 2.5rem 2rem 2rem 2rem;
  text-align: center;
  animation: fadeInUp 1.2s;
}
.error-hero h1 {
  font-size: 4.5rem;
  font-weight: bold;
  color: #1db954;
  margin-bottom: 0.5rem;
}
.error-hero p {
  font-size: 1.2rem;
  color: #ccc;
  margin-bottom: 2rem;
}
.error-hero a {
  background: #1db954;
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 0.8rem 2.2rem;
  font-size: 1.1rem;
  font-weight: bold;
  text-decoration: none;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 2px 12px rgba(30,185,84,0.13);
  display: inline-block;
}
.error-hero a:hover {
  background: #14833b;
  transform: translateY(-2px) scale(1.03);
}
</style>
<div class="error-hero">
  <h1>404</h1>
  <p>Halaman yang kamu cari tidak ditemukan.<br>Cek kembali URL atau kembali ke halaman utama.</p>
  <a href="{{ route('home') }}">Kembali ke Home</a>
</div>
@endsection 