<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HistoryController extends Controller
{
    public function index(){

        $token = Request('token_akses');
        $id_kegiatan = Request('id_kegiatan');

        //JUDUL PENELITIAN
        $judul = DB::table('usulan_juduls')
                    ->where('token_akses', $token)
                    ->where('id', $id_kegiatan)
                    ->first();

        //PROPOSAL DAN RAB
        //KONTRAK
        //SEMINAR ANTARA
        //LUARAN PENELITIAN

        return view('frontend.history', [
            'judul' => $judul
        ]);
    }
}
