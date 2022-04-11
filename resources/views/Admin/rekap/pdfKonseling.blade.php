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
    <center><h2 style="font-size:14px">Laporan Konseling BK {{$monthName}} Tahun {{date('Y')}}</h2></center>
    <div style="margin-left: 10%;margin-right: 10%; font-size:12px">
    	<table width="90%" >
	    	<tr>
	    		<td width="40%"><b>Jumlah Konseling Konseling</b></td>
	    		<td width="10%"><b>:</b></td>
	    		<td width="40%">{{$rekapKonselings->count()}} Konseling</td>
	    	</tr>
	    	<tr>
	    		<td width="40%"><b>Jumlah Masalah Selesai</b></td>
	    		<td width="10%"><b>:</b></td>
	    		<td width="40%">{{$rekapKonselings->where('masalah_selesai',1)->count()}} Masalah</td>
	    	</tr>
	    	<tr>
	    		<td width="40%"><b>Jumlah Masalah Tidak Selesai</b></td>
	    		<td width="10%"><b>:</b></td>
	    		<td width="40%">{{$rekapKonselings->where('masalah_selesai',0)->count()}} Masalah</td>
	    	</tr>
	    	<tr>
	    		<td width="40%"><b>Klasifikasi Masalah</b></td>
	    		<td width="10%"><b>:</b></td>
	    		<tr>
	    			<td width="10%">Pribadi</td>
		    		<td width="10%">:</td>
		    		<td width="10%">{{$rekapKonselings->where('klasifikasi_masalah', 'Pribadi')->count()}} Laporan</td>
	    		</tr>
	    		<tr>
	    			<td width="10%">Sosial</td>
		    		<td width="10%">:</td>
		    		<td width="10%">{{$rekapKonselings->where('klasifikasi_masalah', 'Sosial')->count()}} Laporan</td>
	    		</tr>
	    		<tr>
	    			<td width="10%">Karir</td>
		    		<td width="10%">:</td>
		    		<td width="10%">{{$rekapKonselings->where('klasifikasi_masalah', 'Karir')->count()}} Laporan</td>
	    		</tr>
	    		<tr>
	    			<td width="10%">Belajar</td>
		    		<td width="10%">:</td>
		    		<td width="10%">{{$rekapKonselings->where('klasifikasi_masalah', 'Belajar')->count()}} Laporan</td>
	    		</tr>
	    	</tr>

	    	
	    </table>
        <center><h4>Daftar Konseling</h4></center>
        @foreach($rekapKonselings as $rekapKonselings)
        <table width="90%" border="1" cellspacing="0" cellpadding="0" style="font-size:12px">
        <tr>
            <td width="40%">Nama Siswa</td>
            <td width="50%">{{$rekapKonselings->name}}</td>
        </tr>

        <tr>
            <td width="40%">NIS</td>
            
            <td width="50%">{{$rekapKonselings->user_id}}</td>
        </tr>
        <tr>
            <td width="40%">Postingan</td>
            
            <td width="50%">{{$rekapKonselings->title}}</td>
        </tr>
        <tr>
            <td width="40%">Kategori</td>
            
            <td width="50%">{{$rekapKonselings->category->category}}</td>
        </tr>
        <tr>
            <td width="40%">Klasifikasi Masalah</td>
            
            <td width="50%">{{$rekapKonselings->klasifikasi_masalah}}</td>
        </tr>
        <tr>
            <td width="40%">Alasan Report</td>
            
            <td width="50%">{{$rekapKonselings->alasan_report}}</td>
        </tr>
        <tr>
            <td width="40%">Tanggal Konseling</td>
            
            <td width="50%">{{$rekapKonselings->tanggal_konseling}}</td>
        </tr>
        <tr>
            <td width="40%">Nama Guru</td>
            
            <td width="50%">{{$rekapKonselings->receiver->name}}</td>
        </tr>
        <tr>
            <td width="40%">Deskripsi Penyelesaian</td>
            
            <td width="50%">{!!$rekapKonselings->deskripsi_penyelesaian!!}</td>
        </tr>
        <tr>
            <td width="40%">Masalah Selesai</td>
            
            <td width="50%">@if($rekapKonselings->masalah_selesai == 1) {{"Ya"}} @else {{"Tidak"}} @endif</td>
        </tr>
	    	
	    </table>

        <hr>
        @endforeach
    </div>
</body>
</html>		