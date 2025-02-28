<?php

namespace App\Http\Controllers;

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

class ProgramController extends Controller
{
    public function index()
    {
        return view('backend.program.index');
    }

    public function data()
    {

        $user = DB::table('programs')->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'program' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Program::create(array_merge(
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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'program' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Program::find($request->id);
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

        $data = Program::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
