<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use Auth;

class ArticleController extends Controller
{
    public function article()
    {
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $articles = Article::where('status_id',1)->paginate(5);

        return view('user/article/index',['articles' => $articles], compact('notifs'));
    }

    //Show Article
    public function show_article($slug){
        
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $articles = DB::table('article')->where('slug',$slug)->get();

        return view('user/article/show',['articles' => $articles], compact('notifs'));
    }

}
