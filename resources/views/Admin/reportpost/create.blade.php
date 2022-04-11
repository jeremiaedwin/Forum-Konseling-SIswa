@extends('admin.layout.app')
@section('title', 'Report Posts')
@section('page', 'Report Posts')
@section('content')

<div class="card" style="border-radius: 15px">
      <div class="card-header bg-primary" style="color:white">
        <h5 class="m-auto">Report Post ke BK</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <!-- <div class="card"  style="background-color: #DBD0FC">
              <center><h5 class="mt-0">Profil Siswa</h5></center>
              <div class="row">
                <div class="col-md-12">
                  <center><img src="user.png" height="200" width="200" style="border-radius: 50%; object-fit: cover; align-items: center;"></center>
                </div>
                <div class="col-md-12">
                  <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td> : </td>
                        <td>Nama Siswa</td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td> : </td>
                        <td>181xxxxxx</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td> : </td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td> : </td>
                        <td>Rekayasa Perangkat Lunak</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div> -->


            <div class="card p-2" style="background-color: #DBD0FC; color:black">
              <center><h5 class="mt-0">Detail Postingan</h5></center>
                <table class="table" style="color:black">
                  <tr>
                      <td>Title</td>
                      <td> : </td>
                      <td>{{$posts->title}}</td>
                  </tr>
                  <tr>
                      <td>Kategori</td>
                      <td> : </td>
                      <td>{{$posts->category->category}}</td>
                  </tr>
                  <tr>
                      <td>Dibuat Pada</td>
                      <td> : </td>
                      <td>{{$posts->created_at}}</td>
                  </tr>
                  <tr>
                      <td>Konten</td>
                      <td> : </td>
                      <td><p>{!!$posts->content!!}</p></td>
                  </tr>
                  <tr>
                      <td>Jumlah View</td>
                      <td> : </td>
                      <td>{{$posts->total_visit}}</td>
                  </tr>
                </table>
            </div>
          </div>


          <div class="col-md-6">
            <div class="card p-4" style="background-color: #DBD0FC; color:black">
              <center><h5 class="mt-0">Form Report Postingan</h5></center>
              <div class="form-report-bk">
            <form method="post" action="/admin/reportpost/store">
            {{csrf_field()}}
            <div class="form-group">
              <label>Pilih Guru</label>
              <input type="hidden" name="post_id" value="{{$posts->id}}">
              <select name="receiver_id" class="form-control">
                <option>Pilih Guru</option>
                @foreach($users as $u)
                <option value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
              </select>
            </div>
            
            <div class="form-group">
              <label>Klasifikasi Masalah</label>
              <select name="klasifikasi_masalah" class="form-control">
                <option>Pilih Klasifikasi</option>
                <option value="Karir">Karir</option>
                <option value="Belajar">Belajar</option>
                <option value="Sosial">Sosial</option>
                <option value="Pribadi">Pribadi</option>
              </select>
            </div>

            <div class="form-group">
              <label>Alasan Report</label>
              <select name="alasan_report" class="form-control">
                <option>Pilih Alasan</option>
                <option value="Masalah Cukup Rumit">Masalah Cukup Rumit</option>
                <option value="Belum Mendapatkan Jawaban Terbaik">Belum Mendapatkan Jawaban Terbaik</option>
                <option value="Jumlah View Hanya Sedikit">Jumlah View Hanya Sedikit</option>
                <option value="Siswa Mengajukan Diskusi Dengan BK">Siswa Mengajukan Diskusi Dengan BK</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Deskripsi Report</label>
              <textarea class="form-control" placeholder="deskripsi" name="deskripsi_report"></textarea>
            </div>
            <button type="submit" class="btn btn-sm btn-success">Submit</button>
          </form>
        </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
@endsection