<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\ReplyComment;
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
    }

    function getData($id){
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $comments = Comment::find($id);
        $r_comment = ReplyComment::where('comment_id',$id)->get();
        return view('guru.comment.show', compact('comments', 'r_comment', 'notifs', 'user'));
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
