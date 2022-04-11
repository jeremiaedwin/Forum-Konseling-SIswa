@extends('admin.layout.app')
@section('title', 'Daftar User')
@section('page', 'Daftar User')
@section('content')

<div class="card content-card">
    <div class="card-header bg-primary text-white">
        Daftar User
    </div>
    <div class="card-body">
      <div class="row">
        <div class="" style="width:100%; overflow:auto">
          <table id="table_id" class="table bg-primary" style="color:white;">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Tahun Masuk</th>
                      <th>Tahun Keluar</th>
                      <th>Status</th>
                      <th>Tanggal bergabung</th>

                  </tr>
              </thead>
              <tbody style="color:black">
              @php $no=1; @endphp
              @foreach($users as $u)
                  <tr>
                      <td>{{$no}}</td>
                      <td>{{$u->name}}</td>
                      <td>{{$u->username}}</td>
                      <td>{{$u->email}}</td>
                      <td>
                          <button type="button" id="ubah-role" data-id="{{$u->id}}" style="color:black" class="btn" data-toggle="modal" data-target="#exampleModal">
                          {{$u->role}}
                          </button>
                      </td>
                      <td>{{$u->tahun_masuk}}</td>
                      <td>{{$u->tahun_keluar}}</td>
                      <td>@if($u->status == 1) {{"Aktif"}} @else{{"Non Aktif"}} @endif</td>
                      <td>{{$u->created_at}}</td>
                      
                  </tr>
              @php $no++ @endphp
              @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Ubah Role</h6>
        <form action="/admin/user/updateRole" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="">Ganti Role User</label>
                <input type="text" name="user_id" id="user_id">
                <select name="role" id="" class="form-control">
                    <option value="siswa">Siswa</option>
                    <option value="guru">Guru</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('preview_script')
<script>
$(document).ready( function () {

$(document).on("click","#ubah-role", function(){
  var user_id = $(this).data('id');

  $("#user_id").val(user_id);
  
});

});
</script>
@endpush