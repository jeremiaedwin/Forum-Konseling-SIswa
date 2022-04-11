<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Reportpost;
use App\Laporankonseling;
use App\Rekaplaporanpost;
use Auth;

class DashboardController extends Controller
{
    function index(){
        $messages = Message::where('receiver_id', Auth::id())->where('status', 0)->get();
        $messages2 = Message::where('receiver_id', Auth::id())->where('status', 1)->orderBy('created_at', 'desc')->paginate(5);
        $reports = Reportpost::where('receiver_id', Auth::id())->get();
        $reports2 = Reportpost::where('receiver_id', Auth::id())->where('status', 0)->paginate(5);
        $reportKonseling = Rekaplaporanpost::where('receiver_id', Auth::user()->id)->get();
        return view('guru.dashboard.index', compact('messages', 'messages2', 'reports', 'reports2', 'reportKonseling'));
    }
}
