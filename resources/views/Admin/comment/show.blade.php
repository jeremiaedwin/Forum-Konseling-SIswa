@extends('admin.layout.app')
@section('title', 'Daftar Komentar')
@section('page', 'Daftar Komentar')
@section('content')

<div class="card content-card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <center><img src="{{asset('image/'. $comments->user->profile->foto_profil)}}" width="150" height="150" style="border-radius:50%" alt=""></center>
            </div>
            <div class="col-md-8" style="border-radius:15px; border-top: 2px solid #7D7AAE; border-bottom: 2px solid #7D7AAE">
                <table class="table" style="color: #3A4058; ">
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td>{{$comments->user->name}}</td>
                    </tr>
                    <tr>
                        <td>Post</td>
                        <td>:</td>
                        <td>{{$comments->post->title}}</td>
                    </tr>
                    <tr>
                        <td>Komentar</td>
                        <td>:</td>
                        <td><p>{{$comments->comment}}</p></td>
                    </tr>
                    <tr>
                        <td>Dibuat Pada</td>
                        <td>:</td>
                        <td>{{$comments->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Komentar Favorit</td>
                        <td>:</td>
                        <td>@if($comments->jawaban_terbaik) {{"Ya"}} @else {{"Tidak"}} @endif</td>
                    </tr>
                    <tr>
                        <td>Sebagai Anonymous</td>
                        <td>:</td>
                        <td>@if($comments->anonymous) {{"Ya"}} @else {{"Tidak"}} @endif</td>
                    </tr>
                    <tr>
                        <td>Jumlah Balasan</td>
                        <td>:</td>
                        <td>{{$comments->replycomment->count('comment_id')}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Like</td>
                        <td>:</td>
                        <td>{{$comments->commentlike->count('comment_id')}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-3" style="overflow:auto">
                <h3>Daftar Balasan</h3>
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Komentar</th>
                        <td>Dibuat</td>
                        <td>Disunting</td>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody style="color:black">
                    @php $no = 1 @endphp
                    @foreach($r_comments as $c)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$c->user->name}}</td>
                        <td>{{$c->comment}}</td>
                        <td>{{$c->created_at}}</td>
                        <td>{{$c->updated_at}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm detail" data-toggle="collapse" data-id="{{$c->id}}" href="#collapseExample-{{$c->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="far fa-eye"></i>
                            </a>
                            <div class="collapse" id="collapseExample-{{$c->id}}">
                                <div class="card card-body">
                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>       
            </div>
        </div> 
    </div>
</div>

@endsection

@push('preview_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('.detail').click(function(){
        var rc_id = $(this).data('id');

        $.ajax({
            type:"GET",
            url :"/admin/replycomments/getdata/"+rc_id,
            data:"",
            cache:false,
            success:function(data){
                $("#collapseExample-"+rc_id).html(data);
            }
        });
    });
        
</script>
@endpush