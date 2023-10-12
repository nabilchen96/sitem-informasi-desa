<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class TahunController extends Controller
{
    public function index(){
        return view('backend.tahun.index');
    }

    public function data(){
        
        $tahun = DB::table('tahun_akademiks');

        $tahun = $tahun->get();

        
        return response()->json(['data' => $tahun]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_tahun'      => 'unique:tahun_akademiks',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{
            $data = TahunAkademik::create([
                'nama_tahun'     => $request->nama_tahun,
                'is_active'      => $request->is_active,
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
            'nama_tahun' => 'required',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{

            $tahun = TahunAkademik::find($request->id);
            $data = $tahun->update([
                'nama_tahun'     => $request->nama_tahun,
                'is_active'      => $request->is_active,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request){

        $data = TahunAkademik::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
