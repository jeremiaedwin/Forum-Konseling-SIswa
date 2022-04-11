@extends('guru.layout.app')
@section('title', 'Posts')
@section('page', 'Post/Show')
@section('content')

<div class="card content-card" id="content-post" style="width:95%; margin-left:auto; margin-right:auto">
    <!-- post show -->
    <div class="card-header background-index-head" style="background-color: white; color: #3A4058;border-top: 2px solid #7D7AAE">
        <div class="media">
            @if($posts->anonymous != 1)
            <img class="mr-3" src="{{ asset('image/'. $posts->user->profile->foto_profil) }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-3" style="font-weight: 700">{{$posts->user->name}}</h5>
            </div>
            @else
            <img class="mr-3" src="{{ asset('image/user.png') }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-3">{{$posts->user->name}} Bertanya Sebagai Anonim</h5>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body backgoround-post-show">
        <div class="mt-2">
            <center><h2>{{$posts->title}}</h2></center>
            <center><span>{{ \Carbon\Carbon::parse($posts->created_at)->diffForhumans() }}</span></center>
            <button disabled class="btn btn-sm" style="margin-left: 10%;border-color:blue; color:black; font-weight:bold">{{$posts->category->category}}</button>
        </div>
        <div class="mb-4 mt-2">
            @if($posts->image != null)
            <img src="{{ asset('image/'. $posts->image) }}" alt="" class="image-post-show">
            @endif
        </div>
        <div class="mt-2">
            <p class="konten-post" style="font-family: Georgia, 'Times New Roman', Times, serif;">{!! $posts->content !!}</p>
        </div>
        <!-- end -->

        <!-- Like Button -->
        <div class="post-like">
            @if($user_like == true)
            <div class="form-unlike">
                <form action="/guru/post/unlike" method="post">
                {{csrf_field()}}
                    <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                    <input type="hidden" name="post_id" id="" value="{{$posts->id}}">
                    <button type="submit" id="unlike" style="color: blue; background-color: #DBD0FC; border:none" class="btn btn-lg"><i class="fas fa-thumbs-up"><p id="jml_like">({{$likes}})</p></i></button>   
                </form>     
            </div>    
            @else
            <div class="form-like">
                <form action="/guru/post/like" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                    <input type="hidden" name="post_id" id="" value="{{$posts->id}}">
                    <button type="submit" style="color: blue; background-color: #DBD0FC; border:none" class="like-submit btn-lg"><i id="like" class="far fa-thumbs-up"><p id="jml_like">({{$likes}})</p></i></button>
                </form>     
            </div>
            @endif
        </div>
        <!-- end -->
    </div>
</div>

<div class="mb-2 mt-2 ml-2" style="margin-left:auto; margin-right:auto"><a href="/guru/post" class="btn btn-lg" style="border: none; color:grey; font-weight:bold; margin-left:auto; margin-right:auto">Kembali</a></div>

