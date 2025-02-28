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
                    <h3 class="font-weight-bold">Program dan Agenda</h3>
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
                                    <th width="25%">Program / Lokasi</th>
                                    <th width="20%">Mulai / Selesai</th>
                                    <th>Status / Keterangan</th>
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
                        <h5 class="modal-title m-2" id="exampleModalLabel">Program dan Agenda Form</h5>
                    </div>
                    <div class="modal-body">
                        <div id="respon_error" class="text-danger mb-4"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Program <sup class="text-danger">*</sup></label>
                            <input name="program" id="program" type="text" placeholder="program"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Lokasi <sup class="text-danger">*</sup></label>
                            <input name="lokasi" id="lokasi" type="text" placeholder="Lokasi"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi <sup class="text-danger">*</sup></label>
                            <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi" required
                                class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Mulai <sup class="text-danger">*</sup></label>
                            <input type="datetime-local" name="tgl_mulai" id="tgl_mulai"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Selesai <sup class="text-danger">*</sup></label>
                            <input name="tgl_selesai" id="tgl_selesai" type="datetime-local"
                                class="form-control form-control-sm" required>
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
                ajax: '/data-program',
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
                        return `<b>Program: </b><br>${row.program} <br><br> <b>Lokasi: </b><br>${row.lokasi}`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                            <b>Tanggal Mulai: </b><br>
                            ${row.tgl_mulai} <br><br> 

                            <b>Tanggal Selesai</b><br>
                            ${row.tgl_selesai}`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        let sekarang = new Date();
                        let tglMulai = new Date(row.tgl_mulai);
                        let tglSelesai = new Date(row.tgl_selesai);

                        let status;
                        if (sekarang < tglMulai) {
                            status = "Belum Dimulai";
                        } else if (sekarang >= tglMulai && sekarang <= tglSelesai) {
                            status = "Sedang Berjalan";
                        } else {
                            status = "Sudah Lewat";
                        }

                        return `
                        <b>Status: </b><br>
                        <span class="badge bg-info text-white" style="border-radius: 8px;">${status}</span> <br><br>

                        <b>Deskripsi: </b><br>
                        ${row.deskripsi}
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
                modal.find('#program').val(cokData[0].program);
                modal.find('#lokasi').val(cokData[0].lokasi);
                modal.find('#deskripsi').val(cokData[0].deskripsi);
                modal.find('#tgl_mulai').val(cokData[0].tgl_mulai);
                modal.find('#tgl_selesai').val(cokData[0].tgl_selesai);
            }
        });



        form.onsubmit = (e) => {

            let formData = new FormData(form);

            document.getElementById('respon_error').innerHTML = ``

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: formData.get('id') == '' ? '/store-program' : '/update-program',
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
                    axios.post('/delete-program', {
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