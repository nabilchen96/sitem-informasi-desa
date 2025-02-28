@extends('backend.app')
@push('style')
    <link href="{{ asset('bell.css') }}" rel="stylesheet">
    @push('style')
        <style>
            #myTable_filter input {
                height: 29.67px !important;
            }

            #myTable_length select {
                height: 29.67px !important;
            }

            .btn {
                border-radius: 50px !important;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: #9e9e9e21 !important;
            }

            th,
            td {
                font-size: 13.2px !important;
            }

            /* Mengatur ukuran dan margin panah sorting di DataTables */
            table.dataTable thead .sorting::after,
            table.dataTable thead .sorting_asc::after,
            table.dataTable thead .sorting_desc::after {
                margin-bottom: 5px !important;
                content: "▲" !important;
                top: 7px !important;
            }

            table.dataTable thead .sorting::before,
            table.dataTable thead .sorting_asc::before,
            table.dataTable thead .sorting_desc::before {
                margin-top: -5px !important;
                content: "▼" !important;
                bottom: 7px !important;
            }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            #map {
                height: 600px;
                width: 100%;
            }
        </style>
    @endpush
@endpush
@section('content')

    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <h3 class="font-weight-bold">Dashboard</h3>
                    <h6 class="font-weight-normal mb-0">Hi, {{ Auth::user()->name }}.
                        Welcome back to Portal Sistem Informasi Desa</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 mt-4">
                            <div class="card shadow bg-gradient-success card-img-holder text-white">
                                <div class="card-body">
                                    <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg"
                                        class="card-img-absolute" alt="circle">
                                    <h4 class="font-weight-normal mb-3">
                                        Total Penduduk
                                        <i class="bi bi-graph-up float-right"></i>
                                    </h4>
                                    <h3 class="mt-4 mb-3">

                                        {{ $total_penduduk }}
                                    </h3>
                                    <span>Orang</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-4">
                            <div class="card shadow bg-gradient-primary card-img-holder text-white">
                                <div class="card-body">
                                    <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg"
                                        class="card-img-absolute" alt="circle">
                                    <h4 class="font-weight-normal mb-3">
                                        Total Laporan
                                        <i class="bi bi-graph-up float-right"></i>
                                    </h4>
                                    <h3 class="mt-4 mb-3">

                                        {{ @$total_laporan ?? 0}}
                                    </h3>
                                    <span>Aduan</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-4">
                            <div class="card shadow bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg"
                                        class="card-img-absolute" alt="circle">
                                    <h4 class="font-weight-normal mb-3">
                                        Total Pengajaun
                                        <i class="bi bi-graph-up float-right"></i>
                                    </h4>
                                    <h3 class="mt-4 mb-3">

                                        {{  @$total_pengajuan ?? 0}}
                                    </h3>
                                    <span>Pengajuan Surat</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-4">
                            <div class="card shadow bg-gradient-danger card-img-holder text-white">
                                <div class="card-body">
                                    <img src="https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg"
                                        class="card-img-absolute" alt="circle">
                                    <h4 class="font-weight-normal mb-3">
                                        Total Program
                                        <i class="bi bi-graph-up float-right"></i>
                                    </h4>
                                    <h3 class="mt-4 mb-3">

                                        {{ @$total_program ?? 0 }}
                                    </h3>
                                    <span>Program & Agenda</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
@endpush