<!-- kolom komentar -->
<div class="card" id="kolom-komentar" style="width:95%; margin-left:auto; margin-right:auto">
    <div class="card-header comment-post-header" style="background-color: #7D7AAE">
        <h5>Comment Section</h5>
    </div>
    <div class="card-body komentar comment-post-body">
        <h4>Beri Komentar</h4>
        <form action="/guru/comment" method="post">
        {{csrf_field()}}
            <div class="form-group">
                <input type="hidden" name="user_id" value="">
                <label for="isi komentar">Komentarmu :</label>
                <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                <input type="hidden" name="receiver_id" id="" value="{{$posts->user_id}}">
                <input type="hidden" name="post_id" id="" value="{{$posts->id}}">
                <textarea name="comment" id="" cols="20" rows="3" class="form-control" placeholder="Komentarmu"></textarea>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="anonymous" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Beri Komentar Sebagai Anonymous?
                    </label>
                </div>
            </div>
            <button type="submit" class="kirim-komentar btn btn-primary">Kirim</button>
        </form>
        <hr>
    <center>
        <button class="btn comment-index" data-idpost="{{$posts->id}}" id="tampilkanKomentar" type="button" data-toggle="collapse" data-target="#collapseKomentar" aria-expanded="false" aria-controls="collapseExample">
            Tampilkan Komentar
        </button>
    </center>
    <div class="collapse" id="collapseKomentar">
        <!-- komentar like -->
        <h5>{{$posts->comment()->count()}} Komentar</h5>
            @foreach($posts->comment()->orderBy('created_at', 'desc')->get() as $c)
            @if($c->jawaban_terbaik)
            <div class="media" style="background-color:#b5fab1; padding:10px; border-style: outset; border-bottom: 2px solid #7D7AAE; margin-bottom:5px;">
            @else
            <div class="media" style="background-color:white; padding:10px; border-style: outset; border-bottom: 2px solid #7D7AAE; margin-bottom:5px;">
            @endif
                @if($c->anonymous == 1)
                <img src="{{ asset('image/user.png') }}" alt="" width="64" height="64" class="align-self-start mr-3" style="border-radius:50%">
                @else
                <img class="align-self-start mr-3" src="{{ asset('image/'. $c->user->profile->foto_profil) }}" width="64" height="64"style="border-radius:50%; object-fit: contain;" alt="Generic placeholder image">
                
                @endif
                <div class="media-body" id="komen-{{$c->id}}">
                <div class="row">
                    <div class="col-md-8">
                        @if($c->anonymous == 1)
                        <h5 style="font-weight:bold">{{$c->user->name}} Berkomentar Sebagai Anonymous</h4>
                        @else
                        <h5 style="font-weight:bold">{{$c->user->name}}</h5>
                        @endif
                    </div>
                    <div class="col-md-4" style="text-align:right">
                        @if(Auth::user()->id == $c->user_id)
                            <a id="delete-komen" data-toggle="modal" data-id="{{$c->id}}" data-target="#hapus-komentar" style="float:right"><button class="btn btn-sm"><i class="fas fa-trash"></i></button></a>
                            <a id="edit-komentar" data-toggle="modal" data-id="{{$c->id}}" data-comment="{{$c->comment}}" data-target="#editKomentar" style="float:right"><button class="btn btn-sm"><i class="fas fa-pen"></i></button></a>
                        @else
                    @endif
                    </div>
                </div>
                
                    
                    @if($c->jawaban_terbaik)
                    <h5><b>Jawaban Terbaik</b></h5>
                    @else
                    @endif
                    <p id="isi-komen-{{$c->id}}">{{$c->comment}}</p>
                    <span style="color:grey;">{{ \Carbon\Carbon::parse($c->created_at)->diffForhumans() }}</span>
                    <a id="balas-komentar" data-toggle="modal" data-target="#reply-comment" data-id="{{$c->id}}" data-user_id="{{Auth::user()->id}}" data-receiver_id="{{$c->user_id}}" data-post_id="{{$c->post_id}}"><button class="btn btn-sm" style="color:#3A4058"><span class="far fa-comment-dots" style="color:#3A4058"></span> Balas Komentar</button></a>
                    
                    <a class="btn btn-sm"  style="color:#3A4058">{{$c->commentlike->count()}} Suka</a>
                    <div style="float:right">
                        @if($c->commentlike()->where('user_id', $user)->first())
                        <form action="/guru/comment/unlike" method="post">
                        {{csrf_field()}}
                            <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                            <input type="hidden" name="comment_id" id="" value="{{$c->id}}">
                            <button type="submit" id="unlike" style="color: blue; border:none" class="btn btn-lg"><i class="fas fa-thumbs-up"></i></button>   
                        </form>     
                        @else
                        <form action="/guru/comment/like" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                            <input type="hidden" name="comment_id" id="" value="{{$c->id}}">
                            <button type="submit" style="color: blue; border:none" class="btn btn-lg"><i id="like" class="far fa-thumbs-up"></i></button>
                        </form> 
                    @endif
                    </div>

            <!-- show replyComment -->
            
            <a data-toggle="collapse" href="#collapseExample-{{$c->id}}" data-id="{{$c->id}}" role="button" aria-expanded="false" aria-controls="collapseExample" class="btn btn-sm reply-comment-show" ><button style="color:#3A4058" class="btn click-balasan" id="tombol-balasan"><div id="jumlah-komentar-{{$c->id}}">{{$c->replycomment->count()}} Balasan</div></button></a>
            <div class="collapse" id="collapseExample-{{$c->id}}">
            
            </div>

            <!-- end -->

            


            <!-- komentar fav -->
            @if($c->post->user->id == Auth::user()->id)
            <div style="float:right">
            @if($c->jawaban_terbaik == 0)
                <form action="/commentSolved/{{$c->id}}" method="post">
                {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="jawaban_terbaik" id="" value="1">
                        <button type="submit" class="btn" style="color:red"><span class="far fa-heart"></span></button>
                    </div>
                </form>
            @else
                <form action="/commentUnSolved/{{$c->id}}" method="post">
                {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="jawaban_terbaik" id="" value="0">
                        <button type="submit" class="btn" style="color:red"><span class="fas fa-heart"></span></button>
                    </div>
                </form>
                @endif
            </div>
            <!-- end -->
        @endif

        </div>
    </div>
    @endforeach
</div>

        <!-- start modal-->
        <div class="modal fade" id="reply-comment" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Balas Komentar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div id="modal-balas" class="modal-body">
                        <div class="form-group">
                            <label for="">Balas Komentar</label>
                            <input type="hidden" class="form-control" id="id" name="comment_id" >
                            <input type="hidden" class="form-control" id="user_id" name="user_id">
                            <input type="hidden" class="form-control" id="receiver_id" name="receiver_id">
                            <input type="hidden" class="form-control" id="post_id" name="post_id">
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" placeholder="Tulis Balasan"></textarea>
                        </div>
                        <div class="form-group">
                            <select name="anonymous" id="anonymous" class="form-control">
                            <option value="0">Sebagai User Biasa</option>
                            <option value="1">Sebagai User Anonim</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal-reply">Close</button>
                    <input type="submit" class="btn btn-primary btn-reply" name="simpan" value="Simpan">
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal form --> 

        <!-- modal delete -->
        <div class="modal fade" id="hapus-komentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Komentar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Anda Yakin Ingin menghapus Komentar Ini?</h4>
                    <input type="hidden" id="komentar-id-delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCloseModal">Close</button>
                    <button type="button" class="btn btn-danger btn-delete" id="btnHapusKomen">Delete</button>
                </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end -->

        <!-- modal edit Komentar -->
        <div class="modal fade" id="editKomentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Komentar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                    <label for="">Edit Komentar</label>
                        <input type="hidden" id="komentarIdEdit">
                        <textarea id="komentarBaru" name="comment" id="comment" cols="50" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnCloseModal2" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  type="button" class="btn btn-primary btn-edit" id="btnEditKomen">Edit</button>
                </div>
                </div>
                </div>
            </div>
        </div>
    <!-- end -->

<!-- start modal form-edit-->
<div class="modal fade" id="reply-comment" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Balas Komentar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/guru/replyComment" method="post">
        {{csrf_field()}}
        <div id="modal-balas" class="modal-body">
            <div class="form-group">
                <label for="">Balas Komentar</label>
                <input type="hidden" class="form-control" id="id" name="comment_id" >
                <input type="hidden" class="form-control" id="user_id" name="user_id">
                <input type="hidden" class="form-control" id="receiver_id" name="receiver_id">
                <input type="hidden" class="form-control" id="post_id" name="post_id">
                <textarea name="comment" id="" cols="30" rows="10" class="form-control" placeholder="Tulis Balasan"></textarea>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="anonymous" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Balas Komentar Sebagai Anonymous
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
        </div>
        </form>
        </div>
    </div>
</div>
<!-- end modal form-edit -->  

@endsection

@push('preview_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Balas Komentar -->
<script>
  $(document).on("click","#balas-komentar", function(){
    var id = $(this).data('id');
    var user_id = $(this).data('user_id');
    var post_id = $(this).data('post_id');
    var receiver_id = $(this).data('receiver_id');
    var comment_id = $(this).data('comment_id');
    

    $("#modal-balas #id").val(id);
    $("#modal-balas #user_id").val(user_id);
    $("#modal-balas #receiver_id").val(receiver_id);
    $("#modal-balas #post_id").val(post_id);
    
  });
</script>
<!-- end -->

<!-- membalas balasan komentar -->
<script type="text/javascript">
    $(document).on('click', '.btn-reply-replied', function(e) {

        e.preventDefault();

        var comment_id = $("#modal-balas2 #id2").val();
        var user_id = $("#modal-balas2 #user_id2").val();
        var receiver_id = $("#modal-balas2 #receiver_id2").val();
        var post_id = $("#modal-balas2 #post_id2").val();
        var anonymous = $("#modal-balas2 #anonymous2").val();
        var comment = $("#modal-balas2 #comment2").val();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        url:"/guru/replyComment/?"+Math.random(),
        method:'POST',
        data:{
                comment_id:comment_id, 
                user_id:user_id,
                receiver_id:receiver_id,
                post_id:post_id,
                comment:comment,
                anonymous:anonymous,
                },
        success:function(data){
            alert("sukses");
            $("#jumlah-komentar-"+comment_id).load(location.href+" #jumlah-komentar-"+comment_id,"");
            $("#modal-balas #comment").val();
            $("#jumlah-komentar-"+comment_id).trigger("click");
            },
        error:function(error){
            console.log(error)
        },
        complete: function () {
            location.reload(true);
            
            }
        });
    });
</script>
<!-- end -->

<!-- ambil data balasan komentar yang ingin dibalas -->
<script>

  $(document).on("click","#balas-komentar2", function(){
  var id = $(this).data('id');
  var user_id = $(this).data('user_id');
  var post_id = $(this).data('post_id');
  var receiver_id = $(this).data('receiver_id');
  var comment_id = $(this).data('comment_id');


  $("#modal-balas2 #id2").val(id);
  $("#modal-balas2 #user_id2").val(user_id);
  $("#modal-balas2 #receiver_id2").val(receiver_id);
  $("#modal-balas2 #post_id2").val(post_id);

  })

</script>
<!-- end -->

<!-- ambil data komentar yang ingin di edit -->
<script>
  $(document).on("click","#edit-komentar", function(){
    var komen_id = $(this).data('id');
    var komen = $(this).data('comment');

    $("#komentarIdEdit").val(komen_id);
    $("#komentarBaru").val(komen);
    
  });
</script>
<!-- end -->

<!-- edit komentar -->
<script type="text/javascript">


    $(".btn-edit").click(function(e){

        e.preventDefault();

        var id = $("#komentarIdEdit").val();
        var comment = $("#komentarBaru").val();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        url:"/guru/comment/edit/"+id+"/?"+Math.random(),
        method:'PUT',
        data:{
                id:id, 
                comment:comment,
                },
        success:function(data){
            alert("sukses");
            
            $("#btnCloseModal2").trigger("click");
            $("#isi-komen-"+id).load(location.href+" #isi-komen-"+id,"");
            },
        error:function(error){
            console.log(error)
        },
        complete: function () {
            
            
            }
        });
    });

