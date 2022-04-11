@extends('guru.layout.app')
@section('title', 'Jendela Pengumuman')
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
                  <a class="dropdown-item" href="/admin/edit_artikel/{{ $article->slug }}">Edit</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal{{ $article->slug }}">Hapus</a>
                </div>
            </div>
        </div>
        <h1>{{$article -> title}}</h1>
          <div class="card-body">
            <img src="{{asset('image')}}/{{ $article->image }}" class="card-article-index" style="max-width: 100%; max-height:100%; width:100%; height:auto;" alt="">
          </div>
          <div class="card-body">
            <p>{!!$article -> content!!}</p>
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
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin untuk menghapus artikel ini ?</div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="/admin/delete_artikel/{{ $article->slug }}">Hapus</a>
        </div>
      </div>
    </div>
  </div>

@endforeach

@endsection