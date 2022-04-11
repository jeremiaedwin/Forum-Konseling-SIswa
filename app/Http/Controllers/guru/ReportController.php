<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Caterepo;
use App\Comment;
use App\Report;
use Auth;

class ReportController extends Controller
{
    public function index(){
        $user = Auth::user()->id;
        $caterepos = Caterepo::all();
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $reports = Report::where('user_id', $user)->paginate(10);

        return view('guru/report/index', ['reports' => $reports], compact('notifs', 'caterepos'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'caterepo_id' => 'required',
            'comment' => 'required',
        ],[
            'caterepo_id.required' => 'Pilih salah satu categori pelanggaran',
            'comment.required' => 'Beri Alasan dari pelanggaran post ini',
        ]);

        DB::table('reports')->insert([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'caterepo_id' => $request->caterepo_id,
            'comment' => $request->comment,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/guru/post');
    }

    public function delete($id){

        Report::where('id', $id)->delete();
        
        return redirect('/guru/report/index');
    }
}
