<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CatepeguController extends Controller
{
    //Index Categories
    public function catepegu(){
        $catepegus = DB::table('catepegus')->get();

        return view('admin/category_pengumuman/index',['catepegus' => $catepegus]);
    }

    public function store_create_catepegu(Request $request){
        $this->validate($request,[
            'category' => 'required|unique:catepegus',
        ],[
            'category.required' => 'Nama kategori anda kosong',
            'category.unique' => 'Kategori sudah dibuat',
        ]);

        DB::table('catepegus')->insert([
            'category' => $request->category,
            'created_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect('/admin/kategori_pengumuman');
    }

    public function store_edit_catepegu(Request $request, $id){
        $this->validate($request,[
            'category' => 'required|unique:catepegus',
        ],[
            'category.required' => 'Nama kategori anda kosong',
            'category.unique' => 'Kategori sudah dibuat',
        ]);
        DB::table('catepegus')->where('id', $id)->update([
            'category' => $request->category,
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect('/admin/kategori_pengumuman');
    }

    public function delete_catepegu($id){
        DB::table('catepegus')->where('id', $id)->delete();

        return redirect('/admin/kategori_pengumuman');
    }
}
