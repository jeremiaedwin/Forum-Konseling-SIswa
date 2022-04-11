@extends('guru.layout.app')
@section('title', 'Galeri')
@section('page', 'Galeri/Daftar Galeri')
@section('content')

<div class="card" style="border-radius: 35px;">
    <div class="card-header text-white" style="background-color:#7D7AAE">
        <div class="row">
            <div class="col-md-9">
                <h5 class="m-0">Daftar Galeri</h5>
            </div>
            <div class="col-md-3">
                <a href="/guru/galeri/create" class="m-0 btn btn-sm btn-primary" style="float:right">Tambah</a>
            </div>
        </div>
    </div>
        <div class="card-body">
        
            <div class="row justify-content-md-center">
                @foreach($galeries as $g)
                <div class="col-md-auto">
                    <div class="card text-dark" style="width: 18rem; border:1px solid #7D7AAE">
                    @php
                        $gambar = explode('|',$g->image);
                        $gambar1 = $gambar[0];
                    @endphp
                        <img class="card-img-top" widht="200" height="200" style="object-fit:scale-down" src="{{asset('image/'.$gambar1)}}" alt="Card image cap">

                        <div class="card-body">
                            <h5 class="card-title" style="font-weight:900">{{$g->nama_kegiatan}}</h5>
                            <p class="card-text">{{$g->tanggal_kegiatan}}</p>
                            <a href="/guru/galeri/{{$g->id}}" class="btn text-white" style="background-color:#7D7AAE">Lihat</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        
    </div>

@endsection

