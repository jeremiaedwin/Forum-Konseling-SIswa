@extends('layout.app')
@section('title', 'Post')
@section('page', 'Post/Daftar Post')
@section('content')

<div class="container-fluid">
<!-- Sortir -->

<div class="card content-card header-index-post">
    <div class="card-header">
    <form action="/post/sortir" method="post">
    {{csrf_field()}}
            <div class="form-group row">
                <div class="col">
                    <select name="category" id="" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $c)
                        <option value="{{$c->id}}">{{$c->category}} ( {{$c->post->count('category_id')}} Post)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4"> 
                    <select name="sortir" id="sortir" class="form-control">
                        <option value="">Sortir</option>
                        <option value="1">Populer</option>
                        <!-- <option value="2">Rating</option> -->
                        <option value="3">Terbaru</option>
                        <option value="4">Terlama</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end -->

<!-- list post -->
    @foreach($posts as $p)
    <div class="card content-card daftar-post">
        <div class="card-header background-index-head" style="background-color: white; color: #3A4058;border-top: 2px solid #7D7AAE">
            <div class="media">
                @if($p->anonymous != 1)
                <img class="mr-3" src="{{ asset('image/'. $p->user->profile->foto_profil) }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-3" style="font-weight: 700">{{$p->user->username}} @if($p->solved != 1) <button disabled="disabled" class="btn btn-danger btn-sm">Not Solved</button> @else ($p->solved != 1) <button disabled="disabled" class="btn btn-success btn-sm">Solved</button> @endif </h5>
                </div>
                @else
                <img class="mr-3" src="{{ asset('image/user.png') }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-3">Anonymous @if($p->solved != 1) <button disabled="disabled" class="btn btn-danger btn-sm">Not Solved</button> @else ($p->solved != 1) <button disabled="disabled" class="btn btn-success btn-sm">Solved</button> @endif </h5>
                </div>
                @endif
                <!--Laporkan-->
                @if($p->user_id == Auth::user()->id)
                @else
                <div class="btn-group" style="float:right">
                    <div class="btn-group dropleft">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-lg" style="color:black">
                            <i class="fas fa-caret-down" ></i>
                        </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ReportModal{{ $p->slug }}">Laporkan</a>
                    </div>
                </div>
                </div>
                @endif
                <!--End Laporkan-->
            </div>
        </div>
        <div class="card-body background-index-post-body">
        @if($p->image == true)
            <img src="{{asset('image/'. $p->image)}}"  alt="" style="width:300px; height:300px;" class="image-post-index">
            <h3>{{$p->title}}</h3>
            <p class="">{!! \Illuminate\Support\Str::limit($p->content, 200) !!}</p>
            <form  method="post" action="/post/updateView/{{$p->slug}}">
            {{csrf_field()}}
                <input type="hidden" name="total_visit" id="" value="{{$p->total_visit + 1}}">
                <button type="submit" name="submit" class="button">Lanjutkan Membaca</button>
            </form>
            <i class="fas fa-eye mt-2"> ({{$p->total_visit}}) </i>
            <i class="fas fa-thumbs-up mt-2"> ({{$p->like->count('post_id')}})</i>
            <i class="fas fa-comments mt-2"> ({{$p->comment->count('post_id')}})</i>
            <span style="float: right">{{ \Carbon\Carbon::parse($p->created_at)->diffForhumans() }}</span>
        @else
            <h3>{{$p->title}}</h3>
            <p class="">{!! \Illuminate\Support\Str::limit($p->content, 200) !!}</p>
            <form  method="post" action="/post/updateView/{{$p->slug}}">
            {{csrf_field()}}
                <input type="hidden" name="total_visit" id="" value="{{$p->total_visit + 1}}">
                <button type="submit" name="submit" class="button">Lanjutkan Membaca</button>
            </form>
            <i class="fas fa-eye mt-2"> ({{$p->total_visit}}) </i>
            <i class="fas fa-thumbs-up mt-2"> ({{$p->like->count('post_id')}})</i>
            <i class="fas fa-comments mt-2"> ({{$p->comment->count('post_id')}})</i>
            <span style="float: right">{{ \Carbon\Carbon::parse($p->created_at)->diffForhumans() }}</span>
        @endif
        </div>
    </div>
    
    <!-- Report Modal -->
    <div class="modal fade" id="ReportModal{{ $p->slug }}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report Post</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                    <div class="modal-body">
                        <form action="/report/store" method="POST">
                            {{csrf_field()}}
                            <p>Kategori Pelanggaran :</p>
                            <input type="hidden" name="post_id" value="{{$p->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            @foreach($caterepos->chunk(2) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $caterepo)
                                    <div class="col-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="caterepo_id" id="{{$caterepo->id}}" value="{{$caterepo->id}}">
                                            <label class="form-check-label" for="{{$caterepo->id}}">{{$caterepo->category}}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <hr class="divider">
                            <div class="form-group">
                                <label>Alasan :</label>
                                <textarea class="form-control" name="comment"></textarea>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <input class="btn btn-danger" type="submit" value="Repot">
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    @endforeach
    {{$posts->links()}}
    <!-- end -->
</div>
@endsection



