@extends('layout.app')
@section('title', 'Notification')
@section('page', 'Notification/Index')
@section('content')

<div class="card content-card">
    <div class="card-header"style="color:white;background-color:#7D7AAE">
        <b>Notifikasi Anda
    </b>     
</div>
    <div class="card-body">
        <table class="table" style="color:black">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Post</th>
                    <th>Notifikasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($notif as $n)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$n->post->title}}</td>
                    <td>{{$n->user->name}} mengomentari postinganmu</td>
                    <td>
                        @if($n->status == "0")
                        <span class="fas fa-circle" style="color:red"></span>
                        {{"Belum terbaca"}}
                        @else
                        {{"Sudah Terbaca"}}
                        @endif
                    </td>
                    <td>
                        <form action="/notifications/{{$n->id}}/open" method="post">
                        {{csrf_field()}}

                        @if($n->status == "0")
                            <input type="hidden" name="status" id="" value="{{$n->status + 1}}">
                            <input type="hidden" name="slug" id="" value="{{$n->post->slug}}">
                            <button type="submit" class="btn btn-primary btn-sm">Lihat</button>
                        @else
                            <a href="/post/{{$n->post->slug}}" class="btn btn-primary btn-sm">Lihat</a>
                        @endif
                        </form>
                    </td>
                    <td>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>


@endsection