</script>
<!-- end -->

<!-- ambil data komentar yang ingin dihapus -->
<script>
  $(document).on("click","#delete-komen", function(){
    var komen_id = $(this).data('id');

    $("#komentar-id-delete").val(komen_id);
  });
</script>
<!-- end -->

<script>

    $(".btn-delete").click(function(e){

        e.preventDefault();

        var id = $("#komentar-id-delete").val();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        url:"/guru/comment/delete/"+id+"/?"+Math.random(),
        method:'delete',
        data:{
                id:id, 
                },
        success:function(data){
            alert("sukses");
            $("#btnCloseModal").trigger("click");
            $("#btnCloseModal").trigger("click");
            },
        error:function(error){
            console.log(error)
        },
        complete: function () {
            }
        });
    });
</script>
<!-- end -->

<!-- menampilkan komentar -->
<script>
    $('.reply-comment-show').click(function(){
        var rc_id = $(this).data('id');

        $.ajax({
            type:"GET",
            url :"/guru/replycomments/getdata/"+rc_id,
            data:"",
            cache:false,
            success:function(data){
                $("#collapseExample-"+rc_id).html(data);
            }
        });
    });            
</script>
<!-- end -->

<!-- membalas komentar -->
<script type="text/javascript">
    $(".btn-reply").click(function(e){

        e.preventDefault();

        var comment_id = $("#modal-balas #id").val();
        var user_id = $("#modal-balas #user_id").val();
        var receiver_id = $("#modal-balas #receiver_id").val();
        var post_id = $("#modal-balas #post_id").val();
        var comment = $("#modal-balas #comment").val();
        var anonymous = $("#modal-balas #anonymous").val();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        url:"/guru/replyComment/?"+Math.random(),
        method:'POST',
        data:{
                comment_id:comment_id, 
                user_id:user_id,
                receiver_id:receiver_id,
                post_id:post_id,
                comment:comment,
                anonymous:anonymous,
                },
        success:function(data){
            alert("sukses");
            
            location.reload(true);
            
        },
        error:function(error){
            console.log(error)
        },
        complete: function () {            
            }
        });
    });
