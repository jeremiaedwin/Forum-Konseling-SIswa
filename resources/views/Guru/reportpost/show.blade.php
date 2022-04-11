@extends('guru.layout.app')
@section('title', 'Report Post')
@section('page', 'Show')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
            <center><h5 class="mt-0 text-dark">Detail Postingan</h5></center>
                <table class="table text-dark" style="">
                  <tr>
                      <td>Title</td>
                      <td> : </td>
                      <td>{{$r_post->post->title}}</td>
                  </tr>
                  <tr>
                      <td>Kategori</td>
                      <td> : </td>
                      <td>{{$r_post->post->category->category}}</td>
                  </tr>
                  <tr>
                      <td>Dibuat Pada</td>
                      <td> : </td>
                      <td>{{$r_post->post->created_at}}</td>
                  </tr>
                  <tr>
                      <td>Konten</td>
                      <td> : </td>
                      <td><p>{!!$r_post->post->content!!}</p></td>
                  </tr>
                  <tr>
                      <td>Jumlah View</td>
                      <td> : </td>
                      <td>{{$r_post->post->total_visit}}</td>
                  </tr>
                </table>
            </div>

            <div class="col-md-6">
                
            </div>
            
            <div class="col-md-12">
                <a href="/guru/messages" class="btn  text-primary" style="float:right; font-weight:800">Hubungi Siswa</a>
                <a href="/guru/reportkonseling/create/{{$r_post->id}}" class="btn  text-success" style="float:right; font-weight:800">Buat Laporan</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('preview_script')

@endpush