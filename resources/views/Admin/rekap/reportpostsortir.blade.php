@extends('admin.layout.app')
@section('title', 'Rekap Report Post')
@section('page', 'Rekap Report Post')
@section('content')

<div class="container-fluid text-dark">
    <div class="card">
        <div class="card-body">
        <form action="/admin/rekap/reportpost/sortir" method="post">
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
                    @foreach($r_post2 as $thn)
                    <option value="{{$thn->tahun}}">{{$thn->tahun}}</option>
                    @endforeach
                </select>
            </div>
                
            <div class="col-3">
                <button type="submit" class="btn btn-success btn-sm">Sortir</button> <br>
                <input type="hidden" value="{{$year}}" name="tahun1">
                <input type="hidden" value="{{$month}}" name="bulan1">
                <a href="/admin/rekap/sortir/reportpostpdf/{{$year}}/{{$month}}"  class="btn btn-primary btn-sm mt-2">Cetak PDF</a>
            </div>
            </div>
        </form>
            <div class="row m-3">
                <div class="col-md-12">
                <center><strong><h5>Rekap Report Post Bulan {{$monthName}} Tahun {{$year}}</h5></strong></center>
                <table class="table" style="color:black">
                <tr>
                    <td><b>Jumlah Report Post Konseling</b></td>
                    <td><b>:</b></td>
                    <td>{{$r_post->count()}} Konseling</td>
                </tr>
                
                <tr>
                    <td><b>Jumlah Report yang Telah Ditanggapi</b></td>
                    <td><b>:</b></td>
                    <td>{{$r_post->where('status',1)->count()}} Masalah</td>
                </tr>
                <tr>
                    <td><b>Jumlah Report yang Belum Ditanggapi</b></td>
                    <td><b>:</b></td>
                    <td>{{$r_post->where('status',0)->count()}} Masalah</td>
                </tr>
                <tr>
                    <td><b>Alasan Report</b></td>
                    <tr>
                        <td>Masalah Cukup Rumit</td>
                        <td>{{$r_post->where('alasan_report', 'Masalah Cukup Rumit')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Belum Mendapatkan Jawaban Terbaik</td>
                        <td>{{$r_post->where('alasan_report', 'Belum Mendapatkan Jawaban Terbaik')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah View Hanya Sedikit</td>
                        <td>{{$r_post->where('alasan_report', 'Jumlah View Hanya Sedikit')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Siswa Mengajukan Diskusi Dengan BK</td>
                        <td>{{$r_post->where('alasan_report', 'Siswa Mengajukan Diskusi Dengan BK')->count()}}</td>
                    </tr>
                </tr>
                <tr>
                    <td><b>Klasifikasi Masalah</b></td>
                    <tr>
                        <td>Pribadi</td>
                        <td>{{$r_post->where('klasifikasi_masalah', 'Pribadi')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Sosial</td>
                        <td>{{$r_post->where('klasifikasi_masalah', 'Sosial')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Karir</td>
                        <td>{{$r_post->where('klasifikasi_masalah', 'Karir')->count()}}</td>
                    </tr>
                    <tr>
                        <td>Belajar</td>
                        <td>{{$r_post->where('klasifikasi_masalah', 'Belajar')->count()}}</td>
                    </tr>
                </tr>
                </table>
                
                    <table id="table_id" class="table text-dark">
                    
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Report</th>
                                <th>Siswa</th>
                                <th>Guru yang Menanggapi</th>
                                <th>Postingan</th>
                                <th>Klasifikasi Masalah</th>
                                <th>Alasan Report</th>                                
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="color:black">
                        @php $no = 1 @endphp
                        @foreach($r_post as $k)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$k->created_at}}</td>
                                <td>{{$k->post->user->name}}</td>
                                <td>{{$k->receiver->name}}</td>
                                <td>{{$k->post->title}}</td>
                                <td>{{$k->klasifikasi_masalah}}</td>                                
                                <td>{{$k->alasan_report}}</td>
                                <td>@if($k->status == 1) {{"Sudah Ditanggapi"}} @else {{"Belum Ditanggapi"}} @endif</td>                                
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
