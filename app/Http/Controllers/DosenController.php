<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DosenController extends Controller
{

    public function test()
    {
        $dosens = Dosen::pluck('no_wa');

        $dataString = implode(',', $dosens->toArray() );

        echo $dataString;
    }

    public function index()
    {
        return view('backend.dosen.index');
    }

    public function data()
    {

        $dosen = DB::table('dosens');

        $dosen = $dosen->get();


        return response()->json(['data' => $dosen]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email'      => 'unique:dosens',
            'nama_dosen' => 'required',
            'nip'        => 'required',
            'jenis_kelamin' => 'required',
            'no_wa' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
            
        } else {
            $tokenAkses = 'SIPP-' . Str::random(5);
            $data = Dosen::create([
                'nip'            => $request->nip,
                'nama_dosen'     => $request->nama_dosen,
                'email'          => $request->email,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'no_wa'          => $request->no_wa,
                'is_active'      => $request->is_active,
                'token_akses'    => $tokenAkses,
            ]);

            sendWADosen($request->no_wa, $request->nama_dosen, $tokenAkses, $request->jenis_kelamin);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
            
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'    => 'required',
            'nama_dosen' => 'required',
            'nip'        => 'required',
            'jenis_kelamin' => 'required',
            'no_wa' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        } else {

            $dosen = Dosen::find($request->id);
            $data = $dosen->update([
                'nip'            => $request->nip,
                'nama_dosen'     => $request->nama_dosen,
                'email'          => $request->email,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'no_wa'          => $request->no_wa,
                'is_active'      => $request->is_active,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = Dosen::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
