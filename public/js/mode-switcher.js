document.addEventListener('DOMContentLoaded', function() {
  const btn = document.getElementById('mode-switcher');
  const body = document.body;
  function setMode(dark) {
    if (dark) {
      body.classList.add('dark');
      btn.textContent = '☀️';
      localStorage.setItem('mode', 'dark');
    } else {
      body.classList.remove('dark');
      btn.textContent = '🌙';
      localStorage.setItem('mode', 'light');
    }
  }
  btn.addEventListener('click', function() {
    setMode(!body.classList.contains('dark'));
  });
  // On load
  setMode(localStorage.getItem('mode') === 'dark');

  // Sticky audio player logic
  document.querySelectorAll('.music-card audio').forEach(function(audio) {
    audio.style.display = 'none'; // Hide inline audio
    const card = audio.closest('.music-card');
    const playBtn = document.createElement('button');
    playBtn.textContent = 'Play';
    playBtn.className = 'global-play-btn';
    playBtn.style.margin = '0.5rem 0 0.2rem 0';
    audio.parentNode.insertBefore(playBtn, audio);
    playBtn.addEventListener('click', function(e) {
      e.preventDefault();
      const bar = document.getElementById('audio-player-bar');
      const player = document.getElementById('player-audio');
      const cover = document.getElementById('player-cover');
      const title = document.getElementById('player-title');
      const artist = document.getElementById('player-artist');
      player.src = audio.querySelector('source').src;
      title.textContent = card.querySelector('.music-title')?.textContent || '';
      artist.textContent = card.querySelector('.music-artist')?.textContent || '';
      const img = card.querySelector('img');
      if(img) {
        cover.src = img.src;
        cover.style.display = '';
      } else {
        cover.style.display = 'none';
      }
      bar.style.display = 'flex';
      player.play();
    });
  });
}); 