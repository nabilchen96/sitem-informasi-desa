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
    </style>
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold text-white">Data Dosen</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    {{-- @if (Auth::user()->role == 'Admin')                         --}}
                        <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#modal">
                            Tambah
                        </button>
                    {{-- @endif --}}
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>Token Akses</th>
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
                        <h5 class="modal-title m-2" id="exampleModalLabel">Dosen Form</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input name="nip" id="nip" type="text" placeholder="NIP"
                                class="form-control form-control-sm" aria-describedby="emailHelp" required>
                            <span class="text-danger error" style="font-size: 12px;" id="nip_alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama_dosen">Nama Lengkap</label>
                            <input name="nama_dosen" id="nama_dosen" type="text" placeholder="Nama Lengkap"
                                class="form-control form-control-sm" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" id="email" type="email" placeholder="email"
                                class="form-control form-control-sm" aria-describedby="emailHelp" required>
                            <span class="text-danger error" style="font-size: 12px;" id="email_alert"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="no_wa">No. WA (Aktif)</label>
                            <input name="no_wa" id="no_wa" type="text" placeholder="62899328812"
                                class="form-control form-control-sm" aria-describedby="no_waHelp" required>
                            <span class="text-danger error" style="font-size: 12px;" id="no_wa_alert"></span>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Aktif</label>
                            <select name="is_active" class="form-control" id="is_active" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getData()
        })

        function getData() {
            $("#myTable").DataTable({
                "ordering": false,
                ajax: '/data-dosen',
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
                        data: "nip"
                    },
                    {
                        data: "nama_dosen"
                    },
                    {
                        render: function(data, type, row, meta) {
                            if (row.jenis_kelamin == "Laki-laki") {
                                return `<span class="badge badge-success">${row.jenis_kelamin}</span>`
                            } else if (row.jenis_kelamin == "Perempuan") {
                                return `<span class="badge badge-danger">Laboran</span>`
                            }
                        }
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "token_akses"
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
                modal.find('#nip').val(cokData[0].nip)
                modal.find('#email').val(cokData[0].email)
                modal.find('#nama_dosen').val(cokData[0].nama_dosen)
                modal.find('#jenis_kelamin').val(cokData[0].jenis_kelamin)
                modal.find('#token_akses').val(cokData[0].token_akses)
                modal.find('#no_wa').val(cokData[0].no_wa)
                modal.find('#is_active').val(cokData[0].is_active)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: formData.get('id') == '' ? '/store-dosen' : '/update-dosen',
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
                        document.getElementById('nip_alert').innerHTML = res.data.respon.nip ?? ''
                        document.getElementById('nama_dosen_alert').innerHTML = res.data.respon.nama_dosen ?? ''
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
                    axios.post('/delete-user', {
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
