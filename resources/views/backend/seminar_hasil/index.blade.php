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
                    <h3 class="font-weight-bold">Data Seminar Hasil</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th>Peneliti</th>
                                    <th>File Seminar hasil</th>
                                    <th>Tanggal Unggah</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                ajax: '/data-seminar-hasil',
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
                        data: "nama_dosen"
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a href="/file_seminar_hasil/${row.file_seminar_hasil}">
                                <i style="font-size: 1rem;" class="bi bi-cloud-arrow-down"></i> File Seminar Hasil
                            </a>`
                        }
                    },
                    {
                        data: "created_at"
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
