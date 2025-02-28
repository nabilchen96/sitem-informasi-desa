<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use DB;
use App\Models\Program;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PendudukController extends Controller
{
    public function index()
    {
        return view('backend.penduduk.index');
    }

    public function data()
    {

        $user = DB::table('penduduks')->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'nik' => 'unique:penduduks|required',
            'dokumen_kk' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_ktp' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('dokumen_kk')) {
                $kkPath = $request->file('dokumen_kk')->store('uploads/dokumen_kk', 'public');
            }

            // Simpan file KTP
            if ($request->hasFile('dokumen_ktp')) {
                $ktpPath = $request->file('dokumen_ktp')->store('uploads/dokumen_ktp', 'public');
            }

            $data = Penduduk::create(array_merge(
                $request->all(),
                [
                    'id_creator' => Auth::id(),
                    'dokumen_kk' => $kkPath ?? null,
                    'dokumen_ktp' => $ktpPath ?? null,
                ]
            ));


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
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:penduduks,nik,' . $request->id,
            'dokumen_kk' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_ktp' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('dokumen_kk')) {
                $kkPath = $request->file('dokumen_kk')->store('uploads/dokumen_kk', 'public');
            }

            // Simpan file KTP
            if ($request->hasFile('dokumen_ktp')) {
                $ktpPath = $request->file('dokumen_ktp')->store('uploads/dokumen_ktp', 'public');
            }

            $data = Penduduk::find($request->id);
            $data->update(array_merge(
                $request->all(),
                [
                    'dokumen_kk' => $kkPath ?? $data->dokumen_kk,
                    'dokumen_ktp' => $ktpPath ?? $data->dokumen_ktp,
                ]
            ));


            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);

    }

    public function delete(Request $request)
    {

        $data = Penduduk::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
