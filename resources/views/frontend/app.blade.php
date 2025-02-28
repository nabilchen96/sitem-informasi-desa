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

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content">

              <h2>🖥️ Portal</h2>
              <h1 class="mb-4">
                Sistem Informasi <br> Desa
                <span class="accent-text">{{ DB::table('desas')->value('desa') }}</span>
              </h1>

              <p class="mb-4 mb-md-5">
                Portal sistem informasi pengelolaan data kependudukan desa, layanan desa, agenda desa,
                program desa, berita dan informasi desa, pengajuan surat masyarakat, dan laporan atau keluhan masyarakat
                desa
              </p>

              <div class="hero-buttons">
                <a href="{{ url('login') }}" class="btn btn-primary me-0 me-sm-2 mx-1">Login</a>
                <a href="{{ url('/') }}#laporan" class="btn btn-link mt-2 mt-sm-0">
                  <i class="bi bi-play-circle me-1"></i>
                  Aduan Masyarakat
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="hero-image">
              <img src="{{ url('hero 2.png') }}" width="70%" alt="Hero Image" class="img-fluid">
            </div>
          </div>
        </div>
      </div>

    </section>

    <section>
      <div class="container">
        <div class="text-left">
          <h1 id="berita">Berita</h1>
          <a href="{{ url('daftar-berita') }}">Lihat Daftar Berita lainnya <i class="bi bi-arrow-right"></i> </a>
        </div>
        <div class="row mt-4">
          @php
      $berita = DB::table('beritas')->orderBy('created_at', 'DESC')->get();
      @endphp
          @foreach ($berita as $b)
        <div class="col-lg-3 mb-4">
          <div class="card h-100 d-flex flex-column">
            <img src="storage/{{ $b->gambar_utama }}" style="object-fit: cover; height: 200px;" class="card-img-top"
            alt="...">
            <div class="card-body d-flex flex-column">
            <p class="card-text flex-grow-1">{{ $b->judul }}</p>
            <a href="{{ url('detail-berita') }}?id={{ $b->id }}" class="btn btn-primary mt-auto">Detail</a>
            </div>
          </div>
        </div>
      @endforeach

        </div>
      </div>
    </section>

    <div class="container mb-4">
      <div class="text-left mb-4">
        <h1 id="programagenda">Program Desa</h1>
        <a href="{{ url('/program-desa') }}">Lihat Program Desa lainnya <i class="bi bi-arrow-right"></i> </a>
      </div>
      <div style="padding-left: 13px; padding-right: 13px;">
        <table style="font-size: 17px !important;" class="table table-striped table-bordered">
          <thead class="table-dark">
            <tr class="row">
              <th class="col-lg-12">Program dan Agenda Desa</th>
            </tr>
          </thead>
          <tbody>
            @php
        $agenda = DB::table('programs')->orderBy('created_at', 'DESC')->get();
        @endphp
            @foreach ($agenda as $a)
        <tr class="row mt-3">
          <td class="col-lg-3 table-info">
          <b>Program: </b><br>
          {{ $a->program }}
          <br>
          <div class="mb-3"></div>

          <b>Status: </b><br>
          <span class="bg-info badge">Masih Berlangsung</span>
          </td>
          <td class="col-lg-4">
          <div class="row">
            <div class="col-lg-12">
            <b>Mulai: </b><br>
            <div class="text-primary">
              {{ date('d-m-Y H:i:s', strtotime($a->tgl_mulai)) }}
            </div>
            <div class="mb-3"></div>
            <b> Selesai: </b><br>
            <div class="text-primary">{{ date('d-m-Y H:i:s', strtotime($a->tgl_selesai)) }}</div><br>
            <div class="mb-3"></div>
            </div>
            <div class="col-6">


            </div>
          </div>
          </td>
          <!-- <td class="col-lg-1"></td> -->
          <td class="col-lg-5">
          <b>Lokasi: </b><br>
          {{ $a->lokasi }}
          <br>
          <div class="mb-3"></div>
          <b>Keterangan: </b><br>
          <div style="width: 80%;">{{ $a->deskripsi }}</div>
          </td>
        </tr>
      @endforeach
          </tbody>
        </table>
      </div>

    </div>
    <br>

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

    <iframe id="peta" class="contact"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.6424613861236!2d102.19920717501995!3d-3.436870196537618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e315b9e7801b9b1%3A0x300cd9e67330acf3!2sKantor%20Bupati%20Bengkulu%20Utara!5e0!3m2!1sid!2sid!4v1732679905033!5m2!1sid!2sid"
      width="100%" height="500" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
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