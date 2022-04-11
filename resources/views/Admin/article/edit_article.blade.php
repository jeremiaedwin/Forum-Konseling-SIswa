@extends('admin.layout.app')
@section('title','Edit Artikel')
@section('page','Edit Artikel')
@section('content')

@foreach($articles as $article)

<div class="m-2 mr-2" style="font-size: 20px">
    <form class="w-100" action="/admin/proses_update_artikel" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
       <div class="form-group">

            <input type="hidden" name="slug" class="form-control" value="{{$article->slug}}">
            <input type="hidden" name="images" class="form-control" value="{{$article->image}}">
            <label>Judul</label>
            <input type="text" class="form-control mb-2" name="title" value="{{ $article->title }}">

            @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
                <br>
            @endif

            <label>Kategori</label>
            <select name="category" class="form-control">
                <option value="0" selected disabled>Pilih Kategori</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{ ($article->category_id == $category->id) ? 'selected':'' }} >{{$category->category}}</option>
                @endforeach
            </select>

            <label>Status</label>
            <select name="status" class="form-control">
                <option value="0" selected disabled>Pilih Status</option>
                @foreach($statuses as $status)
                <option value="{{$status->id}}" {{ ($article->status_id == $status->id) ? 'selected':'' }} >{{$status->status}}</option>
                @endforeach
            </select>
            
            <label>Konten</label>
            <textarea class="form-control mb-2" id="editor1" rows="10" name="content">{{ $article->content }}</textarea>

            @if($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
                <br>
            @endif

            <label>Image</label>
            <br id="break" style="display:none">
            <br id="break2" style="display:inline">
            <img id="fotomu" src="{{ asset('image/'.$article->image) }} " style="width: 300px; height:300px">
            <input type="file" class="form-control" name="image" id="image" onChange="readURL(this);">

            @if($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
                <br>
            @endif
            <input class="btn btn-primary mt-4 mb-4" type="submit" value="Submit">
       </div>
    </form>
</div>

@endforeach

@endsection

@push('preview_script')
    <script type="text/javascript">
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#fotomu').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
                document.getElementById('fotomu').style.width ="300px";
                document.getElementById('fotomu').style.height ="300px";
                document.getElementById('break').style.display ="inline";
                document.getElementById('break2').style.display ="hidden";
            }
        }
        
        $("#image").change(function(){
            readURL(this);
        });
    </script>
    <script>
            CKEDITOR.replace( 'editor1' );
    </script>

@endpush