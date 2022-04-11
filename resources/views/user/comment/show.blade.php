<div class="card card-content"  style="">
    <div class="card-body" >
        
        <!-- reply comment -->
        
        
        @if($r_comment)
        <h5 class="mt-2 mb-2">{{$r_comment->count()}} Balasan</h5>
        
        @foreach($r_comment as $rc)
        
            <div class="media mb-2" style="background-color:white; padding:10px; border-style: outset; border-bottom: 3px solid #7D7AAE;border-right: 3px solid #7D7AAE">
            @if($rc->anonymous == 1)
            <img src="{{ asset('image/user.png') }}" alt="" width="64" height="64" class="align-self-start mr-3" style="border-radius:50%">
            @else
            <img src="{{ asset('image/'. $rc->user->profile->foto_profil) }}" alt="" width="64" height="64" class="align-self-start mr-3" style="border-radius:50%; object-fit:cover">
            @endif
                <div class="media-body" style="color:#3A4058">
                  @if(Auth::user()->id == $rc->user_id)
                      <a id="hapus-balas-komentar" data-toggle="modal" data-id="{{$rc->id}}" data-comment_id="{{$rc->comment_id}}" data-target="#hapusBalasanKomentar" style="float:right"><button class="btn btn-sm">| hapus komentar</button></a>
                      <a id="edit-balas-komentar" data-toggle="modal" data-id="{{$rc->id}}" data-comment="{{$rc->comment}}" data-target="#editBalasanKomentar" style="float:right"><button class="btn btn-sm">edit komentar</button></a>
                  @else
                  @endif  
                    
                    @if($rc->anonymous == 1)
                    <h5 class="mt-0"><b>Anonim</b></h5>
                    @else
                    <h5 class="mt-0"><b>{{$rc->user->username}}</b></h5>
                    @endif
                    <p><b>@if($rc->receiver_id == $ts) <b>Pembuat Komentar</b> @else {{$rc->receiver->username}} @endif</b> {{$rc->comment}}</p>
                    <span style="float:right">{{ \Carbon\Carbon::parse($rc->created_at)->diffForhumans() }}</span>
                    <a id="balas-komentar2" data-toggle="modal" data-target="#reply-comment2" data-id="{{$rc->comment_id}}" data-user_id="{{Auth::user()->id}}" data-receiver_id="{{$rc->user_id}}" data-post_id="{{$rc->post_id}}"><button class="btn btn-sm" style="color:#3A4058; font-weight:600">Balas Komentar</button></a>
                </div>
            </div>
        @endforeach
        @else
        <h5>Tidak ada Komentar</h5>
        
        @endif
    </div>
</div>


<!-- start modal-->
<div class="modal fade" id="reply-comment2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Balas Komentar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div id="modal-balas2" class="modal-body">
            <div class="form-group">
                <label for="">Balas Komentar</label>
                <input type="hidden" class="form-control" id="id2" name="comment_id" >
                <input type="hidden" class="form-control" id="user_id2" name="user_id">
                <input type="hidden" class="form-control" id="receiver_id2" name="receiver_id">
                <input type="hidden" class="form-control" id="post_id2" name="post_id">
                <textarea name="comment" id="comment2" cols="30" rows="10" class="form-control" placeholder="Tulis Balasan"></textarea>
            </div>
            <div class="form-group">
                <select name="anonymous" id="anonymous2" class="form-control">
                  <option value="0">Sebagai User Biasa</option>
                  <option value="1">Sebagai User Anonim</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btnCloseModal321" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary btn-reply-replied" name="simpan" value="Simpan">

        </div>

      </div>
    </div>
  </div>
<!-- end modal form-edit -->  

<!-- modal delete -->
<div class="modal fade" id="hapusBalasanKomentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="hidden" id="balasanKomentarIdDelete">
            <input type="hidden" id="komentarIdDelete">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCloseRModal">Close</button>
            <button type="button" class="btn btn-danger btn-r-delete" id="btnHapusBalasKomen">Delete</button>
        </div>
        </div>
    </div>
</div>
<!-- end -->

<!-- modal edit Komentar -->
<div class="modal fade" id="editBalasanKomentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input type="hidden" id="balasKomentarIdEdit">
                
                <textarea id="komentarBalasanBaru" name="rcomment" id="comment" cols="50" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button id="btnCloseModa3" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  type="button" class="btn btn-primary btn-edit-balasan" id="btnEditBalasKomen">Edit</button>
        </div>
        </div>
    </div>
</div>
<!-- end -->



