<div class="card">
    <div style="width: 100%;">

        <form id="form">
            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
            <div class="row">
                <?php
                
                $data = DB::table('dosens')->where('token_akses', Request('token_akses'))->first();
                ?>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">File Pengumuman<sup class="text-danger">*</sup></label>
                        <br>
                        @if ($jadwal->file_upload)
                            <a target="_blank" class="mt-4" style="text-decoration: underline !important; color: red;"
                                href="{{ asset('file_pengumuman') }}/{{ @$jadwal->file_upload }}"><i
                                    class="bi bi-file-earmark"></i> Unduh File</a>
                        @else
                            <a class="mt-4" style="text-decoration: underline !important; color: red;"
                                href="#">Belum Ada File Pengumuman</a>
                        @endif
                    </div>
                </div>
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
                        <label class="form-label">Program Studi <sup class="text-danger">*</sup></label>
                        <select name="program_studi" id="program_studi" class="form-control border" required>
                            <option value="">--Pilih Prodi--</option>
                            <option>DIV TRBU</option>
                            <option>DIII PPKP</option>
                            <option>DIII MBU</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">Judul Penelitian / PKM <sup class="text-danger">*</sup></label>
                        <input type="text" name="judul_penelitian" id="judul_penelitian" class="form-control border"
                            placeholder="Judul Penelitian" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Jenis Penelitian / PKM <sup class="text-danger">*</sup></label>
                        <select name="jenis_penelitian" id="jenis_penelitian" class="form-control border" required>
                            <option value="">--Pilih Jenis Penelitian--</option>
                            <option>Dasar</option>
                            <option>Terapan</option>
                            <option>Pengembangan</option>
                            <option>Pengembangan Lanjutan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Jenis Usulan <sup class="text-danger">*</sup></label>
                        <select name="jenis_usulan" class="form-control" id="jenis_usulan" required>
                            <option value="">--Pilih--</option>
                            <option value="Penelitian">Penelitian</option>
                            <option value="PKM">PKM</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">Sub Topik Penelitian / PKM <sup class="text-danger">*</sup></label>
                        <select name="sub_topik" id="sub_topik" class="form-control border" required>
                            <option value="">--Pilih Sub Topik Penelitian--</option>
                            <option>Aviation of Learning Technology</option>
                            <option>Evaluation of Education Management</option>
                            <option>Development of Learning Technology</option>
                            <option>Implementation of Learning Media</option>
                            <option>Airport Design, Planning, Maintenance</option>
                            <option>Eco/Smart Airport</option>
                            <option>Automation System</option>
                            <option>Fire Engineering</option>
                            <option>Aviation Safety</option>
                            <option>Aviation Security</option>
                            <option>Aviation Services</option>
                            <option>Human Resources Deevelopment</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Pelaksanaan Penelitian / PKM <sup class="text-danger">*</sup></label>
                        <select name="jenis_pelaksanaan" class="form-control border" required>
                            <option value="">--Pilih Jenis Pelaksanaan--</option>
                            <option>Kelompok</option>
                            <option>Mandiri</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Scan Blanko Persetujuan<sup class="text-danger">*</sup></label>
                        <input type="file" name="file_blanko" id="file_blanko"
                            class="form-control border"required>
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

            axios({
                    method: 'post',
                    url: '/store-usul-judul',
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
