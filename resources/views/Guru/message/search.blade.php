@foreach($search as $user2)

    <div class="media mb-3">
        <img class="align-self-start mr-3" src="{{ asset('image/'. $user2->profile->foto_profil) }}" width="64" heigh="64" alt="Generic placeholder image">
        <div class="media-body">
            <a style="text-decoration:none;"><h5 class="mt-0 user-select2" style="cursor: context-menu;" id="{{$user2->id}}">{{$user2->name}}
            @if($user2->status)
                <span class="pending" id="u-list">{{ $user2->status }}</span>
            @endif</h5>
            </a>
            @if(Cache::has('user-is-online-' . $user2->id))
                <span class="text-success">Online</span>
            @else
                <span class="text-secondary">Offline</span>
            @endif
        </div>
    </div>

@endforeach