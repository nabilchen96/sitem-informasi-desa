<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $total_penduduk = DB::table('penduduks')->count();
        $total_laporan = DB::table('laporans')->count();
        $total_pengajuan = DB::table('pengajuan_surats')->count();
        $total_programs = DB::table('programs')->count();       

        return view('backend.dashboard', [
            'total_laporan' => $total_laporan,
            'total_pengajuan' => $total_pengajuan,
            'total_penduduk' => $total_penduduk,
            'total_program' => $total_programs
        ]);
    }
}