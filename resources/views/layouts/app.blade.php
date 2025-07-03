<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Music Collection">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Collection</title>
    <link rel="stylesheet" href="/css/custom.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/barfiller.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nowfont.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/rockville.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <style>
        main {
            flex: 1;
        }

        .col-lg-4.d-flex {
            display: flex !important;
        }

        .event__item {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .event__item__text {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .music-card {
            background-color: #6f42c1; /* Ungu Bootstrap */
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
        }

        .music-card h4,
        .music-card p {
            color: white;
        }

        .music-card .btn-light {
            background-color: white;
            color: black;
            border: none;
        }

        .music-card .btn-light:hover {
            background-color: #e2e2e2;
        }
    </style>

</head>
<body>
    <div id="loading-screen" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(24,24,24,0.97);display:flex;align-items:center;justify-content:center;">
        <div class="music-loader">
            <i class="fa fa-music fa-4x fa-spin" style="color:#1db954;"></i>
        </div>
    </div>
    @if (!request()->routeIs('home'))
        <nav id="main-navbar">
            <div class="nav-logo">🎵 Music</div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="/musics">My Collections</a></li>
                <li><a href="/musics/create">Add Music</a></li>
            </ul>
            <div class="nav-actions">
                <button id="mode-switcher" aria-label="Switch mode">🌙</button>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </nav>
    @endif
    <main>
        @yield('content')
    </main>
    <div id="audio-player-bar" style="display:none;">
        <img id="player-cover" src="" alt="cover" style="width:48px;height:48px;border-radius:8px;object-fit:cover;display:none;">
        <div id="player-info">
            <div id="player-title" style="font-weight:bold;"></div>
            <div id="player-artist" style="font-size:0.95em;color:#aaa;"></div>
        </div>
        <audio id="player-audio" controls style="width:300px;max-width:60vw;"></audio>
    </div>
    <footer id="main-footer">
        <span>&copy; {{ date('Y') }} Music Collection</span>
    </footer>
    <script src="/js/mode-switcher.js"></script>
    <script>
    // Loading screen logic
    window.addEventListener('DOMContentLoaded', function() {
        const loader = document.getElementById('loading-screen');
        function showLoader() { loader.style.display = 'flex'; }
        function hideLoader() { loader.style.display = 'none'; }
        // Show loader on link click (except anchor with target _blank or download)
        document.body.addEventListener('click', function(e) {
            const a = e.target.closest('a');
            if (a && !a.hasAttribute('target') && !a.hasAttribute('download') && a.href && a.origin === location.origin) {
                showLoader();
            }
        });
        // Hide loader after page load
        hideLoader();
    });
    // Hide loader if page loaded via back/forward
    window.addEventListener('pageshow', function() {
        document.getElementById('loading-screen').style.display = 'none';
    });
    </script>

    <!-- JS Plugins -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.barfiller.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
