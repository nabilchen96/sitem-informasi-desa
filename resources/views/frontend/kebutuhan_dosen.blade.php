@extends('frontend.app')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <section class="features-overview" id="features-section">
            </section>
            <div class="row">
                <div class="col-lg-6">
                    <img data-aos="fade-right" data-aos-duration="1500" width="100%"
                        style="margin-left: -100px; margin-top: 50px;" src="{{ asset('hero 9.png') }}">
                    <img width="100%" style="margin-right: -100px; margin-top: 50px;" src="{{ asset('hero 10.png') }}">
                </div>
                <div class="col-lg-6">
                    <div class="mt-5">
                        <h2>🎺 Kebutuhan Dosen</h2>

                        <h6 class="section-subtitle text-muted mb-4">
                            Kebutuhan Dosen Terkait Kegiatan Penelitian & Pengabdian Kepada Masyarakat Politeknik
                            Penerbangan Palembang
                        </h6>
                        <a href="{{ url('/front/kebutuhan_dosen') }}?p=izin" style="border-radius: 25px; font-size: 12px;"
                            class="btn btn-info">Surat Izin
                            Penelitian</a>
                        {{-- <a href="{{ url('/front/kebutuhan_dosen') }}?p=publikasi"
                            style="border-radius: 25px; font-size: 12px;" class="btn btn-info mx-1">Publikasi</a>
                        <a href="{{ url('/front/kebutuhan_dosen') }}?p=pelatihan"
                            style="border-radius: 25px; font-size: 12px;" class="btn btn-info mx-1">Pelatihan
                            Penelitian & Pengabdian</a> --}}
                    </div>
                    <br>
                    @if (Request('p') == 'izin' || Request('p') == null)
                        @include('frontend.kebutuhan.surat_izin')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
@endsection
