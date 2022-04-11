@extends('layout.app')
@section('title', 'Group')
@section('page', 'Chat Group')
@section('content')

@if($me == false)
<div class="card">
    <div class="card-body">
        <form action="/chatgroup/join" method="post">
            {{csrf_field()}}
            <center>
            <h5>Anda Belum Terdaftar Di Group ini</h5>
            <br>
            <h6>Silahkan klik join untuk bergabung</h6>
            <input type="hidden" name="groupchat_id" value="{{$groups->id}}">            
            <button type="submit" class="btn btn-success">Join</button>
            <a href="/chatgroup" class="btn btn-primary">Cancel</a>
            </center>
        </form>
    </div>
</div>

@elseif($me == true && $me2 == false)
<div class="card">
    <div class="card-body">
        <center>
        <h5>Tunggu Konfirmasi dari guru</h5>
        <form action="/chatgroup/unjoin" method="post">
            {{csrf_field()}}
            <input type="hidden" name="groupchat_id2" value="{{$groups->id}}">            
            <button type="submit" class="btn btn-danger">Batalkan Join</button>
        </form>
        <a href="/chatgroup" class="btn btn-primary">Kembali</a>
        </center>
    </div>
</div>
@else
<div class="card">
<div class="card-body">
    <div class="row no-gutters">

    <div class="col-md-4">
        <div class="media text-dark" style="padding: 10px; background-color: #d4d9ce;">
        <img class="align-self-center mr-3" src="{{asset('image/'. Auth::
            user()->profile->foto_profil)}}" height="64" width="64" style="border-radius: 50%; object-fit: cover;" alt="Generic placeholder image">
        <div class="media-body">
            <h5 class="mt-0">{{Auth::user()->name}}</h5>
        </div>
        </div>

        <div style="height: 400px; overflow: scroll;">

        <!-- user dalam group -->
        <span class="mt-5">User dalam Group</span>
        @foreach($anggota as $a)
        @if($a->status == 1)
        <div class="media mt-1 text-dark" style="padding: 10px; border-top: 1px solid #d4d9ce;
            border-bottom: 1px solid #d4d9ce;">
            <img class="align-self-center mr-3" src="{{asset('image/'. $a->user->profile->foto_profil)}}" height="64" width="64" style="border-radius: 50%; object-fit: cover;" alt="Generic placeholder image">
            <div class="media-body">
            <h5 class="mt-0">@if($a->user->role == 'siswa') {{$a->user->username}} @else {{$a->user->name}} <span><b>({{$a->user->role}})</b></span>@endif</h5>
           
            </div>
        </div>
        @endif
        @endforeach
        <!-- end -->

        </div>
        

    </div>

    <div class="col-md-8">
        <div class="card">
        <div class="card-header" style="background-color: #7D7AAE;">
            <h5 style="font-weight: 400; color: white; margin: auto;">{{$groups->title}} ({{$anggota->count()}})</h5>
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
                    <span style="font-size: 14px; color: grey">5 minutes ago</span>
                </div>
                </div>
            </div>
            <!-- end -->

            @else
            <!-- if you are the receiver -->
            <div class="chat-group-item-user-1">
                <div class="media mb-2" style="padding: 10px; background-color: #c3ebc6; border-radius: 15px; color:black">
    
                <div class="media-body">
                    <h5 class="mt-0" style="color:black">{{$c->sender->name}}</h5>
                    {{$c->message}}<br>
                    <span style="font-size: 14px; color: black">5 minutes ago</span>
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


@endif
@endsection


@push('after_script')
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
        // if(sender_id == data.data.from){
        //     $("#kolom-chat").load(location.href+" #kolom-chat","");
        // }else if(my_id == data.data.membersGroup){
        //     $("#kolom-chat").load(location.href+" #kolom-chat","");
        $("#kolom-chat").load(location.href+" #kolom-chat","");
        // }
        scrollToBottomFunc();
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
                    url: '/messagegroup', // need to create this post route
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

function scrollToBottomFunc(){
    $('#kolom-chat').animate({
        scrollTop: $('#kolom-chat').get(0).scrollHeight
    },50);
};
</script>
@endpush
