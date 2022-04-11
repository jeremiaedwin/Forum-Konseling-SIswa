@extends('guru.layout.app')
@section('title', 'Galeri')
@section('page', 'Galeri/Show Galeri')
@section('content')

<div class="card" style="border-radius: 35px;">
    <div class="card-header text-white" style="background-color:#7D7AAE">Show Galeri</div>
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Nama Kegiatan</th>
                <th> : </th>
                <td>{{$galeries->nama_kegiatan}}</td>
            </tr>

            <tr>
                <th>Tanggal Kegiatan</th>
                <th> : </th>
                <td>{{$galeries->tanggal_kegiatan}}</td>
            </tr>
            <tr>
                <th>Foto Kegiatan</th>
                <th> : </th>
                <td></td>
            </tr>
        </table>
        <div class="row justify-content-md-center">
        @php
            $gambar = explode('|',$galeries->image);
            $no =0;
        @endphp
        @foreach ($gambar as $key=>$item)
            <div class="col-md-auto">
                <img src="{{asset('/image/'.$item)}}" style="object-fit:scale-down" alt=""  width="400px" height="400px">
            </div>
            @endforeach
        </div>
        <a href="/guru/galeri/" class="btn text-white" style="background-color:#7D7AAE">Kembali</a>
    </div>
</div>

@endsection

