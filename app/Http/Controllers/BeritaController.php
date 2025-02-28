<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Berita;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BeritaController extends Controller
{
    public function index()
    {
        return view('backend.berita.index');
    }

    public function data()
    {

        $user = DB::table('beritas')
                ->join('users', 'users.id', '=', 'beritas.id_creator')
                ->select(
                    'beritas.*',
                    'users.name'
                )
                ->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'required',
            'gambar_utama' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('gambar_utama')) {
                $gambar_utama = $request->file('gambar_utama')->store('uploads/gambar_utama', 'public');
            }

            $data = Berita::create(array_merge(
                $request->all(),
                [
                    'gambar_utama' => $gambar_utama,
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
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'required',
            'gambar_utama' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            // Simpan file KK
            if ($request->hasFile('gambar_utama')) {
                $gambar_utama = $request->file('gambar_utama')->store('uploads/gambar_utama', 'public');
            }

            $data = Berita::find($request->id);
            $data->update(array_merge(
                $request->all(),
                [
                    'gambar_utama' => $gambar_utama ?? $data->gambar_utama,
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

        $data = Berita::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
