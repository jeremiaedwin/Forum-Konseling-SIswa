<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Notifications;
use Auth;
use DB;
use App\Chat;
use App\User;
use App\Comment;
use App\Message;
use Pusher\Pusher;
use Cache;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $user = Auth::user()->id;
        // $users = User::all();
        $users = DB::select("select users.id, users.name, users.role, users.email, profiles.foto_profil as foto_profil, count(status) as status 
        from users LEFT  JOIN profiles ON users.id = profiles.user_id LEFT JOIN messages ON profiles.user_id = messages.sender_id and status = 0 and messages.receiver_id = " . Auth::id() . "
        where profiles.user_id != " . Auth::id() . " 
        group by users.id, users.name, users.role, profiles.foto_profil, users.email");
        $notifs = Comment::where('user_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        return view('guru.message.index', compact('notifs', 'user', 'users'));
    }



    public function store(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $msg = new Message();
        $msg->sender_id = $from;
        $msg->receiver_id = $to;
        $msg->message = $message; // message will be unread when sending message
        $msg->save();

        $data = ['from' => $from, 'to' => $to];
        event(new Notifications($data));
    
    }



    function getData($user_id){
        $my_id = Auth::id();
        $users2 = User::find($user_id);


        Message::where(['receiver_id' => $user_id, 'sender_id' => $my_id])->update(['status' => 1]);
        

        $users = User::all();
        
        $messages = Message::where(function ($query) use ($user_id, $my_id){
            $query->where('sender_id', $my_id)->where('receiver_id', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id){
            $query->where('sender_id', $user_id)->where('receiver_id', $my_id);
        })->get();
        $notifs = Comment::where('user_id', $my_id)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        return view('guru.message.show', ['messages' => $messages, 'users2' => $users2, 'users' => $users, 'notifs'=>$notifs]);
    }

    function searchSiswa(Request $request){
        $name = $request->name;
        $search = User::where('name', 'like', '%' . $name . '%')->get();
        return view('guru.message.search', compact('search'));
    }
}
