@extends('guru.layout.app')
@section('title', 'Jendela Pengumuman')
@section('content')

@foreach( $kel_pengumuman as $pengumuman )

<div class="card content-card mt-4">
    <div class="card-body">
            <h1>{{ $pengumuman -> title}}</h1>
            <p>Author : {{ $pengumuman ->user -> name}}</p>
            <p>Kategori : {{ $pengumuman ->catepegus->category}}</p>
            <div class="card-body">
                <iframe class="embed-responsive-item" id="pdfmu" src="{{ '/pdf/'.$pengumuman->pdf }}" style=" width:100%; height:auto;"></iframe>
            </div>
            <span style="float: right">{{Carbon\Carbon::parse($pengumuman->created_at)->diffForHumans()}}</span>
    </div>
</div>

@endforeach

@endsection