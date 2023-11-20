<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Nilai Usulan Proposal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .tanda-tangan {
            border-top: 1px solid #000;
            margin-top: 20px;
            padding-top: 10px;
        }

    </style>
</head>
<body>
    <div class="conteiner-fluid">
        <h4 class="text-center">LEMBAR PENILAIAN PROPOSAL PENELITIAN</h4>
        <br>
        <div class="row">
            <p>Pada Hari {{ $data->hari }} Tanggal {{ date('d',strtotime($data->tanggal)) }} Bulan {{ bln_indo($data->tanggal) }} Tahun {{ date('Y', strtotime($data->tanggal) ) }} telah dilakukan penilaian terhadap proposal penelitian sebagai berikut : </p>
            <table class="table">
                <tr>
                    <td>1.</td>
                    <td>Nama Ketua Peneliti</td>
                    <td>:</td>
                    <td>{{ $peneliti->nama_dosen }}</td>
                </tr>
                @php
                $string = $peneliti->anggota;

                // Menggunakan explode() untuk memisahkan string menjadi array
                $arrayResult = explode(", ", $string);
                @endphp
                <tr>
                    <td>2.</td>
                    <td>Nama Anggota</td>
                    <td>:</td>
                    <td>
                        <ol type='1'>
                            @foreach ($arrayResult as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Judul Penelitian</td>
                    <td>:</td>
                    <td>{{ $judul->judul_penelitian }}</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td colspan="3">Biaya Penelitian Yang Diusulkan ke Poltekbang Palembang: <br>
                        Rp. {{ number_format($data->biaya_diusulkan) }}
                    </td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td colspan="3">Biaya Penelitian Direkomendasikan: Rp. {{ number_format($data->biaya_direkomendasikan) }}

                    </td>
                </tr>
            </table>
        </div>

        <br>
        <div class="row">
            Dengan hasil penilaian sebagai berikut :
            <table class="table table-bordered">
                <tr>
                    <th class="bg-info">No</th>
                    <th class="bg-info">Kriteria</th>
                    <th class="bg-info">Indikator</th>
                    <th class="bg-info">Bobot <br> (B)</th>
                    <th class="bg-info">Skor <br> (S)</th>
                    <th class="bg-info">Nilai <br> (BxS)</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Relevansi Dengan RIP Poltekbang Palembang</td>
                    <td>Tema dan Sub Tema sesuai dengan RIP Poltekbang Palembang</td>
                    <td>15</td>
                    <td>{{ $data->nilai_kriteria_1 }}</td>
                    <td>{{ $data->n1_x_bobot }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Perumusan Masalah</td>
                    <td>Ketajaman rumusan masalah dan tujuan penelitian</td>
                    <td>10</td>
                    <td>{{ $data->nilai_kriteria_2 }}</td>
                    <td>{{ $data->n2_x_bobot }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Manfaat hasil penelitian</td>
                    <td>Pengembangan Iptek, pembangunan dan/atau pengembangan kelembagaan</td>
                    <td>15</td>
                    <td>{{ $data->nilai_kriteria_3 }}</td>
                    <td>{{ $data->n3_x_bobot }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Tinjauan Pustaka</td>
                    <td>Relevansi kemutakhiran, dan penyusunan daftar Pustaka</td>
                    <td>20</td>
                    <td>{{ $data->nilai_kriteria_4 }}</td>
                    <td>{{ $data->n4_x_bobot }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Metode Penelitian</td>
                    <td>Ketepatan metode yang digunakan</td>
                    <td>20</td>
                    <td>{{ $data->nilai_kriteria_5 }}</td>
                    <td>{{ $data->n5_x_bobot }}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Kelayakan penelitian</td>
                    <td>Kesesuaian jadwal, kesesuaian keahlian personalia, kesesuaian ajuan dana</td>
                    <td>20</td>
                    <td>{{ $data->nilai_kriteria_6 }}</td>
                    <td>{{ $data->n6_x_bobot }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center"><b>Jumlah</b></td>
                    <td>
                        {{ $data->n1_x_bobot + $data->n2_x_bobot + $data->n3_x_bobot + $data->n4_x_bobot + $data->n5_x_bobot + $data->n6_x_bobot }}
                    </td>
                </tr>
            </table>
            <br>
            <u>Keterangan:</u>
            <ol type="a">
                <li>Skor diisi dengan : 1 = Sangat Kurang; 2 = Kurang; <br> 3 = Cukup; 4 = Baik; 5 = Sangat Baik</li>
                <li><i>Passing grade</i> = 350 tanpa skor 1.</li>
                <li>Rekomendasi : <b><i>{{ $data->rekomendasi }}</i></b> </li>
                <li>Saran Perbaikan (jika ada) bagi yang Diterima: <br> {{ $data->saran_perbaikan != "" || $data->saran_perbaikan != NULL ? $data->saran_perbaikan : "-"  }} </li>
                <li>Alasan bagi Yang Tidak Diterima: <br> {{ $data->alasan_bagi_yang_tidak_diterima != "" || $data->alasan_bagi_yang_tidak_diterima != NULL ? $data->alasan_bagi_yang_tidak_diterima : "-"  }} </li>
            </ol>
        </div>

        <div>
            <br><br><br>
           
            <div style="float: left; margin-left: 20px;">
                <p style="color: white">White text</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewer 1</p>
                <br><br>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;({{$peneliti->reviewer1}})</p>
            </div>

            <div style="float: right;">
                @php
                    $now = now();
                @endphp
                <p>Palembang, {{ tgl_indo(date('Y-m-d', strtotime($now) )) }}</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewer 2</p>
                <br><br>
                <p>&nbsp;&nbsp;&nbsp;({{$peneliti->reviewer2}})</p>
            </div>
            
        </div>

    </div>


</body>
</html>
