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
                                    onclick="getData()">Baru <sup><span
                                            class="badge badge-warning">{{ $new->count() ?? 0 }}</span></sup></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#buzz" role="tab" data-toggle="tab" onclick="getData2()">Acc
                                    <sup><span class="badge badge-success">{{ $acc->count() ?? 0 }}</span></sup></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#references" role="tab" data-toggle="tab"
                                    onclick="getData3()">Ditolak <sup><span
                                            class="badge badge-danger">{{ $tolak->count() ?? 0 }}</span></sup></a>
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

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form">
                        <div class="modal-header p-3">
                            <h5 class="modal-title m-2" id="exampleModalLabel">Ubah Status Usulan</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select name="status" id="status" class="form-control border" required>
                                    <option value="">--Pilih--</option>
                                    <option value="0">Baru</option>
                                    <option value="1">ACC</option>
                                    <option value="2">Tolak</option>
                                </select>
                            </div>

                            <input name="token_akses" id="token_akses" type="hidden" placeholder="Token Akses"
                                class="form-control form-control-sm" aria-describedby="emailHelp" required>

                            <div class="form-group">
                                <label for="keterangan_respon">Ketarangan</label>
                                <input name="keterangan_respon" id="keterangan_respon" type="text"
                                    placeholder="Keterangan" class="form-control form-control-sm"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            <button id="tombol_kirim" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formTolak">
                        <div class="modal-header p-3">
                            <h5 class="modal-title m-2" id="exampleModalLabel">Ubah Status Usulan</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="idTolak" id="idTolak">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select name="statusTolak" id="statusTolak" class="form-control border">
                                    <option value="2">Tolak</option>
                                </select>
                            </div>

                            <input name="token_akses" id="token_akses" type="hidden" placeholder="Token Akses"
                                class="form-control form-control-sm" aria-describedby="emailHelp" required>

                            <div class="form-group">
                                <label for="keterangan_responTolak">Ketarangan</label>
                                <input name="keterangan_responTolak" id="keterangan_responTolak" type="text"
                                    placeholder="Keterangan" class="form-control form-control-sm" disabled
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </form>
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
            $('#myTable').DataTable().clear().destroy();
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
                            <a href="${row.link_video}" target="_blank"> 
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

        function getData2() {
            $('#myTable2').DataTable().clear().destroy();
            $("#myTable2").DataTable({
                "ordering": false,
                scrollX: true,
                scrollCollapse: true,
                ajax: '/data-usulan-proposal-acc',
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
                            <a href="${row.link_video}" target="_blank"> 
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

        function getData3() {
            $('#myTable3').DataTable().clear().destroy();
            $("#myTable3").DataTable({
                "ordering": false,
                scrollX: true,
                scrollCollapse: true,
                ajax: '/data-usulan-proposal-tolak',
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
                            <a href="${row.link_video}" target="_blank"> 
                                <i style="font-size: 0.9rem;" class="bi bi-film"></i> Link Video
                            </a>
                            `
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a data-toggle="modal" data-target="#modalTolak"
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

        $('#modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('bs-id') // Extract info from data-* attributes
            var cok = $("#myTable").DataTable().rows().data().toArray()

            let cokData = cok.filter((dt) => {
                return dt.id == recipient;
            })

            document.getElementById("form").reset();
            document.getElementById('id').value = ''
            $('.error').empty();

            if (recipient) {
                var modal = $(this)
                modal.find('#id').val(cokData[0].id)
                modal.find('#status').val(cokData[0].status)
                modal.find('#token_akses').val(cokData[0].token_akses)
                modal.find('#keterangan_respon').val(cokData[0].keterangan)
            }
        })

        $('#modalTolak').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('bs-id') // Extract info from data-* attributes
            var cok = $("#myTable3").DataTable().rows().data().toArray()

            let cokData = cok.filter((dt) => {
                return dt.id == recipient;
            })

            document.getElementById("form").reset();
            document.getElementById('id').value = ''
            $('.error').empty();

            if (recipient) {
                var modal = $(this)
                modal.find('#idTolak').val(cokData[0].id)
                modal.find('#statusTolak').val(cokData[0].status)
                modal.find('#keterangan_responTolak').val(cokData[0].keterangan)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: formData.get('id') == '' ? '/store-usulan-judul' : '/update-status-usulan-proposal',
                    data: formData,
                })
                .then(function(res) {
                    //handle success         
                    if (res.data.responCode == 1) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: res.data.respon,
                            timer: 3000,
                            showConfirmButton: false
                        })

                        // $("#modal").modal("hide");
                        // $('#myTable').DataTable().clear().destroy();
                        // getData()

                        setTimeout(() => {
                            location.reload(res.data.respon);
                        }, 1500);

                    } else {
                        //error validation
                        document.getElementById('status_alert').innerHTML = res.data.respon.statys ?? ''
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function(res) {
                    document.getElementById("tombol_kirim").disabled = false;
                    //handle error
                    console.log(res);
                });
        }

        hapusData = (id) => {
            Swal.fire({
                title: "Yakin hapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"

            }).then((result) => {

                if (result.value) {
                    axios.post('/delete-dosen', {
                            id
                        })
                        .then((response) => {
                            if (response.data.responCode == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    timer: 2000,
                                    showConfirmButton: false
                                })

                                $('#myTable').DataTable().clear().destroy();
                                getData();

                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal...',
                                    text: response.data.respon,
                                })
                            }
                        }, (error) => {
                            console.log(error);
                        });
                }

            });
        }
    </script>
@endpush
