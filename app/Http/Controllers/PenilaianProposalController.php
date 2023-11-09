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
                'usulan_proposal_id'          => $request->id,
                'hari'                        => $request->hari,
                'tanggal'                     => $request->tanggal,
                'biaya_diusulkan'             => $request->biaya_diusulkan,
                'biaya_direkomendasikan'      => $request->biaya_direkomendasikan,
                'nilai_kriteria_1'            => $request->nilai_kriteria_1,
                'n1_x_bobot'                  => $request->nilai_kriteria_1 * 15,
                'nilai_kriteria_2'            => $request->nilai_kriteria_2,
                'n2_x_bobot'                  => $request->nilai_kriteria_2 * 10,
                'nilai_kriteria_3'            => $request->nilai_kriteria_3,
                'n3_x_bobot'                  => $request->nilai_kriteria_3 * 15,
                'nilai_kriteria_4'            => $request->nilai_kriteria_4,
                'n4_x_bobot'                  => $request->nilai_kriteria_4 * 20,
                'nilai_kriteria_5'            => $request->nilai_kriteria_5,
                'n5_x_bobot'                  => $request->nilai_kriteria_5 * 20,
                'nilai_kriteria_6'            => $request->nilai_kriteria_6,
                'n6_x_bobot'                  => $request->nilai_kriteria_5 * 20,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }
}
