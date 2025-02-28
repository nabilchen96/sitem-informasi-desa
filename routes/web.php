<?php

use App\Http\Controllers\PenilaianProposalController;
use Illuminate\Support\Facades\Route;
// use Barryvdh\DomPDF\Facade as PDF; // Import namespace penuh
use Barryvdh\DomPDF\Facade\Pdf;

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
Route::get('/', function () {
    return view('frontend.app');
});

//LOGIN
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/loginProses', 'App\Http\Controllers\AuthController@loginProses');
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/program-desa', function(){
    return view('frontend.program_desa');
});

Route::get('/daftar-laporan', function(){
    return view('frontend.laporan_desa');
});

Route::get('/daftar-berita', function(){
    return view('frontend.berita_desa');
});

Route::get('/detail-berita', function(){
    return view('frontend.detail_berita');
});


//REGISTER
Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('register');

Route::post('/store-front-laporan', 'App\Http\Controllers\LaporanController@storeFront');

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
    // Route::get('/export-excel-user', 'App\Http\Controllers\UserController@exportExcel');
    // Route::post('/import-excel-user', 'App\Http\Controllers\UserController@importExcel');

    //DESA
    Route::get('/desa', 'App\Http\Controllers\DesaController@index');
    Route::get('/data-desa', 'App\Http\Controllers\DesaController@data');
    Route::post('/store-desa', 'App\Http\Controllers\DesaController@store');
    Route::post('/update-desa', 'App\Http\Controllers\DesaController@update');
    Route::post('/delete-desa', 'App\Http\Controllers\DesaController@delete');

    //DESA
    Route::get('/program', 'App\Http\Controllers\ProgramController@index');
    Route::get('/data-program', 'App\Http\Controllers\ProgramController@data');
    Route::post('/store-program', 'App\Http\Controllers\ProgramController@store');
    Route::post('/update-program', 'App\Http\Controllers\ProgramController@update');
    Route::post('/delete-program', 'App\Http\Controllers\ProgramController@delete');

    //PENDUDUK
    Route::get('/penduduk', 'App\Http\Controllers\PendudukController@index');
    Route::get('/data-penduduk', 'App\Http\Controllers\PendudukController@data');
    Route::post('/store-penduduk', 'App\Http\Controllers\PendudukController@store');
    Route::post('/update-penduduk', 'App\Http\Controllers\PendudukController@update');
    Route::post('/delete-penduduk', 'App\Http\Controllers\PendudukController@delete');

    //BERITA
    Route::get('/berita', 'App\Http\Controllers\BeritaController@index');
    Route::get('/data-berita', 'App\Http\Controllers\BeritaController@data');
    Route::post('/store-berita', 'App\Http\Controllers\BeritaController@store');
    Route::post('/update-berita', 'App\Http\Controllers\BeritaController@update');
    Route::post('/delete-berita', 'App\Http\Controllers\BeritaController@delete');

    //LAPORAN
    Route::get('/laporan', 'App\Http\Controllers\LaporanController@index');
    Route::get('/data-laporan', 'App\Http\Controllers\LaporanController@data');
    Route::post('/store-laporan', 'App\Http\Controllers\LaporanController@store');
    Route::post('/update-laporan', 'App\Http\Controllers\LaporanController@update');
    Route::post('/delete-laporan', 'App\Http\Controllers\LaporanController@delete');

    //PENGAJUAN SURAT
    Route::get('/pengajuan-surat', 'App\Http\Controllers\PengajuanSuratController@index');
    Route::get('/data-pengajuan-surat', 'App\Http\Controllers\PengajuanSuratController@data');
    Route::post('/store-pengajuan-surat', 'App\Http\Controllers\PengajuanSuratController@store');
    Route::post('/update-pengajuan-surat', 'App\Http\Controllers\PengajuanSuratController@update');
    Route::post('/delete-pengajuan-surat', 'App\Http\Controllers\PengajuanSuratController@delete');

});

//LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
