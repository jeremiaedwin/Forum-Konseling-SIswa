@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('page', 'Dashboard')
@section('content')

<div class="row mt-2">

    <div class="col-md-3">
        <div class="card card-admin-1" style="border-top: 2px solid blue">
        <div class="card-body">
            <div class="row">
            <div class="col-md-4">
                <i class="fas fa-user fa-4x"></i>
            </div>
            <div class="col-md-8">
                <h5 class="card-admin-text-1">USERS</h5>
                <h5 class="card-admin-text-2">{{$users->count()}}</h5>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-admin-1" style="border-top: 2px solid blue">
        <div class="card-body">
            <div class="row">
            <div class="col-md-4">
                <i class="fas fa-question fa-4x"></i>
            </div>
            <div class="col-md-8">
                <h5 class="card-admin-text-1">POSTINGAN</h5>
                <h5 class="card-admin-text-2">{{$posts}}</h5>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-admin-1" style="border-top: 2px solid blue">
        <div class="card-body">
            <div class="row">
            <div class="col-md-4">
                <i class="far fa-file fa-4x"></i>
            </div>
            <div class="col-md-8">
                <h5 class="card-admin-text-1">PENGAJUAN</h5>
                <h5 class="card-admin-text-2">{{$r_post->count()}}</h5>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-admin-1" style="border-top: 2px solid blue">
        <div class="card-body">
            <div class="row">
            <div class="col-md-4">
                <i class="fas fa-file fa-4x"></i>
            </div>
            <div class="col-md-8">
                <h5 class="card-admin-text-1">KONSELING</h5>
                <h5 class="card-admin-text-2">{{$rekapKonselings->count()}}</h5>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>

<div class="row mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">Chart</div>
            <div class="card-body">
                <div id="post-chart">

                </div>
                <div id="user-chart">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="width:100%; overflow:auto">
                <table id="table_id" class="table text-dark"> 
                <h3>Pengajuan Konseling</h3>                   
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
        <div class="card">
            <div class="card-body" style="width:100%; overflow:auto">
                <table id="table_id" class="table text-dark">        
                <h3>Laporan Konseling</h3>  
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

@endsection

@push('preview_script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var posts =  <?php echo json_encode($posts_chart) ?>;
    var comments =  <?php echo json_encode($comment_chart) ?>;
   
    Highcharts.chart('post-chart', {
        title: {
            text: 'Grafik Postingan'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Banyak Data'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Post',
            data: posts
        },{
            name: 'Comment',
            data: comments
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>

<script>
    var users =  <?php echo json_encode($role_users) ?>;
    var users2 =  <?php echo json_encode($role_users2) ?>;
    var users3 =  <?php echo json_encode($role_users3) ?>;
    Highcharts.chart('user-chart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Presentase User'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{series.y}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: 'User'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}'
            }
        }
    },
    series: [{
        name: 'Role',
        colorByPoint: true,
        data: [{
            name: 'Siswa',
            y: users
        }, {
            name: 'Guru',
            y: users2
        }, {
            name: 'Admin',
            y: users3
        }]
    }]
});
</script>
@endpush