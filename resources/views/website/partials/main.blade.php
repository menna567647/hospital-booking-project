<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Hospital management System </title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .btn-outline-primary:hover,
        .btn-outline-primary:hover i {
            color: #fff !important;
        }
    </style>

</head>

<body>
    <main>
        <!-- ################# Header Starts Here#######################--->
        <header id="menu-jk">
            <div id="nav-head" class="header-nav">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-3 col-sm-12 site-logo">
                            HMS
                            <a data-toggle="collapse" data-target="#menu" href="#menu">
                                <i class="fas d-block d-md-none small-menu fa-bars"></i>
                            </a>
                        </div>
                        <div id="menu" class="col-lg-8 col-md-9 d-none d-md-block nav-item">
                            <ul class="nav-list">
                                <li><a href="{{ route('website.page') }}">Home</a></li>
                                <li><a href="{{ route('website.page') }}#contact_us">Contact Us</a></li>
                                @guest('client')
                                    <li><a href="{{ route('website.login') }}">{{ __('Login') }}</a></li>
                                    @if (Route::has('website.register'))
                                        <li><a href="{{ route('website.register') }}">Register</a></li>
                                    @endif
                                @endguest
                                @auth('client')
                                    <li>
                                        <a
                                            href="{{ route('website.profile.edit', Auth('client')->user()->id) }}">{{ __('language.MYPROFILE') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('website.bookings.index') }}">{{ __('language.DOCTORSCHEDULE') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('website.bookings.show') }}">{{ __('language.MYBOOKINGS') }}</a>
                                    </li>

                                    <li>
                                        <a class="btn btn-outline-primary btn-sm"
                                            href="{{ route('website.profile.password') }}">
                                            <i class="fa-solid fa-key me-1"></i> {{ __('language.CHANGEMYPASSWORD') }}
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ auth('client')->user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('website.logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('website.logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endauth
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a class="btn btn-outline-primary btn-sm text-black" rel="alternate"
                                            hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @if (session('user_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('user_message') }}
            </div>
        @endif
        <section>
            @yield('content')
        </section>
    </main>

    <!-- ################# Footer Starts Here#######################--->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h2>Useful Links</h2>
                    <ul class="list-unstyled link-list">
                        <li><a ui-sref="about" href="#about">About us</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="portfolio" href="#services">Services</a><i class="fa fa-angle-right"></i>
                        </li>
                        <li><a ui-sref="products" href="#logins">Logins</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="gallery" href="#gallery">Gallery</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="contact" href="#contact">Contact us</a><i class="fa fa-angle-right"></i></li>
                    </ul>
                </div>
    </footer>
    <!-- JS -->
    <script src="{{ asset('build/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/bootstrap.min.js') }}"></script>

</body>

</html>
