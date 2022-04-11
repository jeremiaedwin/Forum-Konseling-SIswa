@extends('guru.layout.app')
@section('title', 'Group')
@section('page', 'Post/Daftar Group')
@section('content')

<div class="card kontainer-group-chat" style="border-radius: 35px;">
          <div class="card-header header-group-chat" style="background-color: #7D7AAE; color: white; font-weight: 700;">
            <div class="row">
                <div class="col-md-9">
                    Group Chat BK SMKN 11 Bandung
                </div>
                <div class="col-md-3">
                    <a href="/guru/chatgroup/create" class="btn btn-sm btn-success" style="float:right">Buat Group Baru</a>
                </div>
            </div>
          </div>

          <div class="card-body body-chat-group" style="background-color: whitesmoke">
              <div class="row">
                  @foreach($groups as $g)
                <!-- card group chat -->
                <div class="col-md-4 mt-2 d-flex align-items-stretch" style="color:black">

                  <div class="card daftar-group-chat" style="color: black; border: 3px solid #DBD0FC;">
                    <div class="card-body">
                      <span><button disabled="" class="btn btn-sm btn-primary" style="border-radius: 15px">Dibuat pada {{date('d-m-Y', strtotime($g->created_at))}}</button></span>
                      <h5 class="mt-2">{{$g->title}}</h5>
                      <p class="">{{Str::limit($g->description, 200)}}</p>
                      <div class="row" style="align-content: center;">
                        <div class="col-md-4">
                          <a href="/guru/chatgroup/{{$g->id}}" class="btn btn-sm btn-success" style="border-radius: 15px">Masuk Group</a>
                        </div>
                        <div class="col-md-8 mt-1">
                          <span style="font-size: 13px; color: grey; font-weight: 600; float: right;"><i class="fas fa-user"></i> Dibuat Oleh {{$g->user->name}}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- end -->
                @endforeach

                 


              </div>
          </div>

        </div>

@endsection

