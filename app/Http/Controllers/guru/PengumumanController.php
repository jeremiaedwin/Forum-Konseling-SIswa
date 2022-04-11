<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Pengumuman;
use App\Catepegu;
use App\Status;
use Auth;

class PengumumanController extends Controller
{
   public function index(){

        $kel_pengumuman = Pengumuman::where('user_id',Auth::user()->id)->paginate(5);

        return view('guru/pengumuman/index',['kel_pengumuman' => $kel_pengumuman]);
    }

    public function create(){
        $catepegus = Catepegu::all();
        $statuses = Status::all();

        return view('guru/pengumuman/buat_pengumuman',compact('catepegus','statuses'));
    }

    public function store_create_pengumuman(Request $request){

        $this->validate($request,[
            'title' => 'required|unique:pengumuman',
            'category' => 'not_in:0|required',
            'status' => 'required',
            'pdf' => 'required|mimes:pdf'
        ],[
            'title.required' => 'Judul artikel anda kosong',
            'title.unique' => 'Judul artikel sudah dibuat',
            'category.not_in:0' => 'Pilih Kategori untuk Artikel ini',
            'category.required' => 'Pilih Kategori untuk Artikel ini',
            'status.required' => 'Pilih Status untuk Artikel ini',
            'pdf.required' => 'Gambar anda kosong',
            'pdf.mimes' => 'File tidak mendukung',
        ]);
        $pdfName = date('dmyHis').'.'.$request->file('pdf')->getClientOriginalExtension();
        
        $request->pdf->move(public_path('pdf'),$pdfName);
        
        DB::table('pengumuman')->insert([
            'created_at'=> date('Y-m-d H:i:s'),
            'catepegus_id' => $request->category,
            'status_id' => $request->status,
            'user_id' =>$request->user_id,
            'title' => $request->title,
            'slug'=> Str::slug($request->title),
            'pdf' => $pdfName,
        ]);

        return redirect('guru/pengumuman');
    }

    public function edit_pengumuman($slug){
        $catepegus = Catepegu::all();
        $statuses = Status::all();

        $kel_pengumuman = DB::table('pengumuman')->where('slug',$slug)->get();

        return view('guru/pengumuman/edit_pengumuman',['kel_pengumuman' => $kel_pengumuman],compact('catepegus','statuses'));

    }

    public function update_pengumuman(Request $request){
        if($request->pdf != null){
            $this->validate($request,[
                'title' => 'required|unique:pengumuman',
                'category' => 'not_in:0|required',
                'status' => 'required',
                'pdf' => 'required|mimes:pdf'
            ],[
                'title.required' => 'Judul artikel anda kosong',
                'title.unique' => 'Judul artikel sudah dibuat',
                'category.not_in:0' => 'Pilih Kategori untuk Artikel ini',
                'category.required' => 'Pilih Kategori untuk Artikel ini',
                'status.required' => 'Pilih Status untuk Artikel ini',
                'pdf.required' => 'Gambar anda kosong',
                'pdf.mimes' => 'File tidak mendukung',
            ]);
            $pdfName = date('dmyHis').'.'.$request->file('pdf')->getClientOriginalExtension();
            
            $request->pdf->move(public_path('pdf'),$pdfName);

            DB::table('pengumuman')->where('slug', $request->slug)->update([
                'updated_at'=> date('Y-m-d H:i:s'),
                'catepegus_id' => $request->category,
                'status_id' => $request->status,
                'user_id' =>$request->user_id,
                'title' => $request->title,
                'slug'=> Str::slug($request->title),
                'pdf' => $pdfName,
            ]);
        }
        else{
            $this->validate($request,[
                'title' => 'required|unique:pengumuman',
                'category' => 'not_in:0|required',
                'status' => 'required',
            ],[
                'title.required' => 'Judul artikel anda kosong',
                'title.unique' => 'Judul artikel sudah dibuat',
                'category.not_in:0' => 'Pilih Kategori untuk Artikel ini',
                'category.required' => 'Pilih Kategori untuk Artikel ini',
                'status.required' => 'Pilih Status untuk Artikel ini',
            ]);
            DB::table('pengumuman')->where('slug', $request->slug)->update([
                'updated_at'=> date('Y-m-d H:i:s'),
                'catepegus_id' => $request->category,
                'status_id' => $request->status,
                'user_id' =>$request->user_id,
                'title' => $request->title,
                'slug'=> Str::slug($request->title),
            ]);
        }

        return redirect('guru/pengumuman');
    }

    public function delete_pengumuman($slug){
        DB::table('pengumuman')->where('slug', $slug)->delete();

        return redirect('guru/pengumuman');
    }

        //Show Article
    public function show_pengumuman($slug){
        
        $kel_pengumuman = Pengumuman::where('slug',$slug)->get();

        return view('guru/pengumuman/show',['kel_pengumuman' => $kel_pengumuman]);
    }
}
