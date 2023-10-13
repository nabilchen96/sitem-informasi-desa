<?php

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

//LANDING
Route::get('/', function(){
    return view('frontend.landing');
});

//JADWAL
Route::get('/front/jadwal', function(){
    return view('frontend.jadwal');
});

//PENGUMUMAN
Route::get('/front/pengumuman', function(){
    return view('frontend.pengumuman');
});

//LIBRARY
Route::get('/front/library', 'App\Http\Controllers\LibraryController@frontLibrary');

//PENGUMUMAN
Route::get('/front/pengumuman', 'App\Http\Controllers\PengumumanController@frontPengumuman');

//FORMULIR
Route::get('/front/kegiatan', function(){
    return view('frontend.kegiatan');
});

//USUL JUDUL
Route::post('/store-usul-judul', 'App\Http\Controllers\UsulanJudulController@store');


//KEBUTUHAN DOSEN
Route::get('/front/kebutuhan_dosen', function(){
    return view('frontend.kebutuhan_dosen');
});

//LOGIN
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/loginProses', 'App\Http\Controllers\AuthController@loginProses');

//BACKEND
Route::group(['middleware' => 'auth'], function () {

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

    //PROPOSAL
    Route::get('/proposal', function(){
        return view('backend.proposal.index');
    });

    //REVISI PROPOSAL

    //NOTIFIKASI WHATSAPP
    Route::get('/notifikasi', function(){
        return view('backend.notifikasi.index');
    });

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

});

//LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
