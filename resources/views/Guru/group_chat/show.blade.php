@extends('guru.layout.app')
@section('title', 'Group')
@section('page', 'Post/Daftar Group')
@section('content')

<div class="card" style="color:black">
<div class="card-body">
    <div class="row no-gutters">

    <div class="col-md-4">
        <div class="media" style="padding: 10px; background-color: #d4d9ce;">
        <img class="align-self-center mr-3" src="{{asset('image/'. Auth::
            user()->profile->foto_profil)}}" height="64" width="64" style="border-radius: 50%; object-fit: cover;" alt="Generic placeholder image">
        <div class="media-body">
            <h5 class="mt-0">{{Auth::user()->name}}</h5>
            <p>Status Online.</p>
        </div>
        </div>

        <div style="height: 400px; overflow: scroll;">

        <!-- user dalam group -->
        @foreach($anggota as $a)
        <div class="media mt-1" style="padding: 10px; border-top: 1px solid #d4d9ce;
            border-bottom: 1px solid #d4d9ce;">
            <img class="align-self-center mr-3" src="{{asset('image/'. $a->user->profile->foto_profil)}}" height="64" width="64" style="border-radius: 50%; object-fit: cover;" alt="Generic placeholder image">
            <div class="media-body">
            <h5 class="mt-0">{{$a->user->name}}</h5>
            </div>
        </div>
        @endforeach
        <!-- end -->

        </div>
        

    </div>

    <div class="col-md-8">
        <div class="card">
        <div class="card-header" style="background-color: #7D7AAE;">
            <div class="row">
                <div class="col-md-6">
                    <h5 style="font-weight: 400; color: white; margin: auto;">{{$groups->title}} ({{$anggota->count()}})</h5>
                </div>
                <div class="col-md-6">
                @if($groups->user_id == Auth::user()->id)
                    <a href="/guru/chatgroup/{{$groups->id}}/userjoin" class="btn btn-sm" style="color:white; float:right">
                        {{$anggota2}} Request Join
                    </a>
                @endif
                </div>
            </div>
            
            
        </div>
        <div class="card-body" style="height: 440px; background-color: #eaede6">

            <div class="chat-group-list" id="kolom-chat" style="height: 370px; overflow: auto;">

            @foreach($chat as $c)
            @if($c->sender_id == Auth::user()->id)
            <!-- if you are the sender -->
            <div class="chat-group-item-user-1">
                <div class="media bg-white mb-2" style="padding: 10px; border-radius: 15px">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Anda</h5>
                    {{$c->message}}<br>
                    <span style="font-size: 14px; color: grey">{{$c->created_at}}</span>
                </div>
                </div>
            </div>
            <!-- end -->

            @else
            <!-- if you are the receiver -->
            <div class="chat-group-item-user-1">
                <div class="media mb-2" style="padding: 10px; background-color: #c3ebc6; border-radius: 15px">
    
                <div class="media-body">
                    <h5 class="mt-0">{{$c->sender->name}}</h5>
                    {{$c->message}}<br>
                    <span style="font-size: 14px; color: grey">{{$c->created_at}}</span>
                </div>
                </div>
            </div>
            <!-- end -->
            @endif

            @endforeach

            </div>

            <div class="chat-input mt-2" style=" bottom: 0; margin-bottom: 10px; ">
                <input type="text" name="message" class="form-control input w-100" placeholder="Input Message" >
            </div>

        </div>
        </div>
    </div>

    </div>
</div>
</div>

@endsection



@push('preview_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var groupchat_id = "{{$groups->id}}";
    var sender_id = "{{Auth::user()->id}}";
    var my_id = "{{Auth::user()->id}}";

    

    $(document).ready(function(){
        
        Pusher.logToConsole = true;
        var pusher = new Pusher('6a94a88d777315d912a1', {
        cluster: 'ap1',
        forceTLS: true
        });
        var channel = pusher.subscribe('fks-channel');
        channel.bind('fks-event', function(data) {
        $("#kolom-chat").load(location.href+" #kolom-chat","");
        });

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
            $(document).on('keyup', '.input', function (e) {
            var message = $(this).val();
            
            // check if enter key is pressed and message is not null also receiver is selected
            if (e.keyCode == 13 && message != '' && groupchat_id != '') {
                $(this).val(''); // while pressed enter text box will be empty
                var datastr = "groupchat_id=" + groupchat_id + "&message=" + message;
                console.log(groupchat_id);
                

                $.ajax({
                    type: 'post',
                    url: '/guru/messagegroup', // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        
                    }
                });
            }
        
        });
});
</script>


@endpush
