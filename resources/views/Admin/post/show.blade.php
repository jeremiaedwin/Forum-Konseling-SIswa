@extends('admin.layout.app')
@section('title', 'Posts')
@section('page', 'Posts/Show')
@section('content')

<div class="row">
    <div class="col-md-7">
        <div class="card content-card" id="content-post" style="width:95%; margin-left:auto; margin-right:auto">
            <!-- post show -->
            <div class="card-header background-index-head" style="background-color: white; color: #3A4058;border-top: 2px solid #7D7AAE">
                <div class="media">
                    @if($posts->anonymous != 1)
                    <img class="mr-3" src="{{ asset('image/'. $posts->user->profile->foto_profil) }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-3" style="font-weight: 700">{{$posts->user->name}}</h5>
                    </div>
                    @else
                    <img class="mr-3" src="{{ asset('image/user.png') }}" style="width:64px; height:64px; border-radius:50%" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-3">Anonymous</h5>
                    </div>
                    @endif
                    <div class="m-auto">
                        @if($posts->solved == 0)
                        <button disabled="disabled" class="btn btn-sm " style="color:white; background-color:red"><h5 class="m-auto">Not solved</h5></button>
                        @else
                        <button disabled="disabled" class="btn btn-sm btn-success" style="color:white;"><h5 class="m-auto">Solved</h5></button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body backgoround-post-show">
                <div class="mt-2">
                    <center><h2>{{$posts->title}}</h2></center>
                    <center><span>{{ \Carbon\Carbon::parse($posts->created_at)->diffForhumans() }}</span></center>
                    <button disabled class="btn btn-sm" style="margin-left: 10%;border-color:blue; color:black; font-weight:bold">{{$posts->category->category}}</button>
                </div>
                <div class="mb-4 mt-2">
                    @if($posts->image != null)
                    <img src="{{ asset('image/'. $posts->image) }}" alt="" class="image-post-show">
                    @endif
                </div>
                <div class="mt-2">
                    <p class="konten-post" style="font-family: Georgia, 'Times New Roman', Times, serif;">{!! $posts->content !!}</p>
                </div>
                <!-- end -->
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div id="diagram-view">

        </div>
        <div class="card" style="background-color: white; color: #3A4058;border-top: 2px solid #7D7AAE">
            <div class="card-body">
                <div class="list-group">
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    {{$likes}} Orang Menyukai Post Ini 
                </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="list-unstyled">
                            @foreach($likes2 as $like)
                            <li class="media mt-2">
                                <img class="mr-3" width="64" height="64" src="{{asset('image/'.$like->user->profile->foto_profil)}}" alt="Generic placeholder image">
                                <div class="media-body">
                                <h5 class="mt-2 mb-1">{{$like->user->name}}</h5>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="list-group mt-3">
                <a class="btn btn-success" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                    {{$comments->count('post_id')}} Orang Mengomentari Post Ini 
                </a>
                    <div class="collapse" id="collapseExample1">
                        <ul class="list-unstyled">
                            @foreach($comments as $comment)
                            <li class="media mt-2">
                                <img class="mr-3" width="64" height="64" src="{{asset('image/'.$comment->user->profile->foto_profil)}}" alt="Generic placeholder image">
                                <div class="media-body">
                                <h5 class="mt-0 mb-1">{{$comment->user->name}}</h5>
                                    <p>
                                    <a class="btn btn-sm" data-toggle="collapse" href="#collapseExample-{{$comment->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Lihat komentar
                                    </a>
                                    </p>
                                    <div class="collapse" id="collapseExample-{{$comment->id}}" style="width:25%">
                                        {{$comment->comment}}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="list-group mt-3">
                    <a class="btn btn-secondary" data-toggle="collapse" href="#" role="button" aria-expanded="false" aria-controls="collapseExample">
                        {{$posts->total_visit}} Orang Melihat Post Ini 
                    </a>
                </div>

                <div class="list-group mt-3">
                    <form action="/admin/post/updateDraft/{{$posts->id}}" method="post">
                    {{csrf_field()}}
                        @if($posts->status_id == 1)
                        <input type="hidden" name="status_id" id="status_id" value="0">
                        <button type="submit" id="update_status" class="update-status btn btn-warning btn-block" alt="simpan sebagai draft">Non Aktifkan Postingan Ini</button>
                        @else
                        <input type="hidden" name="status_id" id="status_id" value="1">
                        <button type="submit" id="update_status" class="update-status btn btn-warning btn-block" alt="publikasikan">Aktifkan Postingan Ini</button>
                        @endif
                    </form>
                </div>
                <div class="list-group mt-3">
                    <a class="btn btn-danger" href="/admin/reportpost/{{$posts->id}}/create">
                        Perlu Bimbingan BK
                    </a>
                </div>
                <div class="list-group mt-3">
                    <a class="btn btn-muted" href="/admin/post/">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('preview_script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
        var diagramViews =  <?php echo json_encode($views) ?>;
        var data_datearray =<?php echo json_encode($dateviews) ?>;;
        Highcharts.chart('diagram-view', {

title: {
    text: 'Diagram Page View'
},
xAxis: {
        type: 'datetime',
        categories: data_datearray
        },
legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},


series: [{
    name: 'Jumlah View',
    data: diagramViews,
}],



});
</script>
@endpush