<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use App\ReplyComment;

class CommentController extends Controller
{
    function index(){
        $posts = Post::all();
        $comments = Comment::all();
        $users = User::all();
        return view('admin.comment.index', compact('posts', 'comments', 'users'));
    } 

    function sortir(Request $request){
        $posts = Post::all();
        $id = $request->id;
        $comments = Comment::where('user_id', $id)->get();
        $users = User::all();
        return view('admin.comment.index', compact('posts', 'comments', 'users'));
    }

    function show($id){
        $comments = Comment::find($id);
        $r_comments = ReplyComment::where('comment_id', $id)->get();
        return view('admin.comment.show', compact('comments', 'r_comments'));
    }

    function getDataReply($id){
        $r_comments = ReplyComment::find($id);
        return view('admin.comment.getDataReply', compact('r_comments'));
    }
}
