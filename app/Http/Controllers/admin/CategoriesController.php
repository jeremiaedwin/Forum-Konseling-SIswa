<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //Index Categories
    public function category(){
        $categories = DB::table('categories')->get();

        return view('admin/categories/index',['categories' => $categories]);
    }

    public function store_create_category(Request $request){
        $this->validate($request,[
            'category' => 'required|unique:categories',
        ],[
            'category.required' => 'Nama kategori anda kosong',
            'category.unique' => 'Kategori sudah dibuat',
        ]);

        DB::table('categories')->insert([
            'category' => $request->category,
            'created_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect('/admin/daftar_kategori');
    }

    public function store_edit_category(Request $request, $id){
        $this->validate($request,[
            'category' => 'required|unique:categories',
        ],[
            'category.required' => 'Nama kategori anda kosong',
            'category.unique' => 'Kategori sudah dibuat',
        ]);
        DB::table('categories')->where('id', $id)->update([
            'category' => $request->category,
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect('/admin/daftar_kategori');
    }

    public function delete_category($id){
        DB::table('categories')->where('id', $id)->delete();

        return redirect('/admin/daftar_kategori');
    }
}
