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
                    <h3 class="font-weight-bold">Berita</h3>
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
                                    <th width="80px">Gambar</th>
                                    <th>Judul</th>
                                    <th>Tgl Publikasi</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Kategori</th>
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
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    <div class="modal-header p-3">
                        <h5 class="modal-title m-2" id="exampleModalLabel">Form Berita</h5>
                    </div>
                    <div class="modal-body">
                        <div id="respon_error" class="text-danger mb-4"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Judul <sup class="text-danger">*</sup></label>
                            <input name="judul" id="judul" type="text" placeholder="Judul Berita"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori <sup class="text-danger">*</sup></label>
                            <select name="kategori" id="kategori" class="form-control form-control-sm">
                                <option>Berita Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Gambar Utama <sup class="text-danger">*</sup></label>
                            <input type="file" name="gambar_utama" id="gambar_utama" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Konten <sup class="text-danger">*</sup></label>
                            <div id="editor" style="height: 200px;"></div>
                            <input type="hidden" name="konten" id="konten">
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
    <!-- Tambahkan Quill JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        document.getElementById('form').onsubmit = function () {
            document.getElementById('konten').value = quill.root.innerHTML;
        };
    </script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            getData()
        })
        function getData() {
            $("#myTable").DataTable({
                "ordering": true,
                ajax: '/data-berita',
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
                            <div style="
                                border-radius: 10px;
                                background-image: url('/storage/${row.gambar_utama}');
                                width: 80px;
                                aspect-ratio: 1/1;
                                background-size: cover;
                                background-position: center;
                            ">
                            </div>
                        `
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        ${row.judul} <br><br>`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                        ${row.created_at} <br><br>`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                            ${row.name} <br><br>`;
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `
                            ${row.kategori}<br><br>`;
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

            quill.root.innerHTML = ``;

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
                modal.find('#judul').val(cokData[0].judul);
                modal.find('#kategori').val(cokData[0].kategori);
                modal.find('#konten').val(cokData[0].konten);
                // modal.find('#tgl_mulai').val(cokData[0].tgl_mulai);
                // modal.find('#tgl_selesai').val(cokData[0].tgl_selesai);
                quill.root.innerHTML = cokData[0].konten;
            }
        });



        form.onsubmit = (e) => {
            e.preventDefault();

            // Ambil data dari Quill dan masukkan ke dalam formData
            let formData = new FormData(form);
            formData.set('konten', quill.root.innerHTML); // Menambahkan konten dari Quill

            document.getElementById('respon_error').innerHTML = ``;
            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: formData.get('id') == '' ? '/store-berita' : '/update-berita',
                data: formData,
            })
                .then(function (res) {
                    if (res.data.responCode == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: res.data.respon,
                            timer: 3000,
                            showConfirmButton: false
                        });

                        $("#modal").modal("hide");
                        $('#myTable').DataTable().clear().destroy();
                        getData();
                    } else {
                        // Handle error response
                        let respon_error = ``;
                        Object.entries(res.data.respon).forEach(([field, messages]) => {
                            messages.forEach(message => {
                                respon_error += `<li>${message}</li>`;
                            });
                        });

                        document.getElementById('respon_error').innerHTML = respon_error;
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function (error) {
                    console.log(error);
                    document.getElementById("tombol_kirim").disabled = false;
                });
        };

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
                    axios.post('/delete-berita', {
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