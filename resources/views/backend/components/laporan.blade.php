<table id="myTable" class="table table-striped table-bordered" style="width: 100%;">
    <thead class="table-dark">
        <tr class="row">
            <td class="col-12" colspan="3">Keluhan dan Aduan Masyarakat</td>
        </tr>
    </thead>
    @php
        $laporan = DB::table('laporans')->get();
    @endphp
    @foreach ($laporan as $k => $l)
        <tr class="row mt-3">
            <td class="col-lg-3 col-6">
                <b> Tanggal Laporan: </b><br>
                {{ $l->created_at }}<br><br>

                <b> Laporan: </b><br>
                {{ $l->laporan }}
            </td>
            <td class="col-lg-2 col-6">
                <b>Gambar Laporan: </b><br>
                <a href="storage/{{ $l->gambar_laporan }}">
                    <i class="bi bi-eye-fill"></i> Lihat Detail
                </a>
            </td>
            <td class="col-lg-3 col-6">
                <b> Tanggal Tanggapan: </b><br>
                {{ $l->tanggapan ? $l->tanggapan : $l->updated_at }}<br><br>

                <b> Tanggapan: </b><br>
                {{ $l->tanggapan }}
            </td>
            <td class="col-lg-2 col-6">
                <b>Gambar Tanggapan: </b><br>
                <a href="storage/{{ $l->gambar_tanggapan }}">
                    <i class="bi bi-eye-fill"></i> Lihat Detail
                </a>
            </td>
            <td class="col-lg-2 col-12">
                <b>Status Aduan: </b><br>
                {{ $l->status }}
            </td>
        </tr>

    @endforeach
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div id="respon_error" class="text-danger mb-4"></div>
                    <div class="form-group">
                        <label>Laporan <sup class="text-danger">*</sup></label>
                        <textarea name="laporan" id="laporan" class="form-control form-control-sm" required
                            placeholder="Laporan"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Gambar Laporan</label>
                        <input type="file" name="gambar_laporan" id="gambar_laporan"
                            class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group mt-4">
                        {!! NoCaptcha::display() !!}
                        {!! NoCaptcha::renderJs() !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="tombol_kirim" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>