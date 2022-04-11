<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reportpost;
use App\Post;
use App\User;

class ReportpostController extends Controller
{
    public function index(){
        $r_post = Reportpost::all();
        return view('admin.reportpost.index', compact('r_post'));
    }

    public function show($id){

    }

    public function create($id){
        $posts = Post::find($id);
        $users = User::where('role', 'guru')->get();
        return view('admin.reportpost.create', compact('posts', 'users'));
    }

    public function store(Request $request){
        $r_post = new Reportpost;
        $r_post->post_id = $request->post_id;
        $r_post->alasan_report = $request->alasan_report;
        $r_post->klasifikasi_masalah = $request->klasifikasi_masalah;
        $r_post->receiver_id = $request->receiver_id;
        $r_post->deskripsi_report = $request->deskripsi_report;
        $r_post->save();
        return back()->withInfo('data tersimpan');
                
    }

    public function update(Request $request, $id){
        $r_post = Reportpost::find($id);
        $r_post->post_id = $id;
        $r_post->klasifikasi_masalah = $request->klasifikasi_masalah;
        $r_post->receiver_id = $request->receiver_id;
        $r_post->deskripsi_report = $request->deskripsi_report;
        $r_post->save();
        return back();       
    }
}
