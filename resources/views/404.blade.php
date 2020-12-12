<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($meta) ? $meta->title : ''  }}</title>

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="en_US">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="robots" content="index,follow">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="icon" href="img/favicon.png" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{mix('/frontend/css/all.css')}}">
</head>
<body>
    <div id="app">
        <section class="medium-gap error-404">
            <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <div class="main-content">
                    <h1>error 404</h1>
                    <span>The page you were looking for does not exist.</span>
                </div>
                </div>
            </div>
            </div>
        </section>
        <section class="medium-gap go-back-home">
        <div class="container">
            <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="main-content">
                <div class="row">
                    <div class="col-lg-8">
                    <div class="left-content">
                        <h2><em>Oops</em>, looks like you're <em>lost</em>!</h2>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="normal-white-button">
                        <router-link to="/">Go Back Home</router-link>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('frontend/js/vendors/jquery-3.4.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/isotope.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/jquery.appear.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/jquery.countTo.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/jquery.easing.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/owl-carousel.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/jquery.hoverIntent.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/packery-mode.pkgd.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/parallax.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/perfect-scrollbar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/frontend/js/vendors/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('frontend/js/main.js')}}" type="text/javascript"></script>
</body>
</html>