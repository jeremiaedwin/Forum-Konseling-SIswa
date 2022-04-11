<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reportpost;
use App\Post;
use App\User;

class ReportpostController extends Controller
{
    public function index(){
        $r_post = Reportpost::all();
        return view('guru.reportpost.index', compact('r_post'));
    }

    public function show($id){
        $r_post = Reportpost::find($id);
        return view('guru.reportpost.show', compact('r_post'));
    }
}
