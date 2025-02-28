<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Laporan;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LaporanController extends Controller
{
    public function index()
    {
        return view('backend.laporan.index');
    }

    public function data()
    {

        $user = DB::table('laporans')->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'laporan' => 'required',
            'gambar_laporan' => 'file|mimes:jpg,jpeg,png|max:2048',
            'gambar_tanggapan' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('gambar_laporan')) {
                $gambar_laporan = $request->file('gambar_laporan')->store('uploads/gambar_laporan', 'public');
            }

            if ($request->hasFile('gambar_tanggapan')) {
                $gambar_tanggapan = $request->file('gambar_tanggapan')->store('uploads/gambar_tanggapan', 'public');
            }

            $data = Laporan::create(array_merge(
                $request->all(),
                [
                    'status' => $request->status ?? 'Diproses',
                    'tanggapan' => $request->tanggapan ?? 'Belum Ada Tanggapan',
                    'gambar_laporan' => $gambar_laporan ?? '',
                    'gambar_tanggapan' => $gambar_tanggapan ?? '',
                    'id_creator' => Auth::id()
                ]
            ));


            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);

    }

    public function storeFront(Request $request)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
            'laporan' => 'required',
            'gambar_laporan' => 'file|mimes:jpg,jpeg,png|max:2048',
            'gambar_tanggapan' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('gambar_laporan')) {
                $gambar_laporan = $request->file('gambar_laporan')->store('uploads/gambar_laporan', 'public');
            }

            if ($request->hasFile('gambar_tanggapan')) {
                $gambar_tanggapan = $request->file('gambar_tanggapan')->store('uploads/gambar_tanggapan', 'public');
            }

            $data = Laporan::create(array_merge(
                $request->all(),
                [
                    'status' => $request->status ?? 'Diproses',
                    'tanggapan' => $request->tanggapan ?? 'Belum Ada Tanggapan',
                    'gambar_laporan' => $gambar_laporan ?? '',
                    'gambar_tanggapan' => $gambar_tanggapan ?? '',
                    'id_creator' => Auth::id()
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
            'laporan' => 'required',
            'gambar_laporan' => 'file|mimes:jpg,jpeg,png|max:2048',
            'gambar_tanggapan' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('gambar_laporan')) {
                $gambar_laporan = $request->file('gambar_laporan')->store('uploads/gambar_laporan', 'public');
            }

            if ($request->hasFile('gambar_tanggapan')) {
                $gambar_tanggapan = $request->file('gambar_tanggapan')->store('uploads/gambar_tanggapan', 'public');
            }

            $data = Laporan::find($request->id);
            $data->update(array_merge(
                $request->all(),
                [
                    'tanggapan' => $request->tanggapan ?? 'Belum Ada Tanggapan',
                    'gambar_laporan' => $gambar_laporan ?? $data->gambar_laporan,
                    'gambar_tanggapan' => $gambar_tanggapan ?? $data->gambar_tanggapan,
                    'id_creator' => Auth::id()
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

        $data = Laporan::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
