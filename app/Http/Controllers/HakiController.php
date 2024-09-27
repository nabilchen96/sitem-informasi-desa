<?php

namespace App\Http\Controllers;

use App\Models\Haki;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HakiController extends Controller
{
    public function index()
    {
        return view('backend.haki.index');
    }

    public function data()
    {

        $haki = DB::table('hakis');
        $haki = $haki->get();

        return response()->json(['data' => $haki]);
    }

    public function dataHAKI()
    {

        $haki = DB::table('hakis');
        $haki = $haki->get();

        return response()->json(['data' => $haki]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'file_haki' => 'mimes:pdf'
        ]);

        $file = $request->file;
        $nama_file = '1' . date('YmdHis.') . $file->extension();
        $file->move('file_haki', $nama_file);

        if ($validator->fails()) {

            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];

        } else {
            $data = Haki::create([
                'judul' => $request->judul,
                'file' => $nama_file,
            ]);

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
            'id'    => 'required',
            'judul' => 'required',
            'file_haki' => 'mimes:pdf'
        ]);

        if($request->file){
            $file = $request->file;
            $nama_file = '1' . date('YmdHis.') . $file->extension();
            $file->move('file_haki', $nama_file);
        }

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $haki = Haki::find($request->id);
            $data = $haki->update([
                'judul' => $request->judul, 
                'file'  => $nama_file ?? $haki->file
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

        $data = Haki::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function frontLibrary(Request $request){

        // $data = Library::orderBy('created_at','DESC');
        $data = DB::table('hakis')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('frontend.haki', [
            'data'  => $data
        ]);
    }

    public function frontHAKI(Request $request){

        // $data = Library::orderBy('created_at','DESC');
        $data = DB::table('hakis')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('frontend.haki', [
            'data'  => $data
        ]);
    }
}
