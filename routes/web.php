<?php

use Illuminate\Support\Facades\Route;
use App\Events\Notifikasi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/artikel/index', function () {
    return view('user/artikel/index');
});

Route::get('/artikel/show', function () {
    return view('user/artikel/show');
});

Route::get('/profile/show', function () {
    return view('user/profile/show');
});

Route::get('/post', function () {
    return view('user/post/index');
});


Route::get('/logout','HomeController@logout');

Route::get('/asd', function () {
    return view('asd');
});

//Admin

Route::group(['middleware' => ['auth','checkRole:admin']],function(){
    Route::get('admin/dashboard', 'admin\DashboardController@index');
    //Halaman Home
    Route::get('/admins', 'AdminController@index');

    //Article
    Route::get('/admin/artikel','admin\ArticleController@article');
    Route::get('/admin/edit_artikel/{slug}', 'admin\ArticleController@edit_article');
    Route::post('/admin/proses_update_artikel', 'admin\ArticleController@update_article');
    Route::get('/admin/delete_artikel/{slug}', 'admin\ArticleController@delete_article');
    Route::get('/admin/show/{slug}', 'admin\ArticleController@show_article');

    //Categories
    Route::get('/admin/daftar_kategori','admin\CategoriesController@category');
    Route::post('/admin/proses_buat_kategori','admin\CategoriesController@store_create_category');
    Route::post('/admin/proses_edit_kategori/{id}','admin\CategoriesController@store_edit_category');
    Route::get('/admin/delete_category/{id}', 'admin\CategoriesController@delete_category');

    //Pengumuman
    Route::get('/admin/pengumuman', 'admin\PengumumanController@index');
    Route::get('/admin/buat_pengumuman', 'admin\PengumumanController@create');
    Route::post('/admin/proses_buat_pengumuman', 'admin\PengumumanController@store_create_pengumuman');
    Route::get('/admin/edit_pengumuman/{slug}', 'admin\PengumumanController@edit_pengumuman');
    Route::post('/admin/proses_edit_pengumuman', 'admin\PengumumanController@update_pengumuman');
    Route::get('/admin/delete_pengumuman/{slug}', 'admin\PengumumanController@delete_pengumuman');
    Route::get('/admin/show_pengumuman/{slug}', 'admin\PengumumanController@show_pengumuman');

    //Kategori Pengumuman
    Route::get('/admin/kategori_pengumuman', 'admin\CatepeguController@catepegu');
    Route::post('/admin/proses_buat_kategori_pengumuman', 'admin\CatepeguController@store_create_catepegu');
    Route::post('/admin/proses_edit_catepegu/{id}', 'admin\CatepeguController@store_edit_catepegu');
    Route::get('/admin/delete_catepegu/{id}', 'admin\CatepeguController@delete_catepegu');
    
    //post
    Route::get('/admin/post', 'admin\PostController@index');
    Route::get('/admin/post/{id}', 'admin\PostController@show');
    Route::post('/admin/post/sortir', 'admin\PostController@sortir');
    Route::post('/admin/post/updateDraft/{id}', 'admin\PostController@updateDraft');
    Route::get('/admin/post/delete/{id}', 'admin\PostController@destroy');

    //Report List
    Route::get('/admin/report/index', 'admin\ReportController@index');
    Route::get('/admin/report/delete/{id}', 'admin\ReportController@delete');
    Route::get('/admin/report/delete_post/{id}', 'admin\ReportController@delete_post');

    //comments
    Route::get('/admin/comments/', 'admin\CommentController@index');
    Route::post('/admin/comments/sortir', 'admin\CommentController@sortir');
    Route::get('/admin/comments/{id}', 'admin\CommentController@show');
    Route::get('/admin/replycomments/getdata/{id}', 'admin\CommentController@getDataReply');

    //message
    Route::get('/admin/messages', 'admin\MessageController@index');
    Route::post('/admin/message', 'admin\MessageController@store')->name('message');
    Route::get('/admin/messages/{id}/', 'admin\MessageController@getMessage')->name('messages');
    Route::get('/admin/newmessages', 'admin\MessageController@newMessage')->name('newmessages');
    Route::get('/admin/message/{id}/', 'admin\MessageController@getData');

    //user
    Route::resource('/admin/user', 'admin\UserController');
    Route::post('/admin/user/updateRole', 'admin\UserController@updateRole');

    //reportpost
    Route::get('/admin/reportpost/', 'admin\ReportpostController@index');
    Route::get('/admin/reportpost/{id}/create', 'admin\ReportpostController@create');
    Route::get('/admin/reportpost/{id}/show', 'admin\ReportpostController@show');
    Route::post('/admin/reportpost/store', 'admin\ReportpostController@store');
    Route::post('/admin/reportpost/{id}/update', 'admin\ReportpostController@update');
    Route::post('/admin/reportpost/{id}/delete', 'admin\ReportpostController@delete');

    //admin rekap 
    Route::get('/admin/rekap/post', 'admin\RekapController@rekapPost');
    Route::get('/admin/rekap/konseling', 'admin\RekapController@rekapKonseling');
    Route::get('/admin/rekap/konseling/{id}', 'admin\RekapController@detailRekapKonseling');
    Route::get('/admin/rekap/konseling/pdf/{id}', 'admin\RekapController@pdfRekapKonseling');
    Route::get('/admin/rekap/asd', 'admin\RekapController@cetakKonseling');
    Route::get('/admin/rekap/konselingsortirpdf/{year}/{month}', 'admin\RekapController@cetakKonselingSortir');
    Route::post('/admin/rekap/sortir', 'admin\RekapController@sortirKonseling');
    Route::get('/admin/rekap/post/pdf', 'admin\RekapController@pdfRekapPost');
    Route::get('/admin/rekap/reportpost', 'admin\RekapController@rekapReportPost');
    Route::post('/admin/rekap/reportpost/sortir', 'admin\RekapController@rekapReportPostSortir');
    Route::get('/admin/rekap/reportpostpdf', 'admin\RekapController@pdfRekapReportPost');
    Route::get('/admin/rekap/sortir/reportpostpdf/{year}/{month}', 'admin\RekapController@pdfRekapReportPostSortir');

    //Profile
    Route::resource('/admin/profile', 'admin\ProfileController');
});

