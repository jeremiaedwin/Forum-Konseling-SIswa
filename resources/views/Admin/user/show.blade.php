@extends('admin.layout.app')
@section('title', 'Show User')
@section('page', 'Show User')
@section('content')

<div class="card content-card">
    <div class="card-header bg-primary text-white">
        Daftar User
    </div>
    <div class="card-body">
      <div class="row">
        <div class="" style="width:100%; overflow:auto">
            <table class="table">
                <tr>
                    <td>
                        <table class="table">
                            <tr>
                                <td><center><img src="{{asset('image/'. $user->foto_profil)}}" width="150" height="150" style="border-radius:50%; object-fit:cover" alt=""></center></td>
                            </tr>
                        </table>
                    </td>

                    <td>
                        <table class="table">
                            <tr>
                                <td>ID</td>
                                <td> : </td>
                                <td>{{$user->id}}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td> : </td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td> : </td>
                                <td>{{$user->username}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> : </td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td> : </td>
                                <td>{{$user->role}}</td>
                            </tr>
                            <tr>
                                <td>Tahun Masuk</td>
                                <td> : </td>
                                <td>{{$user->tahun_masuk}}</td>
                            </tr>
                            <tr>
                                <td>Tahun Keluar</td>
                                <td> : </td>
                                <td>{{$user->tahun_keluar}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td> : </td>
                                <td>@if($user->status == 1) {{"Aktif"}} @else{{"Non Aktif"}} @endif</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
      </div>
    </div>
</div>

@endsection

@push('preview_script')

@endpush