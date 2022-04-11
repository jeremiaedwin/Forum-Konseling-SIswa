@extends('layout.app')
@section('title', 'Artikel')
@section('page', 'Artikel/Daftar Artikel')
@section('content')

@foreach($articles as $article)

<div class="card content-card mt-4">
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-3">
                <img src="{{asset('image')}}/{{ $article->image }}" class="card-article-index" style="max-width: 100%; max-height:100%; width:200px; height:200px;" alt="">
                <!--
                <div class="mt-5">
                    <i class="far fa-eye fa-lg">
                        <p class="ml-2" style="float: right">0 views</p>
                    </i>
                </div>
                -->
            </div>
            <div class="col-md-9 mt-2">
                <h3>{{$article->title}}</h3>
                <p>Kategori : {{$article->category->category}}</p>
                <p class="">{!! Illuminate\Support\Str::limit($article->content,500) !!}</p>
                <a href="/show/{{$article->slug}}" style="text-decoration : none"><p>Lanjutkan Membaca</p></a>
            </div>
        </div>
        <span style="float: right">{{Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</span>
    </div>
</div>

@endforeach

@endsection

