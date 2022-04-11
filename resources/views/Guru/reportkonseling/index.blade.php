@extends('guru.layout.app')
@section('title', 'Report Post')
@section('page', 'Index')
@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
        <h5>Daftar Konseling Yang Anda Telah Lakukan</h5>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Konseling</th>
                <th>Nama Siswa</th>
                <th>Topik Konseling</th>
                <th>Masalah</th>
                <th>Alasan Konseling</th>
                <th>Masalah Selesai</th>
            </tr>
        </thead>
        <tbody style="color:black">
        @php $no = 1 @endphp
        @foreach($r_konseling as $k)
            <tr>
                <td>{{$no}}</td>
                <td>{{$k->tanggal_konseling}}</td>
                <td>{{$k->name}}</td>
                <td>{{$k->klasifikasi_masalah}}</td>
                <td>{{$k->title}}</td>
                <td>{{$k->alasan_report}}</td>
                <td>@if($k->masalah_selesai == 1) {{"Ya"}} @else {{"Tidak"}} @endif</td>
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