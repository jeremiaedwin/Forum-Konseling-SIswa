    <!DOCTYPE html>
    <html>
    <head>
        
    </head>
    <body>
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
        <table border="1" cellspacing="0" cellpadding="0">

            <tr>
                <td>
                <center><h4>Profil Siswa</h4></center>
                    <table>
                        <tr>
                            <td><center><img src="{{public_path('image/'.$rekapKonselings->foto_profil)}}" alt="" height="200" width="200"></center></td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td> : </td>
                            <td>{{$rekapKonselings->name}}</td>
                        </tr>

                        <tr>
                            <td>NIS</td>
                            <td> : </td>
                            <td>{{$rekapKonselings->user_id}}</td>
                        </tr>
                        
                        <!-- <tr>
                            <td>NIS</td>
                            <td> : </td>
                            <td>{{$rekapKonselings->user_id}}</td>
                        </tr> -->
                        
                    </table>  
                </td>


                <td>
                    <center><h4>Masalah</h4></center>
                    <table class="table text-dark">
                        
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
                <center><h4>Hasil Konseling</h4></center>
                    <table class="table text-dark">
                        
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
            </tr>
        </table>

    </body>
    </html>