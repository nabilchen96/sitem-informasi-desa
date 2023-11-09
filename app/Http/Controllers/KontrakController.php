<?php

namespace App\Http\Controllers;

use App\Models\FileKontrak;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class KontrakController extends Controller
{
    public function index(){

        return view('backend.kontrak.index');
    }

    public function data(){

        $data = DB::table('file_kontraks as fk')
                ->leftjoin('usulan_juduls as uj', 'uj.token_akses', '=', 'fk.token_akses')
                ->orderBy('fk.created_at', 'DESC')
                ->select(
                    'fk.*', 
                    'uj.judul_penelitian', 
                    'uj.nama_ketua'
                )
                ->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request){

        $file = $request->file;
        $nama_file = '1' . date('YmdHis.') . $file->extension();
        $file->move('file_kontrak', $nama_file);

        $data = FileKontrak::create([
            'file_kontrak'  => $nama_file, 
            'status'        => $request->status, 
            'token_akses'   => $request->token_akses, 
            'jadwal_id'     => $request->jadwal_id,
        ]);

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Ditambah'
        ];

        return response()->json($data);
    }
}