//Guru

Route::group(['middleware' => ['auth','checkRole:guru']],function(){

    Route::get('guru/dashboard', 'guru\DashboardController@index');
    
    Route::get('/guru', 'GuruController@index');
    
    Route::get('/guru/qna', function () {
        return view('guru/tanya_jawab/qna');
    });
    
    Route::get('/guru/buat_qna', function () {
        return view('guru/tanya_jawab/buat_qna');
    });
    
    //Article
    Route::get('/guru/artikel', 'guru\ArticleController@article');
    Route::get('/guru/buat_artikel', 'guru\ArticleController@create_article');
    Route::post('/guru/proses_buat_artikel', 'guru\ArticleController@store_create_article');
    Route::get('/guru/show/{slug}', 'guru\ArticleController@show_article');

    //post
    Route::get('/guru/post', 'guru\PostController@index');
    Route::get('/guru/post/{id}', 'guru\PostController@show')->name('guru-post.show');
    Route::post('/guru/post/updateView/{id}', 'guru\PostController@updateView');
    Route::post('/guru/post/like', 'guru\PostController@like');
    Route::post('/guru/post/unlike', 'guru\PostController@unlike');
    Route::post('/guru/post/sortir', 'guru\PostController@sortir');

    //Report List
    Route::get('/guru/report/index', 'guru\ReportController@index');
    Route::post('/guru/report/store', 'guru\ReportController@store');
    Route::get('/guru/report/delete/{id}', 'guru\ReportController@delete');

    //commentPost
    Route::post('/guru/comment', 'guru\CommentController@post_comment_store');
    Route::post('/guru/comment/like', 'guru\CommentController@like');
    Route::post('/guru/comment/unlike', 'guru\CommentController@unlike');
    Route::get('/guru/comment/{id}', 'guru\CommentController@show')->name('guru.comment.show');
    Route::put('/guru/comment/edit/{id}', 'guru\CommentController@update');
    Route::delete('/guru/comment/delete/{id}', 'guru\CommentController@delete');

    //replyComment
    Route::post('/guru/replyComment', 'guru\ReplyCommentController@store');
    Route::get('/guru/replycomments/getdata/{id}', 'guru\ReplyCommentController@getData');
    Route::put('/guru/replycomment/edit/{id}', 'user\ReplyCommentController@update');
    Route::delete('/guru/replycomment/delete/{id}', 'user\ReplyCommentController@delete');

    //profile
    Route::resource('/guru/profile', 'guru\ProfileController');

    //artikel
    Route::get('/guru/edit_artikel/{slug}', 'guruController@edit_article');
    Route::get('/guru/edit_artikel/{slug}', 'guru\ArticleController@edit_article');
    Route::post('/guru/proses_update_artikel', 'guru\ArticleController@update_article');
    Route::get('/guru/delete_artikel/{slug}', 'guru\ArticleController@delete_article');

    //message
    Route::get('/guru/messages', 'guru\MessageController@index');
    Route::post('/guru/message', 'guru\MessageController@store');
    Route::post('/guru/message/searchsiswa', 'guru\MessageController@searchSiswa');
    Route::get('/guru/messages/{id}/', 'guru\MessageController@getMessage')->name('messages');
    Route::get('/guru/newmessages', 'guru\MessageController@newMessage')->name('newmessages');
    Route::get('/guru/message/{id}/', 'guru\MessageController@getData');

    //Pengumuman
    Route::get('/guru/pengumuman', 'guru\PengumumanController@index');
    Route::get('/guru/buat_pengumuman', 'guru\PengumumanController@create');
    Route::post('/guru/proses_buat_pengumuman', 'guru\PengumumanController@store_create_pengumuman');
    Route::get('/guru/edit_pengumuman/{slug}', 'guru\PengumumanController@edit_pengumuman');
    Route::post('/guru/proses_edit_pengumuman', 'guru\PengumumanController@update_pengumuman');
    Route::get('/guru/delete_pengumuman/{slug}', 'guru\PengumumanController@delete_pengumuman');

    Route::get('/guru/show_pengumuman/{slug}', 'guru\PengumumanController@show_pengumuman');
    //group chat
    Route::get('/guru/chatgroup', 'guru\GroupchatController@index');
    Route::get('/guru/chatgroup/create', 'guru\GroupchatController@create');
    Route::get('/guru/chatgroup/{id}', 'guru\GroupchatController@show');
    Route::get('/guru/chatgroup/{id}/userjoin', 'guru\GroupchatController@userJoin');
    Route::post('/guru/chatgroup/store', 'guru\GroupchatController@store');
    Route::post('/guru/chatgroup/acceptuser', 'guru\GroupchatController@acceptReqJoin');
    Route::post('/guru/chatgroup/declineuser', 'guru\GroupchatController@declineReqJoin');
    Route::post('/guru/messagegroup', 'guru\GroupchatController@sendMessage');

    //reportpost
    Route::get('/guru/reportpost/', 'guru\ReportpostController@index');
    Route::get('/guru/reportpost/{id}/show', 'guru\ReportpostController@show');

    //reportkonseling
    Route::get('/guru/reportkonseling', 'guru\ReportkonselingController@index');
    Route::get('/guru/reportkonseling/create/{id}', 'guru\ReportkonselingController@create');
    Route::post('/guru/reportkonseling/store', 'guru\ReportkonselingController@store');

    //galeribk
    Route::resource('/guru/galeri', 'guru\GaleribkController');
});
    

