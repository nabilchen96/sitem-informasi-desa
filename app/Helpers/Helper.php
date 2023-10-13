<?php

use App\Mail\PengujianBaru;
use App\Mail\PengujianUpdate;
use App\Models\Dosen;
use Illuminate\Support\Facades\Mail;

function kirimEmail($isian)
{
    $data = ['jenis' => $isian];

    $kirim = Mail::to("verifikator.lab@poltekbangplg.ac.id")->send(new PengujianBaru($data));
    return response()->json($kirim);
}

function kirimEmailUpdate($isian, $email, $status_verifikasi)
{
    $data = ['jenis' => $isian, 'status_verifikasi' => $status_verifikasi];

    $kirim = Mail::to($email)->send(new PengujianUpdate($data));
    return response()->json($kirim);
}

function getJadwalAktif()
{
    $data = DB::table('jadwals')
        ->leftJoin('kegiatans', 'kegiatans.id', 'jadwals.kegiatan_id')
        ->select('jadwals.*', 'kegiatans.nama_kegiatan', 'kegiatans.tahun')
        ->where('jadwals.status', '1')
        ->first();

    return $data;
}

function greetToDosen()
{
    $waktu = gmdate("H:i", time() + 7 * 3600);
    $t = explode(":", $waktu);
    $jam = $t[0];
    $menit = $t[1];

    if ($jam >= 00 and $jam < 10) {
        if ($menit > 00 and $menit < 60) {
            $ucapan = "Selamat Pagi";
        }
    } else if ($jam >= 10 and $jam < 15) {
        if ($menit > 00 and $menit < 60) {
            $ucapan = "Selamat Siang";
        }
    } else if ($jam >= 15 and $jam < 18) {
        if ($menit > 00 and $menit < 60) {
            $ucapan = "Selamat Sore";
        }
    } else if ($jam >= 18 and $jam <= 24) {
        if ($menit > 00 and $menit < 60) {
            $ucapan = "Selamat Malam";
        }
    } else {
        $ucapan = "Error";
    }

    return $ucapan;
}

function getListDosenWANumber()
{
    $dosens = Dosen::pluck('no_wa');
    $dataString = implode(',', $dosens->toArray());
    return $dataString;
}

function sendWADosen($noWA, $namaDosen, $tokenAkses, $jk)
{
    $greet = greetToDosen();

    if ($jk == 'Laki-laki') {
        $nick = "Bapak";
    } else if ($jk == "Perempuan") {
        $nick = "Ibu";
    } else {
        $nick = "";
    }

    $pesan = "$greet $nick $namaDosen, berikut kami sampaikan Token untuk mengakses aplikasi PUSPPM. URL : https://sipp.poltekbangplg.ac.id. TOKEN : *$tokenAkses* Salam Hormat *- Admin PUSPPM -*";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $noWA,
            'message' => $pesan,
            'delay' => '5',
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 32IW16nCPnRmoLc5yCm9' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function sendWAJadwal($kegiatan, $message, $tgl_awal, $tgl_akhir)
{

    $tglawal = date('d-m-Y',strtotime($tgl_awal));
    $tglakhir = date('d-m-Y',strtotime($tgl_akhir));

    $noWA = getListDosenWANumber();

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $noWA,
            'message' => "Informasi Jadwal *$kegiatan*. Tahap : *" .$message. "* dimulai pada *$tglawal* s/d *$tglakhir*. Silahkan cek informasi pada https://sipp.poltekbangplg.ac.id Salam Hormat *- Admin PUSPPM -*",
            'delay' => '5',
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 32IW16nCPnRmoLc5yCm9' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}
