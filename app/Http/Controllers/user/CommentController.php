<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\ReplyComment;
use App\CommentLike;
use App\Post;
use App\User;
use App\Like;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comments = new Comment;
        $comments->user_id = $request->user_id;
        $comments->receiver_id = $request->receiver_id;
        $comments->post_id = $request->post_id;
        $comments->comment = $request->comment;
        $comments->anonymous = $request->anonymous;
        $comments->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $comments = Comment::find($id);
        $r_comment = ReplyComment::where('comment_id',$id)->get();
        return view('user.comment.show2', compact('comments', 'r_comment', 'notifs', 'user'));
    }

    public function getIndex($id)
    {
        $comments = Comment::where('post_id', '=', $id)->get();
        $posts = Post::where('id', '=', $id)->first();
        $user =  Auth::user()->id;
        $posts1 = $posts->id;
        $user_like = Like::where('user_id', '=', $user)->where('post_id', '=', $posts1)->first();
        $comment_like = CommentLike::where('user_id', '=', $user)->get();
        $likes = Like::where('post_id', '=', $posts1)->count();
        
        return view('user.comment.index', compact('comments', 'likes', 'user_like', 'user','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $comments = Comment::find($id);
        $comments->comment = $request->comment;
        $comments->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rcomments = ReplyComment::where('comment_id', $id);
        $rcomments->delete();
        $comments = Comment::find($id);
        $comments->delete();

    }

    public function delete($id)
    {
        $rcomments = ReplyComment::where('comment_id', $id);
        $rcomments->delete();
        $comments = Comment::find($id);
        $comments->delete();

    }

    public function like(Request $request){
        $like = new CommentLike;
        $like->user_id = $request->user_id;
        $like->comment_id = $request->comment_id;
        $like->save();

        return back()->withInfo('Anda menyukai komentar ini');
    }

    public function unlike(Request $request){
        $query1 =  $request->user_id;
        $query2 = $request->comment_id;
        $unlike = CommentLike::where('user_id',$query1)->where('comment_id',$query2)->first();
        $unlike->delete();

        return back();
    }

    function commentSolved(Request $request, $id){
        $comments = Comment::find($id);
        $comments->jawaban_terbaik = $request->jawaban_terbaik;
        $comments->save();
        return back()->withInfo("Berhasil ditambahkan menjadi komentar terbaik");
    }

    function commentUnSolved(Request $request, $id){
        $comments = Comment::find($id);
        $comments->jawaban_terbaik = $request->jawaban_terbaik;
        $comments->save();
        return back()->withInfo("Berhasil dihapus dari komentar terbaik");
    }
}
