<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="header__logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo" style="max-height: 50px;"></a>
                </div>
            </div>
            <div class="col-lg-10 col-md-10">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Discography</a></li>
                            <li><a href="#">Videos</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                    <div class="header__right__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header Section End -->
