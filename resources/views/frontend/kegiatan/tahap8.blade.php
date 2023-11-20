<div class="card">
    <div style="width: 100%;">
        <form id="form">
            <div class="row">
                <?php
                
                $data = DB::table('dosens')
                    ->where('token_akses', Request('token_akses'))
                    ->first();
                
                $judul = DB::table('usulan_juduls')
                    ->where('token_akses', @$data->token_akses)
                    ->latest()
                    ->first();
                
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
                        <label class="form-label">Judul Penelitian <sup class="text-danger">*</sup></label>
                        <input type="hidden" name="usulan_judul_id" id="usulan_judul_id" value="{{ @$judul->id }}">
                        <input type="text" name="judul_penelitian" id="judul_penelitian"
                            value="{{ @$judul->judul_penelitian }}" class="form-control border"
                            placeholder="Judul Penelitian" required readonly>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Jenis Publikasi <sup class="text-danger">*</sup></label>
                        <select name="jenis_publikasi" id="jenis_publikasi" class="form-control border" required>
                            <option>HAKI</option>
                            <option>Buku</option>
                            <option>Artikel</option>
                            <option>PPM</option>
                            <option>Proc</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">Kategori <sup class="text-danger">*</sup></label>
                        <select name="kategori" id="kategori" class="form-control border" required>
                            <option>Nasional</option>
                            <option>Scopus</option>
                            <option>Wos</option>
                            <option>Doaj</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">File Luaran <sup class="text-danger">*</sup></label>
                        <input type="file" name="file_luaran" id="file_luaran" class="form-control border"required>
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
                    url: '/store-luaran-penelitian',
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
