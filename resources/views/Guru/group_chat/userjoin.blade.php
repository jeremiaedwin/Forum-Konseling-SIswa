@extends('guru.layout.app')
@section('title', 'Group')
@section('page', 'Post/Daftar User Join')
@section('content')

<div class="card" >
    <div class="card-header" style="background-color: #7D7AAE; color: white; font-weight: 700">
        <h5>Daftar User Ingin Join</h5>
    </div>
    <div class="card-body" style="color:black">
        <ul class="list-group">
            @foreach($userJoin as $u)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-8">
                        <p><b>{{$u->user->name}}</b></p><br>
                        <p>Request pada {{date('d-m-Y', strtotime($u->created_at))}}</p>
                    </div>
                    <div class="col-md-4">
                        <form action="/guru/chatgroup/acceptuser" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="group_id" value="{{$u->groupchat_id}}">
                            <input type="hidden" name="user_id" value="{{$u->user_id}}">
                            <button type="submit" class="btn btn-success btn-sm">Terima Request</button>
                        </form>
                        <form action="/guru/chatgroup/declineuser" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="group_id2" value="{{$u->groupchat_id}}">
                            <input type="hidden" name="user_id2" value="{{$u->user_id}}">
                            <button type="submit" class="btn btn-danger btn-sm">Tolak Request</button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <center><a href="/guru/chatgroup/{{$groups->id}}" class="btn btn-primary">Kembali</a></center>
    </div>
</div>

@endsection

