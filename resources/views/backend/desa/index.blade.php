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
                    <h3 class="font-weight-bold">Data Desa</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    @php
                        $desa = DB::table('desas')->count();
                    @endphp
                    @if ($desa == 0)
                        <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#modal">
                            Tambah
                        </button>
                    @endif
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered"
                            style="vertical-align: text-top !important; width: 100%;">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Desa / Kepala Desa</th>
                                    <th>Kec. / Kab. / Kota</th>
                                    <th>Prov. / Alamat</th>
                                    <th>Website / Telp.</th>
                                    <th>Luas / Status</th>
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
                        <h5 class="modal-title m-2" id="exampleModalLabel">Desa Form</h5>
                    </div>
                    <div class="modal-body">
                        <div id="respon_error" class="text-danger mb-4"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Nama Desa</label>
                            <input name="desa" id="desa" type="text" placeholder="desa" class="form-control form-control-sm"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Kepala Desa/Lurah</label>
                            <input name="kepala_desa" id="kepala_desa" type="text" placeholder="kepala Desa"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input name="kecamatan" id="kecamatan" type="text" placeholder="Kecamatan"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Kabupaten/Kota</label>
                            <input name="kabupaten" id="kabupaten" type="text" placeholder="Kabupaten/Kota"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input name="provinsi" id="provinsi" type="text" placeholder="provinsi"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" id="alamat" placeholder="Alamat" required
                                class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Luas Wilayah</label>
                            <input name="luas_wilayah" id="luas_wilayah" type="number" placeholder="Luas Wilayah"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="">PILIH STATUS</option>
                                <option>Desa</option>
                                <option>Kelurahan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input name="website" id="website" type="text" placeholder="Website"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>telepon</label>
                            <input name="telepon" id="telepon" type="text" placeholder="Telepon"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Tentang</label>
                            <textarea name="tentang" id="tentang" placeholder="Tentang" required
                                class="form-control form-control-sm"></textarea>
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
                ajax: '/data-desa',
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
                        <b>Desa: </b><br>
                        ${row.desa} <br><br>

                        <b>Kepala Desa: </b><br>
                        ${row.kepala_desa} <br><br>`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <b>Kecamatan: </b><br>
                        ${row.kecamatan} <br><br>

                        <b>Kabupaten/Kota: </b><br>
                        ${row.kabupaten} <br><br>
                        `
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <b>Provinsi: </b><br>
                        ${row.provinsi} <br><br>

                        <b>Alamat: </b><br>
                        ${row.alamat} <br><br>
                        `
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <b>Website: </b><br>
                        ${row.website} <br><br>

                        <b>Telepon: </b><br>
                        ${row.telepon} <br><br>
                        `
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        <b>Luas Wilayah: </b><br>
                        ${row.luas_wilayah} <br><br>

                        <b>Status: </b><br>
                        ${row.status} <br><br>
                        `
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
                modal.find('#desa').val(cokData[0].desa);
                modal.find('#kepala_desa').val(cokData[0].kepala_desa);
                modal.find('#kecamatan').val(cokData[0].kecamatan);
                modal.find('#kabupaten').val(cokData[0].kabupaten);
                modal.find('#provinsi').val(cokData[0].provinsi);
                modal.find('#luas_wilayah').val(cokData[0].luas_wilayah);
                modal.find('#status').val(cokData[0].status);
                modal.find('#website').val(cokData[0].website);
                modal.find('#telepon').val(cokData[0].telepon);
                modal.find('#tentang').val(cokData[0].tentang);
                modal.find('#alamat').val(cokData[0].alamat);
            }
        });



        form.onsubmit = (e) => {

            let formData = new FormData(form);

            document.getElementById('respon_error').innerHTML = ``

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: formData.get('id') == '' ? '/store-desa' : '/update-desa',
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
                    axios.post('/delete-desa', {
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