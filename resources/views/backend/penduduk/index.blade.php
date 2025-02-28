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
            white-space: nowrap;
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
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold">Data Penduduk</h3>
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
                        <table id="myTable" class="table table-striped table-bordered"
                            style="vertical-align: text-top !important; width: 100%;">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">NIK / Nama / Status</th>
                                    <th width="20%">JK / Tempat / Tgl Lahir</th>
                                    <th>Agama / Pekerjaan</th>
                                    <th>Alamat / KTP / KK</th>
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
                        <h5 class="modal-title m-2" id="exampleModalLabel">Form Data Penduduk</h5>
                    </div>
                    <div class="modal-body">
                        <div id="respon_error" class="text-danger mb-4"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>NIK <sup class="text-danger">*</sup></label>
                            <input name="nik" id="nik" type="text" placeholder="NIK" class="form-control form-control-sm"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap <sup class="text-danger">*</sup></label>
                            <input name="nama_lengkap" id="nama_lengkap" type="text" placeholder="Nama Lengkap"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input name="tempat_lahir" id="tempat_lahir" type="text" placeholder="Tempat Lahir"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm">
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" id="alamat" placeholder="Alamat"
                                class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" id="agama" class="form-control form-control-sm">
                                <option value="">Pilih</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Perkawinan <sup class="text-danger">*</sup></label>
                            <select name="status_perkawinan" required id="status_perkawinan" class="form-control form-control-sm">
                                <option value="">Pilih</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input name="pekerjaan" id="pekerjaan" type="text" placeholder="Pekerjaan"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input name="pendidikan_terakhir" id="pendidikan_terakhir" type="text"
                                placeholder="Pendidikan Terakhir" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumen KK</label>
                            <input type="file" name="dokumen_kk" id="dokumen_kk" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumen KTP</label>
                            <input type="file" name="dokumen_ktp" id="dokumen_ktp" class="form-control form-control-sm">
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
        document.addEventListener('DOMContentLoaded', function () {
            getData()
        })
        function getData() {
            $("#myTable").DataTable({
                "ordering": true,
                ajax: '/data-penduduk',
                processing: true,
                scrollX: true,
                scrollCollapse: true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...'
                },
                columns: [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <div class="mb-3">
                            <b>Nama: </b><br>
                            ${row.nama_lengkap}
                        </div>
                        <div class="mb-3">
                            <b>NIK: </b><br>
                            ${row.nik}
                        </div>

                        <b>Status</b><br>
                        <span class="badge bg-info text-white" style="border-radius: 8px;">
                            ${row.status_perkawinan}
                        </span>
                        `
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <div class="mb-3">
                            <b>Jenis Kelamin: </b><br>
                            ${row.jenis_kelamin}
                        </div>
                        <div class="mb-3">
                            <b>Tanggal Lahir: </b><br>
                            ${row.tanggal_lahir}
                        </div> 

                        <b>Tempat Lahir</b><br>
                        ${row.tempat_lahir}`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <div class="mb-3">
                            <b>Agama: </b><br>
                            ${row.agama}
                        </div>

                        <div class="mb-3">
                            <b>Pendidikan Terakhir: </b><br>
                            ${row.pendidikan_terakhir}
                        </div>

                        <b>Pekerjaan: </b><br>
                        ${row.pekerjaan}`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <div class="mb-3">
                            <b>KTP: </b><br>
                            <a href="storage/${row.dokumen_ktp}">
                                <i class="bi bi-file-earmark-arrow-down"></i> 
                                Download KTP
                            </a>
                        </div>
                        <div class="mb-3">
                            <b>KK: </b><br>
                            <a href="storage/${row.dokumen_ktp}">
                                <i class="bi bi-file-earmark-arrow-down"></i> 
                                Download KK
                            </a>
                        </div>

                        <b>Alamat: </b><br>
                        ${row.alamat}
                        `;
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `<a data-toggle="modal" data-target="#modal"
                            data-bs-id=` + (row.id) + ` href="javascript:void(0)">
                            <i style="font-size: 1.5rem;" class="text-success bi bi-grid"></i>
                        </a>`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `<a href="javascript:void(0)" onclick="hapusData(` + (row.id) + `)">
                            <i style="font-size: 1.5rem;" class="text-danger bi bi-trash"></i>
                        </a>`
                    }
                },
                ]
            })
        }

        $('#modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('bs-id'); // Extract info from data-* attributes
            var cok = $("#myTable").DataTable().rows().data().toArray();

            let cokData = cok.filter((dt) => {
                return dt.id == recipient;
            });

            document.getElementById("form").reset();
            document.getElementById('id').value = '';
            $('.error').empty();

            if (recipient) {
                // Edit Mode
                var modal = $(this);
                modal.find('#id').val(cokData[0].id);
                modal.find('#nama_lengkap').val(cokData[0].nama_lengkap);
                modal.find('#nik').val(cokData[0].nik);
                modal.find('#tanggal_lahir').val(cokData[0].tanggal_lahir);
                modal.find('#tempat_lahir').val(cokData[0].tempat_lahir);
                modal.find('#jenis_kelamin').val(cokData[0].jenis_kelamin);
                modal.find('#alamat').val(cokData[0].alamat);
                modal.find('#agama').val(cokData[0].agama);
                modal.find('#status_perkawinan').val(cokData[0].status_perkawinan);
                modal.find('#pekerjaan').val(cokData[0].pekerjaan);
                modal.find('#pendidikan_terakhir').val(cokData[0].pendidikan_terakhir);
            }
        });



        form.onsubmit = (e) => {

            let formData = new FormData(form);

            document.getElementById('respon_error').innerHTML = ``

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: formData.get('id') == '' ? '/store-penduduk' : '/update-penduduk',
                data: formData,
            })
                .then(function (res) {
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
                        //respon 
                        let respon_error = ``
                        Object.entries(res.data.respon).forEach(([field, messages]) => {
                            messages.forEach(message => {
                                respon_error += `<li>${message}</li>`;
                            });
                        });

                        document.getElementById('respon_error').innerHTML = respon_error

                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function (res) {
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
                    axios.post('/delete-penduduk', {
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