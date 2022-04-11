@extends('layout.app')
@section('title', 'Post')
@section('page', 'Post/Create Post')
@section('content')

<div class="card content-card">
    <div class="card-header" style="background-color:#7D7AAE; color:white;">
        Buat Post
    </div>
    <div class="card-body postingan">
        
        <form action="/post" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="hidden" name="user_id" id="title" class="form-control" value="{{Auth::user()->id}}">
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="category">Kategori</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $c)
                        <option value="{{$c->id}}">{{$c->category}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="status">Status</label>
                    <select name="status_id" id="status" class="form-control">
                        <option value="">Pilih Status</option>
                        @foreach($statuses as $s)
                        <option value="{{$s->id}}">{{$s->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="">Image (Opsional)</label>
                <input type="file" accept="image/*" name="image" onchange="showPreview(event);" class="form-control" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
            </div>
            <div class="form-group preview">
                <img  width="200" height="200" id="preview">
            </div>
            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea name="content" id="editor1" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="anonymous" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Posting Sebagai Anonymous?
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
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
    
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
@endpush
