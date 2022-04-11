@extends('guru.layout.app')
@section('title', 'Report Post')
@section('page', 'Index')
@section('content')

<div class="card">
    <div class="card-header">
        Tambah Laporan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
            <form action="/guru/reportkonseling/store" method="post">
            {{csrf_field()}}
            <center><h5 class="mt-0 text-dark">Detail Postingan</h5></center>
                <table class="table" style="color:black">
                  <tr>
                      <td>Title</td>
                      <td> : </td>
                      <td>{{$r_post->post->title}}</td>
                      <input type="hidden" name="post_id" value="{{$r_post->post->id}}">
                      <input type="hidden" name="reportpost_id" value="{{$r_post->id}}">
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
            <center><h5 class="mt-0 text-dark">Detail Siswa</h5></center>
                <table class="table"  style="color:black">
                  <tr>
                      <td>Nama</td>
                      <td> : </td>
                      <td>{{$r_post->post->user->name}}</td>
                  </tr>
                  <tr>
                      <td>NIS</td>
                      <td> : </td>
                      <td>{{$r_post->post->user->id}}</td>
                  </tr>
                  <tr>
                      <td>Tanggal Bergabung</td>
                      <td> : </td>
                      <td>{{$r_post->post->user->created_at}}</td>
                  </tr>
                  
                </table>
            </div>
        </div>

        
        <hr>
        <center><h5  style="color:black">Buat Laporan Konseling</h5></center>

        <div class="form-group"  style="color:black">
            <label for="">Tanggal Konseling</label>
            <input type="date" class="form-control" name="tanggal_konseling" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC;">
        </div>
        <div class="form-group"  style="color:black">
            <label for="">Masalah Selesai ?</label>
            <select name="masalah_selesai" id="" class="form-control">
                <option value="">Pilih Opsi</option>
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <div class="form-group" style="color:black">
            <label for="">Deskripsi Konseling</label>
            <textarea name="deskripsi_penyelesaian" id="editor1" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

@endsection

@push('preview_script')
<script>
    CKEDITOR.replace( 'editor1' );
</script>
@endpush