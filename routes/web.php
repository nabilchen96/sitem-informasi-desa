<?php

use App\Http\Controllers\PenilaianProposalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('nilai/{id}',[PenilaianProposalController::class,'cetakNilai']);

//LANDING
Route::get('/', function () {
    return view('frontend.landing');
});

//JADWAL
Route::get('/front/jadwal', function () {
    return view('frontend.jadwal');
});

//PENGUMUMAN
Route::get('/front/pengumuman', function () {
    return view('frontend.pengumuman');
});

//LIBRARY
Route::get('/front/library', 'App\Http\Controllers\LibraryController@frontLibrary');

//PENGUMUMAN
Route::get('/front/pengumuman', 'App\Http\Controllers\PengumumanController@frontPengumuman');

//FORMULIR
Route::get('/front/kegiatan', function () {
    return view('frontend.kegiatan');
});

//USUL JUDUL
Route::post('/store-usul-judul', 'App\Http\Controllers\UsulanJudulController@store');

//USUL PROPOSAL
Route::post('/store-usul-proposal', 'App\Http\Controllers\UsulanProposalController@store');

//REVISI PROPOSAL
Route::post('/store-revisi-proposal', 'App\Http\Controllers\RevisiProposalController@store');

//MENGAJUKAN SURAT IZIN PENELITIAN
Route::post('/store-surat-izin-penelitian', 'App\Http\Controllers\SuratIzinPenelitianController@store');

//SEMINAR ANTARAN
Route::post('/store-seminar-antara', 'App\Http\Controllers\SeminarAntaraController@store');

//LUARAN PENELITIAN
Route::post('/store-luaran-penelitian', 'App\Http\Controllers\LuaranPenelitianController@store');

//SEMINAR HASIL
Route::post('/store-seminar-hasil', 'App\Http\Controllers\SeminarHasilController@store');

//HISTORY
Route::get('/front/history', 'App\Http\Controllers\HistoryController@index');


//KEBUTUHAN DOSEN
Route::get('/front/kebutuhan_dosen', function () {
    return view('frontend.kebutuhan_dosen');
});

//LOGIN
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/loginProses', 'App\Http\Controllers\AuthController@loginProses');

