<div class="card">
    <div class="row">
        <fieldset class="form-group border p-3">
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
    </div>
    <div class="row">
        <div class="alert alert-info">
            Diinformasikan kepada seluruh dosen yang mengusulkan judul penelitian dan PKM untuk dapat melihat
            hasil seleksi pengumuman judul penelitian dan PKM di Menu <a class="text-info"
                href="{{ url('front/pengumuman') }}">Pengumuman</a>
        </div>
    </div>
</div>
