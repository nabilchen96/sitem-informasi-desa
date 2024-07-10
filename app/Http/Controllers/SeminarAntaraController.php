<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\RecordUsulanProposal;
use App\Models\SeminarAntara;
use Illuminate\Http\Request;
use DB;
use App\Models\UsulanJudul;
use Auth;
use Illuminate\Support\Facades\Validator;

class SeminarAntaraController extends Controller
{
    public function index()
    {
        return view('backend.seminar_antara.index');
    }

    public function data()
    {
        $data = DB::table('seminar_antaras as sa')
            ->leftjoin('dosens as d', 'd.token_akses', '=', 'sa.token_akses')
            ->join('usulan_juduls as uj', 'uj.id', '=', 'sa.usulan_judul_id')
            ->select(
                'sa.*',
                'd.nama_dosen',
                'uj.judul_penelitian'
            )
            ->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {

        // dd($request->usulan_judul_id);

        //upload file seminar antara
        $file_seminar_antara = $request->file_seminar_antara;
        $nama_file_seminar_antara = '1' . date('YmdHis.') . $file_seminar_antara->extension();
        $file_seminar_antara->move('file_seminar_antara_library', $nama_file_seminar_antara);

        $data = SeminarAntara::UpdateOrcreate(
            [
                'usulan_judul_id' => $request->usulan_judul_id,
                'token_akses' => $request->token_akses,
            ],
            [
                'usulan_judul_id' => $request->usulan_judul_id,
                'file_seminar_antara' => $nama_file_seminar_antara,
                'token_akses' => $request->token_akses,
            ]
        );

        // sendWAAjuan("Seminar Antara");

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Ditambah'
        ];


        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = SeminarAntara::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
