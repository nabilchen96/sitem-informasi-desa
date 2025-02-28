<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi Desa</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ url('ilanding/logo.png') }}" rel="icon">
    <link href="{{ url('ilanding/logo.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('ilanding/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('ilanding/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ url('ilanding/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ url('ilanding/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ url('ilanding/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ url('ilanding/assets/css/main.css') }}" rel="stylesheet">

    <style>
        .stat-item {
            text-align: center;
            /* Pusatkan konten */
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .stat-content {
            margin-top: 10px;
        }

        /* Media Query untuk perangkat dengan lebar layar di bawah 768px */
        @media (max-width: 768px) {
            .stat-item {
                display: flex;
                flex-direction: column;
                /* Ubah arah menjadi vertikal */
                align-items: center;
            }

            .stat-icon {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div style="border-radius: 0px !important;"
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">
                    <!-- <img src="{{ url('ilanding/logo.png') }}" alt=""> -->
                    🖥️
                </h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}" class="active">Home</a></li>
                    <!-- <li><a href="#about">About</a></li> -->
                    <li><a href="{{ url('/daftar-berita') }}">Berita</a></li>
                    <li><a href="{{ url('/program-desa') }}">Program</a></li>
                    <li><a href="{{ url('/daftar-laporan') }}">Laporan</a></li>
                    <li><a href="{{ url('/') }}#peta">Lokasi</a></li>
                    <li><a href="{{ url('login') }}">Login</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- <a class="btn-getstarted" href="index.html#about">Get Started</a> -->

        </div>
    </header>

    <main class="main">
        <br><br><br>
        <div class="container mt-5 mb-5">
            <div class="text-left mb-2">
                <h1 id="laporan">Laporan Warga</h1>
                <a href="{{ url('/daftar-laporan') }}">Lihat Laporan Desa lainnya <i class="bi bi-arrow-right"></i> </a>
            </div>
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Buat Laporan
            </button>
            <div style="padding-left: 13px; padding-right: 13px;">
                @include('backend.components.laporan')
            </div>
        </div>


    </main>

    <footer id="footer" class="footer">


    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('ilanding/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('ilanding/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ url('ilanding/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ url('ilanding/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ url('ilanding/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('ilanding/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ url('ilanding/assets/js/main.js') }}"></script>

    <script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

    <script>
        form.onsubmit = (e) => {
            e.preventDefault();

            // Ambil data dari Quill dan masukkan ke dalam formData
            let formData = new FormData(form);

            document.getElementById('respon_error').innerHTML = ``;
            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: '/store-front-laporan',
                data: formData,
            })
                .then(function (res) {
                    if (res.data.responCode == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: res.data.respon,
                            timer: 3000,
                            showConfirmButton: false
                        });
                        location.reload()
                    } else {
                        // Handle error response
                        let respon_error = ``;
                        Object.entries(res.data.respon).forEach(([field, messages]) => {
                            messages.forEach(message => {
                                respon_error += `<li>${message}</li>`;
                            });
                        });

                        document.getElementById('respon_error').innerHTML = respon_error;
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function (error) {
                    console.log(error);
                    document.getElementById("tombol_kirim").disabled = false;
                });
        };
    </script>
</body>

</html>