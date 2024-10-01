<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/landingpage-1.css') }}">
    <title>Landing Page - SIG Innovation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/sigialogo.png') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Carousel Test</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Penyesuaian frame gambar */
        .img-sizing-template {
            height: 100%;
            /* Biarkan frame menyesuaikan tinggi berdasarkan konten atau pengaturan */
            width: 100%;
            /* Frame mengambil 100% lebar dari container */
            overflow: hidden;
            /* Sembunyikan bagian gambar yang melewati frame */
        }

        /* Pengaturan gambar di dalam frame */
        .carousel-item img {
            width: 100%;
            /* Gambar mengambil 100% lebar dari frame */
            height: 100%;
            /* Gambar mengambil 100% tinggi dari frame */
            object-fit: cover;
            /* Gambar mengisi seluruh frame dengan proporsi yang benar */
        }
    </style>

    <style>
        /* Mengatur latar belakang seluruh halaman */
        body {
            background-color: #ebebeb;
        }
    </style>

    @vite([])
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed w-100 top-0 start-0" style="z-index: 9;">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="#">
                <div class="d-flex align-items-center text-color-main">
                    <img class="me-3" src="{{ asset('assets/landingpage/logo.png') }}" alt="">
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
                        <a class="nav-link active text-color-main" aria-current="page" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color-main" href="#pendaftaran">Event</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link text-color-main" href="#info">InovasiTV</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link text-color-main" href="#footer">Kontak</a>
                    </li>
                    @if (Auth::user())
                        <li class="nav-item">
                            <a class="nav-link text-color-main" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-danger">Keluar</button>
                        </form>
                    @else
                        <button class="login-button">
                            <a class="nav-link text-white" href="{{ route('login') }}">Masuk</a>
                        </button>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid">

        <section class="container-fluid justify-content-center  p-0" id="hero">
            <div class="padding-for-content-to-navbar   "></div>
            <div class="row align-items-start">
                <img id="hero-background" src="{{ asset('assets/landingpage/beranda-2.png') }}" alt="">
            </div>
        </section>

        {{-- Menambahkan carrousel gambar yang bisa digeser, total ada 6 item/gambar --}}
        <section class="row justify-content-evenly position-relative" style="top:-30vh; margin-bottom:-20vh"
            id="card-beranda-offset">
            <div class="col-md-12">
                <div class="featured-carousel owl-carousel">
                    @foreach ($flyer as $f)
                        <div class="item">
                            <div class="work">
                                <div class="img d-flex align-items-end justify-content-center"
                                    style="background-image: url({{ asset('storage/' . $f->flyer_path) }});">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <style>
            /* Mengurangi ukuran frame dan gambar */
            .featured-carousel .item {
                max-width: 450px;
                /* Sesuaikan ukuran ini */
                margin: auto;
            }

            .featured-carousel .img {
                height: 400px;
                /* Sesuaikan ukuran ini */
                width: 100%;
                background-size: cover;
                background-position: center;
                border-radius: 8px;
                /* Membuat gambar lebih stylish dengan border-radius */
                box-shadow: 0 4px 8px rgb(152, 44, 44);
                /* Memberikan efek bayangan */
            }
        </style>



        <section class="container-fluid justify-content-center" id="pendaftaran">
            <div id="pendaftaran-content-wrapper">
                <div class="row align-items-center px-5">
                    <div class="col-lg-6">
                        <div class="img-sizing-template">
                            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="4000"
                                        data-description="Event yang membahas teknologi dan inovasi terbaru dalam produksi semen, dengan fokus pada capaian dan perkembangan dari PT Semen Indonesia Tbk.">
                                        <a href="">
                                            <img src="{{ asset('assets/landingpage/testing-carousel-1.jpg') }}"
                                                class="d-block w-100">
                                        </a>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000"
                                        data-description="Event ini fokus pada implementasi sistem dan teknologi terbaru di PT Semen Padang, termasuk pencapaian dan strategi peningkatan kualitas produksi semen.
