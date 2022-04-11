@extends('layout.app')
@section('title', 'Jendela Pengumuman')
@section('page', 'Jendela Pengumuman')
@section('content')

@foreach($kel_pengumuman as $pengumuman)

<div class="card content-card mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h3>{{$pengumuman->title}}</h3>
                  <p>Author : {{$pengumuman->user->name}} | Kategori : {{ $pengumuman ->catepegus->category}}</p>
                <a href="/show_pengumuman/{{$pengumuman->slug}}" style="text-decoration : none"><p>Lanjutkan Membaca</p></a>
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

@endforeach

@endsection