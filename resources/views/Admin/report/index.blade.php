@extends('admin.layout.app')
@section('title', 'Post')
@section('page', 'Report Post')
@section('content')

@foreach($reports as $report)

<div class="card content-card mt-4">
  <div class="card-body">
        <div class="row">
          <div class="col-md-9 mt-2">
              <h4>Judul Post : {{$report->post->title}}</h4>
              <p>Kategori : {{$report->caterepo->category}}</p>
              <p>Komentar : {{$report->comment}}</p>
              <p style="color:blue">By : {{$report->user->name}}</p>
              <a href="/admin/report/delete/{{$report->id}}" class="btn btn-warning"><i class="fas fa-trash-alt"></i></a>
              <a href="/admin/report/delete_post/{{$report->post_id}}" class="btn btn-danger"><i class="fas fa-minus-circle"></i></a>
              <a href="/admin/post/{{$report->post_id}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
          </div>
        </div>
        <span style="float: right">{{Carbon\Carbon::parse($report->created_at)->diffForHumans()}}</span>
  </div>
</div>

@endforeach

@endsection