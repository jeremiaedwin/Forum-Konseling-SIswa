@foreach($notifs as $n)
    <a class="dropdown-item d-flex align-items-center" href="#">
        <div>
        <div class="small text-gray-500">{{ \Carbon\Carbon::parse($n->created_at)->diffForhumans() }}</div>
        @if($n->anonymous == 0)
        <span class="font-weight-bold">{{$n->user->name}} mengomentari postinganmu</span>
        @else
        <span class="font-weight-bold">Anonim mengomentari postinganmu</span>
        @endif
        </div>
        <td>
            <form action="/comment/{{$n->id}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            @if($n->status == "0")
                <input type="hidden" name="status" id="" value="{{$n->status + 1}}">
                <input type="hidden" name="slug" id="" value="{{$n->post->slug}}">
                <button type="submit" class="btn btn-primary btn-sm">Lihat</button>
            @else
                <a href="/post/{{$n->post->slug}}" class="btn btn-primary btn-sm">Lihat</a>
            @endif
            </form>
        </td>
    </a>
@endforeach
