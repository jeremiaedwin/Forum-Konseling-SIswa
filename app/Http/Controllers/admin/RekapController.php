<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use App\PostCategory;
use App\Rekapkonseling;
use App\Reportpost;
use App\Post;

class RekapController extends Controller
{
    // --------------------------- Rekap Post ----------------------------------------------------------------
    function rekapPost(){
        $diagramCategory = DB::table("posts")
        ->join('categories', "posts.category_id","=","categories.id")
	    ->select("posts.category_id", "categories.category", DB::raw("COUNT(category_id) as count_category"))
        ->whereYear('posts.created_at', date('Y'))
        ->groupBy("posts.category_id", "categories.category")
        ->get();
        $countCategory=[];
        $nameCategory=[];
        foreach($diagramCategory as $c)
        $nameCategory[] = $c->category;
        foreach($diagramCategory as $d)
        $countCategory[] = $d->count_category;
        $tahun = Post::all();
        $tahun_sortir = [];
        foreach($tahun as $thn)
        $tahun_sortir[] = $thn->created_at->year;
        $rekapPost = Rekapkonseling::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
        $reportPost = Reportpost::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
        $posts = Post::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
        return view('admin.rekap.post', compact('nameCategory', 'diagramCategory', 'reportPost', 'countCategory', 'rekapPost', 'reportPost', 'posts'));
    }




    function rekapPostPDF(){
        $diagramCategory = DB::table("posts")
        ->join('categories', "posts.category_id","=","categories.id")
	    ->select("posts.category_id", "categories.category", DB::raw("COUNT(category_id) as count_category"))
        ->whereYear('posts.created_at', date('Y'))
        ->groupBy("posts.category_id", "categories.category")
        ->get();
        $countCategory=[];
        $nameCategory=[];
        foreach($diagramCategory as $c)
        $nameCategory[] = $c->category;
        foreach($diagramCategory as $d)
        $countCategory[] = $d->count_category;
        $tahun = Post::all();
        $tahun_sortir = [];
        foreach($tahun as $thn)
        $tahun_sortir[] = $thn->created_at->year;
        $rekapPost = Rekapkonseling::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
        $reportPost = Reportpost::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
        $posts = Post::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
        return view('admin.rekap.rekaPost', compact('nameCategory', 'diagramCategory', 'reportPost', 'countCategory', 'rekapPost', 'reportPost', 'posts'));
    }

    function pdfRekapPost(){
        $diagramCategory = DB::table("posts")
       ->join('categories', "posts.category_id","=","categories.id")
       ->select("posts.category_id", "categories.category", DB::raw("COUNT(category_id) as count_category"))
       ->whereYear('posts.created_at', date('Y'))
       ->groupBy("posts.category_id", "categories.category")
       ->get();
        $posts = Post::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
       $rekapPost = Rekapkonseling::whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
       $judulPDF = "Rekap Post.pdf";
       $pdf = PDF::loadview('admin.rekap.pdfPost',['rekapPost'=>$rekapPost, 'posts'=>$posts,'diagramCategory'=>$diagramCategory]);
       return $pdf->download($judulPDF);
   }



    // --------------------------- Rekap Konseling ----------------------------------------------------------------
    function rekapKonseling(){
        $month = date('m');
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $rekapKonselings = Rekapkonseling::whereYear('tanggal_konseling', date('Y'))->whereMonth('tanggal_konseling', $month)->orderBy('created_at', 'desc')->get();
        $rekapKonselings3 = DB::select("select year(created_at) as tahun from posts group By year(created_at)");        
        $rekapKonselings2 = DB::table('laporankonselings')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count("created_at") as jumlah'))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();
        $jumlahKonseling = [];
        foreach($rekapKonselings2 as $rk1)
        $jumlahKonseling[] = $rk1->date;
        return view('admin.rekap.konseling', compact('rekapKonselings', 'rekapKonselings3', 'month', 'monthName'));
    }

    function sortirKonseling(Request $request){
        $month = $request->bulan;
        $year = $request->tahun;
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $rekapKonselings = Rekapkonseling::whereYear('tanggal_konseling', $year)->whereMonth('tanggal_konseling', $month)->orderBy('tanggal_konseling', 'desc')->get();
        $rekapKonselings3 = DB::select("select year(created_at) as tahun from posts group By year(created_at)");
        return view('admin.rekap.sortirkonseling', compact('rekapKonselings', 'rekapKonselings3', 'year', 'month', 'monthName'));
    }

