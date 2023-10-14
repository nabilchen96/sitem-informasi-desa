<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\RevisiProposal;
use Auth;
use Illuminate\Support\Facades\Validator;

class RevisiProposalController extends Controller
{
    public function index()
    {

        return view('backend.revisi_proposal.index');
    }

    public function data()
    {

        $data = DB::table('revisi_proposals as rp')
                ->join('dosens as d', 'd.token_akses', '=', 'rp.token_akses')
                ->join('usulan_proposals as up', 'up.token_akses', '=', 'd.token_akses')
                ->join('usulan_juduls as uj', 'uj.token_akses', '=', 'd.token_akses')
                ->select(
                    'rp.file_proposal_revisi', 
                    'rp.tgl_upload',
                    'd.nama_dosen', 
                    'uj.judul_penelitian', 
                    'uj.nama_ketua', 
                    'rp.created_at'
                )
                ->groupBy('rp.file_proposal_revisi')
                ->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token_akses' => 'required',
        ]);

        //upload file proposal
        $file_proposal_revisi = $request->file_proposal_revisi;
        $nama_file_proposal_revisi = '1' . date('YmdHis.') . $file_proposal_revisi->extension();
        $file_proposal_revisi->move('file_proposal_revisi_library', $nama_file_proposal_revisi);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = RevisiProposal::create([
                'jadwal_id'             => $request->jadwal_id,
                'file_proposal_revisi'  => $nama_file_proposal_revisi,
                'token_akses'           => $request->token_akses,
                'status'                => '0',
                'tgl_upload'        => date('Y-m-d'),
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }
}