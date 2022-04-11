<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\Comment;
use App\Laporankonseling;
use App\Rekapkonseling;
use Auth;

class ProfileController extends Controller
{

    public function index($id)
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $posts = Post::where('user_id', $id)->get();
        $user = Auth::user()->id;
        $comments = comment::where('user_id', Auth::id())->get();
        $comments2 = comment::where('user_id', Auth::id())->where('jawaban_terbaik', 1)->count();
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $profiles = Profile::where('user_id', $user)->first();
        $reportkonselings = Rekapkonseling::where('nis', Auth::user()->id)->orderBy('tanggal_konseling', 'desc')->get();
        return view('user.profile.show', compact('posts', 'user', 'notifs', 'comments','comments2', 'profiles','reportkonselings'));
    }

    public function edit($id)
    {
        $user = Auth::user()->id;
        $notifs = Comment::where('receiver_id', $user)->where('status',0)->orderBy('created_at', 'desc')->paginate(5);
        $profiles = Profile::where('user_id', $user)->first();
        return view('user.profile.edit', compact('user', 'notifs',  'profiles'));
    }

    public function update(Request $request, $id)
    {
        $profiles = Profile::find($id);
        $profiles->tanggal_lahir = $request->tanggal_lahir;
        $profiles->alamat = $request->alamat;
        $profiles->agama = $request->agama;
        $profiles->jenis_kelamin = $request->jenis_kelamin;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('\image');
            $file->move($destinationPath, $filename);
            $profiles->foto_profil = $filename;
        }
        $profiles->save();
        return back();
    }

    public function destroy($id)
    {
        //
    }
}
