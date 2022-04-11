@extends('guru.layout.app')
@section('title', 'Buat Artikel')
@section('page', 'Buat Artikel')
@section('content')


<div class="m-2 mr-2" style="font-size: 20px">
    <form class="w-100" action="/guru/proses_buat_artikel" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
       <div class="form-group">
            <input type="hidden" name="user_id" id="title" class="form-control" value="{{Auth::user()->id}}">
            <label>Judul</label>
            <input type="text" class="form-control mb-2" name="title" value="{{ old('title') }}">

            @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
                <br>
            @endif

            <label>Kategori</label>
            <select name="category" class="form-control">
                <option value="0" selected disabled>Pilih Kategori</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{ (collect(old('category')) -> contains($category->id)) ? 'selected':'' }} >{{$category->category}}</option>
                @endforeach
            </select>

            @if($errors->has('category'))
                <span class="text-danger">{{ $errors->first('category') }}</span>
                <br>
            @endif

            <label>Status</label>
            <select name="status" class="form-control">
                <option value="0" selected disabled>Pilih Status</option>
                @foreach($statuses as $status)
                <option value="{{$status->id}}" {{ (collect(old('status')) -> contains($status->id)) ? 'selected':'' }} >{{$status->status}}</option>
                @endforeach
            </select>
            
            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                <br>
            @endif
            
            <label>Konten</label>
            <textarea class="form-control mb-2" id="editor1" rows="10" name="content">{{ old('content') }}</textarea>

            @if($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
                <br>
            @endif

            <label>Image</label>
            <br id="break" style="display:none">
            <img id="fotomu" src="{{ old('image') }}">
            <input type="file" class="form-control" name="image" id="image" onChange="readURL(this);">

            @if($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
                <br>
            @endif
            <input class="btn btn-primary mt-4 mb-4" type="submit" value="submit">
       </div>
    </form>
</div>

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