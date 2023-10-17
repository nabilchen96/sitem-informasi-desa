<form id="form">
    <div class="mb-4">
        <label>Nama Dosen <sup class="text-danger">*</sup></label>
        <textarea name="nama_dosen" id="nama_dosen" class="form-control border" cols="30" rows="3"
            placeholder="Nama dosen ( gunakan tanda (;) bila lebih Dari 1 orang)" required></textarea>
    </div>
    <div class="mb-4">
        <label>Alasan Pengajuan Surat <sup class="text-danger">*</sup></label>
        <textarea name="alasan_pengajuan_surat" id="alasan_pengajuan_surat" class="form-control border" cols="30"
            rows="3" placeholder="Alasan Pengajuan Surat" required></textarea>
    </div>
    <div class="mb-4">
        <label>Tanggal Rencana Kegiatan<sup class="text-danger">*</sup></label>
        <input type="date" name="tanggal_rencana_kegiatan" id="tanggal_rencana_kegiatan" required
            class="form-control border">
    </div>
    <div class="mb-4">
        <label>Lokasi Rencana Kegiatan<sup class="text-danger">*</sup></label>
        <input type="text" name="lokasi_rencana_kegiatan" id="lokasi_rencana_kegiatan" required
            class="form-control border" placeholder="Lokasi Rencana Kegiatan">
    </div>
    <div class="mb-4">
        <label>Judul Penelitian Terkait<sup class="text-danger">*</sup></label>
        <input type="text" name="judul_penelitian_terkait" id="judul_penelitian_terkait" required
            class="form-control border" placeholder="Judul Penelitian Terkait">
    </div>
    <button id="tombol_kirim" class="btn btn-info">Submit</button>
</form>
@push('script')
    <script>
        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: '/store-surat-izin-penelitian',
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
