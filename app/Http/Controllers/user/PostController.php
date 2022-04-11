<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Post;
use App\Category;
use App\Status;
use App\Comment;
use App\CommentLike;
use App\Like;
use App\ReplyComment;
use App\Caterepo;
use App\Report;
use App\Laporankonseling;
use App\Reportpost;
use Auth;
use Files;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        $statuses = Status::all();
        $likes = Like::all();
        $posts = Post::where('status_id', '1')->orderBy('created_at', 'Desc')->paginate(5);
        $posts2 = Post::where('status_id', '1')->orderBy('created_at', 'Desc')->paginate(5);
        $caterepos = Caterepo::all();
        return view('user.post.index', compact('categories', 'statuses', 'posts', 'posts2', 'likes', 'notifs', 'user', 'caterepos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $statuses = Status::all();
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.post.create', compact('categories', 'statuses', 'user'))->withNotifs($notifs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:posts',
            'category_id' => 'required',
            'status_id' => 'required',
            'content' => 'required'
        ]);
        $posts = new Post;
        $posts->user_id = $request->user_id;
        $posts->status_id = $request->status_id;
        $posts->category_id = $request->category_id;
        $posts->title = $request->title;
        $posts->slug = Str::slug($posts->title);
        $posts->content = $request->content;
        $posts->anonymous = $request->anonymous;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('\image');
            $file->move($destinationPath, $filename);
            $posts->image = $filename;
        }
        $posts->save();

        return back()->withInfo('Post Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        $statuses = Status::all();
        $comments = Comment::all();
        $posts = Post::where('slug', '=', $slug)->first();
        $user =  Auth::user()->id;
        $posts1 = $posts->id;
        $posts2 = $posts->total_visit+1;
        
        $user_like = Like::where('user_id', '=', $user)->where('post_id', '=', $posts1)->first();
        $comment_like = CommentLike::where('user_id', '=', $user)->get();
        $likes = Like::where('post_id', '=', $posts1)->count();
        $jawaban_terbaik = Comment::where('user_id', $user)->where('jawaban_terbaik', 1)->count();

        return view('user.post.show', compact('categories', 'statuses', 'posts', 'posts1', 'comments', 'likes', 'user_like', 'user', 'notifs', 'user', 'jawaban_terbaik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        $categories = Category::all();
        $statuses = Status::all();
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.post.edit', compact('categories', 'statuses', 'posts', 'notifs', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Post::find($id);
        $posts->title = $request->title;
        $posts->category_id = $request->category_id;
        $posts->status_id = $request->status_id;
        $posts->content = $request->content;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('\image');
            $file->move($destinationPath, $filename);
            $posts->image = $filename;
        }
        $posts->save();

        return back()->withInfo('Post Berhasil Diedit');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function like(Request $request)
    {
        // \DB::table('likes')->insert([
        //     'user_id' => $request->user_id, //This Code coming from ajax request
        //     'post_id' => $request->post_id, //This Chief coming from ajax request
        // ]);

        // return response()->json(
        //     [
        //         'success' => true,
        //         'message' => 'Data inserted successfully'
        //     ]
        // );

        $data = new Like;
        $data->user_id =  $request->user_id;
        $data->post_id = $request->post_id;
        $data->save();

        return back()->withInfo('Anda menyukai post ini');
    }

    public function unlike(Request $request)
    {
        $user_id =  $request->user_id;
        $post_id = $request->post_id;
        $data = Like::where('post_id', $post_id)->where('user_id', $user_id)->first();
        $data->delete();

        return back()->withInfo('Anda membatalkan suka post ini');
        
    }

    function updateDraft(Request $request, $id){
        $data = Post::find($id);
        $data->status_id = $request->status_id;
        $data->save ();
        return back();
    }

    function updateView(Request $request, $slug){
        $visit = $request->total_visit;
        $updateViews = DB::update("update posts set total_visit = ? where slug = ?", [$visit, $slug]);
        return redirect()->route('post.show', $slug);
    }

    function sortir(Request $request){
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
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
            $posts = Post::where('category_id', $query1)->where('status_id', '1')->orderBy('total_visit', 'Desc')->get();
        }
        if($query1 != null && $query2 == 3){
            $posts = Post::where('category_id', $query1)->where('status_id', '1')->orderBy('created_at', 'Desc')->get();
        }
        if($query1 != null && $query2 == 4){
            $posts = Post::where('category_id', $query1)->where('status_id', '1')->orderBy('created_at', 'asc')->get();
        }
        $caterepos = Caterepo::all();
        return view('user.post.sortir', compact('query1', 'query2', 'posts', 'categories',  'notifs', 'user', 'caterepos'));
    }

    function updateSolved(Request $request, $id){
        $posts = Post::find($id);
        $solved = $posts->solved;
        if($solved == 0){
            $posts->solved = 1;
            $posts->save();
        }if($solved == 1){
            $posts->solved = 0;
            $posts->save();
        }
        // $posts->save();
        
        return back()->withInfo('Data berhasil disimpan');
    }

    
}
