@extends('frontend.app')
@section('content')
    <div class="content-wrapper pt-5">
        <div class="container">
            <section class="features-overview" id="features-section">
                <div class="content-header">
                    <h2>👷 Kegiatan PusPPM</h2>
                    <h6 class="section-subtitle text-muted mb-4">
                        Kegiatan Penelitian dan Pengabdian Kepada Masyarakat <br> Politeknik Penerbangan Palembang
                    </h6>
                    <span class="text-muted">Kunjungi tautan berikut ini <a class="text-info"
                            href="{{ url('front/history') }}">History</a> <br>
                        untuk melihat history atau aktivitas penelitian anda</span>
                </div>
                <br>
                
                <ul class="d-none d-lg-block d-xl-block timeline">
                    <li @if (@getJadwalAktif()->tahap_ke == 1) style="background: red;" data-year="We Are Here!" @endif
                        data-text="1. Pengajuan Judul"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 2) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="2. Pengumuman Hasil Seleksi"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 3) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="3. Proposal"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 4) style="background: red;" data-year="We Are Here!" @endif
                        data-year=""
                        data-text="4. {{ @getJadwalAktif()->tahap_ke == '4 ' ? @getJadwalAktif()->nama_jadwal : 'Seminar Proposal' }}">
                    </li>
                    <li @if (@getJadwalAktif()->tahap_ke == 5) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="5. Pembahasan RAB"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 6) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="6. Penanda Tanganan Kontrak"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 7) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="7. Seminar Antara"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 8) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="8. Luaran Penelitian"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 9) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="9. Seminar Hasil"></li>
                    <li @if (@getJadwalAktif()->tahap_ke == 10) style="background: red;" data-year="We Are Here!" @endif
                        data-year="" data-text="10. Survey Kepuasan Layanan"></li>
                </ul>
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
                        <li class="text-left">
                            1. Pengajuan Judul @if (@getJadwalAktif()->tahap_ke == 1)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            2. Pengumuman Hasil Seleksi @if (@getJadwalAktif()->tahap_ke == 2)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            3. Proposal @if (@getJadwalAktif()->tahap_ke == 3)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            4. Seminar Proposal @if (@getJadwalAktif()->tahap_ke == 4)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            5. RAB @if (@getJadwalAktif()->tahap_ke == 5)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            6. Surat Izin Penelitian @if (@getJadwalAktif()->tahap_ke == 6)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            7. Seminar Antara @if (@getJadwalAktif()->tahap_ke == 7)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            8. Luaran Penelitian @if (@getJadwalAktif()->tahap_ke == 8)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            9. Seminar Hasil @if (@getJadwalAktif()->tahap_ke == 9)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                        <li class="text-left">
                            10. Survey Kepuasan Layanan @if (@getJadwalAktif()->tahap_ke == 10)
                                <br> <b>We Are Here!</b>
                            @endif
                        </li>
                    </ul>
                </div>
                <br><br>
            </section>
            @if (@getJadwalAktif()->tahap_ke == 1)
                @include('frontend.kegiatan.tahap1', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 2)
                @include('frontend.kegiatan.tahap2',[
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 3)
                @include('frontend.kegiatan.tahap3', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 4 && @getJadwalAktif()->nama_jadwal == 'Revisi Proposal')
                @include('frontend.kegiatan.tahap4_bagian1', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 4 && @getJadwalAktif()->nama_jadwal == 'Seminar Proposal')
                @include('frontend.kegiatan.tahap4_bagian2', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 5)
                @include('frontend.kegiatan.tahap5', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 6)
                @include('frontend.kegiatan.tahap6', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 7)
                @include('frontend.kegiatan.tahap7', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 8)
                @include('frontend.kegiatan.tahap8', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 9)
                @include('frontend.kegiatan.tahap9', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 10)
                @include('frontend.kegiatan.tahap10', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @endif
        </div>
    </div>
@endsection
