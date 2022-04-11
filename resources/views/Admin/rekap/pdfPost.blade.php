<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <div style="margin: auto">
        <center><h1>Rekap Postingan Tahun @php echo date('Y')@endphp</h1></center>
        <h3>Post</h3>
        <table width="100%" border="1px solid black">
            <tr>
                <td width="50%">Jumlah Post</td>
                <td width="50%">{{$posts->count()}}</td>
            </tr>
            <tr>
                <td style="width:50%">Masalah Selesai</td>
                <td style="width:50%">{{$posts->where('solved', 1)->count()}}</td>
            </tr>
            <tr>
                <td style="width:50%">Masalah Tidak Selesai</td>
                <td style="width:50%">{{$posts->where('solved', 0)->count()}}</td>
            </tr>
            <tr>
                <td>Diatasi BK</td>
                <td>{{$rekapPost->count()}}</td>
            </tr>
        </table>
            
        <h4>Kategori</h4>
        <table table width="100%" border="1px solid black">
            <tr>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
            @foreach($diagramCategory as $dc)
            <tr>                        
                <td>{{$dc->category}}</td>
                <td>{{$dc->count_category}}</td>                        
            </tr>
            @endforeach
        </table>

        
    </div>
</body>
</html>