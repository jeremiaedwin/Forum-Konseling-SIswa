<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Caterepo;
use App\Comment;
use App\CommentLike;
use App\Like;
use App\ReplyComment;
use App\Report;
use App\Laporankonseling;
use App\Reportpost;
use App\Post;
use Auth;

class ReportController extends Controller
{
    public function index(){
        $user = Auth::user()->id;
        $caterepos = Caterepo::all();
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $reports = Report::paginate(10);

        return view('admin/report/index', ['reports' => $reports], compact('notifs', 'caterepos'));
    }

    public function delete($id){
        DB::table('reports')->where('id', $id)->delete();

        return redirect('admin/report/index');
    }

    public function delete_post($id){
        Report::where('post_id', $id)->delete();
        $laporankonseling = Laporankonseling::where('post_id',$id);
        $laporankonseling->delete();
        $reportpost = Reportpost::where('post_id',$id);
        $reportpost->delete();
        $like=Like::where('post_id',$id);
        $like->delete();
        $comments=Comment::where('post_id',$id);
        $comments->delete();
        $c_reply=ReplyComment::where('post_id',$id);
        $c_reply->delete();
        $posts=Post::FindOrFail($id);
        \File::delete(public_path('image/'. $posts->image));
        $posts->delete();


        return redirect('admin/report/index');
    }
}