    public function cetakKonseling()
    {
        $month = date('m');
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $rekapKonselings = Rekapkonseling::whereYear('tanggal_konseling', date('Y'))->whereMonth('tanggal_konseling', $month)->orderBy('created_at', 'desc')->get();
        $judulPDF = "Rekap Konseling " . date('m'). ".pdf";   
    	$pdf = PDF::loadview('admin.rekap.pdfKonseling',['rekapKonselings'=>$rekapKonselings, 'monthName'=>$monthName]);
    	return $pdf->download($judulPDF);
    }

    public function cetakKonselingSortir(Request $request, $year, $month)
    {
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $rekapKonselings = Rekapkonseling::whereYear('tanggal_konseling', $year)->whereMonth('tanggal_konseling', $month)->orderBy('tanggal_konseling', 'desc')->get();
        $judulPDF = "Rekap Konseling bulan" . $month. "tahun ". $year. ".pdf";
    	$pdf = PDF::loadview('admin.rekap.pdfKonseling',['rekapKonselings'=>$rekapKonselings, 'monthName'=>$monthName]);
    	return $pdf->download($judulPDF);
    }

    function detailRekapKonseling($id){
        $rekapKonselings = rekapKonseling::find($id);
        return view('admin.rekap.detailKonseling', compact('rekapKonselings'));
    }

    public function pdfRekapKonseling($id)
    {
    	$rekapKonselings = Rekapkonseling::find($id);
        $nameSiswa = $rekapKonselings->name;
        $masalahSiswa = $rekapKonselings->title;
        $judulPDF = "Konseling " . $nameSiswa . " Permasalahan" . $masalahSiswa . ".pdf";
        
    	$pdf = PDF::loadview('admin.rekap.pdfDetailKonseling',['rekapKonselings'=>$rekapKonselings]);
    	return $pdf->download($judulPDF);
    }


    

    // --------------------------- Rekap Report Post ----------------------------------------------------------------
    
    function rekapReportPost(){
        $year = date('Y');
        $month = date('m');
        
        // $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $r_post = Reportpost::whereYear('created_at', $year)->whereMonth('created_at', $month)->orderBy('created_at', 'desc')->get();
        $r_post2 = DB::select("select year(created_at) as tahun from reportposts group By year(created_at)");
        return view('admin.rekap.reportpost', compact('r_post', 'year', 'month', 'r_post2', 'monthName'));
    }

    function rekapReportPostSortir(Request $request){
        $month = $request->bulan;
        $year = $request->tahun;
        // $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $r_post = Reportpost::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->orderBy('created_at', 'desc')->get();
        $r_post2 = DB::select("select year(created_at) as tahun from reportposts group By year(created_at)");
        return view('admin.rekap.reportpostsortir', compact('r_post', 'year', 'month', 'r_post2', 'monthName'));
    }

    public function pdfRekapReportPost()
    {
    	$year = date('Y');
        $month = date('m');
        
        // $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $r_post = Reportpost::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->orderBy('created_at', 'desc')->get();
        $r_post2 = DB::select("select year(created_at) as tahun from reportposts group By year(created_at)");
        $judulPDF = "Rekap Report Post " . $monthName . " " . $year . ".pdf";
        
    	$pdf = PDF::loadview('admin.rekap.pdfReportPost',compact('r_post', 'year', 'month', 'r_post2', 'monthName'));
    	return $pdf->download($judulPDF);
    }
    
    public function pdfRekapReportPostsortir(Request $request,  $year, $month)
    {
        // $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $r_post = Reportpost::whereYear('created_at', $year)->whereMonth('created_at', $month)->orderBy('created_at', 'desc')->get();
        $r_post2 = DB::select("select year(created_at) as tahun from reportposts group By year(created_at)");
        $judulPDF = "Rekap Report Post " . $month . " " . $year . ".pdf";
        
    	$pdf = PDF::loadview('admin.rekap.pdfReportPost',compact('r_post', 'year', 'month', 'r_post2', 'monthName'));
    	return $pdf->download($judulPDF);
    }
} 
