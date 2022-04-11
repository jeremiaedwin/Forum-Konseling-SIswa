@extends('admin.layout.app')
@section('title', 'Rekap Konseling')
@section('page', 'Rekap Konseling')
@section('content')

<div class="container-fluid text-dark">
    <div class="card">
        <div class="card-body">
        <form action="/admin/rekap/sortir" method="post">
        {{csrf_field()}}
            <div class="row">
            <div class="col-3">
                <label for="">Bulan</label>
                <select name="bulan" id="" class="form-control" required>
                    <option value="">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-3">
                <label for="">Tahun</label>
                <select name="tahun" id="" required class="form-control">
                    <option value="">Pilih Tahun</option>
                    @foreach($rekapKonselings3 as $thn)
                    <option value="{{$thn->tahun}}">{{$thn->tahun}}</option>
                    @endforeach
                </select>

                <input type="hidden" value="{{$year}}" name="tahun1">
                <input type="hidden" value="{{$month}}" name="bulan1">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-success btn-sm">Sortir</button> <br>
                <a href="/admin/rekap/konselingsortirpdf/{{$year}}/{{$month}}"  class="btn btn-primary btn-sm mt-2">Cetak PDF</a>
            </div>
            </div>
        </form>
            <div class="row m-3">
                <div class="col-md-12">
                <center><strong><h5>Laporan Konseling {{$monthName}} Tahun {{$year}}</h5></strong></center>
                <table class="table" style="color:black">
                <tr>
                    <td><b>Jumlah Konseling Konseling</b></td>
                    <td><b>:</b></td>
                    <td>{{$rekapKonselings->count()}} Konseling</td>
                </tr>
                <tr>
                    <td><b>Jumlah Masalah Selesai</b></td>
                    <td><b>:</b></td>
                    <td>{{$rekapKonselings->where('masalah_selesai',1)->count()}} Masalah</td>
                </tr>
                <tr>
                    <td><b>Jumlah Masalah Tidak Selesai</b></td>
                    <td><b>:</b></td>
                    <td>{{$rekapKonselings->where('masalah_selesai',0)->count()}} Masalah</td>
                </tr>
                <tr>
                    <td><b>Klasifikasi Masalah</b></td>
                    <tr>
                        <td>Pribadi</td>
                        <td>{{$rekapKonselings->where('klasifikasi_masalah', 'Pribadi')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Sosial</td>
                        <td>{{$rekapKonselings->where('klasifikasi_masalah', 'Sosial')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Karir</td>
                        <td>{{$rekapKonselings->where('klasifikasi_masalah', 'Karir')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Belajar</td>
                        <td>{{$rekapKonselings->where('klasifikasi_masalah', 'Belajar')->count()}}</td>
                    </tr>
                </tr>
                </table>
                <a href="/admin/rekap/asd"  class="btn btn-primary m-3">Cetak PDF</a>
                    <table id="table_id" class="table text-dark">
                    
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Konseling</th>
                                <th>Nama Siswa</th>
                                <th>Topik Konseling</th>
                                <th>Masalah</th>
                                <th>Alasan Konseling</th>
                                <th>Masalah Selesai</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody style="color:black">
                        @php $no = 1 @endphp
                        @foreach($rekapKonselings as $k)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$k->tanggal_konseling}}</td>
                                <td>{{$k->name}}</td>
                                <td>{{$k->klasifikasi_masalah}}</td>
                                <td>{{$k->title}}</td>
                                <td>{{$k->alasan_report}}</td>
                                <td>@if($k->masalah_selesai == 1) {{"Ya"}} @else {{"Tidak"}} @endif</td>
                                <td><a href="/admin/rekap/konseling/{{$k->id}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        @php $no++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('preview_script')

@endpush
