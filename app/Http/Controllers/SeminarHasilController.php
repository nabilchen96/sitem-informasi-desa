<?php

namespace App\Http\Controllers;

use App\Models\SeminarHasil;
use Illuminate\Http\Request;
use DB;
use App\Models\UsulanJudul;
use Auth;
use Illuminate\Support\Facades\Validator;

class SeminarHasilController extends Controller
{
    public function index()
    {
        return view('backend.seminar_hasil.index');
    }

    public function data()
    {
        $data = DB::table('seminar_hasils as sa')
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
        //upload file seminar hasil
        $file_seminar_hasil = $request->file_seminar_hasil;
        $nama_file_seminar_hasil = '1' . date('YmdHis.') . $file_seminar_hasil->extension();
        $file_seminar_hasil->move('file_seminar_hasil_library', $nama_file_seminar_hasil);

        $data = SeminarHasil::UpdateOrcreate(
            [
                'usulan_judul_id' => $request->usulan_judul_id,
                'token_akses' => $request->token_akses,
            ],
            [
                'usulan_judul_id' => $request->usulan_judul_id,
                'file_seminar_hasil' => $nama_file_seminar_hasil,
                'token_akses' => $request->token_akses,
            ]
        );

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Ditambah'
        ];


        return response()->json($data);
    }
}
