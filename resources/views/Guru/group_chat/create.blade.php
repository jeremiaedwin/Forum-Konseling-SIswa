@extends('guru.layout.app')
@section('title', 'Group')
@section('page', 'Group/Create Group')
@section('content')

<div>
<div class="card" style="border-radius: 35px;">
    <div class="card-header">Create Group</div>
        <div class="card-body">
            <form action="/guru/chatgroup/store" method="post" style="color:#262927; font-weight:bold">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">Judul Group</label>
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                    <input type="text" name="title" class="form-control input-form" placeholder="Masukan Judul Group" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC; color:black">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Group</label>
                    <textarea class="form-control" placeholder="Masukan Deskripsi Group" style="outline: 0; border-width: 0 0 2px; border-color: #DBD0FC; color:black" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
<div>
</div>

@endsection

