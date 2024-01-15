<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotifikasiController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('nama_dosen')->get();
        return view('backend.notifikasi.index', compact('dosens') );
    }

    public function data()
    {

        $notifikasi = DB::table('notifikasis')->orderBy('created_at', 'DESC')->get();

        return response()->json(['data' => $notifikasi]);
    }

    public function teskirimNotif(Request $request)
    {
        // dd($request->list_nomor);
        sendWANotif($request->keterangan, $request->list_nomor);
        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Ditambah'
        ];
        return response()->json($data);
    }

    public function store(Request $request)
    {   
        // dd(count($request->list_nomor));
        $validator = Validator::make($request->all(), [
            'judul_notif' => 'required',
            'isi_notif' => 'required',
        ]);

        if ($validator->fails()) {

            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];

        } else {
            
            if($request->list_nomor[0] == 'Semua' || count($request->list_nomor) > 1){
                $tipe_pengiriman = 'Broadcast';
            } else {
                $tipe_pengiriman = "Personal";
            }

            if($request->list_nomor == 'Semua') {
                $listnomor = "Semua";
            } else {
                $listnomor = implode(',', $request->list_nomor);
                
            }

            $data = Notifikasi::create([
                'judul_notif' => $request->judul_notif,
                'isi_notif' => $request->isi_notif,
                'list_nomor' => $listnomor,
                'tipe_pengiriman' => $tipe_pengiriman,
                'kirim_sekarang' => '1',
            ]);

            sendWANotif($request->isi_notif, $request->list_nomor);

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
            'judul_notif' => 'required'
        ]);

        if ($request->file) {
            $file = $request->file;
            $nama_file = '1' . date('YmdHis.') . $file->extension();
            $file->move('file_notifikasi', $nama_file);
        }

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $notifikasi = Notifikasi::find($request->id);
            $data = $notifikasi->update([
                'judul_notif' => $request->judul_notif,
                'file' => $nama_file ?? $notifikasi->file,
                'keterangan' => $request->keterangan
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = Notifikasi::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function frontNotifikasi(Request $request)
    {

        $data = Notifikasi::orderBy('created_at', 'DESC')->get();

        return view('frontend.notifikasi', [
            'data' => $data
        ]);
    }
}
