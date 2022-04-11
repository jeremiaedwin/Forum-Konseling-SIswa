@extends('admin.layout.app')
@section('title', 'Report Posts')
@section('page', 'Report Posts')
@section('content')

<div class="card" style="border-radius: 15px">
      <div class="card-header bg-primary" style="color:white">
        <h5 class="m-auto">Report Post ke BK</h5>
      </div>
      <div class="card-body">
        
      <table id="table_id" class="table bg-primary" style="color:white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Post</th>
                    <th>Guru Yang Menangani</th>
                    <th>Klasifikasi Masalah</th>
                    <th>Alasan Report</th>
                    <th>Aksi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="color:black">
            @php $no=1; @endphp
            @foreach($r_post as $r)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$r->post->title}}</td>
                    <td>{{$r->receiver->name}}</td>
                    <td>{{$r->klasifikasi_masalah}}</td>
                    <td>{{$r->alasan_report}}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                    </td>
                    <td>
                    <a href="/user/{{$r->id}}/edit" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                    </td>
                </tr>
            @php $no++ @endphp
            @endforeach
            </tbody>
        </table>
        
      </div>
    </div>
@endsection