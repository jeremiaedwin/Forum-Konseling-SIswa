<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\ReplyComment;
use App\User;
use App\Post;
use Auth;
class ReplyCommentController extends Controller
{
    function store(Request $request){
        $comments = new ReplyComment;
        $comments->user_id = $request->user_id;
        $comments->receiver_id = $request->receiver_id;
        $comments->post_id = $request->post_id;
        $comments->comment_id = $request->comment_id;
        $comments->comment = $request->comment;
        $comments->anonymous = $request->anonymous;
        $comments->save();
        return back();
        
    }

    function show($comment_id){
        $replies = ReplyComment::find($comment_id);
    }

    function getData($id){
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $comments = Comment::find($id);
        $r_comment = ReplyComment::where('comment_id',$id)->get();
        $ts = $comments->user_id;
        return view('user.comment.show', compact('comments', 'r_comment', 'notifs', 'user', 'ts'));
    }

    function delete($id){
        $r_comment = ReplyComment::find($id);
        $r_comment->delete();
    }

    function update(Request $request, $id){
        $comments = ReplyComment::find($id);
        $comments->comment = $request->comment;
        $comments->save();
        
    }
}
