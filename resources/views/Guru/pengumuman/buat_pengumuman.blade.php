@extends('guru.layout.app')
@section('title', 'Buat Pengumuman')
@section('page', 'Buat Pengumuman')
@section('content')



<div class="m-2 mr-2" style="font-size: 20px">
    <form class="w-100" action="/guru/proses_buat_pengumuman" method="POST" enctype="multipart/form-data">
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
                @foreach($catepegus as $catepegu)
                <option value="{{$catepegu->id}}" {{ (collect(old('category')) -> contains($catepegu->id)) ? 'selected':'' }} >{{$catepegu->category}}</option>
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

            <label>PDF</label>
            <br id="break" style="display:none">
            <iframe class="embed-responsive-item" id="pdfmu" src="{{ old('pdf') }}" style="display:none"></iframe>
            <input type="file" class="form-control" name="pdf" id="pdf" onChange="readURL(this);">

            @if($errors->has('pdf'))
                <span class="text-danger">{{ $errors->first('pdf') }}</span>
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
                    $('#pdfmu').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
                document.getElementById('pdfmu').style.width ="600px";
                document.getElementById('pdfmu').style.height ="600px";
                document.getElementById('pdfmu').style.display ="inline";
                document.getElementById('break').style.display ="inline";
            }
        }
        
        $("#pdf").change(function(){
            readURL(this);
        });
    </script>
@endpush