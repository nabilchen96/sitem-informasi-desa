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
                    <h3 class="font-weight-bold">Data Kontrak</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#modal">
                        Tambah
                    </button>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul Penelitian</th>
                                    <th>Nama Peneliti</th>
                                    <th>Tanggal Upload</th>
                                    <th>Status</th>
                                    <th width="5%"></th>
                                    <th width="5%"></th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    <div class="modal-header p-3">
                        <h5 class="modal-title m-2" id="exampleModalLabel">Kontrak Form</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Judul Penelitian <sup class="text-danger">*</sup></label>
                            <?php
                            $data = DB::table('usulan_juduls')
                                ->where('status', '1')
                                ->get();
                            ?>
                            <select name="token_akses" id="token_akses" class="form-control">
                                <option value="">--PILIH JUDUL PENELITIAN--</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->token_akses }}">{{ $item->nama_ketua }} -
                                        {{ $item->judul_penelitian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File Kontrak<sup class="text-danger">*</sup></label>
                            <input name="file" id="file" type="file" placeholder="file"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--STATUS KONTRAK--</option>
                                <option>BARU</option>
                                <option>ACC</option>
                                <option>TOLAK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jadwal</label>
                            <?php
                            $j = DB::table('jadwals as j')
                                ->leftjoin('kegiatans as k', 'k.id', '=', 'j.kegiatan_id')
                                ->where('k.status', '1')
                                ->select('j.*')
                                ->get();
                            ?>
                            <select name="jadwal_id" id="jadwal_id" class="form-control" required>
                                <option value="">--PILIH JADWAL--</option>
                                @foreach ($j as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_jadwal }}</option>
                                @endforeach
                            </select>
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
                ajax: '/data-kontrak',
                scrollX: true,
                scrollCollapse: true,
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
                        render: function(data, type, row, meta){
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
                        data: 'created_at'
                    },
                    {
                        render: function(data, type, row, meta) {
                            if (row.status == "0") {
                                return `Baru`
                            } else if (row.status == "2") {
                                return `ACC`
                            } else {
                                return `Ditolak`
                            }
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a href="/file_kontrak/${row.file_kontrak}">
                                    <i style="font-size: 1.5rem;" class="text-info bi bi-cloud-arrow-down"></i>
                                </a>`
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
                modal.find('#token_akses').val(cokData[0].token_akses)
                modal.find('#status').val(cokData[0].status)
                modal.find('#jadwal_id').val(cokData[0].jadwal_id)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: formData.get('id') == '' ? '/store-kontrak' : '/update-kontrak',
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

                        $("#modal").modal("hide");
                        $('#myTable').DataTable().clear().destroy();
                        getData()

                    } else {
                        //error validation
                        console.log('error');
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
                    axios.post('/delete-kontrak', {
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
