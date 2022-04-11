@extends('guru.layout.app')
@section('title', 'Profile')
@section('page', 'Profile/Profile Anda')
@section('content')

<form action="/guru/profile/{{$profiles->id}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
{{method_field('PUT')}}
<div class="row">
    <div class="col-md-4">
        <div class="card card-content">
            <div class="card-body">
                <center><img  src="{{asset('image/'. $profiles->foto_profil)}}" alt="" width="250" height="250" class="profile-image-edit"></center>
                <div class="buttonProfileEdit" style="margin-top:10px">
                <input type="file" name="image" class="form-control">
                <button type="submit" class="btn btn-success btn-block mt-3">Simpan Perubahan</button>
                <a href="/guru/profile/{{$profiles->id}}" class="btn btn-primary btn-block mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-content">
            <div class="card-body">
                <h4>Profile Setting</h4>
                <div class="profile-form-box">
                    
                    <div class="form-group">
                        <label for="">Nama Panjang</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="{{$profiles->nama_lengkap}}" placeholder="Nama Lengkap Anda">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" value="{{$profiles->tanggal_lahir}}">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" id="" class="form-control" name="alamat" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC;" placeholder="Alamat Anda">{{$profiles->alamat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Agama</label>
                        <select name="agama" id="" class="form-control" name="agama" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC;">
                        @if($profiles->agama == null)
                            <option value="">Pilih Agama</option>
                            @else
                            <option value="{{$profiles->agama}}">{{$profiles->agama}}</option>
                            @endif
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Kristen Katholik">Kristen Katholik</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Hindu">Hindu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="" name="jenis_kelamin" class="form-control" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC;">
                            @if($profiles->jenis_kelamin == null)
                            <option value="">Pilih Jenis Kelamin</option>
                            @else
                            <option value="{{$profiles->jenis_kelamin}}">{{$profiles->jenis_kelamin}}</option>
                            @endif
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

