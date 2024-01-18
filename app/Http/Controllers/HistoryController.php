<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HistoryController extends Controller
{
    public function index(){

        $token = Request('token_akses');
        $id_kegiatan = Request('id_kegiatan');

        //JUDUL PENELITIAN
        $judul = DB::table('usulan_juduls')
                    ->where('token_akses', $token)
                    ->where('id', $id_kegiatan)
                    ->first();

        //PROPOSAL DAN RAB
        $proposal = DB::table('usulan_proposals')
                    ->where('usulan_judul_id', $id_kegiatan)
                    ->get();

        //REVISI
        $revisi = DB::table('revisi_proposals as rp')
                ->join('dosens as d', 'd.token_akses', '=', 'rp.token_akses')
                ->join('usulan_proposals as up', 'up.token_akses', '=', 'd.token_akses')
                ->join('usulan_juduls as uj', 'uj.token_akses', '=', 'd.token_akses')
                ->select(
                    'rp.file_proposal_revisi', 
                    'up.*'
                )
                ->where('uj.id', $id_kegiatan)
                ->get();
        

        //KONTRAK
        $kontrak = DB::table('file_kontraks as fk')
                ->leftjoin('usulan_juduls as uj', 'uj.token_akses', '=', 'fk.token_akses')
                ->orderBy('fk.created_at', 'DESC')
                ->select(
                    'fk.*'
                )
                ->where('uj.id', $id_kegiatan)
                ->first();

        //SEMINAR ANTARA
        $seminar = DB::table('seminar_antaras as sa')
            ->join('dosens as d', 'd.token_akses', '=', 'sa.token_akses')
            ->join('usulan_juduls as uj', 'uj.token_akses', '=', 'd.token_akses')
            ->select(
                'sa.*', 
                'd.nama_dosen', 
                'judul_penelitian'
            )
            ->where('uj.id', $id_kegiatan)
            ->first();

        //LUARAN PENELITIAN
        $luaran = DB::table('luaran_penelitians as sa')
            ->join('dosens as d', 'd.token_akses', '=', 'sa.token_akses')
            ->join('usulan_juduls as uj', 'uj.token_akses', '=', 'd.token_akses')
            ->select(
                'sa.*',
                'd.nama_dosen',
                'judul_penelitian'
            )
            ->where('uj.id', $id_kegiatan)
            ->get();

        return view('frontend.history', [
            'judul' => $judul, 
            'proposal' => $proposal, 
            'revisi' => $revisi,
            'kontrak' => $kontrak, 
            'seminar' => $seminar, 
            'luaran' => $luaran
        ]);
    }
}
