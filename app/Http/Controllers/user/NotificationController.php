<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\ReplyComment;
use Auth;

class NotificationController extends Controller
{
    public function index($id){
        $notifs = Comment::where('receiver_id', $id)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $notif = Comment::where('receiver_id', $id)->orderBy('created_at', 'desc')->get();
        $notif2 = ReplyComment::where('receiver_id', $id)->orderBy('created_at', 'desc')->get();
        return view('user.notification.index', compact('notif', 'notifs', 'notif2'));
    }

    public function index2(){
        $user = Auth::user()->id;
        $notif = Comment::where('receiver_id', $user)->where('status_id', 0)-paginate(5);
        return view('layout.notif', compact('notif'));
    }

    function open(Request $request, $id){
        $notifs = Comment::find($id);
        $notifs->status = $request->status;
        $slug = $request->slug;
        $notifs->save();
        return redirect()->route('post.show', $slug);
    }
}
