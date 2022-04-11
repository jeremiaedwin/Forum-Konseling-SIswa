@extends('layout.app')
@section('title', 'Comment')
@section('page', 'Post/Comment')
@section('content')

<div class="card card-content" style="border:none; background-color:white; border-radius:15px; border-top:5px solid #7D7AAE">
    <div class="card-body">
        <div class="media" style="background-color:white; padding:10px; border-style: outset; border-bottom: 3px solid #7D7AAE;border-right: 3px solid #7D7AAE">
        <img src="{{ asset('image/'. $comments->user->profile->foto_profil) }}" alt="" width="64" height="64" class="align-self-start mr-3" style="border-radius:50%">
            <div class="media-body" style="color:#3A4058">
                <h5 class="mt-0"><b>{{$comments->user->name}}</b></h5>
                <p>{{$comments->comment}}</p>
                <span style="float:right">{{ \Carbon\Carbon::parse($comments->created_at)->diffForhumans() }}</span>
                <a id="balas-komentar2" data-toggle="modal" data-target="#reply-comment2" data-id1="{{$comments->id}}" data-user_id1="{{Auth::user()->id}}" data-receiver_id1="{{$comments->user_id}}" data-post_id1="{{$comments->post_id}}"><button class="btn btn-sm" style="color:#3A4058; font-weight:600">Balas Komentar</button></a>
            </div>
        </div>
        <a href="/post/{{$comments->post->slug}}" class="btn btn-lg" style="border:0;"><b><span class="fas fa-back"></span>Kembali</b></a>
        
        <!-- reply comment -->
        <div class="container">
        @if($r_comment)
        <h5 class="mt-2 mb-2">{{$r_comment->count()}} Balasan</h5>
        @foreach($r_comment as $rc)
            <div class="media mb-2" style="background-color:white; padding:10px; border-style: outset; border-bottom: 3px solid #7D7AAE;border-right: 3px solid #7D7AAE">
            @if($rc->anonymous == 1)
            <img src="{{ asset('image/user.png') }}" alt="" width="64" height="64" class="align-self-start mr-3" style="border-radius:50%">
            @else
            <img src="{{ asset('image/'. $rc->user->profile->foto_profil) }}" alt="" width="64" height="64" class="align-self-start mr-3" style="border-radius:50%">
            @endif
                <div class="media-body" style="color:#3A4058">
                    @if($rc->anonymous == 1)
                    <h5 class="mt-0"><b>Anonim</b></h5>
                    @else
                    <h5 class="mt-0"><b>{{$rc->user->name}}</b></h5>
                    @endif
                    <p><b>{{$rc->receiver->name}}</b> {{$rc->comment}}</p>
                    <span style="float:right">{{ \Carbon\Carbon::parse($rc->created_at)->diffForhumans() }}</span>
                    <a id="balas-komentar" data-toggle="modal" data-target="#reply-comment" data-id="{{$rc->comment_id}}" data-user_id="{{Auth::user()->id}}" data-receiver_id="{{$rc->user_id}}" data-post_id="{{$rc->post_id}}"><button class="btn btn-sm" style="color:#3A4058; font-weight:600">Balas Komentar</button></a>
                </div>
            </div>
        @endforeach
        @else
        <h5>Tidak ada Komentar</h5>
        @endif
        </div>
    </div>
</div>

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
        <form action="/replyComment" method="post">
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
<!-- start modal form-edit-->
<div class="modal fade" id="reply-comment2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Balas Komentar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/replyComment" method="post">
        {{csrf_field()}}
        <div id="modal-balas2" class="modal-body">
            <div class="form-group">
                <label for="">Balas Komentar</label>
                <input type="hidden" class="form-control" id="id2" name="comment_id" >
                <input type="hidden" class="form-control" id="user_id2" name="user_id">
                <input type="hidden" class="form-control" id="receiver_id2" name="receiver_id">
                <input type="hidden" class="form-control" id="post_id2" name="post_id">
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

@push('after_script')

@push('after_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
  $(document).on("click","#balas-komentar", function(){
    var id = $(this).data('id');
    var user_id = $(this).data('user_id');
    var post_id = $(this).data('post_id');
    var receiver_id = $(this).data('receiver_id');
    

    $("#modal-balas #id").val(id);
    $("#modal-balas #user_id").val(user_id);
    $("#modal-balas #receiver_id").val(receiver_id);
    $("#modal-balas #post_id").val(post_id);
    
  })

  </script>
    
    <script>
    
  $(document).on("click","#balas-komentar2", function(){
    var id = $(this).data('id1');
    var user_id = $(this).data('user_id1');
    var post_id = $(this).data('post_id1');
    var receiver_id = $(this).data('receiver_id1');
    var comment_id = $(this).data('comment_id1');
    

    $("#modal-balas2 #id2").val(id);
    $("#modal-balas2 #user_id2").val(user_id);
    $("#modal-balas2 #receiver_id2").val(receiver_id);
    $("#modal-balas2 #post_id2").val(post_id);
    
  })

  </script>
@endpush
@endpush

