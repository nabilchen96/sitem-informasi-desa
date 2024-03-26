<div class="card">
    x<fieldset class="form-group border p-3">
        <legend class="w-auto px-2">Jadwal Kegiatan : {{ $jadwal->nama_jadwal }}</legend>
        <div class="form-group">
            <label>Tgl Awal</label>
            <input name="tgl_awal_upload" id="tgl_awal_upload" type="date" value="{{$jadwal->tanggal_awal}}" class="form-control" disabled>
            
          </div>

          <div class="form-group">
            <label>Tgl Akhir</label>
            <input name="tgl_akhir_upload" id="tgl_akhir_upload" type="date" value="{{$jadwal->tanggal_akhir}}" class="form-control" disabled>
            <span class="text-danger error" style="font-size: 12px;" id="tgl_akhir_upload_alert"></span>
          </div>
    </fieldset>
    <div class="row">
        <div class="alert alert-info">
            <ul>
                <li>
                    Diinformasikan kepada seluruh dosen yang melakukan penelitian pada periode tahun ini untuk mengisi kuesioner kepuasan
                    pelaksana penelitian melalui <a class="text-info"
                        href="https://sikepala.poltekbangplg.ac.id/form-responden?tipe=Kuesioner%20Kepuasan%20Pelaksana%20Penelitian&jenis_responden=Dosen">
                        link berikut ini
                    </a>
                </li>
                <li>
                    Diinformasikan kepada seluruh dosen yang melakukan PKM pada periode tahun ini untuk mengisi kuesioner kepuasan
                    pelaksana PKM melalui <a class="text-info"
                        href="https://sikepala.poltekbangplg.ac.id/form-responden?tipe=Kuesioner%20Kepuasan%20Pelaksana%20PKM&jenis_responden=Dosen">
                        link berikut ini
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
