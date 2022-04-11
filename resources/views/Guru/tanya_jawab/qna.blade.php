@extends('guru.layout.app')
@section('title', 'QnA')
@section('page', 'QnA/Daftar Post')
@section('content')

<div class="float-right mr-2">
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sortir
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
    </div>
    </div>
</div>
<br>
<div class="card content-card mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('image/1.jpg') }}" class="card-article-index" width="200px" height="200px" alt="">
                <div class="mt-5">
                    <i class="far fa-eye fa-lg">
                        <p class="ml-2" style="float: right">0 views</p>
                    </i>
                </div>
            </div>
            <div class="col-md-8 mt-2">
                <h3>Article Title</h3>
                <p class="">The leather jacked showed the scars of being his favorite for years. It wore those scars with pride, feeling that they enhanced his 
                presence rather than diminishing it. The scars gave it character and had not overwhelmed to the point that it had become ratty. 
                The jacket was in its prime and it knew it.</p>
                <a href="" style="text-decoration : none"><p>Lanjutkan Membaca</p></a>
            </div>
        </div>
            <span style="float: right">dd/MM/yyyy</span>
    </div>
</div>


@endsection