@extends('guru.layout.app')
@section('title', 'Buat QnA')
@section('page', 'QnA/Buat Post')
@section('content')

<div class="m-2 mr-2" style="font-size: 20px">
    <form class="w-100">
       <div class="form-group">
            <label>Judul</label>
            <input type="text" class="form-control mb-2" >
            <label>Konten</label>
            <textarea class="form-control mb-2" rows="10"></textarea>
            <label>Image</label>
            <input type="text" class="form-control" >
            <input class="btn btn-primary mt-4 mb-4" type="submit">
       </div>
    </form>
</div>

@endsection