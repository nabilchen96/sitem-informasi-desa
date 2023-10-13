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
                    <h3 class="font-weight-bold">Data Pengajuan Judul</h3>
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
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home" role="tab" data-toggle="tab"
                                onclick="getData()">Baru <sup><span class="badge badge-warning">1</span></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab" onclick="getData2()">Acc
                                <sup><span class="badge badge-success">2</span></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#references" role="tab" data-toggle="tab"
                                onclick="getData3()">Ditolak <sup><span class="badge badge-danger">3</span></sup></a>
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
                                            <th>Prodi</th>
                                            <th>Jenis Penelitian</th>
                                            <th>Sub Topik Penelitian</th>
                                            <th>Pelaksanaan Penelitian</th>
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
                                            <th>Prodi</th>
                                            <th>Jenis Penelitian</th>
                                            <th>Sub Topik Penelitian</th>
                                            <th>Pelaksanaan Penelitian</th>
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
                                            <th>Prodi</th>
                                            <th>Jenis Penelitian</th>
                                            <th>Sub Topik Penelitian</th>
                                            <th>Pelaksanaan Penelitian</th>
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
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form">
                        <div class="modal-header p-3">
                            <h5 class="modal-title m-2" id="exampleModalLabel">Dosen Form</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="judul_penelitian">Judul Penelitian</label>
                                <input name="judul_penelitian" id="judul_penelitian" type="text" placeholder="NIP"
                                    class="form-control form-control-sm" aria-describedby="emailHelp" required>
                                <span class="text-danger error" style="font-size: 12px;" id="judul_penelitian_alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="nama_ketua">Nama Ketua</label>
                                <input name="nama_ketua" id="nama_ketua" type="text" placeholder="Nama Ketua"
                                    class="form-control form-control-sm" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Program Studi</label>
                                <select name="program_studi" id="program_studi" class="form-control border" required>
                                    <option value="">--Pilih Prodi--</option>
                                    <option>DIV TRBU</option>
                                    <option>DIII PPKP</option>
                                    <option>DIII MBU</option>
                                </select>
                                <span class="text-danger error" style="font-size: 12px;" id="program_studi_alert"></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis Penelitian</label>
                                <select name="jenis_penelitian" id="jenis_penelitian" class="form-control border" required>
                                    <option value="">--Pilih Jenis Penelitian--</option>
                                    <option>Dasar</option>
                                    <option>Terapan</option>
                                    <option>Pengembangan</option>
                                    <option>Pengembangan Lanjutan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_active">Sub Topik</label>
                                <select name="sub_topik" id="sub_topik" class="form-control border" required>
                                    <option value="">--Pilih Sub Topik Penelitian--</option>
                                    <option>Aviation of Learning Technology</option>
                                    <option>Evaluation of Education Management</option>
                                    <option>Development of Learning Technology</option>
                                    <option>Implementation of Learning Media</option>
                                    <option>Airport Design, Planning, Maintenance</option>
                                    <option>Eco/Smart Airport</option>
                                    <option>Automation System</option>
                                    <option>Fire Engineering</option>
                                    <option>Aviation Safety</option>
                                    <option>Aviation Security</option>
                                    <option>Aviation Services</option>
                                    <option>Human Resources Deevelopment</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis Pelaksanaan</label>
                                <select name="jenis_pelaksanaan" id="jenis_pelaksanaan" class="form-control border" required>
                                    <option value="">--Pilih Jenis Pelaksanaan--</option>
                                    <option>Kelompok</option>
                                    <option>Mandiri</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select name="status" id="status" class="form-control border" required>
                                    <option value="">--Pilih--</option>
                                    <option value="0">Baru</option>
                                    <option value="1">ACC</option>
                                    <option value="2">Tolak</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="token_akses">Token Akses</label>
                                <input name="token_akses" id="token_akses" type="text" placeholder="Token Akses"
                                    class="form-control form-control-sm" aria-describedby="emailHelp" required>
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
                ajax: '/data-usulan-judul',
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
                        data: "judul_penelitian"
                    },
                    {
                        data: "nama_ketua"
                    },
                    {
                        data: "program_studi"
                    },
                    {
                        data: "jenis_penelitian"
                    },
                    {
                        data: "sub_topik"
                    },
                    {
                        data: "jenis_pelaksanaan"
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
            $("#myTable2").DataTable({
                "ordering": false,
                scrollX: true,
                scrollCollapse: true,
                ajax: '/data-usulan-judul-acc',
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
                        data: "judul_penelitian"
                    },
                    {
                        data: "nama_ketua"
                    },
                    {
                        data: "program_studi"
                    },
                    {
                        data: "jenis_penelitian"
                    },
                    {
                        data: "sub_topik"
                    },
                    {
                        data: "jenis_pelaksanaan"
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
            $("#myTable3").DataTable({
                "ordering": false,
                scrollX: true,
                scrollCollapse: true,
                ajax: '/data-usulan-judul-tolak',
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
                        data: "judul_penelitian"
                    },
                    {
                        data: "nama_ketua"
                    },
                    {
                        data: "program_studi"
                    },
                    {
                        data: "jenis_penelitian"
                    },
                    {
                        data: "sub_topik"
                    },
                    {
                        data: "jenis_pelaksanaan"
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
                modal.find('#judul_penelitian').val(cokData[0].judul_penelitian)
                modal.find('#nama_ketua').val(cokData[0].nama_ketua)
                modal.find('#program_studi').val(cokData[0].program_studi)
                modal.find('#jenis_penelitian').val(cokData[0].jenis_penelitian)
                modal.find('#jenis_pelaksanaan').val(cokData[0].jenis_pelaksanaan)
                modal.find('#sub_topik').val(cokData[0].sub_topik)
                modal.find('#status').val(cokData[0].status)
                modal.find('#token_akses').val(cokData[0].token_akses)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: formData.get('id') == '' ? '/store-usulan-judul' : '/update-usulan-judul',
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
                        document.getElementById('judul_penelitian_alert').innerHTML = res.data.respon.judul_penelitian ?? ''
                        document.getElementById('status_alert').innerHTML = res.data.respon.status ?? ''
                        document.getElementById('email_alert').innerHTML = res.data.respon.email ?? ''
                        document.getElementById('no_wa_alert').innerHTML = res.data.respon.no_wa ?? ''
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
