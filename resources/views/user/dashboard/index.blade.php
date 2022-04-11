@extends('layout.app')
@section('title', 'Home')
@section('content')

<!-- banner -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{asset('image/banner-fks.jpg')}}" style="object-fit:cover" height="300" alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('image/banner-fks.jpg')}}" style="object-fit:cover" height="300" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('image/banner-fks.jpg')}}" style="object-fit:cover" height="300" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- end -->

<!-- pengumuman -->

<div class="row mt-3">
@foreach($pengumumans as $pengumuman)
  <div class="col-md-8">
    <div class="card h-100">
      <div class="card-header" style="border-top: 7px solid #7D7AAE;  border-radius:15px; color: #3A4058">
        <center><h3>Pengumuman</h3></center>
      </div>
      <div class="card-body" style="color: #3A4058; border-bottom: 2px solid #7D7AAE; border-top: 2px solid #7D7AAE;">
        <h3><center><b>{{$pengumuman->title}}</b></center></h3>
        <center><iframe class="embed-responsive-item" id="pdfmu" src="{{ '/pdf/'.$pengumuman->pdf }}" style=" width:100%; height:auto;"></iframe></center>
      </div>
    </div>
  </div>
  @endforeach
  <!-- end -->

  <!-- artikel -->
  <div class="col-md-4">
    <ul class="list-group" style="color:black">
      <li class="list-group-item active" style="background-color: #7D7AAE">Artikel Terbaru</li>
      
      @foreach($articles as $article)
      <li class="list-group-item" >

        <a href="/show/{{$article->slug}}">
          <div class="card md-3 my-2" style="">
              <div class="media">
                <img class="align-self-center mr-3" src="{{asset('image')}}/{{ $article->image }}" height="64" width="64" alt="Generic placeholder image">
                <div class="media-body">
                  <h5 class="mt-0">{{$article->title}}</h5>
                  <p>{!! Illuminate\Support\Str::limit($article->content,50) !!}</p>
                </div>
              </div>
          </div>
        </a>

      </li>
      @endforeach
    </ul>
  </div>
  <!-- end -->
</div>

<div class="card mt-3">
  <div class="card-header">
    Artikel
  </div>

  <div class="card-body" >
    <div class="row">
@foreach($articles2 as $article2)
      <div class="col-md-3 d-flex">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="{{asset('image')}}/{{ $article2->image }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$article2->title}}</h5>
            <p class="card-text">{!! Illuminate\Support\Str::limit($article2->content,50) !!}</p>
            <center><a href="/show/{{$article2->slug}}" class="btn btn-primary">Baca Selengkapnya</a></center>
          </div>
        </div>
      </div>
@endforeach
    </div>
  </div>
</div>


<div class="container">
<div style="margin-top: 15px">
<center><b><h3>Post Terbaru</h3></b></center>
<!-- list post -->
@foreach($posts as $p)
<div class="card content-card">
    <div class="card-header background-index-head" style="background-color: white; color: #3A4058;border-top: 2px solid #7D7AAE">
        <div class="media">
            @if($p->anonymous != 1)
            <img class="mr-3" src="{{ asset('image/'. $p->user->profile->foto_profil) }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-3" style="font-weight: 700">{{$p->user->username}} @if($p->solved != 1) <button disabled="disabled" class="btn btn-danger btn-sm">Not Solved</button> @else ($p->solved != 1) <button disabled="disabled" class="btn btn-success btn-sm">Solved</button> @endif </h5>
            </div>
            @else
            <img class="mr-3" src="{{ asset('image/user.png') }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-3">Anonymous @if($p->solved != 1) <button disabled="disabled" class="btn btn-danger btn-sm">Not Solved</button> @else ($p->solved != 1) <button disabled="disabled" class="btn btn-success btn-sm">Solved</button> @endif </h5>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body background-index-post-body">
    @if($p->image == true)
        <img src="{{asset('image/'. $p->image)}}"  alt="" style="width:300px; height:300px;" class="image-post-index">
        <h3>{{$p->title}}</h3>
        <p class="">{!! \Illuminate\Support\Str::limit($p->content, 200) !!}</p>
        <form  method="post" action="/post/updateView/{{$p->slug}}">
        {{csrf_field()}}
            <input type="hidden" name="total_visit" id="" value="{{$p->total_visit + 1}}">
            <button type="submit" name="submit" class="button">Lanjutkan Membaca</button>
        </form>
        <i class="fas fa-eye mt-2"> ({{$p->total_visit}}) </i>
        <i class="fas fa-thumbs-up mt-2"> ({{$p->like->count('post_id')}})</i>
        <i class="fas fa-comments mt-2"> ({{$p->comment->count('post_id')}})</i>
        <span style="float: right">{{ \Carbon\Carbon::parse($p->created_at)->diffForhumans() }}</span>
    @else
        <h3>{{$p->title}}</h3>
        <p class="">{!! \Illuminate\Support\Str::limit($p->content, 200) !!}</p>
        <form  method="post" action="/post/updateView/{{$p->slug}}">
        {{csrf_field()}}
            <input type="hidden" name="total_visit" id="" value="{{$p->total_visit + 1}}">
            <button type="submit" name="submit" class="button">Lanjutkan Membaca</button>
        </form>
        <i class="fas fa-eye mt-2"> ({{$p->total_visit}}) </i>
        <i class="fas fa-thumbs-up mt-2"> ({{$p->like->count('post_id')}})</i>
        <i class="fas fa-comments mt-2"> ({{$p->comment->count('post_id')}})</i>
        <span style="float: right">{{ \Carbon\Carbon::parse($p->created_at)->diffForhumans() }}</span>
    @endif
    </div>
</div>
@endforeach
{{$posts->links()}}
<!-- end -->
</div>
</div>


@endsection

@push('after_script')

  
@endpush

