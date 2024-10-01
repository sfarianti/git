<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <title>Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    @vite([])
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-to-the-top">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="#">
                <div class="navbrand-set text-color-main">
                    <img  class="me-3" src="{{ asset('assets/landingpage/logo.png') }}" alt="">
                    <div>
                        Portal <b>Inovasi</b>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-color-main" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color-main" href="#pendaftaran">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color-main" href="#info">InovasiTV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color-main" href="#">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <button class="login-button">
                            <a class="nav-link text-white" href="{{ route('login') }}">Masuk</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid">
        <div class="row align-items-start mt-lg-5 pt-lg-5 mt-md-5 pt-md-5 mt-sm-5 pt-sm-5 debug"
            style="height: fit-content" id="hero">
            <img  class="" src="{{ asset('assets/landingpage/hero.png') }}" alt="">
        </div>
        <div class="row justify-content-center align-items-start mt-3 debug" style="height: 80vh" id="pendaftaran">
            <div class="pendaftaran-text-wrapper ">
                <h2 class="color-main bold">Alur Pendaftaran</h2>
                <div class="custom-hr"></div>
            </div>
            <div class="container-fluid d-flex justify-content-center pb-5">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-1.png') }}" alt="">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-2.png') }}" alt="">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-3.png') }}" alt="">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-4.png') }}" alt="">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-5.png') }}" alt="">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-6.png') }}" alt="">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-7.png') }}" alt="">
                <img  class="carousel-img-size" src="{{ asset('assets/landingpage/car-8.png') }}" alt="">
            </div>
        </div>
        <div class="row debug align-items-center bg mt-3" id="info">
            <div class="infography debug">
                <div class="info-left">
                    <img  id="info-image" class="debug p-0 m-0" src="{{ asset('assets/landingpage/info-left.png') }}" alt="">
                </div>
                <div class="info-center">
                    <button>
                        <a href="">
                            <img class="info-button"  src="{{ asset("assets/landingpage/button-sig-internal.png") }}" alt="">
                        </a>
                    </button>
                    <button>
                        <a href="">
                            <img class="info-button"  src="{{ asset("assets/landingpage/button-konvensi-mutu-nasional.png") }}" alt="">
                        </a>
                    </button>
                    <button>
                        <a href="">
                            <img class="info-button"  src="{{ asset("assets/landingpage/button-retro.png") }}" alt="">
                        </a>
                    </button>

                </div>
                <div class="info-right"></div>
            </div>
        </div>
        {{-- <div class="row debug mt-3" id="company">
        </div> --}}
    </main>
    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