//BACKEND
Route::group(['middleware' => 'auth'], function () {

    Route::get('/cetak-nilai-proposal/{usulan_proposal_id}', 'App\Http\Controllers\PenilaianProposalController@cetakNilai');
    
    //DASHBOARD
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

    //USER
    Route::get('/user', 'App\Http\Controllers\UserController@index');
    Route::get('/data-user', 'App\Http\Controllers\UserController@data');
    Route::post('/store-user', 'App\Http\Controllers\UserController@store');
    Route::post('/update-user', 'App\Http\Controllers\UserController@update');
    Route::post('/delete-user', 'App\Http\Controllers\UserController@delete');

    //DOSEN
    Route::get('/dosen', 'App\Http\Controllers\DosenController@index');
    Route::get('/data-dosen', 'App\Http\Controllers\DosenController@data');
    Route::post('/store-dosen', 'App\Http\Controllers\DosenController@store');
    Route::post('/update-dosen', 'App\Http\Controllers\DosenController@update');
    Route::post('/delete-dosen', 'App\Http\Controllers\DosenController@delete');
    Route::get('/test', 'App\Http\Controllers\DosenController@test');

    //TAHUN
    Route::get('/tahun', 'App\Http\Controllers\TahunController@index');
    Route::get('/data-tahun', 'App\Http\Controllers\TahunController@data');
    Route::post('/store-tahun', 'App\Http\Controllers\TahunController@store');
    Route::post('/update-tahun', 'App\Http\Controllers\TahunController@update');
    Route::post('/delete-tahun', 'App\Http\Controllers\TahunController@delete');

    //KEGIATAN
    Route::get('/kegiatan', 'App\Http\Controllers\KegiatanController@index');
    Route::get('/data-kegiatan', 'App\Http\Controllers\KegiatanController@data');
    Route::post('/store-kegiatan', 'App\Http\Controllers\KegiatanController@store');
    Route::post('/update-kegiatan', 'App\Http\Controllers\KegiatanController@update');
    Route::post('/delete-kegiatan', 'App\Http\Controllers\KegiatanController@delete');

    //JADWAL
    Route::get('/jadwal', 'App\Http\Controllers\JadwalController@index');
    Route::get('/data-jadwal', 'App\Http\Controllers\JadwalController@data');
    Route::post('/store-jadwal', 'App\Http\Controllers\JadwalController@store');
    Route::post('/update-jadwal', 'App\Http\Controllers\JadwalController@update');
    Route::post('/delete-jadwal', 'App\Http\Controllers\JadwalController@delete');

    //USULAN JUDUl
    Route::get('/usulan-judul', 'App\Http\Controllers\UsulanJudulController@index');
    Route::get('/data-usulan-judul', 'App\Http\Controllers\UsulanJudulController@data');
    Route::get('/data-usulan-judul-acc', 'App\Http\Controllers\UsulanJudulController@dataAcc');
    Route::get('/data-usulan-judul-tolak', 'App\Http\Controllers\UsulanJudulController@dataTolak');
    Route::post('/store-usulan-judul', 'App\Http\Controllers\UsulanJudulController@store');
    Route::post('/update-usulan-judul', 'App\Http\Controllers\UsulanJudulController@update');
    Route::post('/delete-usulan-judul', 'App\Http\Controllers\UsulanJudulController@delete');

    //USULAN PROPOSAL
    Route::get('/usulan-proposal', 'App\Http\Controllers\UsulanProposalController@index');
    Route::get('/penilaian-proposal', 'App\Http\Controllers\UsulanProposalController@index');
    Route::post('/update-penilaian-proposal', 'App\Http\Controllers\PenilaianProposalController@store');
    Route::get('/data-usulan-proposal', 'App\Http\Controllers\UsulanProposalController@data');
    
    Route::get('/data-usulan-proposal-acc', 'App\Http\Controllers\UsulanProposalController@dataAcc');
    Route::get('/data-usulan-proposal-tolak', 'App\Http\Controllers\UsulanProposalController@dataTolak');
    Route::post('/update-status-usulan-proposal', 'App\Http\Controllers\UsulanProposalController@updateStatus');
    Route::post('/update-reviewer-proposal', 'App\Http\Controllers\UsulanProposalController@updateReviewer');

    //REVISI PROPOSAL
    Route::get('/revisi-proposal', 'App\Http\Controllers\RevisiProposalController@index');
    Route::get('/data-revisi-proposal', 'App\Http\Controllers\RevisiProposalController@data');

    //IZIN PENELITIAN
    Route::get('/surat-izin-penelitian', 'App\Http\Controllers\SuratIzinPenelitianController@index');
    Route::get('/data-surat-izin-penelitian', 'App\Http\Controllers\SuratIzinPenelitianController@data');
    Route::post('/store-file-surat-izin-penelitian', 'App\Http\Controllers\SuratIzinPenelitianController@storeFile');


    //SEMINAR ANTARA
    Route::get('/seminar-antara', 'App\Http\Controllers\SeminarAntaraController@index');
    Route::get('/data-seminar-antara', 'App\Http\Controllers\SeminarAntaraController@data');

    //LUARAN PENELITIAN
    Route::get('/luaran-penelitian', 'App\Http\Controllers\LuaranPenelitianController@index');
    Route::get('/data-luaran-penelitian', 'App\Http\Controllers\LuaranPenelitianController@data');

    //SEMINAR HASIL
    Route::get('/seminar-hasil', 'App\Http\Controllers\SeminarHasilController@index');
    Route::get('/data-seminar-hasil', 'App\Http\Controllers\SeminarHasilController@data');

    //NOTIFIKASI WHATSAPP
    // Route::get('/notifikasi', function () {
    //     return view('backend.notifikasi.index');
    // });
    Route::get('/notifikasi', 'App\Http\Controllers\NotifikasiController@index');
    Route::get('/data-notifikasi', 'App\Http\Controllers\NotifikasiController@data');
    Route::post('/store-notifikasi', 'App\Http\Controllers\NotifikasiController@store');
    Route::post('/update-notifikasi', 'App\Http\Controllers\NotifikasiController@update');
    Route::post('/delete-notifikasi', 'App\Http\Controllers\NotifikasiController@delete');

    //LIBRARY
    Route::get('/library', 'App\Http\Controllers\LibraryController@index');
    Route::get('/data-library', 'App\Http\Controllers\LibraryController@data');
    Route::post('/store-library', 'App\Http\Controllers\LibraryController@store');
    Route::post('/update-library', 'App\Http\Controllers\LibraryController@update');
    Route::post('/delete-library', 'App\Http\Controllers\LibraryController@delete');

    //PENGUMUMAN
    Route::get('/pengumuman', 'App\Http\Controllers\PengumumanController@index');
    Route::get('/data-pengumuman', 'App\Http\Controllers\PengumumanController@data');
    Route::post('/store-pengumuman', 'App\Http\Controllers\PengumumanController@store');
    Route::post('/update-pengumuman', 'App\Http\Controllers\PengumumanController@update');
    Route::post('/delete-pengumuman', 'App\Http\Controllers\PengumumanController@delete');

    //KONTRAK
    Route::get('/kontrak', 'App\Http\Controllers\KontrakController@index');
    Route::get('/data-kontrak', 'App\Http\Controllers\KontrakController@data');
    Route::post('/store-kontrak', 'App\Http\Controllers\KontrakController@store');
    Route::post('/update-kontrak', 'App\Http\Controllers\KontrakController@update');
    Route::post('/delete-kontrak', 'App\Http\Controllers\KontrakController@delete');

});

//LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
