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
                <h3 class="font-weight-bold">Data
                    {{ $jenis = DB::table('jenis_dokumens')->where('id', Request('jenis_dokumen'))->value('jenis_dokumen') }}
                </h3>
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
                                <th>Pemilik</th>
                                <th>Jenis Dokumen</th>
                                <th>Tanggal Upload</th>
                                <th width="5%">PDF</th>
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
                    <h5 class="modal-title m-2" id="exampleModalLabel">Dokumen Form</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_dokumen" id="id_dokumen" value="{{ Request('jenis_dokumen') }}">
                    <div class="form-group">
                        <label>Dokumen</label>
                        <input name="dokumen" id="dokumen" type="file" placeholder="Dokumen"
                            class="form-control form-control-sm" accept=".pdf, image/*" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Dokumen</label>
                        <input type="text" placeholder="Dokumen" value="{{ $jenis }}"
                            class="form-control form-control-sm" required readonly>
                    </div>
                    <div class="form-group">
                        <label>Pemilik</label>
                        <?php $users = DB::table('users')->get(); ?>
                        <select name="status" id="status" class="form-control" required>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            getData()
        })

        function getData() {

            // Mendapatkan query string dari URL
            let params = new URLSearchParams(window.location.search);

            // Mendapatkan nilai parameter
            let jenis_dokumen = params.get('jenis_dokumen'); // "John"

            $("#myTable").DataTable({
                "ordering": false,
                ajax: '/data-file-dokumen?jenis_dokumen=' + jenis_dokumen,
                processing: true,
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
                    data: "name"
                },
                {
                    data: "jenis_dokumen"
                },
                {
                    data: "created_at"
                },
                {
                    render: function (data, type, row, meta) {
                        return `<a target="_blank" href="/convert-to-pdf/${ row.dokumen }">
                            <i style="font-size: 1.5rem;" class="text-danger bi bi-file-earmark-pdf"></i>
                        </a>`
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
                        return `<a href="javascript:void(0)" onclick="hapusData(` + (row
                            .id) + `)">
                            <i style="font-size: 1.5rem;" class="text-danger bi bi-trash"></i>
                        </a>`
                    }
                },
                ]
            })
        }

        $('#modal').on('show.bs.modal', function (event) {
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
                modal.find('#jenis_dokumen').val(cokData[0].jenis_dokumen)
                modal.find('#status').val(cokData[0].status)
                modal.find('#role').val(cokData[0].role)
                modal.find('#no_wa').val(cokData[0].no_wa)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: formData.get('id') == '' ? '/store-file-dokumen' : '/update-file-dokumen',
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

                        location.reload('/file-dokumen')

                    } else {

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
                    axios.post('/delete-file-dokumen', {
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