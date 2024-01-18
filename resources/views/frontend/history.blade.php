@extends('frontend.app')
@section('content')
    <style>
        th,
        td {
            white-space: nowrap;
        }
    </style>
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
                <form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Kegiatan Penelitian <sup class="text-danger">*</sup></label>
                                <select name="id_kegiatan" id="id_kegiatan" class="form-control">
                                    <?php $kegiatan = DB::table('kegiatans')->get(); ?>
                                    @foreach ($kegiatan as $item)
                                        <option value="{{ @$item->id }}">{{ @$item->nama_kegiatan }}</option>
                                    @endforeach
                                </select>
                                <span class="text-white" style="font-size: 12px;">*</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Token <sup class="text-danger">*</sup></label>
                                <div class="input-group">
                                    <input type="text" name="token_akses" id="token_akses" class="form-control border"
                                        placeholder="Token" required>
                                    <button type="submit" style="margin-left: 5px; border: none;"
                                        class="input-group-text bg-info text-white" id="basic-addon2">Cari</button>
                                </div>
                                <span class="text-danger" style="font-size: 12px;">
                                    *Masukan Token untuk Mencari Nama Dosen yang Terdaftar
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
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

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">


                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label class="form-label">Ketua Peneliti <sup
                                                    class="text-danger">*</sup></label>
                                            <input value="{{ @$judul->nama_ketua }}" type="text"
                                                class="form-control border" placeholder="Ketua Peneliti" readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Program Studi <sup class="text-danger">*</sup></label>
                                            <input value="{{ @$judul->program_studi }}" type="text"
                                                class="form-control border" placeholder="Program Studi" readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Judul Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <input value="{{ @$judul->judul_penelitian }}" type="text"
                                                class="form-control border" placeholder="Judul Penelitian" readonly>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label class="form-label">Jenis Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <input value="{{ @$judul->jenis_penelitian }}" type="text"
                                                class="form-control border" placeholder="Jenis Penelitian" readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Sub Topik Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <input value="{{ @$judul->sub_topik }}" type="text"
                                                class="form-control border" placeholder="Sub Topik Penelitian" readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Pelaksanaan Penelitian <sup
                                                    class="text-danger">*</sup></label>
                                            <input value="{{ @$judul->jenis_pelaksanaan }}" type="text"
                                                class="form-control border" placeholder="Jenis Pelaksanaan" readonly>
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
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>Anggota</th>
                                                <th>Rev</th>
                                                <th class="text-center">Proposal</th>
                                                <th class="text-center">RAB</th>
                                                <th class="text-center">Video</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proposal as $item)
                                                <tr>
                                                    <td>
                                                        {{ @$item->anggota }}
                                                    </td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <a href="/file_proposal_library/{{ @$item->file_proposal }}">
                                                            <i style="font-size: 1rem;"
                                                                class="bi bi-file-earmark-text"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/file_rab_library/{{ @$item->file_rab }}">
                                                            <i style="font-size: 1rem;"
                                                                class="bi bi-file-earmark-text"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ @$item->link_video }}">
                                                            <i style="font-size: 1rem;" class="bi bi-film"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach ($revisi as $k => $item)
                                                <tr>
                                                    <td>
                                                        {{ @$item->anggota }}
                                                    </td>
                                                    <td>Ke {{ $k + 1 }}</td>
                                                    <td class="text-center">
                                                        <a href="/file_proposal_library/{{ @$item->file_proposal }}">
                                                            <i style="font-size: 1rem;"
                                                                class="bi bi-file-earmark-text"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/file_rab_library/{{ @$item->file_rab }}">
                                                            <i style="font-size: 1rem;"
                                                                class="bi bi-file-earmark-text"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ @$item->link_video }}">
                                                            <i style="font-size: 1rem;" class="bi bi-film"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                <a target="_blank" href="{{ url('file_kontrak') }}/{{ @$kontrak->file_kontrak }}"
                                    style="font-size: 20px;"><i class="bi bi-file-earmark-text"></i> Lihat
                                    File
                                    Kontrak</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    Seminar Antara
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <label class="form-label">
                                    File Seminar Antara <sup class="text-danger">*</sup>
                                </label><br>
                                <a target="_blank"
                                    href="{{ url('file_seminar_antara_library') }}/{{ @$seminar->file_seminar_antara }}"
                                    style="font-size: 20px;"><i class="bi bi-file-earmark-text"></i> Lihat
                                    File
                                    Seminar Antara</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Luaran Penelitian
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Publikasi</th>
                                                <th class="text-center">File</th>
                                                <th class="text-center">Tanggal Unggah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($luaran as $item)
                                                <tr>
                                                    <td>
                                                        {{ @$item->kategori }}
                                                    </td>
                                                    <td>{{ @$item->jenis_publikasi }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ url('file_luaran_library') }} / {{@$item->file_luaran}}">
                                                            <i style="font-size: 1rem;"
                                                                class="bi bi-file-earmark-text"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ @$item->created_at }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <br><br><br><br>
@endsection