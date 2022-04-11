@extends('guru.layout.app')
@section('title', 'Report Post')
@section('page', 'Index')
@section('content')

<div class="card">
    <div class="card-body">
    <h5 style="color:black; font-weight:700">Daftar Laporan Admin</h5>
        <table id="table_id" class="table table-bordered">
            <thead style="background-color:#7D7AAE; color:white">
                <tr>
                    <th>No</th>
                    <th>Postingan</th>
                    <th>Siswa</th>
                    <th>Masalah</th>
                    <th>Alasan Report</th>
                    <th>Tanggal Report</th>
                    <th>Status</th>
                    <th><i class="fas fa-eye m-0"></i></th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach($r_post as $rp)
                <tr class="" style="color:black">
                    <td>{{$no}}</td>
                    <td>{{$rp->post->title}}</td>
                    <td>{{$rp->post->user->name}}</td>
                    <td>{{$rp->klasifikasi_masalah}}</td>
                    <td>{{$rp->alasan_report}}</td>
                    <td>{{$rp->created_at}}</td>
                    <td>@if($rp->status == 1) <button disabled="disabled" class="btn text-white btn-sm" style="background-color:green">Sudah Ditanggapi</button> @else <button disabled="disabled" class="btn text-white btn-sm" style="background-color:red">Belum Ditanggapi</button> @endif</td>
                    <td><a href="/guru/reportpost/{{$rp->id}}/show" class="btn btn-sm btn-primary">Lihat</a></td>
                </tr>
                @php $no++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('preview_script')

@endpush