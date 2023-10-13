<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\UsulanJudul;
use Auth;
use Illuminate\Support\Facades\Validator;

class UsulanJudulController extends Controller
{
    public function index(){
        return view('backend.judul.index');
    }

    public function data(){
        
        $data = DB::table('usulan_juduls')->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request){

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'nama_ketua'        => 'required', 
            'judul_penelitian'  => 'required', 
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{
            $data = UsulanJudul::create([
                'jadwal_id'         => $request->jadwal_id, 
                'nama_ketua'        => $request->nama_ketua, 
                'judul_penelitian'  => $request->judul_penelitian, 
                'jenis_pelaksanaan' => $request->jenis_pelaksanaan, 
                'jenis_penelitian'  => $request->jenis_penelitian, 
                'program_studi'     => $request->program_studi, 
                'sub_topik'         => $request->sub_topik, 
                'token_akses'       => $request->token_akses, 
                'status'            => 0, 
                'tanggal_upload'    => date('Y-m-d'), 
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }
}
