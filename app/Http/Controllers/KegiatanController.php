<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function index(){
        $tahun_akademik = DB::table('tahun_akademiks')->orderBy('nama_tahun')->get();
        return view('backend.kegiatan.index', compact('tahun_akademik') );
    }

    public function data(){
        
        $kegiatan = DB::table('kegiatans')
                 ->leftJoin('tahun_akademiks','tahun_akademiks.id','kegiatans.tahun_akademik_id')
                 ->select('kegiatans.*','tahun_akademiks.nama_tahun');

        $kegiatan = $kegiatan->get();

        
        return response()->json(['data' => $kegiatan]);
    }

    public function store(Request $request){


        $validator = Validator::make($request->all(), [
            'nama_kegiatan'      => 'unique:kegiatans',
            'tahun_akademik_id' => 'required',
            'status'        => 'required',
            'tahun' => 'required',
            'jenis_kegiatan' => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{
            $data = Kegiatan::create([
                'nama_kegiatan'       => $request->nama_kegiatan,
                'tahun_akademik_id'   => $request->tahun_akademik_id,
                'status'              => $request->status,
                'tahun'               => $request->tahun,
                'jenis_kegiatan'      => $request->jenis_kegiatan,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id'    => 'required',
            'nama_kegiatan'      => 'required',
            'tahun_akademik_id' => 'required',
            'status'        => 'required',
            'tahun' => 'required',
            'jenis_kegiatan' => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{

            $kegiatan = Kegiatan::find($request->id);
            $data = $kegiatan->update([
                'nama_kegiatan'       => $request->nama_kegiatan,
                'tahun_akademik_id'   => $request->tahun_akademik_id,
                'status'              => $request->status,
                'tahun'               => $request->tahun,
                'jenis_kegiatan'      => $request->jenis_kegiatan,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request){

        $data = Kegiatan::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
