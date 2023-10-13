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
                    <span class="text-muted">Kunjungi tautan berikut ini <a class="text-info" href="#">History</a> <br> untuk melihat history atau aktivitas penelitian anda</span>
                </div>
                <br><br>

                <ul class="timeline">
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
                <br><br>
            </section>
            @if (@getJadwalAktif()->tahap_ke == 1)
                @include('frontend.kegiatan.tahap1', [
                    'jadwal' => @getJadwalAktif(),
                ])
            @elseif(@getJadwalAktif()->tahap_ke == 2)
                @include('frontend.kegiatan.tahap2')
            @elseif(@getJadwalAktif()->tahap_ke == 3)
                @include('frontend.kegiatan.tahap3')
            @endif
        </div>
    </div>
@endsection
