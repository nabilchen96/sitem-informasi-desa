<div class="card">
    <div style="width: 100%;">
        <fieldset class="form-group border p-3">
            <legend class="w-auto px-2">Jadwal Pengajuan Judul : {{ $jadwal->nama_jadwal }}</legend>
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
        <form id="form">
            <div class="row">
                <?php
                
                $data = DB::table('dosens')
                    ->where('token_akses', Request('token_akses'))
                    ->first();

                $judul = DB::table('usulan_juduls as uj')
                            ->join('jadwals as j', 'j.id', '=', 'uj.jadwal_id')
                            ->join('kegiatans as k', 'k.id', '=', 'j.kegiatan_id')
                            ->where('uj.token_akses', @$data->token_akses)
                            ->where('k.status', '1')
                            ->select(
                                'uj.*'
                            )
                            ->get();

                            // dd($judul);
                ?>
                <div class="col-lg-6">
                    <form action="{{ url('front/kegiatan') }}" method="GET">
                        <div class="mb-4">
                            <label class="form-label">Token <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <input type="text" name="token_akses" id="token_akses" class="form-control border"
                                    value="{{ Request('token_akses') }}" placeholder="Token" required>
                                <button onclick="submit();" style="margin-left: 5px; border: none;"
                                    class="input-group-text bg-info text-white" id="basic-addon2">Cari</button>
                            </div>
                            <span class="text-danger" style="font-size: 12px;">
                                *Masukan Token untuk Mencari Nama Dosen yang Terdaftar
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">Nama Peneliti <sup class="text-danger">*</sup></label>
                        <input type="text" name="nama_ketua" id="nama_ketua" value="{{ @$data->nama_dosen }}"
                            class="form-control border" placeholder="Nama Peneliti" required readonly>
                        <span class="text-white" style="font-size: 12px;">*</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">Judul Penelitian atau PKM <sup class="text-danger">*</sup></label>
                            <select name="usulan_judul_id" class="form-control border" id="usulan_judul_id">
                                <option value="">PILIH JUDUL PENELITIAN ATAU PKM</option>
                                @foreach ($judul as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul_penelitian }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">File Proposal <sup class="text-danger">*</sup></label>
                        <input type="file" name="file_proposal" id="file_proposal" class="form-control border"required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">File RAB <sup class="text-danger">*</sup></label>
                        <input type="file" name="file_rab" id="file_rab" class="form-control border"required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">Link Video/Presentasi PPT </label>
                        <input type="text" name="link_video" id="link_video" class="form-control border" placeholder="Link Video/Presentasi PPT">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Anggota <sup class="text-danger">*</sup></label>
                        <textarea name="anggota" id="anggota" placeholder="Sebutkan Anggota Penelitian, pisahkan dengan koma" class="form-control border" required rows="5"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-4">
                        <button class="btn btn-primary" id="tombol_kirim">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('script')
    <script>
        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            Swal.fire({
                icon: 'info',
                title: 'Tunggu Sebentar, File anda sedang diupload ...',
                showConfirmButton: false,
                allowOutsideClick: false,
            })

            axios({
                    method: 'post',
                    url: '/store-usul-proposal',
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

                        document.getElementById('form').reset();

                    } else {
                        //error validation
                        console.log('error');
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function(res) {
                    document.getElementById("tombol_kirim").disabled = false;
                    //handle error
                    console.log(res);
                });
        }
    </script>
@endpush
