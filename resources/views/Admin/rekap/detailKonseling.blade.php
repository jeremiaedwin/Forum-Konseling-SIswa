@extends('admin.layout.app')
@section('title', 'Rekap Konseling')
@section('page', 'Rekap Konseling')
@section('content')

<div class="container text-dark">
    
    <table class="table text-dark">
    <center><h4>Laporan Konseling {{$rekapKonselings->name}}</h4></center>
        <td>
            <table>
                <tr>
                    <td>Nama Siswa</td>
                    <td> : </td>
                    <td>{{$rekapKonselings->name}}</td>
                </tr>
                <!-- <tr>
                    <td>NIS</td>
                    <td> : </td>
                    <td>{{$rekapKonselings->user_id}}</td>
                </tr> -->
                <tr>
                    <td>Postingan</td>
                    <td> : </td>
                    <td>{{$rekapKonselings->title}}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td> : </td>
                    <td>{{$rekapKonselings->category->category}}</td>
                </tr>
                <tr>
                    <td>Klasifikasi Masalah</td>
                    <td> : </td>
                    <td>{{$rekapKonselings->klasifikasi_masalah}}</td>
                </tr>
                <tr>
                    <td>Alasan Report</td>
                    <td> : </td>
                    <td>{{$rekapKonselings->alasan_report}}</td>
                </tr>
            </table>
        </td>
        
        <td>
            <table class="table text-dark">
            <center><h4>Hasil Konseling</h4></center>
            <tr>
                <td>Tanggal Konseling</td>
                <td> : </td>
                <td>{{$rekapKonselings->tanggal_konseling}}</td>
            </tr>
            <tr>
                <td>Nama Guru</td>
                <td> : </td>
                <td>{{$rekapKonselings->receiver->name}}</td>
            </tr>
            <tr>
                <td>Deskripsi Penyelesaian</td>
                <td> : </td>
                <td>{!!$rekapKonselings->deskripsi_penyelesaian!!}</td>
            </tr>
            <tr>
                <td>Masalah Selesai</td>
                <td> : </td>
                <td>@if($rekapKonselings->masalah_selesai == 1) {{"Ya"}} @else {{"Tidak"}} @endif</td>
            </tr>
        </table>
        </td>
        
        
    </table>
    
    <a href="/admin/rekap/konseling" class="btn btn-success" >Kembali</a>
    <a href="/admin/rekap/konseling/pdf/{{$rekapKonselings->id}}" target="_blank" class="btn btn-primary">Cetak PDF</a>
</div>

@endsection

@push('preview_script')

@endpush
