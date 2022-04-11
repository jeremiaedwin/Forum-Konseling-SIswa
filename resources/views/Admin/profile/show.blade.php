@extends('admin.layout.app')
@section('title', 'Profile')
@section('page', 'Profile/Profile Anda')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-body foto-sampul" style="background-image: url('{{asset('image/'. $profiles->foto_sampul)}}');">
        </div>
        <div class="foto-profil">
            <img src="{{asset('image/'. $profiles->foto_profil)}}" class="profile-pic" alt="" style="">
            <h3 class="nama-user">{{$profiles->nama_lengkap}}</h3>
            <a href="/admin/profile/{{$profiles->id}}/edit" class="btn btn-secondary text-white profile-setting">Pengaturan Profile</a>
        </div>
    </div>

    <div class="card mt-2">
        <card class="card-header text-white" style="background-color:#7D7AAE;">
            Profile
        </card>

        <div class="card-body">
            <ul class="list-group text-dark" style="height:300px; overflow:scroll">
                <li class="list-group-item">
                    <b>Nama</b> <br> 
                    {{$profiles->nama_lengkap}}
                </li>
                <li class="list-group-item">
                    <b>Username</b> <br> 
                    {{$profiles->user->name}}
                </li>
                <li class="list-group-item">
                    <b>Email</b> <br> 
                    {{$profiles->user->email}}
                </li>
                <li class="list-group-item">
                    <b>Tanggal Lahir</b> <br> 
                    {{$profiles->tanggal_lahir}}
                </li>
                <li class="list-group-item">
                    <b>Agama</b> <br> 
                    {{$profiles->agama}}
                </li>
            </ul>
        </div>
    </div>
@endsection

@push('preview_script')
<script>
    let tabHeader = $(".tab-header")[0];
    let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
    let tabBody = document.getElementsByClassName("tab-body")[0];

    let tabsPane = tabHeader.getElementsByTagName('div');

    for(let i=0;i<tabsPane.length;i++){
        tabsPane[i].addEventListener("click", function(){
            tabHeader.getElementsByClassName("active")[0].classList.remove("active");
            tabsPane[i].classList.add("active");
            tabBody.getElementsByClassName("active")[0].classList.remove("active");
            tabBody.getElementsByTagName("div")[i].classList.add("active");
            
            tabIndicator.style.left = `calc(calc(100%/3)*${i})`;
        });
    }
</script>

<script type="text/javascript">
      $(document).ready(function () {

    if (screen.width > 600) {
        $("#profilUser").click();
    }
      });

</script>
@endpush
