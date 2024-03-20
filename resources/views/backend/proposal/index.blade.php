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
                                                <th >No</th>
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
                                                <th >No</th>
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
                                                <th >No</th>
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
                                        <th >No</th>
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
        @if (Auth::user()->role == 'Admin')
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
                                <input type="hidden" name="bentuk" id="bentuk" value="admin">
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
        @endif

        @if (Auth::user()->role == 'Reviewer')
            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="form">
                            <div class="modal-header p-3">
                                <h5 class="modal-title m-2" id="exampleModalLabel">Penilaian Proposal</h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="bentuk" id="bentuk" value="reviewer">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hari</label>
                                    <select name="hari" id="hari" class="form-control border" required>
                                        <option value="">--Pilih--</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="biaya_diusulkan">Biaya yang diusulkan ke Poltekbang Palembang</label>
                                    <input type="text" name="biaya_diusulkan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="biaya_direkomendasikan">Biaya yang Direkomendasikan</label>
                                    <input type="text" name="biaya_direkomendasikan" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="keterangan_respon">Dengan hasil penelitian sebagai berikut : </label>
                                    <table class="table">
                                        <tr>
                                            <td>No</td>
                                            <td>Kriteria</td>
                                            <td>Indikator</td>
                                            <td>Bobot(B)</td>
                                            <td>Skor(S)</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Relevansi Dengan RIP Poltekbang Palembang </td>
                                            <td>Tema dan Sub Tema sesuai dengan RIP Poltekbang Palembang </td>
                                            <td>15</td>
                                            <td>
                                                <input type="number" name="nilai_kriteria_1" min="1" max="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Perumusan Masalah</td>
                                            <td>Ketajaman rumusan masalah dan tujuan penelitian</td>
                                            <td>10</td>
                                            <td>
                                                <input type="number" name="nilai_kriteria_2" min="1" max="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Manfaat hasil penellitian</td>
                                            <td>Pembangunan Iptek, pembangunan dan/atau pengembangan kelembagaan</td>
                                            <td>15</td>
                                            <td>
                                                <input type="number" name="nilai_kriteria_3" min="1" max="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Tinjauan Pustaka</td>
                                            <td>Relevansi kemutakhiran, dan penyusunan daftar Pustaka</td>
                                            <td>20</td>
                                            <td>
                                                <input type="number" name="nilai_kriteria_4" min="1" max="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Metode Penelitian</td>
                                            <td>Ketepatan metode yang digunakan</td>
                                            <td>20</td>
                                            <td>
                                                <input type="number" name="nilai_kriteria_5" min="1" max="5">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Kelayakan penelitian</td>
                                            <td>Kesesuaian jadwal, kesesuaian keahlian personalia, kesesuaian ajuan dana</td>
                                            <td>20</td>
                                            <td>
                                                <input type="number" name="nilai_kriteria_6" min="1" max="5">
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="rekomendasi">Rekomendasi</label>
                                    <select name="rekomendasi" class="form-control" id="rekomendasi">
                                        <option value="Diterima">Diterima</option>
                                        <option value="Tidak Diterima">Tidak Diterima</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="saran_perbaikan">Saran Perbaikan (jika ada) bagi yang Diterima: </label>
                                    <textarea class="form-control" name="saran_perbaikan" id="saran_perbaikan" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="alasan_bagi_yang_tidak_diterima">Alasan bagi Yang Tidak Diterima:</label>
                                    <textarea class="form-control" name="alasan_bagi_yang_tidak_diterima" id="alasan_bagi_yang_tidak_diterima" cols="30" rows="10"></textarea>
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
        @endif

        <div class="modal fade" id="modalACC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formACC">
                        <div class="modal-header p-3">
                            <h5 class="modal-title m-2" id="exampleModalLabel">Tim Reviewer</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="idACC" id="idACC">
                            <div class="form-group">
                                <label for="reviewer1">Reviewer 1</label>
                                <select name="reviewer1" id="reviewer1" class="form-control border">
                                    <option value="">--Pilih--</option>
                                    @foreach ($reviewers as $rv)
                                        <option value="{{ $rv->id }}">{{ $rv->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error" style="font-size: 12px;" id="reviewer1_alert"></span>
                            </div>

                            <div class="form-group">
                                <label for="reviewer2">Reviewer 2</label>
                                <select name="reviewer2" id="reviewer2" class="form-control border">
                                    <option value="">--Pilih--</option>
                                    @foreach ($reviewers as $rv)
                                        <option value="{{ $rv->id }}">{{ $rv->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error" style="font-size: 12px;" id="reviewer2_alert"></span>
                            </div>

                        </div>
                        <div class="modal-footer p-3">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            <button id="tombol_kirim_acc" class="btn btn-primary btn-sm">Submit</button>
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

                            if (row.sudah_dinilai == "0") {
                                return `<a data-toggle="modal" data-target="#modal"
                                data-bs-id=` + (row.id) + ` href="javascript:void(0)">
                                <i style="font-size: 1.5rem;" class="text-warning bi bi-pencil"></i>
                            </a>`
                            } else {
                                return `<a data-toggle="modal" data-placement="top" title="Isi Nilai" data-target="#modal"
                                data-bs-id=` + (row.id) + ` href="javascript:void(0)">
                                <i style="font-size: 1.5rem;" class="text-warning bi bi-pencil"></i>
                            </a> &nbsp; <a title="Cetak Nilai" href="nilai/` + (row.id) + `" target="_blank">
                                <i style="font-size: 1.5rem;" class="text-success bi bi-printer"></i>
                            </a> `
                           
                            }
                            
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
                            return `<a data-toggle="modal" data-target="#modalACC"
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
            var button = $(event.relatedTarget)
            var recipient = button.data('bs-id')
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

        $('#modalACC').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('bs-id') // Extract info from data-* attributes
            var cok = $("#myTable2").DataTable().rows().data().toArray()

            let cokData = cok.filter((dt) => {
                return dt.id == recipient;
            })

            document.getElementById("form").reset();
            document.getElementById('id').value = ''
            $('.error').empty();

            if (recipient) {
                var modal = $(this)
                modal.find('#idACC').val(cokData[0].id)
                modal.find('#reviewer1').val(cokData[0].reviewer1_id)
                modal.find('#reviewer2').val(cokData[0].reviewer2_id)
            }
        })

        form.onsubmit = (e) => {
            
            let formData = new FormData(form);
            console.log(formData.get('bentuk'));

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;
            if(formData.get('bentuk') == 'admin') {
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

                        setTimeout(() => {
                            location.reload(res.data.respon);
                        }, 1500);

                    } else {
                        //error validation
                        document.getElementById('status_alert').innerHTML = res.data.respon.status ?? ''
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function(res) {
                    document.getElementById("tombol_kirim").disabled = false;
                    //handle error
                    console.log(res);
                });
            } else if(formData.get('bentuk') == 'reviewer') {
                axios({
                    method: 'post',
                    url: '/update-penilaian-proposal',
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

                        setTimeout(() => {
                            location.reload(res.data.respon);
                        }, 1500);

                    } else {
                        //error validation
                        document.getElementById('status_alert').innerHTML = res.data.respon.status ?? ''
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function(res) {
                    document.getElementById("tombol_kirim").disabled = false;
                    //handle error
                    console.log(res);
                });
            }
            
        }

        formACC.onsubmit = (e) => {

            let formData = new FormData(formACC);

            e.preventDefault();

            document.getElementById("tombol_kirim_acc").disabled = true;

            axios({
                    method: 'post',
                    url: '/update-reviewer-proposal',
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

                        $("#modalACC").modal("hide");
                        $('#myTable2').DataTable().clear().destroy();
                        getData2()

                    } else if (res.data.responCode == 2) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sukses',
                            text: res.data.respon,
                            timer: 3000,
                            showConfirmButton: false
                        })

                        $("#modalACC").modal("hide");
                        $('#myTable2').DataTable().clear().destroy();
                        getData2()
                    } else {
                        //error validation
                        document.getElementById('reviewer1_alert').innerHTML = res.data.respon.reviewer1 ?? ''
                        document.getElementById('reviewer2_alert').innerHTML = res.data.respon.reviewer2 ?? ''
                    }

                    document.getElementById("tombol_kirim_acc").disabled = false;
                })
                .catch(function(res) {
                    document.getElementById("tombol_kirim_acc").disabled = false;
                    //handle error
                    console.log(res);
                    Swal.fire({
                        icon: 'error',
                        title: 'Proses Error!',
                        text: res.response.data.message,
                        timer: 3000,
                        showConfirmButton: false
                    })
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
                    axios.post('/delete-usulan-proposal', {
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
