<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use DB;
use App\Models\Desa;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DesaController extends Controller
{
    public function index()
    {
        return view('backend.desa.index');
    }

    public function data()
    {

        $user = DB::table('desas')->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'kepala_desa' => 'required',
            'provinsi' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Desa::create(array_merge(
                $request->all(),
                ['id_creator' => Auth::id()]
            ));
            

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'kepala_desa' => 'required',
            'provinsi' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Desa::find($request->id);
            $data->update(array_merge(
                $request->all(),
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

        $data = Desa::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
