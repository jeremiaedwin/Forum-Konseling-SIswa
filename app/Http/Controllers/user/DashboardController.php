<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Comment;
use App\User;
use App\Post;
use App\Article;
use App\Pengumuman;
class DashboardController extends Controller
{
    public function index()
    {
        $articles = Article::where('status_id',1)->paginate(5);
        $articles2 = Article::where('status_id',1)->paginate(4);
        $posts = Post::where('status_id', '1')->orderBy('created_at', 'Desc')->paginate(5);
        $posts2 = Post::where('status_id', '1')->orderBy('created_at', 'Desc')->paginate(5);
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $pengumumans = Pengumuman::latest()->paginate(1);
        $articles = Article::where('status_id',1)->latest()->paginate(4);
        $articles2 = Article::where('status_id',1)->latest()->paginate(4);
        return view('user.dashboard.index', compact('notifs', 'user', 'posts', 'posts2', 'pengumumans', 'articles', 'articles2'));
    }
}
