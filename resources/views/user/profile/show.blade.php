@extends('layout.app')
@section('title', 'Profile')
@section('page', 'Profile/Profile Anda')
@section('content')

<!-- <div class="card card-content" style="border:none">

    <div class="main">
        <div class="card-body" style="background-image: url('{{asset('image/'. $profiles->foto_sampul)}}');">
        </div>
        <div class="profile">
            <img src="{{asset('image/'. $profiles->foto_profil)}}" >
        </div>
    </div>

    <div class="profile-username">
        <h3>Username</h3>
    </div>
</div> -->

<div class="card">
    <div class="card-body foto-sampul" style="background-image: url('{{asset('image/'. $profiles->foto_sampul)}}');">
    </div>
    <div class="foto-profil">
        <img src="{{asset('image/'. $profiles->foto_profil)}}" alt="" style="object-fit:scale-down; background-color: white">
        <h3 class="nama-user">{{Auth::user()->name}}</h3>
        <a href="/profile/{{$profiles->id}}/edit" class="btn btn-secondary text-white profile-setting">Pengaturan Profile</a>
    </div>
</div>

<div class="card mt-2">
    <card class="card-header text-white" style="background-color:#7D7AAE;">
        Profile
    </card>

    <div class="card-body">
        <ul class="list-group text-dark" style="height:300px; overflow:scroll">
            <li class="list-group-item">
                <b>Nama</b> <br> 
                {{$profiles->user->name}}
            </li>
            <li class="list-group-item">
                <b>Username</b> <br> 
                {{$profiles->user->username}}
            </li>
            <li class="list-group-item">
                <b>Email</b> <br> 
                {{$profiles->user->email}}
            </li>
            <li class="list-group-item">
                <b>Tanggal Lahir</b> <br> 
                {{$profiles->tanggal_lahir}}
            </li>
            <li class="list-group-item">
                <b>Agama</b> <br> 
                {{$profiles->agama}}
            </li>
        </ul>
    </div>
</div>

<div class="row text-dark">
    <!-- Post -->
    <div class="col-md-12">
        <div class="card card-tabs">
            <div class="card-body text-dark">
            <div class="tabs">
            <div class="tab-header">
                <div class="active">
                    <i class="fas fa-pen"></i> Post
                </div>
                <div class="">
                    <i class="fas fa-comments"></i> Comment
                </div>
                <div class="">
                    <i class="fas fa-edit"></i> Konseling
                </div>
            </div>

            <div class="tab-indicator"></div>

            <div class="tab-body">
                <div class="active">
                    <span><b>Post Anda ({{$posts->count('user_id')}})</b></span>
                    <table class="table text-dark" >
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>                                
                                <th><i class="fas fa-eye"></i></th>
                                <th><i class="fas fa-thumbs-up"></i></th>
                                <th><i class="fas fa-comments"></i></th>
                                <th>Solved</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $p)
                            <tr>
                                <td>{{$p->title}}</td>
                                <td>{{$p->category->category}}</td>
                                <td>
                                    @if($p->image == true)
                                    <img src="{{asset('image/'.$p->image)}}" alt="" width="64" height="64">
                                    @else
                                    <b>No Image</b>
                                    @endif
                                </td>
                                <td><b>{{$p->total_visit}}</b></td>
                                <td><b>{{$p->like->count('post_id')}}</b></td>
                                <td><b>{{$p->comment->count('post_id')}}</b></td>
                                <td>
                                    <form action="/post/updatesolved/{{$p->id}}" method="post">
                                    {{csrf_field()}}
                                        <button type="submit" class="btn btn-sm btn-dark">@if ($p->solved == 0) {{"Not Solved"}} @else {{"Solved"}} @endif</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/post/updateDraft/{{$p->id}}" method="post">
                                    {{csrf_field()}}
                                        @if($p->status_id == 1)
                                        <input type="hidden" name="status_id" id="status_id" value="0">
                                        <button type="submit" id="update_status" class="update-status btn btn-primary btn-sm btn-block" alt="simpan sebagai draft"><i class="fas fa-folder"></i></button>
                                        @else
                                        <input type="hidden" name="status_id" id="status_id" value="1">
                                        <button type="submit" id="update_status" class="update-status btn btn-primary btn-sm btn-block" alt="publikasikan"><i class="fas fa-folder-open"></i></button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <a href="/post/{{$p->id}}/edit" class="update-status btn btn-warning btn-sm btn-block"><i class="fas fa-pen"></i></a>
                                </td>
                                <td>
                                    <a href="/post/{{$p->slug}}" class="update-status btn btn-success btn-sm btn-block"><i class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <form action="/post/{{$p->id}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                        <button type="submit" class="update-status btn btn-danger btn-sm btn-block"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <div>
                    <span><b>Comment ({{$comments->count('user_id')}})</b></span>
                    @foreach($comments as $c)
                    <table class="table">
                        <tr>
                            <td>
                                <a href="/post/{{$c->post->slug}}"><b>{{$c->post->title}}</b></a>
                                
                                <p>{{$c->comment}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>
                                    <i class="fas fa-comments"> {{$c->replycomment->count('comment_id')}} Balasan</i>
                                    <i class="fas fa-comments"> {{$c->commentlike->count('comment_id')}} Suka</i>
                                </span>
                            </td>
                            <td>
                             <span style="float:right">{{$c->created_at}}</span>
                            </td>
                        </tr>
                    </table>
                    @endforeach
                </div>

                <div>
                    <table class="table table-bordered">
                        <h5>Daftar Konseling Yang Anda Telah Lakukan</h5>
                            <thead style="background-color:#7D7AAE; color:white">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Konseling</th>
                                    <th>Nama Siswa</th>
                                    <th>Topik Konseling</th>
                                    <th>Masalah</th>
                                    <th>Alasan Konseling</th>
                                    <th>Masalah Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @foreach($reportkonselings as $k)
                                <tr class="text-dark">
                                    <td>{{$no}}</td>
                                    <td>{{$k->tanggal_konseling}}</td>
                                    <td>{{$k->name}}</td>
                                    <td>{{$k->klasifikasi_masalah}}</td>
                                    <td>{{$k->title}}</td>
                                    <td>{{$k->alasan_report}}</td>
                                    <td>@if($k->masalah_selesai == 1) {{"Ya"}} @else {{"Tidak"}} @endif</td>
                                </tr>
                                @php $no++ @endphp
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after_script')
<script>
    let tabHeader = $(".tab-header")[0];
    let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
    let tabBody = document.getElementsByClassName("tab-body")[0];

    let tabsPane = tabHeader.getElementsByTagName('div');

    for(let i=0;i<tabsPane.length;i++){
        tabsPane[i].addEventListener("click", function(){
            tabHeader.getElementsByClassName("active")[0].classList.remove("active");
            tabsPane[i].classList.add("active");
            tabBody.getElementsByClassName("active")[0].classList.remove("active");
            tabBody.getElementsByTagName("div")[i].classList.add("active");
            
            tabIndicator.style.left = `calc(calc(100%/3)*${i})`;
        });
    }
</script>

<script type="text/javascript">
      $(document).ready(function () {

    if (screen.width > 600) {
        $("#profilUser").click();
    }
      });

</script>
@endpush
