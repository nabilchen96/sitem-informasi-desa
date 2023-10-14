<?php

namespace App\Http\Controllers;

use App\Models\UsulanProposal;
use Illuminate\Http\Request;
use DB;
use App\Models\UsulanJudul;
use Auth;
use Illuminate\Support\Facades\Validator;

class UsulanProposalController extends Controller
{
    public function index(){

        return view('backend.proposal.index');
    }

    public function data(){
        
        $data = DB::table('usulan_proposals')
                ->join('usulan_juduls', 'usulan_juduls.id', '=', 'usulan_proposals.usulan_judul_id')
                ->where('usulan_proposals.status','')
                ->orWhere('usulan_proposals.status','0')
                ->select(
                    'usulan_juduls.judul_penelitian', 
                    'usulan_juduls.nama_ketua', 
                    'usulan_proposals.*'
                )
                ->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request){

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'usulan_judul_id'   => 'required', 
            'token_akses'       => 'required', 
        ]);

        //upload file proposal
        $file_proposal = $request->file_proposal;
        $nama_file_proposal = '1' . date('YmdHis.') . $file_proposal->extension();
        $file_proposal->move('file_proposal_library', $nama_file_proposal);

        //upload file rab
        $file_rab = $request->file_rab;
        $nama_file_rab = '1' . date('YmdHis.') . $file_rab->extension();
        $file_rab->move('file_rab_library', $nama_file_rab);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{
            $data = UsulanProposal::create([
                'usulan_judul_id'   => $request->usulan_judul_id,
                'file_proposal'     => $nama_file_proposal, 
                'file_rab'          => $nama_file_rab,
                'anggota'           => $request->anggota,
                'link_vide'         => $request->link_video, 
                'token_akses'       => $request->token_akses,
                'status'            => '0', 
                'tanggal_upload'    => date('Y-m-d'), 
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }
}
