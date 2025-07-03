<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid px-5">
        <div class="d-flex w-100 align-items-center">
            <!-- Brand: Music, not clickable -->
            <span class="navbar-brand fw-bold ms-5 me-5 d-flex align-items-center" style="font-size: 1.7rem; letter-spacing: 2px;">
                <i class="fa fa-music me-2" style="font-size: 2rem;"></i> Music
            </span>

            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse justify-content-start" id="mainNavbar">
                <ul class="navbar-nav d-flex gap-4">
                    <li class="nav-item">
                        <a href="{{ route('musics.index') }}" class="nav-link {{ request()->routeIs('musics.index') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#my-collections" class="nav-link">My Collections</a>
                    </li>
                    <li class="nav-item">
                        <a href="#footer" class="nav-link">Footer</a>
                    </li>
                </ul>
            </div>

            <!-- Logout Button on the far right -->
            <div class="ms-auto d-flex align-items-center">
                <form action="{{ route('logout') }}" method="POST" class="mb-0 ms-4">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger fw-bold px-4 py-2">
                        <i class="fa fa-sign-out me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a.nav-link[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 70, // adjust for navbar height
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
