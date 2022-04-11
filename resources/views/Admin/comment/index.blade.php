@extends('admin.layout.app')
@section('title', 'Daftar Komentar')
@section('page', 'Daftar Komentar')
@section('content')

<div class="card content-card">
    <div class="card-body">
        <form action="/admin/comments/sortir" method="post">
        {{csrf_field()}}
            <div class="form-group row">
                
                <div class="col">
                    <select class="form-control" id="user" name="id">
                        <option value="">User</option>
                        @foreach($users as $u)
                        <option value="{{$u->id}}">{{$u->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Komentar</th>
                    <th>Post</th>
                    <th><i class="fas fa-thumbs-up"></i></th>
                    <th><i class="fas fa-comments"></i></th>
                    <td>Dibuat</td>
                    <td>Disunting</td>
                    <th>View</th>
                </tr>
            </thead>
            <tbody style="color:black">
                @php $no = 1 @endphp
                @foreach($comments as $c)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$c->user->name}}</td>
                    <td>{{$c->comment}}</td>
                    <td>{{$c->post->title}}</td>
                    <td>{{$c->commentlike->count('comment_id')}}</td>
                    <td>{{$c->replycomment->count('comment_id')}}</td>
                    <td>{{$c->created_at}}</td>
                    <td>{{$c->updated_at}}</td>
                    <td>
                        <a href="/admin/comments/{{$c->id}}" class="btn btn-success btn-sm btn-block"><i class="far fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>       
    </div>
</div>

@endsection

@push('preview_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#user').select2();
});
</script>
@endpush