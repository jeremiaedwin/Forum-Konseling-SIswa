<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Post;
use App\Category;
use App\Status;
use App\Comment;
use App\Like;
use App\Caterepo;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $caterepos = Caterepo::all();
        $statuses = Status::all();
        $likes = Like::all();
        $posts = Post::where('status_id', '1')->orderBy('created_at', 'Desc')->paginate(5);
        return view('guru.post.index', compact('categories', 'statuses', 'posts', 'likes','caterepos'));
    }

    public function show(Request $request, $slug)
    {
        $categories = Category::all();
        $statuses = Status::all();
        $comments = Comment::orderBy('created_at', 'asc')->get();
        $posts = Post::where('slug', '=', $slug)->first();
        $user =  Auth::user()->id;
        $posts1 = $posts->id;
        $user_like = Like::where('user_id', '=', $user)->where('post_id', '=', $posts1)->first();
        $likes = Like::where('post_id', '=', $posts1)->count();

        return view('guru.post.show', compact('categories', 'statuses', 'posts', 'posts1', 'comments', 'likes', 'user_like', 'user'));
    }

    function updateView(Request $request, $slug){
        $visit = $request->total_visit;
        $updateViews = DB::update("update posts set total_visit = ? where slug = ?", [$visit, $slug]);
        return redirect()->route('guru-post.show', $slug);
    }

    public function like(Request $request)
    {
        $likes = new Like;
        $likes->user_id =  $request->user_id;
        $likes->post_id = $request->post_id;
        $likes->save();

        return back();
    }

    public function unlike(Request $request)
    {
        $query1 =  $request->user_id;
        $query2 = $request->post_id;
        $unlike = Like::where('user_id',$query1)->where('post_id',$query2)->first();
        $unlike->delete();

        return back();
    }

    function sortir(Request $request){
        $query1 = $request->input('category');
        $query2 = $request->input('sortir');
        // $comments = DB::table('posts')
        // ->join('comments', 'posts.id', '=', 'comments.post_id')
        // ->select('posts.* as p','comments.post_id',DB::raw('count(comments.post_id) as post'))
        // ->groupBy('posts.id')
        // ->orderBy('post', 'desc')
        // ->get();
        // dd($comments);
        $categories = Category::all();
        if($query1 != null){
            $posts = Post::where('category_id', $query1)->where('status_id', '1')->orderBy('created_at', 'desc')->paginate(5);
        }
        if($query2 != null){
            if($query2 == '1'){
                $posts = Post::orderBy('total_visit', 'Desc')->paginate(5);
            }
            if($query2 == '2'){

            }
            if($query2 == '3'){
                $posts = Post::orderBy('created_at', 'Desc')->paginate(5);
            }
            if($query2 == '4'){
                $posts = Post::orderBy('created_at', 'Asc')->paginate(5);
            }
        }
        if($query1 != null && $query2 == 1){
            $posts = Post::where('category_id', $query1)->where('status_id', '1')->orderBy('total_visit', 'Desc')->paginate(5);
        }
        if($query1 != null && $query2 == 3){
            $posts = Post::where('category_id', $query1)->where('status_id', '1')->orderBy('created_at', 'Desc')->paginate(5);
        }
        if($query1 != null && $query2 == 4){
            $posts = Post::where('category_id', $query1)->where('status_id', '1')->orderBy('created_at', 'asc')->paginate(5);
        }
        $caterepos = Caterepo::all();
        return view('user.post.index', compact('query1', 'query2', 'posts', 'categories', 'caterepos'));
    }
}
