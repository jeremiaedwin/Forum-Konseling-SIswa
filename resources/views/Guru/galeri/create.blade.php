@extends('guru.layout.app')
@section('title', 'Galeri')
@section('page', 'Galeri/Create Galeri')
@section('content')

<div>
<div class="card" style="border-radius: 35px;">
    <div class="card-header text-white" style="background-color:#7D7AAE">
        Create Galeri
    </div>
        <div class="card-body">
            <form action="/guru/galeri" method="post" enctype="multipart/form-data" style="color:#262927; font-weight:bold">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control input-form" placeholder="Masukan Nama Kegiatan" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC; color:black">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan" id="" class="form-control" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC; color:black">
                </div>
                <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" name="images[]"  multiple class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="/guru/galeri" class="btn btn-primary">Kembali</a>
            </form>
        </div>
    </div>
<div>
</div>

@endsection

