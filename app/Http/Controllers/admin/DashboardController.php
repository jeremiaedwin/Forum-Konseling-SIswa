<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
Use App\Reportpost;
use App\Rekapkonseling;

class DashboardController extends Controller
{
    function index(){
        $posts_chart = Post::select(\DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');

        $comment_chart = Comment::select(\DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');

        $posts = Post::all()->count();

        $role_users = User::where('role', 'siswa')->count();
        $role_users2 = User::where('role', 'guru')->count();
        $role_users3 = User::where('role', 'admin')->count();
        $r_post = Reportpost::orderBy('created_at', 'desc')->get();
        $rekapKonselings = Rekapkonseling::orderBy('created_at', 'desc')->get();
        $users = User::all();
        return view('admin.dashboard.index', compact('posts_chart', 'comment_chart', 'posts', 'role_users', 'role_users2', 'role_users3', 'users', 'r_post', 'rekapKonselings'));
    }
}
