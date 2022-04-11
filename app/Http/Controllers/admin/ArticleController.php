<?php

namespace App\Http\Controllers\admin;

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
    //Index Article
    public function article()
    {
        $articles = Article::where('status_id',1)->paginate(5);

        return view('admin/article/index',['articles' => $articles]);
    }

    //Edit Article
    public function edit_article($slug){
        $categories = Category::all();
        $statuses = Status::all();

        $articles = DB::table('article')->where('slug',$slug)->get();

        return view('admin/article/edit_article', ['articles' => $articles] ,compact('categories','statuses'));
    }

    //Proses Edit
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

        return redirect('/admin/artikel');
    }

    //Delete Article
    public function delete_article($slug){
        DB::table('article')->where('slug', $slug)->delete();

        return redirect('/admin/artikel');
    }

    //Show Article
    public function show_article($slug){
        
        $articles = DB::table('article')->where('slug',$slug)->get();

        return view('admin/article/show',['articles' => $articles]);
    }
}
