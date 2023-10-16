@extends('backend.app')
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
            white-space: nowrap !important;
        }
    </style>
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold">Data Proposal</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    {{-- <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#modal">
                        Tambah
                    </button> --}}
                    @if (Auth::user()->role == 'Admin')
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#home" role="tab" data-toggle="tab"
                                    onclick="getData()">Baru <sup><span class="badge badge-warning"></span></sup></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#buzz" role="tab" data-toggle="tab" onclick="getData2()">Acc
                                    <sup><span class="badge badge-success"></span></sup></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#references" role="tab" data-toggle="tab"
                                    onclick="getData3()">Ditolak <sup><span class="badge badge-danger"></span></sup></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="home">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped" style="width: 100%;">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Judul</th>
                                                <th>Peneliti</th>
                                                <th>Anggota</th>
                                                <th>File</th>
                                                <th width="5%"></th>
                                                <th width="5%"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="buzz">
                            <div class="table-responsive">
                                <table id="myTable2" class="table table-striped" style="width: 100%;">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Judul</th>
                                            <th>Peneliti</th>
                                            <th>Anggota</th>
                                            <th>File</th>
                                            <th width="5%"></th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="references">
                            <div class="table-responsive">
                                <table id="myTable3" class="table table-striped" style="width: 100%;">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Judul</th>
                                            <th>Peneliti</th>
                                            <th>Anggota</th>
                                            <th>File</th>
                                            <th width="5%"></th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @elseif(Auth::user()->role == 'Reviewer')
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped" style="width: 100%;">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Judul</th>
                                        <th>Peneliti</th>
                                        <th>Anggota</th>
                                        <th>File</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getData()
        })

        function getData() {
            $("#myTable").DataTable({
                "ordering": false,
                scrollX: true,
                scrollCollapse: true,
                ajax: '/data-usulan-proposal',
                processing: true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...'
                },

                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        // data: "judul_penelitian"
                        render: function(data, type, row, meta) {
                            return `<span style="
                            width: 205px !important;
                            white-space: normal;
                            display: inline-block !important;
                            ">
                            ${row.judul_penelitian}
                            </span>`
                        }
                    },
                    {
                        data: "nama_ketua"
                    },
                    {
                        // data: "anggota"
                        render: function(data, type, row, meta) {
                            return `<span style="
                            width: 150px !important;
                            white-space: normal;
                            display: inline-block !important;
                            ">${row.anggota}</span>`
                        }
                    },
                    {
                        // data: "anggota"
                        render: function(data, type, row, meta) {
                            return `<a href="/file_proposal_library/${row.file_proposal}">
                                <i style="font-size: 1rem;" class="bi bi-cloud-arrow-down"></i> File Proposal
                            </a>
                            <br>
                            <a href="/file_proposal_library/${row.file_rab}">
                                <i style="font-size: 1rem;" class="bi bi-cloud-arrow-down"></i> File RAB
                            </a>
                            <br>
                            <a href="/file_proposal_library/${row.file_rab}">
                                <i style="font-size: 0.9rem;" class="bi bi-film"></i> Link Video
                            </a>
                            `
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a data-toggle="modal" data-target="#modal"
                                data-bs-id=` + (row.id) + ` href="javascript:void(0)">
                                <i style="font-size: 1.5rem;" class="text-success bi bi-grid"></i>
                            </a>`
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a href="javascript:void(0)" onclick="hapusData(` + (row
                                .id) + `)">
                                <i style="font-size: 1.5rem;" class="text-danger bi bi-trash"></i>
                            </a>`
                        }
                    },
                ]
            })
        }
    </script>
@endpush