</script>
<!-- end -->

<!-- hapus balasan komentar -->
<script>
    $(document).on('click', '#btnHapusBalasKomen', function(e) {

        e.preventDefault();

        var id = $("#balasanKomentarIdDelete").val();
        var comment_id = $("#komentarIdDelete").val();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        url:"/guru/replycomment/delete/"+id+"/?"+Math.random(),
        method:'delete',
        data:{
                id:id, 
                },
        success:function(data){
            alert("sukses");
            $("#jumlah-komentar-"+comment_id).load(location.href+" #jumlah-komentar-"+comment_id,"");
            $("#btnCloseRModal").trigger("click");
            $("#jumlah-komentar-"+comment_id).trigger("click");
            },
        error:function(error){
            console.log(error)
        },
        complete: function () {
            }
        });
    });
</script>
<!-- end -->

<!-- edit balasan komentar -->

<script type="text/javascript">


    $(document).on('click', '#btnEditBalasKomen', function(e) {

            e.preventDefault();

            var id = $("#balasKomentarIdEdit").val();
            var komen_id = $("#balasKomentarIdKomen").val();
            var comment = $("#komentarBalasanBaru").val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
            url:"/guru/replycomment/edit/"+id+"/?"+Math.random(),
            method:'PUT',
            data:{
                    id:id, 
                    comment:comment,
                    },
            success:function(data){
                alert("sukses");
                $("#btnCloseModa3").trigger("click");
                $("#jumlah-komentar-"+komen_id).trigger("click");
                },
            error:function(error){
                console.log(error)
            },
            complete: function () {
                
                
                }
            });
        });

</script>
<!-- end -->

<!-- ambil data balasan komentar yang ingin di edit -->
<script>
  $(document).on("click","#edit-balas-komentar", function(){
    var komen_id = $(this).data('id');
    var komen = $(this).data('comment');
    var komentar_id = $(this).data('comment_id');

    $("#balasKomentarIdEdit").val(komen_id);
    $("#balasKomentarIdKomen").val(komentar_id);
    $("#komentarBalasanBaru").val(komen);
    
  });
</script>
<!-- end -->

<!-- ambil data balasan komentar yang ingin dihapus -->
<script>
  $(document).on("click","#hapus-balas-komentar", function(){
    var komen_id = $(this).data('id');
    var komentar_id = $(this).data('comment_id');
    console.log(komen_id);
    $("#balasanKomentarIdDelete").val(komen_id);
    $("#komentarIdDelete").val(komentar_id);
  });
</script>
<!-- end -->
@endpush