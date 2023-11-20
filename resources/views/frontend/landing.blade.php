@extends('frontend.app')
@section('content')
    <div class="banner pt-5">
        <div class="">
            <div data-aos="fade-up" data-aos-duration="2000" class="justify-content-center pt-5" style="margin-bottom: -300px;">
                <h1>Selamat Datang di SIPP 👍</h1>
                <p>
                    Sistem Informasi Penelitian dan Pengabdian Kepada Masyarakat
                    <br>Politeknik Penerbangan Palembang
                </p>
                <p class="text-muted">Lihat timelinex Jadwal</p>
                <a style="border-radius: 25px;" class="text-white btn btn-danger">
                    Jadwal &nbsp; <i class="bi bi-play-circle-fill"></i>
                </a>
            </div>

            <div class="row">
                <div class="col-lg-5 d-none d-lg-block d-xl-block">
                    <img data-aos="fade-right" data-aos-duration="1500" width="100%"
                        style="margin-left: -100px; margin-top: 50px;" src="{{ asset('hero 9.png') }}">
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-5 d-none d-lg-block d-xl-block">
                    <img data-aos="fade-left" data-aos-duration="1500" width="100%"
                        style="margin-right: -100px; margin-top: 50px;" src="{{ asset('hero 10.png') }}">
                </div>
            </div>
            <br><br><br>
            <div class="container mt-5">
                <div class="d-lg-none d-xl-none d-xxl-none">
                    <br><br><br><br><br><br><br><br><br><br>
                </div>
                <section class="features-overview" id="features-section">
                    <div data-aos="fade-up" data-aos-duration="1500" class="content-header">
                        <h2>👷 Kegiatan PusPPM</h2>
                        <h6 class="section-subtitle text-muted">
                            Kegiatan Penelitian dan Pengabdian Kepada Masyarakat <br> Politeknik Penerbangan Palembang
                        </h6>
                    </div>
                    <br><br>
                    <div class="d-none d-lg-block d-xl-block">
                        <ul data-aos="fade-up" data-aos-duration="1500" class="timeline">
                            <li @if (@getJadwalAktif()->tahap_ke == 1) style="background: red;" data-year="We Are Here!" @endif
                                data-text="1. Pengajuan Judul"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 2) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="2. Pengumuman Hasil Seleksi"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 3) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="3. Proposal"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 4) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="4. Seminar Proposal"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 5) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="5. RAB"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 6) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="6. Surat Izin Penelitian"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 7) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="7. Seminar Antara"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 8) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="8. Luaran Penelitian"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 9) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="9. Seminar Hasil"></li>
                            <li @if (@getJadwalAktif()->tahap_ke == 10) style="background: red;" data-year="We Are Here!" @endif
                                data-year="" data-text="10. Survey Kepuasan Layanan"></li>
                        </ul>
                    </div>
                    <div class="d-lg-none d-xl-none d-xxl-none">
                        <style>
                            ul.timelinex {
                                list-style-type: none;
                                position: relative;
                            }

                            ul.timelinex:before {
                                content: ' ';
                                background: #d4d9df;
                                display: inline-block;
                                position: absolute;
                                left: 29px;
                                width: 2px;
                                height: 100%;
                                z-index: 400;
                            }

                            ul.timelinex>li {
                                margin: 25px 0;
                                padding-left: 20px;
                            }

                            ul.timelinex>li:before {
                                content: ' ';
                                background: white;
                                display: inline-block;
                                position: absolute;
                                border-radius: 50%;
                                border: 3px solid #22c0e8;
                                left: 20px;
                                width: 20px;
                                height: 20px;
                                z-index: 400;
                            }
                        </style>
                        <ul class="timelinex">
                            <li class="text-left" >
                                1. Pengajuan Judul @if (@getJadwalAktif()->tahap_ke == 1) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left">
                                2. Pengumuman Hasil Seleksi @if (@getJadwalAktif()->tahap_ke == 2) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left">
                                3. Proposal @if (@getJadwalAktif()->tahap_ke == 3) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left">
                                4. Seminar Proposal @if (@getJadwalAktif()->tahap_ke == 4) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left" >
                                5. RAB  @if (@getJadwalAktif()->tahap_ke == 5) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left" >
                                6. Surat Izin Penelitian @if (@getJadwalAktif()->tahap_ke == 6) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left">
                                7. Seminar Antara @if (@getJadwalAktif()->tahap_ke == 7) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left">
                                8. Luaran Penelitian @if (@getJadwalAktif()->tahap_ke == 8) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left">
                                9. Seminar Hasil @if (@getJadwalAktif()->tahap_ke == 9) <br> <b>We Are Here!</b> @endif
                            </li>
                            <li class="text-left">
                                10. Survey Kepuasan Layanan @if (@getJadwalAktif()->tahap_ke == 10) <br> <b>We Are Here!</b> @endif
                            </li>
                        </ul>
                    </div>
                    <br><br>
                </section>
            </div>
        </div>
    </div>
@endsection
