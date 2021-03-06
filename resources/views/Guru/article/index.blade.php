@extends('guru.layout.app')
@section('title', 'Jendela Artikel')
@section('page', 'Jendela Artikel')
@section('content')

@foreach($articles as $article)

<div class="card content-card mt-4">
    <div class="card-body">
        <div class="btn-group" style="float:right">
            <div class="btn-group dropleft">
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-caret-down"></i>
                </button>
                <div class="dropdown-menu">
                @if($article->user_id == Auth::user()->id)
                    <a class="dropdown-item" href="/guru/edit_artikel/{{ $article->slug }}">Edit</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal{{ $article->slug }}">Hapus</a>
                @else
                    
                @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <img src="{{asset('image')}}/{{ $article->image }}" class="card-article-index" style="max-width: 100%; max-height:100%; width:200px; height:200px;" alt="">
                <!--
                <div class="mt-5">
                    <i class="far fa-eye fa-lg">
                        <p class="ml-2" style="float: right">0 views</p>
                    </i>
                </div>
                -->
            </div>
            <div class="col-md-9 mt-2">
                <h3>{{$article->title}}</h3>
                @if($article->status_id == '0')
                  <p style="color:red">Status : {{$article->status->status}}</p>
                @else
                  <p style="color:green">Status : {{$article->status->status}}</p>
                @endif
                <p class="">{!! Illuminate\Support\Str::limit($article->content,500) !!}</p>
                <a href="/guru/show/{{ $article -> slug }}" style="text-decoration : none"><p>Lanjutkan Membaca</p></a>
            </div>
        </div>
            <span style="float: right">{{Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</span>
    </div>
</div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal{{ $article->slug }}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Artikel</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin untuk menghapus artikel ini ?</div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="/guru/delete_artikel/{{ $article->slug }}">Hapus</a>
        </div>
      </div>
    </div>
  </div>

@endforeach

@endsection