Route::group(['middleware' => ['auth', 'checkRole:siswa']],function(){
    Route::get('/dashboard/siswa', 'user\DashboardController@index');
    //article
    Route::get('/article/index', 'user\ArticleController@article');
    Route::get('/show/{slug}', 'user\ArticleController@show_article');
    
    //pengumuman
    Route::get('/pengumuman/index', 'user\PengumumanController@index');
    Route::get('/show_pengumuman/{slug}', 'user\PengumumanController@show_pengumuman');
    
    // post
    Route::resource('/post', 'user\PostController');
    Route::post('/post/like', 'user\PostController@like');
    Route::post('/post/unlike', 'user\PostController@unlike');
    Route::post('/post/updateDraft/{id}', 'user\PostController@updateDraft');
    Route::post('/post/updateView/{id}', 'user\PostController@updateView');
    Route::post('/post/updatesolved/{id}', 'user\PostController@updateSolved');
    Route::post('/post/sortir', 'user\PostController@sortir');

    Route::resource('/like', 'user\LikepostController');
    
    //Report List
    Route::get('/report/index', 'user\ReportController@index');
    Route::post('/report/store', 'user\ReportController@store');
    Route::get('/report/delete/{id}', 'user\ReportController@delete');
    
    // comment
    Route::resource('/comment', 'user\CommentController');
    Route::delete('/comment/{id}', 'user\CommentController@delete');
    Route::get('/comments/{id}', 'user\CommentController@getIndex');
    Route::post('/comment/like', 'user\CommentController@like');
    Route::post('/comment/unlike', 'user\CommentController@unlike');
    Route::post('/commentSolved/{id}', 'user\CommentController@commentSolved');
    Route::post('/commentUnSolved/{id}', 'user\CommentController@commentUnSolved');
    
    // replycomment
    Route::post('/replyComment', 'user\ReplyCommentController@store');
    Route::put('/replycomment/edit/{id}', 'user\ReplyCommentController@update');
    Route::delete('/replycomment/delete/{id}', 'user\ReplyCommentController@delete');
    Route::get('/replycomments/getdata/{id}', 'user\ReplyCommentController@getData');
    
    //notif
    Route::get('/notifications/{id}', 'user\NotificationController@index');
    Route::post('/notifications/{id}/open', 'user\NotificationController@open');
    
    Route::resource('/profile', 'user\ProfileController');
    
    //message
    Route::get('/messages', 'user\MessageController@index');
    Route::post('/message', 'user\MessageController@store')->name('message');
    Route::get('/messages/{id}/', 'user\MessageController@getMessage')->name('messages');
    Route::get('/newmessages', 'user\MessageController@newMessage')->name('newmessages');
    Route::get('/message/{id}/', 'user\MessageController@getData');

    //group chat
    Route::get('/chatgroup', 'user\GroupchatController@index');
    Route::get('/chatgroup/{id}', 'user\GroupchatController@show');
    Route::post('/chatgroup/join', 'user\GroupchatController@join');
    Route::post('/chatgroup/unjoin', 'user\GroupchatController@unjoin');
    Route::post('/messagegroup', 'user\GroupchatController@sendMessage');
});

Route::group(['middleware' => ['auth', 'checkRole:siswa,admin']],function(){
    Route::get('/artikel/index', function () {
        return view('user/artikel/index');
    });
});
