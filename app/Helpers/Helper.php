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

    $pesan = "$greet $nick 
*$namaDosen*, berikut kami sampaikan Token untuk mengakses aplikasi PUSPPM.
URL : https://sipp.poltekbangplg.ac.id
TOKEN : *$tokenAkses*. 

Harap simpan *TOKEN* tersebut agar bisa mengakses aplikasi SIPP. 

Salam Hormat 
*- Admin PUSPPM -*";

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
            'delay' => '10', //nilai jgan diubah
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 7+qnvcbxi_dRrrEfHdJ@' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function sendWAAjuan($jenis)
{

    $pesan = "Halo Admin!, Ada Pengajuan *$jenis* oleh dosen di SIPP nih.

Jangan Lupa dicek yaa!!
https://sipp.poltekbangplg.ac.id/login

Salam Hormat 
*- (^_^) -*";

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
            'target' => '081361155127',
            // 'target' => '08991334254',
            'message' => $pesan,
            'delay' => '10', //nilai jgan diubah
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 7+qnvcbxi_dRrrEfHdJ@' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function sendReviewerAccount($noWA, $namaDosen, $email, $password)
{
    $greet = greetToDosen();

    $pesan = "$greet $namaDosen, berikut kami sampaikan Detail Akun Reviewer Anda.

==============================
URL : https://sipp.poltekbangplg.ac.id/login
Email : *$email*
Password : *$password*
==============================

Harap simpan informasi *AKUN* tersebut agar bisa mengakses aplikasi SIPP. 
Salam Hormat

*- Admin PUSPPM -*";

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
            'delay' => '10', //nilai jgan diubah
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 7+qnvcbxi_dRrrEfHdJ@' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function sendWAJadwal($kegiatan, $message, $komen, $tgl_awal, $tgl_akhir, $tipe)
{

    $tglawal = date('d-m-Y', strtotime($tgl_awal));
    $tglakhir = date('d-m-Y', strtotime($tgl_akhir));

    $depan = "";
    if($tipe == "update"){
        $depan = "Perubahan : ";
    } else {
        $depan = "";
    }

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
            // 'message' => "$depan.'Informasi Jadwal *$kegiatan*. Tahap : *" . $message . "* dimulai pada *$tglawal* s/d *$tglakhir*.
            'message' => "*" .strtoupper($message) . "* 
            
periode *$tglawal* s/d *$tglakhir*.

$komen

=============================
Silahkan *upload file / cek informasi jadwal* pada 
https://sipp.poltekbangplg.ac.id/front/kegiatan
=============================

Salam Hormat 
*- Admin PUSPPM -*",
            'delay' => '10', //nilai jgan diubah
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 7+qnvcbxi_dRrrEfHdJ@' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function sendUpdateUsulanJudul($noWA, $namaDosen, $judul, $status, $jk)
{

    if ($status == "1") {
        $ubah = "Disetujui";
    } else if ($status == "2") {
        $ubah = "Ditolak";
    } else {
        $ubah = "-";
    }

    if ($jk == 'Laki-laki') {
        $nick = "Bapak";
    } else if ($jk == "Perempuan") {
        $nick = "Ibu";
    } else {
        $nick = "";
    }

    $greet = greetToDosen();

    $pesan = "$greet $nick $namaDosen usulan Anda yang berjudul *$judul* *$ubah*. Silahkan cek informasi pada https://sipp.poltekbangplg.ac.id Salam Hormat *- Admin PUSPPM -*  ";

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
            'delay' => '10', //nilai jgan diubah
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 7+qnvcbxi_dRrrEfHdJ@' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function sendUpdateUsulanProposal($noWA, $namaDosen, $judul, $status, $jk, $keterangan)
{

    if ($status == "1") {
        $ubah = "Disetujui";
    } else if ($status == "2") {
        $ubah = "Ditolak";
    } else {
        $ubah = "";
    }

    if ($jk == 'Laki-laki') {
        $nick = "Bapak";
    } else if ($jk == "Perempuan") {
        $nick = "Ibu";
    } else {
        $nick = "";
    }

    if ($keterangan) {
        $ket = $keterangan;
    } else {
        $ket = "-";
    }

    $greet = greetToDosen();

    $pesan = "$greet $nick $namaDosen usulan Proposal *$judul* *$ubah*.
Keterangan : *$ket*.
Silahkan cek histori pada https://sipp.poltekbangplg.ac.id/front/history

Salam Hormat
*- Admin PUSPPM -*  ";

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
            'delay' => '10', //nilai jgan diubah
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 7+qnvcbxi_dRrrEfHdJ@' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function sendWANotif($message, $list_nomor)
{

    if($list_nomor[0] == 'Semua'){
        $noWA = getListDosenWANumber();
    } else {
        $noWA = implode(',', $list_nomor);
    }
    

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
            'message' => "" . $message . ".

Salam Hormat 
*- Admin PUSPPM -*",
            'delay' => '10', //nilai jgan diubah
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 7+qnvcbxi_dRrrEfHdJ@' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
}

function tgl_indo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

function bln_indo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $pecahkan = explode('-', $tanggal);

    return $bulan[(int) $pecahkan[1]];
}
