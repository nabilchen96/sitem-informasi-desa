<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\RecordUsulanProposal;
use App\Models\UsulanProposal;
use Illuminate\Http\Request;
use DB;
use App\Models\UsulanJudul;
use Auth;
use Illuminate\Support\Facades\Validator;

class UsulanProposalController extends Controller
{
    public function index()
    {

        $new = DB::table('usulan_proposals')->where('status', '')->orWhere('status', '0')->get();
        $acc = DB::table('usulan_proposals')->where('status', '1')->get();
        $tolak = DB::table('usulan_proposals')->where('status', '2')->get();
        $reviewers = DB::table('users')->where('role', 'Reviewer')->get();

        return view('backend.proposal.index', compact('new', 'acc', 'tolak', 'reviewers'));
    }

    public function data()
    {
        if (Auth::user()->role == "Admin") {
            $data = DB::table('usulan_proposals')
                ->join('usulan_juduls', 'usulan_juduls.id', '=', 'usulan_proposals.usulan_judul_id')
                ->where('usulan_proposals.status', '')
                ->orWhere('usulan_proposals.status', '0')
                ->select(
                    'usulan_juduls.judul_penelitian',
                    'usulan_juduls.nama_ketua',
                    'usulan_proposals.*'
                )
                ->get();
        } elseif (Auth::user()->role == "Reviewer") {
            $data = DB::table('usulan_proposals')
                ->join('usulan_juduls', 'usulan_juduls.id', '=', 'usulan_proposals.usulan_judul_id')
                ->where('usulan_proposals.status', '1')
                ->select(
                    'usulan_juduls.judul_penelitian',
                    'usulan_juduls.nama_ketua',
                    'usulan_proposals.*'
                )
                ->get();
        }

        return response()->json(['data' => $data]);
    }


    public function dataACC()
    {

        $data = DB::table('usulan_proposals')
            ->join('usulan_juduls', 'usulan_juduls.id', '=', 'usulan_proposals.usulan_judul_id')
            ->where('usulan_proposals.status', '1')
            ->select(
                'usulan_juduls.judul_penelitian',
                'usulan_juduls.nama_ketua',
                'usulan_proposals.*'
            )
            ->get();

        return response()->json(['data' => $data]);
    }

    public function dataTolak()
    {

        $data = DB::table('usulan_proposals')
            ->join('usulan_juduls', 'usulan_juduls.id', '=', 'usulan_proposals.usulan_judul_id')
            ->where('usulan_proposals.status', '2')
            ->select(
                'usulan_juduls.judul_penelitian',
                'usulan_juduls.nama_ketua',
                'usulan_proposals.*'
            )
            ->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {

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

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        } else {
            $data = UsulanProposal::create([
                'usulan_judul_id'   => $request->usulan_judul_id,
                'file_proposal'     => $nama_file_proposal,
                'file_rab'          => $nama_file_rab,
                'anggota'           => $request->anggota,
                'link_video'         => $request->link_video,
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

    public function updateStatus(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'    => 'required',

        ]);

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        } else {

            $usulanproposal = UsulanProposal::find($request->id);
            $getJudul = UsulanJudul::find($usulanproposal->usulan_judul_id);
            $getDosen = Dosen::where('token_akses', $request->token_akses)->first();

            $data = $usulanproposal->update([
                'status'            => $request->status,
                'keterangan'        => $request->keterangan_respon,
            ]);

            RecordUsulanProposal::create([
                'usulan_proposal_id' => $request->id,
                'keterangan_respon' => $request->keterangan_respon,
                'file_proposal_lama' => $usulanproposal->file_proposal,
                'file_rab_lama' => $usulanproposal->file_rab,
                'tgl_record' => date('Y-m-d'),
                'status_record' => $request->status,
                'status_perubahan' => $request->status,
            ]);

            sendUpdateUsulanProposal($getDosen->no_wa, $getDosen->nama_dosen, $getJudul->judul_penelitian, $request->status, $getDosen->jenis_kelamin, $request->keterangan_respon);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function updateReviewer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'idACC'    => 'required',
            'reviewer1' => 'required',
            'reviewer2' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        } elseif ($request->reviewer1 == $request->reviewer2) {
            $data = [
                'responCode'    => 2,
                'respon'        => "Reviewer 1 dan 2 tidak boleh sama"
            ];
            
        } else {

            $usulanproposal = UsulanProposal::find($request->idACC);

            $data = $usulanproposal->update([
                'reviewer1_id'            => $request->reviewer1,
                'reviewer2_id'        => $request->reviewer2,
            ]);


            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }
}
