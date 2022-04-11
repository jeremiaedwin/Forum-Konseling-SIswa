@extends('admin.layout.app')
@section('title', 'Jendela Pengumuman')
@section('page', 'Jendela Pengumuman')
@section('content')

@foreach($kel_pengumuman as $pengumuman)

<div class="card content-card mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="btn-group" style="float:right">
                    <div class="btn-group dropleft">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/admin/edit_pengumuman/{{ $pengumuman->slug }}">Edit</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal{{ $pengumuman->slug }}">Hapus</a>
                        </div>
                    </div>
                </div>
                <h3>{{$pengumuman->title}}</h3>             
                  <p>Author : {{$pengumuman->user->name}}</p>
                  @if($pengumuman->status_id == '0')
                    <p style="color:red">Status : {{$pengumuman->status->status}}</p>
                  @else
                    <p style="color:green">Status : {{$pengumuman->status->status}}</p>
                  @endif
                <a href="/admin/show_pengumuman/{{$pengumuman->slug}}" style="text-decoration : none"><p>Lanjutkan Membaca</p></a>
                  
                <div class="mt-4">
                <!--
                    <i class="far fa-eye fa-lg">
                        <p class="ml-2" style="float: right">0 views</p>
                    </i>
                -->
                    <span style="float: right">{{Carbon\Carbon::parse($pengumuman->created_at)->diffForHumans()}}</span>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal{{ $pengumuman->slug }}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Pengumuman</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin untuk menghapus artikel ini ?</div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="/admin/delete_pengumuman/{{ $pengumuman->slug }}">Hapus</a>
        </div>
      </div>
    </div>
  </div>

@endforeach

@endsection