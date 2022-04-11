<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
<div style="margin-left: 10%;margin-right: 10%;">
	 <table width="100%">
	 	<tr>
	 		<td width="20%">
	 			<center><img src="{{public_path('image/1612945533.png')}}" width="100" height="100"></center>
	 		</td>
	 		<td width="60%">
	 			<center>
	 				<h2 style='margin-bottom:-5px'>FORUM KONSELING 11</h2>
	 				<h3>SMK Negeri 11 Bandung</h3>
                    <p>Jl. Budi Jl. Raya Cilember, Sukaraja, Kec. Cicendo, Kota Bandung, Jawa Barat 40153</p>
                    <p>Telepon: (022) 6652442</p>
	 			</center>
	 		</td>
             <td width="20%">
                <center><img src="{{public_path('image/logo11.jpg')}}" width="120" height="120"></center>
             </td>
	 	</tr>
    </table>
</div>
    <hr>
<div style="margin-left: 10%;margin-right: 10%;">
<center><strong><h3>Rekap Report Post Bulan {{$monthName}} Tahun {{date('Y')}}</h3></strong></center>
    <table width="90%">
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

    <center><h3>Daftar Report Post</h3></center>
    <table border="1" cellspacing="0" cellpadding="0" style="font-size:12px">
    
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
</body>
</html>		