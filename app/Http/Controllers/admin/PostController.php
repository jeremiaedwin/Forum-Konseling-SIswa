<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Post;
use App\PostCategory;
use App\Category;
use App\Status;
use App\Comment;
use App\CommentLike;
use App\Like;
use App\ReplyComment;
use App\User;
use App\Postview;
use App\Report;
use App\Laporankonseling;
use App\Reportpost;
use Auth;
use Files;

class PostController extends Controller
{
    public function index()
    {
        $testview = PostCategory::all()->toArray();

        $diagramCategory = DB::table("posts")
        ->join('categories', "posts.category_id","=","categories.id")
	    ->select("posts.category_id", "categories.category", DB::raw("COUNT(category_id) as count_category"))
        ->groupBy("posts.category_id", "categories.category")
        ->get();

        $countCategory=[];
        $nameCategory=[];

        foreach($diagramCategory as $c)
        $nameCategory[] = $c->category;
        
        foreach($diagramCategory as $d)
        $countCategory[] = $d->count_category;

        // dd($countCategory);
        $user = Auth::user()->id;
        $users = User::all();
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        $statuses = Status::all();
        $likes = Like::all();
        $posts = Post::orderBy('created_at', 'Desc')->paginate(10);
        $posts2 = Post::orderBy('created_at', 'Desc')->paginate(10);
        return view('admin.post.index', compact('users','categories', 'statuses', 'posts', 'posts2', 'likes', 'notifs', 'user', 'nameCategory', 'diagramCategory', 'countCategory'));
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        $statuses = Status::all();
        $comments = Comment::where('post_id', '=', $id)->get();
        $posts = Post::find($id);
        $posts1 = $posts->id;
        $user_like = Like::where('user_id', '=', $user)->where('post_id', '=', $posts1)->first();
        $comment_like = CommentLike::where('user_id', '=', $user)->get();
        $likes = Like::where('post_id', '=', $posts1)->count();
        $likes2 = Like::where('post_id', '=', $id)->get();
        $diagramViews = DB::table('post_view')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count("created_at") as views'))
        ->where('post_id', $id)
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();
        $views = [];
        foreach($diagramViews as $d)
        $views[] = $d->views;
        foreach($diagramViews as $c)
        $dateviews[] = $c->date;

        return view('admin.post.show', compact('categories', 'statuses', 'posts', 'posts1', 'comments', 'likes', 'likes2',  'user_like', 'user', 'notifs', 'user', 'diagramViews', 'views', 'dateviews'));
    }

    function updateDraft(Request $request, $id){
        $data = Post::find($id);
        $data->status_id = $request->status_id;
        $data->save ();
        return back()->withInfo("Status postingan telah dirubah");
    }

    function sortir(Request $request){
        $user = Auth::user()->id;
        $users = User::all();
        $statuses = Status::all();
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $query1 = $request->input('category');
        $query2 = $request->input('status_id');
        $query3 = $request->input('user_id');
        $categories = Category::all();
        if($query1 != null){
            $posts = Post::where('category_id', $query1)->orderBy('created_at', 'desc')->get();
        }

        if($query2 != null){
            $posts = Post::where('status_id', $query2)->orderBy('created_at', 'desc')->get();
        }
        
        if($query1 != null && $query2 != null){
            $posts = Post::where('category_id', $query1)->where('status_id', $query2)->get();
        }

        if($query3 != null){
            $posts = Post::where('user_id', $query3)->orderBy('created_at', 'desc')->get();
        }
        
        return view('admin.post.index', compact('query1', 'query2', 'posts', 'statuses', 'users', 'categories',  'notifs', 'user'));
    }

    public function destroy($id)
    {
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

        return back()->withInfo('Post berhasil dihapus');

    }
}
