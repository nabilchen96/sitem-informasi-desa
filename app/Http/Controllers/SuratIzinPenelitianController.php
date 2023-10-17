<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\SuratIzinPenelitian;
use Auth;
use Illuminate\Support\Facades\Validator;

class SuratIzinPenelitianController extends Controller
{
    public function index()
    {
        return view('backend.surat_izin_penelitian.index');
    }

    public function data(){

        $data = DB::table('surat_izin_penelitians')->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dosen' => 'required'
        ]);

        //upload file proposal
        // $surat_izin_penelitian = $request->surat_izin_penelitian;
        // $nama_surat_izin_penelitian = '1' . date('YmdHis.') . $surat_izin_penelitian->extension();
        // $surat_izin_penelitian->move('surat_izin_penelitian_library', $nama_surat_izin_penelitian);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = SuratIzinPenelitian::create([
                'nama_dosen' => $request->nama_dosen,
                'alasan_pengajuan_surat' => $request->alasan_pengajuan_surat,
                'tanggal_rencana_kegiatan' => $request->tanggal_rencana_kegiatan,
                'lokasi_rencana_kegiatan' => $request->lokasi_rencana_kegiatan,
                'judul_penelitian_terkait' => $request->judul_penelitian_terkait,
                // 'file_surat_izin_penelitian' => $nama_surat_izin_penelitian,
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }
}