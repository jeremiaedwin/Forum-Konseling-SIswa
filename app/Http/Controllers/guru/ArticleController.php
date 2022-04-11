<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Article;
use App\Category;
use App\Status;
use Auth;

class ArticleController extends Controller
{
    
    public function article()
    {
        
        $articles = Article::where('user_id',Auth::user()->id)->paginate(5);

        return view('guru/article/index',['articles' => $articles]);
    }

    public function create_article(){
        $categories = Category::all();
        $statuses = Status::all();

        return view('guru/article/buat_article',compact('categories','statuses'));
    }

    public function store_create_article(Request $request)
    {
        
        
        $this->validate($request,[
            'title' => 'required|unique:article',
            'category' => 'not_in:0|required',
            'status' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ],[
            'title.required' => 'Judul artikel anda kosong',
            'title.unique' => 'Judul artikel sudah dibuat',
            'category.not_in:0' => 'Pilih Kategori untuk Artikel ini',
            'category.required' => 'Pilih Kategori untuk Artikel ini',
            'status.required' => 'Pilih status untuk Artikel ini',
            'content.required' => 'Konten anda kosong',
            'image.required' => 'Gambar anda kosong',
            'image.image' => 'Pilih Gambar yang tepat',
            'image.mimes' => 'File tidak mendukung',
            'image.max' => 'File maksimal berukuran 2 MB',
        ]);
        $imageName = date('dmyHis').'.'.$request->file('image')->getClientOriginalExtension();
        $request->image->move(public_path('image'),$imageName);
        
        DB::table('article')->insert([
            'created_at'=> date('Y-m-d H:i:s'),
            'category_id' => $request->category,
            'status_id' => $request->status,
            'user_id' =>$request->user_id,
            'title' => $request->title,
            'slug'=> Str::slug($request->title),
            'content' => $request->content,
            'image' => $imageName,
        ]);

        return redirect('/guru/artikel');
    }
    public function edit_article($slug){
        $categories = Category::all();
        $statuses = Status::all();

        $articles = DB::table('article')->where('slug',$slug)->get();

        return view('guru/article/edit_article', ['articles' => $articles] ,compact('categories','statuses'));
    }

    public function update_article(Request $request){
        if($request->image != null){
            $this->validate($request,[
                'title' => 'required|unique:article',
                'content' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
            ],[
                'title.required' => 'Judul artikel anda kosong',
                'title.unique' => 'Judul artikel sudah dibuat',
                'content.required' => 'Konten anda kosong',
                'image.required' => 'Gambar anda kosong',
                'image.image' => 'Pilih Gambar yang tepat',
                'image.mimes' => 'File tidak mendukung',
                'image.max' => 'File maksimal berukuran 2 MB',
            ]);
            
            $imageName = date('dmyHis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('image'),$imageName);
            DB::table('article')->where('slug', $request->slug)->update([
                'updated_at'=> date('Y-m-d H:i:s'),
                'category_id' => $request->category,
                'status_id' => $request->status,
                'title' => $request->title,
                'slug'=> Str::slug($request->title),
                'content' => $request->content,
                'image' => $imageName,
            ]);
        }
        else{
            $this->validate($request,[
                'title' => 'required|unique:article',
                'content' => 'required',
            ],[
                'title.required' => 'Judul artikel anda kosong', 
                'title.unique' => 'Judul artikel sudah dibuat',
                'content.required' => 'Konten anda kosong',
            ]);
            $imageName = $request->images;
            DB::table('article')->where('slug', $request->slug)->update([
                'updated_at'=> date('Y-m-d H:i:s'),
                'category_id' => $request->category,
                'status_id' => $request->status,
                'title' => $request->title,
                'slug'=> Str::slug($request->title),
                'content' => $request->content,
                'image' => $imageName,
            ]);
        }

        return redirect('/guru/artikel');
    }
    public function delete_article($slug){
        DB::table('article')->where('slug', $slug)->delete();

        return redirect('/guru/artikel');
    }

    //Show Article
    public function show_article($slug){
        
        $articles = DB::table('article')->where('slug',$slug)->get();
    
        return view('guru/article/show',['articles' => $articles]);
    }
}
