<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\RecordUsulanJudul;
use Illuminate\Http\Request;
use DB;
use App\Models\UsulanJudul;
use Auth;
use Illuminate\Support\Facades\Validator;

class UsulanJudulController extends Controller
{
    public function index()
    {

        $new = DB::table('usulan_juduls')->where('status', '')->orWhere('status', '0')->get();
        $acc = DB::table('usulan_juduls')->where('status', '1')->get();
        $tolak = DB::table('usulan_juduls')->where('status', '2')->get();

        return view('backend.judul.index', compact('new', 'acc', 'tolak'));
    }

    public function data()
    {

        $data = DB::table('usulan_juduls')->where('status', '')->orWhere('status', '0')->get();

        return response()->json(['data' => $data]);
    }

    public function dataAcc()
    {

        $data = DB::table('usulan_juduls')->where('status', '1')->get();

        return response()->json(['data' => $data]);
    }

    public function dataTolak()
    {

        $data = DB::table('usulan_juduls')->where('status', '2')->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'nama_ketua' => 'required',
            'judul_penelitian' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $file = $request->file_blanko;
            if($file){
                $nama_file = '1' . date('YmdHis.') . $file->extension();
                $file->move('scan_blanko', $nama_file);
            } else {
                $nama_file = NULL;
            }
            
            $data = UsulanJudul::create([
                'jadwal_id' => $request->jadwal_id,
                'nama_ketua' => $request->nama_ketua,
                'judul_penelitian' => $request->judul_penelitian,
                'jenis_pelaksanaan' => $request->jenis_pelaksanaan,
                'jenis_penelitian' => $request->jenis_penelitian,
                'program_studi' => $request->program_studi,
                'sub_topik' => $request->sub_topik,
                'token_akses' => $request->token_akses,
                'jenis_usulan' => $request->jenis_usulan,
                'status' => '0',
                'file_blanko' => $nama_file,
                'tanggal_upload' => date('Y-m-d'),
            ]);

            sendWAAjuan("Usulan Judul");

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',

        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $usulanjudul = UsulanJudul::find($request->id);
            $getDosen = Dosen::where('token_akses', $request->token_akses)->first();

            if($request->file_blanko){
                $file = $request->file_blanko;
                $nama_file = '1' . date('YmdHis.') . $file->extension();
                $file->move('scan_blanko', $nama_file);
            }

            $data = $usulanjudul->update([
                'nip' => $request->nip,
                'judul_penelitian' => $request->judul_penelitian,
                'jenis_pelaksanaan' => $request->jenis_pelaksanaan,
                'jenis_penelitian' => $request->jenis_penelitian,
                'program_studi' => $request->program_studi,
                'sub_topik' => $request->sub_topik,
                'jenis_usulan' => $request->jenis_usulan,
                'file_blanko'  => $nama_file ?? $usulanjudul->file_blanko,
                'status' => $request->status
            ]);

            RecordUsulanJudul::create([
                'usulan_judul_id' => $request->id,
                'keterangan_respon' => $request->keterangan_respon,
                'judul_lama' => $usulanjudul->judul_penelitian,
                'tgl_record' => date('Y-m-d'),
                'status_record' => $request->status,
                'status_perubahan' => $request->status
            ]);

            if($request->kirim_wa == '1') {
                sendUpdateUsulanJudul($getDosen->no_wa, $getDosen->nama_dosen, $request->judul_penelitian, $request->status, $getDosen->jenis_kelamin);
            }


            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = UsulanJudul::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
