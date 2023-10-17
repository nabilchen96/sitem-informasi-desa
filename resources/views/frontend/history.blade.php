@extends('frontend.app')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <section class="features-overview" id="features-section">
                <div class="content-header mb-5">
                    <h2>History Penelitian</h2>
                    <h6 class="section-subtitle text-muted mb-4">
                        Silahkan Masukan Token dan Tahun untuk Melihat History Penelitian dan <br> Pengabdian Kepada
                        Masyarakat Anda
                        di Politeknik Penerbangan Palembang
                    </h6>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label">Tahun Penelitian <sup class="text-danger">*</sup></label>
                            <select name="tahun_penelitian" id="tahun_penelitian" class="form-control">
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                            </select>
                            <span class="text-white" style="font-size: 12px;">*</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label">Token <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <input type="text" name="token_akses" id="token_akses" class="form-control border"
                                    value="SIPP-cRYlh	" placeholder="Token" required>
                                <button onclick="submit();" style="margin-left: 5px; border: none;"
                                    class="input-group-text bg-info text-white" id="basic-addon2">Cari</button>
                            </div>
                            <span class="text-danger" style="font-size: 12px;">
                                *Masukan Token untuk Mencari Nama Dosen yang Terdaftar
                            </span>
                        </div>
                    </div>
                </div>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Judul Penelitian
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label class="form-label">Ketua Peneliti <sup
                                                    class="text-danger">*</sup></label>
                                            <input value="Nabil Putra, S.KOM., M.KOM" type="text" name="judul_penelitian"
                                                id="judul_penelitian" class="form-control border"
                                                placeholder="Judul Penelitian" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Program Studi <sup class="text-danger">*</sup></label>
                                            <select name="program_studi" id="program_studi" class="form-control border"
                                                required>
                                                <option value="">--Pilih Prodi--</option>
                                                <option selected>DIV TRBU</option>
                                                <option>DIII PPKP</option>
                                                <option>DIII MBU</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Judul Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <input value="Sistem Informasi Penelitian dan PKM Poltekbang Palembang"
                                                type="text" name="judul_penelitian" id="judul_penelitian"
                                                class="form-control border" placeholder="Judul Penelitian" required>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label class="form-label">Jenis Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <select name="jenis_penelitian" id="jenis_penelitian"
                                                class="form-control border" required>
                                                <option value="">--Pilih Jenis Penelitian--</option>
                                                <option>Dasar</option>
                                                <option>Terapan</option>
                                                <option selected>Pengembangan</option>
                                                <option>Pengembangan Lanjutan</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Sub Topik Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <select name="sub_topik" id="sub_topik" class="form-control border" required>
                                                <option value="">--Pilih Sub Topik Penelitian--</option>
                                                <option>Aviation of Learning Technology</option>
                                                <option selected>Evaluation of Education Management</option>
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
                                            <label class="form-label">Pelaksanaan Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <select name="jenis_pelaksanaan" class="form-control border" required>
                                                <option value="">--Pilih Jenis Pelaksanaan--</option>
                                                <option selected>Kelompok</option>
                                                <option>Mandiri</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Proposal dan RAB
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-6">

                                        <div class="mb-4">
                                            <label class="form-label">
                                                File Proposal <sup class="text-danger">*</sup>
                                            </label><br>
                                            <a href="#" style="font-size: 20px;"><i
                                                    class="bi bi-file-earmark-text"></i> Lihat File
                                                Proposal</a>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">File RAB <sup class="text-danger">*</sup></label>
                                            <br>
                                            <a href="#" style="font-size: 20px;">
                                                <i class="bi bi-file-earmark-text"></i>
                                                Lihat File RAB
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label class="form-label">Link Video <sup class="text-danger">*</sup></label>
                                            <input value="https://www.youtube.com/watch?v=dqj4gkCQCwk" type="text" name="link_video" id="link_video"
                                                class="form-control border" placeholder="Link Video" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Anggota <sup class="text-danger">*</sup></label>
                                            <textarea name="anggota" id="anggota" placeholder="WAHID ALQORNI, S.KOM., M.KOM."
                                                class="form-control border" required rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Kontrak
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <label class="form-label">
                                    File Kontrak <sup class="text-danger">*</sup>
                                </label><br>
                                <a href="#" style="font-size: 20px;"><i
                                        class="bi bi-file-earmark-text"></i> Lihat File
                                    Kontrak</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Surat Izin Penelitian
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <label class="form-label">
                                    File Surat Izin Penelitian <sup class="text-danger">*</sup>
                                </label><br>
                                <a href="#" style="font-size: 20px;"><i
                                        class="bi bi-file-earmark-text"></i> Lihat File
                                    Surat Izin Penelitian</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Seminar Antara
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <label class="form-label">
                                    File Surat Izin Penelitian <sup class="text-danger">*</sup>
                                </label><br>
                                <a href="#" style="font-size: 20px;"><i
                                        class="bi bi-file-earmark-text"></i> Lihat File
                                    Surat Izin Penelitian</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Luaran Penelitian
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <label class="form-label">
                                    File Surat Izin Penelitian <sup class="text-danger">*</sup>
                                </label><br>
                                <a href="#" style="font-size: 20px;"><i
                                        class="bi bi-file-earmark-text"></i> Lihat File
                                    Surat Izin Penelitian</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <br><br><br><br>
@endsection
