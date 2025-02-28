<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
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

class PengajuanSuratController extends Controller
{
    public function index()
    {
        return view('backend.pengajuan_surat.index');
    }

    public function data()
    {

        $user = DB::table('pengajuan_surats')
                ->join('penduduks', 'penduduks.id', '=', 'pengajuan_surats.id_penduduk')
                ->select(
                    'penduduks.nik',
                    'penduduks.nama_lengkap', 
                    'pengajuan_surats.*'
                )
                ->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'surat' => 'file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('surat')) {
                $surat = $request->file('surat')->store('uploads/surat', 'public');
            }

            $data = PengajuanSurat::create(array_merge(
                $request->all(),
                [
                    'surat' => $surat ?? '',
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
            'surat' => 'file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('surat')) {
                $surat = $request->file('surat')->store('uploads/surat', 'public');
            }

            $data = PengajuanSurat::find($request->id);
            $data->update(array_merge(
                $request->all(),
                [
                    'surat' => $surat ?? $data->surat,
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

        $data = PengajuanSurat::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
