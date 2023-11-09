<div class="card">
    <div class="row">
        <div class="col-lg-12 alert alert-info w-100 mb-4">
            Diinformasikan kepada seluruh dosen penelitian. File kontrak dapat diakses menggunakan token melalui form di
            bawah ini
        </div>
        <?php
        
        $data = DB::table('dosens')
            ->where('token_akses', Request('token_akses'))
            ->first();
        
        $judul = DB::table('usulan_juduls')
            ->leftjoin('file_kontraks', 'file_kontraks.token_akses', '=',  'usulan_juduls.token_akses')
            ->where('file_kontraks.token_akses', @$data->token_akses)
            ->orderBy('file_kontraks.created_at', 'DESC')
            ->first();
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
                <label class="form-label">Judul Penelitian <sup class="text-danger">*</sup></label>
                <input type="text" name="judul_penelitian" id="judul_penelitian"
                    value="{{ @$judul->judul_penelitian }}" class="form-control border" placeholder="Judul Penelitian"
                    required readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">File Kontrak<sup class="text-danger">*</sup></label>
                <br>
                @if (@$judul->file_kontrak)
                    <a class="mt-4" style="text-decoration: underline !important; color: red;" href="{{ asset('file_kontrak') }}/{{ @$judul->file_kontrak }}"><i class="bi bi-file-earmark"></i> Unduh File Kontrak</a>
                @else  
                    Masukan dan Cari token untuk mengunduh kontrak
                @endif
            </div>
        </div>
    </div>
</div>
