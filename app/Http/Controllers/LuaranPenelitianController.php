<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\LuaranPenelitian;
use Illuminate\Http\Request;
use DB;
use App\Models\UsulanJudul;
use Auth;
use Illuminate\Support\Facades\Validator;

class LuaranPenelitianController extends Controller
{
    public function index()
    {
        return view('backend.luaran_penelitian.index');
    }

    public function data()
    {
        $data = DB::table('luaran_penelitians as sa')
            ->join('dosens as d', 'd.token_akses', '=', 'sa.token_akses')
            ->join('usulan_juduls as uj', 'uj.token_akses', '=', 'd.token_akses')
            ->select(
                'sa.*',
                'd.nama_dosen',
                'judul_penelitian'
            )
            ->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        //upload file seminar antara
        $file_luaran = $request->file_luaran;
        $nama_file_luaran = '1' . date('YmdHis.') . $file_luaran->extension();
        $file_luaran->move('file_luaran_library', $nama_file_luaran);

        $data = LuaranPenelitian::UpdateOrcreate(
            [
                'usulan_judul_id' => $request->usulan_judul_id,
                'token_akses' => $request->token_akses,
            ],
            [
                'usulan_judul_id' => $request->usulan_judul_id,
                'file_luaran' => $nama_file_luaran,
                'token_akses' => $request->token_akses,
                'jenis_publikasi' => $request->jenis_publikasi,
                'kategori' => $request->kategori
            ]
        );

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Ditambah'
        ];


        return response()->json($data);
    }
}
