<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index(){
        $kegiatans = DB::table('kegiatans')->orderBy('tahun','DESC')->get();
        return view('backend.jadwal.index', compact('kegiatans') );
    }

    public function data(){
        
        $jadwal = DB::table('jadwals')
                 ->leftJoin('kegiatans','kegiatans.id','jadwals.kegiatan_id')
                 ->select('jadwals.*','kegiatans.nama_kegiatan','kegiatans.tahun');

        $jadwal = $jadwal->get();

        
        return response()->json(['data' => $jadwal]);
    }

    public function store(Request $request){


        $validator = Validator::make($request->all(), [
            'nama_jadwal'      => 'required',
            'kegiatan_id'      => 'required',
            'tanggal_awal'     => 'required',
            'tanggal_akhir'    => 'required',
            'tahapan'          => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{
            $data = Jadwal::create([
                'nama_jadwal'       => $request->nama_jadwal,
                'kegiatan_id'   => $request->kegiatan_id,
                'tanggal_awal'   => $request->tanggal_awal,
                'tanggal_akhir'   => $request->tanggal_akhir,
                'status'              => $request->status,
                'tahapan'               => $request->tahapan,
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
            'nama_jadwal'      => 'required',
            'kegiatan_id'      => 'required',
            'tanggal_awal'     => 'required',
            'tanggal_akhir'    => 'required',
            'tahapan'          => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{

            $jadwal = Jadwal::find($request->id);
            $data = $jadwal->update([
                'nama_jadwal'       => $request->nama_jadwal,
                'kegiatan_id'   => $request->kegiatan_id,
                'tanggal_awal'   => $request->tanggal_awal,
                'tanggal_akhir'   => $request->tanggal_akhir,
                'status'              => $request->status,
                'tahapan'               => $request->tahapan,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request){

        $data = Jadwal::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
