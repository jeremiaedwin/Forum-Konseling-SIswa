<div class="card-header" style="background-color:#7D7AAE; color:white;">
<div class="media">
        <img class=" mr-2 " src="{{ asset('image/'. $users2->profile->foto_profil) }}" width="64" height="64" alt="Generic placeholder image" style="border-radius:50%; object-fit:cover">
        <div class="media-body">
            <h4 class="mt-3 user-select" id="{{$users2->id}}" style="font-weight:bold">{{$users2->name}}</h4>
        </div>
    </div>
</div>
<div class="card-body isi-chat" id="isi-chat"  style="color:  #3A4058;">
    <ul type="none">
    @foreach($messages as $m)
    @if(Auth::id() == $m->receiver_id)
        <li class="chat-list1">
    @elseif(Auth::id() == $m->sender_id)
        <li class="chat-list2">
        @endif
            <div class="chat-item">
            @if(Auth::id() == $m->receiver_id)
                <b>{{$m->sender->name}}</b>
            @elseif(Auth::id() == $m->sender_id)
                <b>Anda</b>
                
            @endif
            
                <p>{{$m->message}}</p>
                <span>{{ $m->created_at->diffForHumans() }}</span>
                <!-- @if(Auth::id() == $m->sender_id)
                @if($m->status == 0)
                <span class="ml-3 fas fa-eye chat-status"></span>
                @else
                <span class="ml-3 fas fa-eye chat-status-read"></span>
                @endif
                @else -->

                <!-- @endif -->
            </div>
        </li>
        @endforeach 
    </ul>
</div>
<div class="col input-message">
    <input type="text" name="message" v-model="input" placeholder="input teks" id="" class="form-control input">
</div>

