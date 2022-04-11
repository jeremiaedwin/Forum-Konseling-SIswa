@extends('admin.layout.app')
@section('title', 'Report Posts')
@section('page', 'Report Posts')
@section('content')

<div class="container-fluid text-dark">
    <div class="card">
        <div class="card-header">
            <div class="row">
                
                <div class="col">
                    <a href="/admin/rekap/post/pdf/">Cetak PDF</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Postingan</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark-800">{{$posts->count()}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-dark-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Teratasi</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark-800">{{$posts->where('solved', 1)->count()}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check fa-2x text-dark-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Tidak Teratasi</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark-800">{{$posts->where('solved', 0)->count()}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times fa-2x text-dark-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        Diatasi BK</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark-800">{{$rekapPost->count()}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-dark-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

                    
                <div class="row">               
                    <div class="col-md-6">
                        <div id="chart-post-category">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body">
                                <center>Rincian Kategori</center>
                                    <table class="table">
                                        <thead class="bg-primary" style="color:white">
                                            <tr>
                                                <th>Nama Kategori</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                        @foreach($diagramCategory as $dc)
                                            <tr>                        
                                                <td>{{$dc->category}}</td>
                                                <td>{{$dc->count_category}}</td>                        
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                        <table id="" class="table">
                        <center><h5>Post</h5></center>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Title</th>
                                    <th>Kategori</th>
                                    <th><i class="fas fa-eye"></i></th>
                                    <th><i class="fas fa-thumbs-up"></i></th>
                                    <th><i class="fas fa-comments"></i></th>
                                    <td>Dibuat</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody style="color:black">
                    @php $no = 1 @endphp
                    @foreach($posts as $p)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$p->user->name}}</td>
                        <td>{{$p->title}}</td>
                        <td>{{$p->category->category}}</td>
                        <td>{{$p->total_visit}}</td>
                        <td>{{$p->like->count('post_id')}}</td>
                        <td>{{$p->comment->count('post_id')}}</td>
                        <td>{{$p->created_at}}</td>
                        <td>{{$p->status->status}}</td>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var category =  <?php echo json_encode($countCategory) ?>;
    
    // var series = [],
    // len = name_category.length,
    // i = 0;
    // for(i;i<len;i++){
    //     series.push({
    //         name: i,
    //     });
    //     }
    // len = category.length,
    // i = 0;
    // for(i;i<len;i++){
    //     series.push({
    //         data: i,
    //     });
    //     }
   
    Highcharts.chart('chart-post-category', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Presentase Kategori Post'
    },
    xAxis: {
        categories: {!!json_encode($nameCategory)!!},
        crosshair: true
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0"></td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: {!!json_encode($nameCategory)!!},
        data: category

    }]
});
</script>
@endpush
