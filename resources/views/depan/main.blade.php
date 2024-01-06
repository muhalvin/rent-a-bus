<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carbook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/animate.css">

    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/magnific-popup.css">

    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/aos.css">

    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/jquery.timepicker.css">


    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/icomoon.css">
    <link rel="stylesheet" href="{{ url('assets/depan') }}/css/style.css">

    <script src="{{ url('assets/depan') }}/js/jquery.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/popper.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/bootstrap.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Bus<span>Booking</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="{{ url('cars') }}" class="nav-link">Kendaraan</a></li>
                    <?php if (!empty(session('guest_id'))): ?>
                    <li class="nav-item"><a href="{{ url('pesananku') }}" class="nav-link">Riwayat Pesanan</a></li>
                    <li class="nav-item"><a href="{{ url('transaksiku') }}" class="nav-link">Riwayat Pembayaran</a></li>
                    <li class="nav-item"><a href="{{ url('logout') }}" class="nav-link">Logout</a></li>
                    <?php else: ?>
                    <li class="nav-item"><a href="{{ url('signup') }}" class="nav-link">Sign Up</a></li>
                    <li class="nav-item"><a href="{{ url('signin') }}" class="nav-link">Sign In</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
    @yield('konten')

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container" style="margin-top: -10vh; margin-bottom: -15vh;">
            <div class="row">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="{{ url('/') }}" class="logo">Car<span>book</span></a></h2>
                        <?= htmlspecialchars_decode($xis->tentang_website) ?>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="{{ url('assets/depan') }}/#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="{{ url('assets/depan') }}/#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="{{ url('assets/depan') }}/#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Information</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('about') }}" class="py-2 d-block">About</a></li>
                            <li><a href="{{ url('cars') }}" class="py-2 d-block">Cars</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Customer Support</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('faq') }}" class="py-2 d-block">FAQ</a></li>
                            <li><a href="{{ url('about') }}" class="py-2 d-block">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text"><?= $xis->alamat ?></span></li>
                                <li><a href="tel:{{ $xis->no_telepon }}"><span class="icon icon-phone"></span><span class="text">{{ $xis->no_telepon }}</span></a></li>
                                <li><a href="mailto:{{ $xis->email }}"><span class="icon icon-envelope"></span><span class="text">{{ $xis->email }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | <a href="{{ url('/') }}" target="_blank"><?= $xis->title_footer ?></a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>

    <script src="{{ url('assets/depan') }}/js/jquery.easing.1.3.js"></script>
    <script src="{{ url('assets/depan') }}/js/jquery.waypoints.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/jquery.stellar.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/owl.carousel.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/aos.js"></script>
    <script src="{{ url('assets/depan') }}/js/jquery.animateNumber.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/bootstrap-datepicker.js"></script>
    <script src="{{ url('assets/depan') }}/js/jquery.timepicker.min.js"></script>
    <script src="{{ url('assets/depan') }}/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ url('assets/depan') }}/js/google-map.js"></script>
    <script src="{{ url('assets/depan') }}/js/main.js"></script>

</body>

</html>