">
                                        <a href="">
                                            <img src="{{ asset('assets/landingpage/testing-carousel-2.jpg') }}"
                                                class="d-block w-100">
                                        </a>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000"
                                        data-description="Merupakan acara yang membahas sistem integrasi dan kemajuan dalam produksi semen di PT Semen Tonasa, serta dampaknya terhadap efisiensi operasional.">
                                        <a href="">
                                            <img src="{{ asset('assets/landingpage/testing-carousel-3.jpg') }}"
                                                class="d-block w-100">
                                        </a>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000"
                                        data-description="Event yang mengeksplorasi inovasi teknologi dan strategi yang diterapkan oleh PT Semen Gresik, dengan tujuan untuk meningkatkan kapasitas produksi dan kualitas semen.">
                                        <a href="">
                                            <img src="{{ asset('assets/landingpage/testing-carousel-4.jpg') }}"
                                                class="d-block w-100">
                                        </a>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000"
                                        data-description="Fokus pada perkembangan dan integrasi teknologi terbaru di PT Semen Kupang Indonesia, serta evaluasi pencapaian dan dampaknya terhadap industri semen di wilayah tersebut.">
                                        <a href="">
                                            <img src="{{ asset('assets/landingpage/testing-carousel-5.jpg') }}"
                                                class="d-block w-100">
                                        </a>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000"
                                        data-description="PT SIG (Semen Indonesia Group) adalah sebuah perusahaan BUMN (Badan Usaha Milik Negara) yang merupakan holding company atau perusahaan induk dari berbagai perusahaan produsen semen di Indonesia.">
                                        <a href="">
                                            <img src="{{ asset('assets/landingpage/testing-carousel-6.jpg') }}"
                                                class="d-block w-100">
                                        </a>
                                    </div>
                                </div>
                                <!-- Tombol untuk menggeser gambar -->
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 color-main">
                        <h2 id="carousel-description-heading">Latest News!</h2>
                        <p id="carousel-description">Event yang membahas teknologi dan inovasi terbaru dalam produksi
                            semen, dengan fokus pada capaian dan perkembangan dari PT Semen Indonesia Tbk.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var carouselElement = document.getElementById('carouselExampleInterval');
                var carousel = new bootstrap.Carousel(carouselElement);

                // Event listener untuk perubahan slide
                carouselElement.addEventListener('slid.bs.carousel', function(event) {
                    var currentSlide = event.relatedTarget;
                    var description = currentSlide.getAttribute('data-description');
                    document.getElementById('carousel-description').innerText = description;
                });
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>



        {{-- <section class="container-fluid justify-content-center   p-0" id="pendaftaran">
            <div class="padding-for-content-to-navbar"></div>
            <div id="pendaftaran-content-wrapper">
                <iframe
                    src='https://cdn.knightlab.com/libs/timeline3/latest/embed/index.html?source=1E6yvwYt9r7I2REmAghHOCW2MQcDaJZlXqmHS2T33NC8&font=Default&lang=en&initial_zoom=2&height=650'
                    width='100%' height='650' webkitallowfullscreen mozallowfullscreen allowfullscreen
                    frameborder='0'></iframe>
                <div class="padding-for-content-to-navbar   "></div>
            </div>
        </section> --}}

        <section>
            <div id="content" class="pt-5">
                <div class="mb-4" id="pendaftaran-title">
                    <h2 class="color-main animated-title">Timeline Kompetisi Inovasi</h2>
                    <hr class="custom-hr">
                </div>
                <ul class="timeline mx-auto">
                    @foreach ($timeline as $t)
                        <li class="event animated-item"
                            data-date="{{ \Carbon\Carbon::parse($t->tanggal_mulai)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($t->tanggal_selesai)->format('d M Y') }}
                            ">
                            <h3>{{ $t->judul_kegiatan }} </h3>
                            <p>{{ $t->deskripsi }} </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <style>
            /* Animasi untuk title */
            .animated-title {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 1s ease, transform 1s ease;
            }

            /* Animasi untuk items */
            .animated-item {
                opacity: 0;
                transform: translateX(-20px);
                transition: opacity 1s ease, transform 1s ease;
            }

            /* Efek muncul (trigger oleh JavaScript) */
            .fade-in {
                opacity: 1;
                transform: translateY(0);
            }

            .fade-in-left {
                opacity: 1;
                transform: translateX(0);
            }
        </style>

        <script>
            // Fungsi untuk menambahkan kelas 'fade-in' saat elemen muncul di viewport
            function animateOnScroll() {
                const animatedTitles = document.querySelectorAll('.animated-title');
                const animatedItems = document.querySelectorAll('.animated-item');

                animatedTitles.forEach(item => {
                    const rect = item.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        item.classList.add('fade-in');
                    }
                });

                animatedItems.forEach(item => {
                    const rect = item.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        item.classList.add('fade-in-left');
                    }
                });
            }

            // Trigger animasi saat scroll
            window.addEventListener('scroll', animateOnScroll);

            // Trigger animasi saat pertama kali load (untuk elemen yang sudah terlihat)
            animateOnScroll();
        </script>

        {{-- <section class="container-fluid p-0" id="info">
            <div id="info-bg" class="">
                <div class="padding-for-content-to-navbar   "></div>
                <div class="info   ">
                    <img class=" " src="{{ asset('assets/landingpage/info-left.png') }}" alt="">
                </div>
                <div class="   info-center">
                    <div class="container-for-button">
                        <a href=""><img style="width: 100%"
                                src="{{ asset('assets/landingpage/button-sig-internal.png') }}" alt=""></a>
                    </div>
                    <div class="container-for-button">
                        <a href=""><img style="width: 100%"
                                src="{{ asset('assets/landingpage/button-konvensi-mutu-nasional.png') }}"
                                alt=""></a>
                    </div>
                    <div class="container-for-button">
                        <a href=""><img style="width: 100%"
                                src="{{ asset('assets/landingpage/button-retro.png') }}" alt=""></a>
                    </div>
                    <div class="container-for-button">
                        <a href="">
                            <img style="width:100%" src="{{ asset('assets/landingpage/button-go-live.png') }}"
                                alt="">
                        </a>
                    </div>
                </div>
                <div class="   info-right">
                    <div class="container-for-button">
                        <a href=""><img style="width: 100%"
                                src="{{ asset('assets/landingpage/button-sig-group.png') }}" alt=""></a>
                    </div>
                    <div class="container-for-button">
                        <a href=""><img style="width: 100%"
                                src="{{ asset('assets/landingpage/button-konvensi-mutu-internasional.png') }}"
                                alt=""></a>
                    </div>
                    <div class="container-for-button">
                        <a href=""><img style="width: 100%"
                                src="{{ asset('assets/landingpage/button-paten.png') }}" alt=""></a>
                    </div>
                    <div class="container-for-button">
                        <a href="">
                            <img style="width:100%" src="{{ asset('assets/landingpage/button-bincang-expert.png') }}"
                                alt="">
                        </a>
                    </div>
                </div>

            </div>
        </section> --}}

        <section class="container-fluid justify-content-center" id="company">
            <div class="padding-for-content-to-navbar   "></div>
            <div id="pendaftaran-content-wrapper">
                <div class="row flex-row align-items-center">
                    <div class="  " id="pendaftaran-title">
                        <h2 class="color-main">Kontribusi SIG Group</h2>
                        <hr class="custom-hr">
                    </div>
                    <div id="pendaftaran-timeline" class="d-flex flex-row align-items-center px-5  ">
                        <img style="width:75% " src="{{ asset('assets/landingpage/logo-company.png') }}"
                            alt="">
                    </div>
                </div>
                <div class="padding-for-content-to-navbar   "></div>
            </div>
        </section>
    </main>

    <footer id="footer">
        <img style="width:100%" src="{{ asset('assets/landingpage/footer.png') }}" alt="">
    </footer>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> --}}

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
