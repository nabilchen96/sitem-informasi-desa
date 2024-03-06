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
                    <h3 class="font-weight-bold">Data Jadwal</h3>
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
                                    <th>Nama Kegiatan</th>
                                    <th>Jadwal</th>
                                    <th>Tanggal</th>
                                    <th>Tahapan</th>
                                    <th>Status</th>
                                    <th>Tahap Ke</th>
                                    <th>Publish Pengumuman?</th>
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
                        <h5 class="modal-title m-2" id="exampleModalLabel">Jadwal Form</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="kegiatan_id">Kegiatan</label>
                            <select name="kegiatan_id" class="form-control" id="kegiatan_id" required>
                                @foreach ($kegiatans as $kg)
                                    <option value="{{ $kg->id }}">{{ $kg->nama_kegiatan }} | {{ $kg->tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_jadwal">Nama Jadwal</label>
                            <input name="nama_jadwal" id="nama_jadwal" type="text" placeholder="Nama Jadwal"
                                class="form-control form-control-sm" aria-describedby="emailHelp" required>
                            <span class="text-danger error" style="font-size: 12px;" id="nama_jadwal_alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_awal">Tgl Mulai</label>
                            <input name="tanggal_awal" id="tanggal_awal" type="date" placeholder="Tahun"
                                class="form-control form-control-sm" aria-describedby="tanggal_awalHelp" required>
                            <span class="text-danger error" style="font-size: 12px;" id="tanggal_awal_alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir">Tgl Selesai</label>
                            <input name="tanggal_akhir" id="tanggal_akhir" type="date" placeholder="Tahun"
                                class="form-control form-control-sm" aria-describedby="tanggal_akhirHelp" required>
                            <span class="text-danger error" style="font-size: 12px;" id="tanggal_akhir_alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="tahapan">Tahapan</label>
                            <select name="tahapan" class="form-control" id="tahapan" required>
                                <option value="Pengusulan">Pengusulan</option>
                                <option value="Pelaksanaan">Pelaksanaan</option>
                                <option value="Penyelesaian">Penyelesaian</option>
                            </select>
                            <span class="text-danger error" style="font-size: 12px;" id="tahapan_alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="tahap_ke">Tahapan</label>
                            <select name="tahap_ke" class="form-control" id="tahap_ke" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <span class="text-danger error" style="font-size: 12px;" id="tahap_ke_alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="publish_pengumuman">Publish Pengumuman?</label>
                            <select name="publish_pengumuman" class="form-control" id="publish_pengumuman" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kirim_wa">Kirim WA?</label>
                            <select name="kirim_wa" class="form-control" id="kirim_wa" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="komen">Komentar</label>
                            <textarea name="komen" id="komen" class="form-control" cols="30" rows="10"></textarea>
                            <span class="text-danger error" style="font-size: 12px;" id="komen_alert"></span>
                        </div>
                        <div class="form-group">
                            <label>File Pendukung</label>
                            <input name="file_upload" id="file_upload" type="file" placeholder="Upload File"
                                class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="nama_file">Nama File</label>
                            <input name="nama_file" id="nama_file" type="text" placeholder="Nama File"
                                class="form-control form-control-sm" aria-describedby="emailHelp">
                            <span class="text-danger error" style="font-size: 12px;" id="nama_file_alert"></span>
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
                scrollX: true,
                scrollCollapse: true,
                ajax: '/data-jadwal',
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
                        data: "nama_kegiatan"
                    },
                    {
                        data: "nama_jadwal"
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `${row.tanggal_awal} s/d ${row.tanggal_akhir}`
                        }
                    },
                    {
                        data: "tahapan"
                    },
                    {
                        render: function(data, type, row, meta) {
                            if (row.status == "0") {
                                return `<span class="badge badge-danger">Non Aktif</span>`
                            } else if (row.status == "1") {
                                return `<span class="badge badge-success">Aktif</span>`
                            }
                        }
                    },
                    {
                        data: "tahap_ke"
                    },
                    {
                        render: function(data, type, row, meta) {
                            if (row.publish_pengumuman == "0") {
                                return `<span class="badge badge-danger">Tidak</span>`
                            } else if (row.publish_pengumuman == "1") {
                                return `<span class="badge badge-success">Ya</span>`
                            }
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a href="/file_pengumuman/${row.file_upload}">
                                    <i style="font-size: 1.5rem;" class="text-danger bi bi-file-earmark-text"></i>
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
                modal.find('#kegiatan_id').val(cokData[0].kegiatan_id)
                modal.find('#nama_jadwal').val(cokData[0].nama_jadwal)
                modal.find('#tanggal_awal').val(cokData[0].tanggal_awal)
                modal.find('#tanggal_akhir').val(cokData[0].tanggal_akhir)
                modal.find('#tahapan').val(cokData[0].tahapan)
                modal.find('#tahap_ke').val(cokData[0].tahap_ke)
                modal.find('#status').val(cokData[0].status)
                modal.find('#publish_pengumuman').val(cokData[0].publish_pengumuman)
                modal.find('#nama_file').val(cokData[0].nama_file)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: formData.get('id') == '' ? '/store-jadwal' : '/update-jadwal',
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
                        document.getElementById('nama_jadwal_alert').innerHTML = res.data.respon.nama_jadwal ?? ''
                        document.getElementById('kegiatan_id_alert').innerHTML = res.data.respon.kegiatan_id ?? ''
                        document.getElementById('tanggal_awal_alert').innerHTML = res.data.respon.tanggal_awal ?? ''
                        document.getElementById('tanggal_akhir_alert').innerHTML = res.data.respon.tanggal_akhir ??
                            ''
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
                    axios.post('/delete-jadwal', {
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
