<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Notifications;
use App\Groupchat;
use App\Groupchat_user;
use App\Chatgroup;
use App\User;
use App\Membergroup;
use App\Comment;
use Auth;

class GroupchatController extends Controller
{
    public function index(){
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $groups = Groupchat::all();
        $anggota = Groupchat_user::where('user_id', $user)->get();
        $anggotas = [];
        foreach($anggota as $a)
        $anggotas[] = $a->user_id;

        return view('user.group_chat.index', compact('groups', 'anggota', 'notifs', 'user'));
    }

    public function create(){
        return view('user.group_chat.create');
    }

    public function store(Request $request){
        $groups = new Groupchat;
        $groups->title = $request->title;
        $groups->description = $request->description;
        $groups->user_id = $request->user_id;
        $groups->save();
        return redirect('user/chatgroup');
    }

    public function show($id){
        $anggota = Groupchat_user::where('groupchat_id', $id)->where('status', 1)->get();
        $anggotas = [];
        foreach($anggota as $a)
        $anggotas[] = $a->user_id; 
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);

        $me = Groupchat_user::where("user_id", $user)->where('groupchat_id', $id)->first();
        $me2 = Groupchat_user::where("user_id", $user)->where('groupchat_id', $id)->where("status", 1)->first();
        $groups = Groupchat::find($id);
        $chat = Chatgroup::where('groupchat_id', $id)->get();
        return view('user.group_chat.show', compact('groups', 'anggota', 'chat', 'anggotas','notifs', 'user', 'me', 'me2'));
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->groupchat_id;
        $message = $request->message;
        $members = Groupchat_user::where('groupchat_id', $to)->get();
        $membersGroup = [];
        foreach($members as $m)
        $membersGroup[] = $m->user_id;
        


        $membersGroup = json_encode($membersGroup);

        $msg = new Chatgroup;
        $msg->sender_id = $from;
        $msg->groupchat_id = $to;
        $msg->message = $message; // message will be unread when sending message
        $msg->save();

        $data = ['from' => $from, 'membersGroup' => $membersGroup];
        event(new Notifications($data));
        
    }

    public function join(Request $request){
        $member = new Groupchat_user;
        $member->user_id = Auth::user()->id;
        $member->groupchat_id = $request->groupchat_id;
        $member->status = 0;
        $member->save();
        return back();
    }

    public function unjoin(Request $request){
        
        $my_id = Auth::user()->id;
        $groupchat_id = $request->groupchat_id2;
        $member = Groupchat_user::where('user_id', $my_id)->where('groupchat_id', $groupchat_id)->first();
        $member->delete();
        return back();
    }
}
