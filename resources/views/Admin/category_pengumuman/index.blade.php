@extends('admin.layout.app')
@section('title', 'Daftar Kategori Pengumuman')
@section('page', 'Daftar Kategori Pengumuman')
@section('content')

<div class="container">
    <div class="table-media">
    @if($errors->has('category'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">  
         <span class="text-danger">{{ $errors->first('category') }}</span>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
    @endif
        <button class="btn btn-primary my-2" href="#" data-toggle="modal" data-target="#createCategory">Buat Kategori</button>
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Kategori</th>
                    <th>Tanggal Pembuatan</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
        @foreach($catepegus as $catepegu)
                <tr>
                    <td>{{$catepegu->category}}</td>
                    <td>{{$catepegu->created_at}}</td>
                    <td>
                      <a class="btn btn-success m-1" href="#" data-toggle="modal" data-target="#editCategory{{$catepegu->id}}" >Edit</a>
                      <a class="btn btn-danger m-1" href="#" data-toggle="modal" data-target="#deleteCategory{{$catepegu->id}}" >Hapus</a>
                    </td>
                </tr>

                    <!-- Edit Modal -->
                      <div class="modal fade" id="editCategory{{$catepegu->id}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="m-2 mr-2" style="font-size: 20px">
                                    <form class="w-100" action="/admin/proses_edit_catepegu/{{$catepegu->id}}" method="POST">
                                    {{ csrf_field() }}
                                        <div class="form-group">
                                                <label>Nama Kategori</label>
                                                <input type="text" class="form-control mb-2" name="category" value="{{ $catepegu->category }}">
                                                <button class="btn btn-success" type="button" data-dismiss="modal">Batal</button>
                                                <button class="btn btn-primary" type="submit">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>

                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteCategory{{$catepegu->id}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Apakah anda yakin untuk menghapus kategori ini ?</div>
                        <div class="modal-footer">
                          <button class="btn btn-success" type="button" data-dismiss="modal">Batal</button>
                          <a class="btn btn-danger" href="/admin/delete_catepegu/{{$catepegu -> id}}">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
        @endforeach     
            </tbody>
        </table>
    </div>
</div>

  <!-- Create Modal -->
  <div class="modal fade" id="createCategory" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Kategori</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="m-2 mr-2" style="font-size: 20px">
                <form class="w-100" action="/admin/proses_buat_kategori_pengumuman" method="POST">
                {{ csrf_field() }}
                    <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control mb-2" name="category" id="category" value="{{ old('category') }}">
                            <button class="btn btn-success" type="button" data-dismiss="modal" onClick="batalButton()">Batal</button>
                            <button class="btn btn-primary" type="submit">Buat</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('preview_script')
    <script type="text/javascript">
    function batalButton(){
      document.getElementById('category').value=null;
    };
    </script>
@endpush