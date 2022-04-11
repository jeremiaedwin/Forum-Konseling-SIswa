@extends('layout.app')
@section('title', 'Post')
@section('page', 'Post/Create Post')
@section('content')

<div class="card content-card">
    <div class="card-body postingan">
        
        <form action="/post/{{$posts->id}}/" method="post"  enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PUT')}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="hidden" name="user_id" id="title" class="form-control">
                <input type="text" name="title" id="title" class="form-control" value="{{$posts->title}}">
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="category">Kategori</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $c)
                        <option value="{{$c->id}}" <?php if($posts->category_id == $c->id){echo "selected";} ?>>{{$c->category}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="status">Status</label>
                    <select name="status_id" id="status" class="form-control">
                        <option value="">Pilih Status</option>
                        @foreach($statuses as $status)
                        <option value="{{$status->id}}" <?php if($posts->status_id == $status->id){echo "selected";} ?>>{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="">Image (Opsional)</label>
                <input type="file" accept="image/*" name="image" onchange="showPreview(event);" class="form-control" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
            </div>
            <div class="form-group preview">
                <img src="{{asset('image/'.$posts->image)}}" width="200" height="200" id="preview">
            </div>
            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea name="content" id="" rows="5" class="form-control">{{$posts->content}}</textarea>
            </div>

            <div class="form-group row">
                <div class="col">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="/profile/{{$posts->user_id}}" class="btn btn-primary">Kembali</a>
                </div>
                <div class="col">
                
                </div>
            </div>
            
        </form>
        
    </div>
</div>


@endsection
@push('after_script')
	<script>
		function showPreview(event){
            if(event.target.files.length > 0)
            {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById('preview');
                preview.src=src;
                preview.style.display="block";
            }
        }
	</script>
@endpush
