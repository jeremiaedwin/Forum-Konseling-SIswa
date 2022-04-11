<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Notifications;
use App\Groupchat;
use App\Groupchat_user;
use App\Chatgroup;
use App\User;
use App\Membergroup;
use App\Notif;
use Auth;

class GroupchatController extends Controller
{
    public function index(){
        $groups = Groupchat::all();
        return view('guru.group_chat.index', compact('groups'));
    }

    public function create(){
        return view('guru.group_chat.create');
    }

    public function store(Request $request){
        $groups = new Groupchat;
        $groups->title = $request->title;
        $groups->description = $request->description;
        $groups->user_id = $request->user_id;
        $groups->save();
        $member = new Groupchat_user;
        $member->user_id = Auth::user()->id;
        $member->groupchat_id = $groups->id;
        $member->status = 1;
        $member->save();
        return redirect('guru/chatgroup');
    }

    public function show($id){
        $anggota = Groupchat_user::where('groupchat_id', $id)->where('status',1)->get();
        $anggota2 = Groupchat_user::where('groupchat_id', $id)->where('status',0)->count();
        $groups = Groupchat::find($id);
        $chat = Chatgroup::where('groupchat_id', $id)->get();
        return view('guru.group_chat.show', compact('groups', 'anggota', 'chat', 'anggota2'));
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->groupchat_id;
        $message = $request->message;
        $members = Groupchat_user::where('groupchat_id', $to)->get();
        $membersGroup = [];
        $membersGroup2 = [];
        foreach($members as $m)
        $membersGroup[] = $m->user_id;
        foreach($members as $m2)
        $membersGroup2[] = $m2->user_id;
        
        $membersGroup = json_encode($membersGroup);

        $msg = new Chatgroup;
        $msg->sender_id = $from;
        $msg->groupchat_id = $to;
        $msg->message = $message; // message will be unread when sending message
        $msg->save();

        foreach($membersGroup2 as $mb){
            $sendAll = [
                'chatgroup_id' => $msg->id,
                'user_id' => $mb,
                'read' => 0,
                
            ];
            Membergroup::insert($sendAll);
        }
        
        $data = ['from' => $from, 'membersGroup' => $membersGroup];
        event(new Notifications($data));            
    }

    public function userJoin($id){
        $groups = Groupchat::find($id);
        $userJoin = Groupchat_user::where('groupchat_id', $id)->where('status', 0)->get();
        return view('guru.group_chat.userjoin', compact('userJoin', 'groups'));
    }

    public function acceptReqJoin(Request $request){
        $group_id = $request->group_id;
        $user_id = $request->user_id;
        $member = Groupchat_user::where('groupchat_id', $group_id)->where('user_id', $user_id)->first();
        $member->status = 1;
        $member->save();
        $notif = new Notif;
        $notif->sender_id = Auth::id();
        $notif->receiver_id = $user_id;
        $notif->content = "Guru yang telah bersangkutan menyetujui permintaan bergabung anda.";
        $notif->save(); 
        return back();
    }

    public function declineReqJoin(Request $request){
        $group_id = $request->group_id2;
        $user_id = $request->user_id2;
        $member = Groupchat_user::where('groupchat_id', $group_id)->where('user_id', $user_id)->first();
        $member->status = 1;
        $member->delete();
        $notif = new Notif;
        $notif->sender_id = Auth::id();
        $notif->receiver_id = $user_id;
        $notif->content = "Guru yang telah bersangkutan menolak permintaan bergabung anda.";
        $notif->save(); 
        return back();
    }


}
