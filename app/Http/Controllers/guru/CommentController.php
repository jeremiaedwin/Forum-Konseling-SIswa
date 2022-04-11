<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\ReplyComment;
use App\CommentLike;
use Auth;

class CommentController extends Controller
{
    function post_comment_store(Request $request){
        $request->validate([
            'comment' => 'required',
        ]);


        $comments = new Comment;
        $comments->user_id = $request->user_id;
        $comments->receiver_id = $request->receiver_id;
        $comments->post_id = $request->post_id;
        $comments->comment = $request->comment;
        $comments->anonymous = $request->anonymous;
        $comments->save();
        return back()->withInfo('Komentar Berhasil Ditambahkan');
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

    public function getIndex($id)
    {
        $comments = Comment::where('post_id', '=', $id)->get();
        $posts = Post::where('id', '=', $id)->first();
        $user =  Auth::user()->id;
        $posts1 = $posts->id;
        $user_like = Like::where('user_id', '=', $user)->where('post_id', '=', $posts1)->first();
        $comment_like = CommentLike::where('user_id', '=', $user)->get();
        $likes = Like::where('post_id', '=', $posts1)->count();

        return view('guru.comment.index', compact('comments', 'likes', 'user_like', 'user','posts'));
    }

    public function update(Request $request, $id)
    {
        $comments = Comment::find($id);
        $comments->comment = $request->comment;
        $comments->save();
    }

    public function delete($id)
    {
        $rcomments = ReplyComment::where('comment_id', $id);
        $rcomments->delete();
        $comments = Comment::find($id);
        $comments->delete();

    }
}
