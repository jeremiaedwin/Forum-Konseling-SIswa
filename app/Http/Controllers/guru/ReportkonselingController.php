<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reportpost;
use App\Laporankonseling;
use App\Rekapkonseling;
use Auth;

class ReportkonselingController extends Controller
{
    public function create($id){
        $r_post = Reportpost::find($id);
        return view('guru.reportkonseling.create', compact('r_post'));
    }

    public function store(Request $request){
        $reportpost_id = $request->reportpost_id;
        $r_konseling = new Laporankonseling;
        $r_konseling->post_id = $request->post_id;
        $r_konseling->reportpost_id = $reportpost_id;
        $r_konseling->user_id = Auth::id();
        $r_konseling->tanggal_konseling = $request->tanggal_konseling;
        $r_konseling->masalah_selesai = $request->masalah_selesai;
        $r_konseling->deskripsi_penyelesaian = $request->deskripsi_penyelesaian;
        $r_konseling->save();

        $r_post = Reportpost::find($reportpost_id);
        $r_post->status = 1;
        $r_post->save();
        return back()->withInfo("Data Tersimpan");
    }

    function index(){
        $r_konseling = Rekapkonseling::where('user_id', Auth::id())->get();
        return view('guru.reportkonseling.index', compact('r_konseling'));
    }
}
