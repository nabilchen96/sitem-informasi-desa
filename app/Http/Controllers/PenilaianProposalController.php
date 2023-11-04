<?php

namespace App\Http\Controllers;

use App\Models\PenilaianProposal;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class PenilaianProposalController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'hari'      => 'required',
            'tanggal' => 'required',
            'biaya_diusulkan' => 'required',
            'biaya_direkomendasikan' => 'required',
            'nilai_kriteria_1' => 'required',
            'nilai_kriteria_2' => 'required',
            'nilai_kriteria_3' => 'required',
            'nilai_kriteria_4' => 'required',
            'nilai_kriteria_5' => 'required',
            'nilai_kriteria_6' => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{
            $data = PenilaianProposal::create([
                'hari'     => $request->hari,
                'tanggal'      => $request->tanggal,
                'biaya_diusulkan'      => $request->biaya_diusulkan,
                'biaya_direkomendasikan'      => $request->biaya_direkomendasikan,
                'nilai_kriteria_1'      => $request->nilai_kriteria_1,
                'nilai_kriteria_2'      => $request->nilai_kriteria_2,
                'nilai_kriteria_3'      => $request->nilai_kriteria_3,
                'nilai_kriteria_4'      => $request->nilai_kriteria_4,
                'nilai_kriteria_5'      => $request->nilai_kriteria_5,
                'nilai_kriteria_6'      => $request->nilai_kriteria_6,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }
}
