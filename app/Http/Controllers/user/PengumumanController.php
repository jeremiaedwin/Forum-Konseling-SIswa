<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pengumuman;
use App\Comment;
use Auth;

class PengumumanController extends Controller
{
    public function index(){

        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $kel_pengumuman = Pengumuman::where('status_id',1)->paginate(5);

        return view('user/pengumuman/index',['kel_pengumuman' => $kel_pengumuman], compact('notifs'));
    }
    public function show_pengumuman($slug){

        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $kel_pengumuman = Pengumuman::where('slug',$slug)->get();

        return view('user/pengumuman/show',['kel_pengumuman' => $kel_pengumuman], compact('notifs'));
    }
}
