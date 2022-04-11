@extends('layout.app')
@section('title', 'Jendela Pengumuman')
@section('content')

@foreach($articles as $article)

<div class="card content-card mt-4">
  <div class="card-body">
    <h1>{{$article -> title}}</h1>
      <div class="card-body">
        <img src="{{asset('image')}}/{{ $article->image }}" class="card-article-index" style="max-width: 100%; max-height:100%; width:100%; height:auto;" alt="">
      </div>
      <div class="card-body">
        <p>{!! $article -> content !!}</p>
      </div>
      <span style="float: right">{{Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</span>
  </div>
</div>

@endforeach

@endsection