@extends('admin.layout.app')
@section('title', 'Messsage')
@section('page', 'Message')
@section('content')

<div class="card content-card">
    <div class="card-body">
        <div class="row">
            
            <div class="col-md-4" id="userList">
                <div id="accordion">
                    <div class="card">
                        <div  class="card-header user-list-chat" style="background-color: #7D7AAE; color:black; font-weight:bold" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-block collapseChat" style="background-color: none; color:white; font-weight:bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span><i class="fas fa-user"></i> Chat Dengan User</span>
                            </button>
                        </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div id="">
                                @foreach($users as $user)
                                @if($user->id == Auth::user()->id)
                    
                                @else
                                    <div class="media mb-3">
                                        <img class="profile-pic mr-3" src="{{ asset('image/'. $user->foto_profil) }}" width="64" height="64" alt="Generic placeholder image" style="object-fit:cover; border-radius:50%">
                                        <div class="media-body">
                                            <a style="text-decoration:none;"><h5 class="mt-0 user-select" style="cursor: context-menu;" id="{{$user->id}}">{{$user->name}}
                                            @if($user->status)
                                                <span class="pending" id="u-list">{{ $user->status }}</span>
                                            @endif</h5>
                                            </a>
                                            @if(Cache::has('user-is-online-' . $user->id))
                                                <span class="text-success">Online</span>
                                            @else
                                                <span class="text-secondary">Offline</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                

            <div class="col-md-8" >
                <div class="card content-card ">
                    <div id="chat-box">

                    
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('preview_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

    if (screen.width < 700) {
        $(".collapseChat").click();
    } 
    });

</script>

<script>
var receiver_id="";
var my_id="{{Auth::id()}}";

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6a94a88d777315d912a1', {
        cluster: 'ap1',
        forceTLS: true
        });

        var channel = pusher.subscribe('fks-channel');
        channel.bind('fks-event', function(data) {
        if(my_id == data.data.from){
            $('#' + data.data.to).click();
        }else if(my_id == data.data.to){
            if(receiver_id == data.data.from){
                $('#' + data.data.from).click();
            }else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.data.from).find('.pending').html());
                    if (pending) {
                        $('#' + data.data.from).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.data.from).append('<span class="pending">1</span>');
                    }
                }
            }
        
        
        });

    $('.user-select').click(function(){
        receiver_id = $(this).attr('id');
        $(this).find('.pending').remove();
        
        $.ajax({
            type:"get",
            url: "/admin/message/"+receiver_id,
            data:"",
            cache:false,
            success:function(data){
                $('#chat-box').html(data);
                $('#receiver_id_chat').val(receiver_id);
                scrollToBottomFunc();
            }
        });
    });

    $(document).on('keyup', '.input-message input', function (e) {
        var message = $(this).val();
        // check if enter key is pressed and message is not null also receiver is selected
        if (e.keyCode == 13 && message != '' && receiver_id != '') {
            $(this).val(''); // while pressed enter text box will be empty
            var datastr = "receiver_id=" + receiver_id + "&message=" + message;

            $.ajax({
                type: 'post',
                url: '/admin/message', // need to create this post route
                data: datastr,
                cache: false,
                success: function (data) {
                    
                },
                error: function (jqXHR, status, err) {
                },
                complete: function () {
                    scrollToBottomFunc();
                }
            })
        }
    });
});

function scrollToBottomFunc(){
    $('.isi-chat').animate({
        scrollTop: $('.isi-chat').get(0).scrollHeight
    },50);
};

</script>
@endpush