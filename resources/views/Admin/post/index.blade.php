@extends('admin.layout.app')
@section('title', 'Daftar Posts')
@section('page', 'Daftar Posts')
@section('content')

<div class="card content-card" style="background-color:smokewhite">
    <div class="row">
        <div class="col-md-6">
            <div id="post-chart">

            </div>
        </div>
        <div class="col-md-6">
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
    <div class="card-body">
    <!--    <form action="/admin/post/sortir" method="post">
        {{csrf_field()}}
            <div class="form-group row">
                <div class="col">
                    <select name="category" id="" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $c)
                        <option value="{{$c->id}}">{{$c->category}} ( {{$c->post->count('category_id')}} Post)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4"> 
                    <select name="status_id" id="status" class="form-control">
                        <option value="">Status</option>
                        @foreach($statuses as $s)
                        <option value="{{$s->id}}">{{$s->status}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" id="user" name="user_id">
                        <option value="">User</option>
                        @foreach($users as $u)
                        <option value="{{$u->id}}">{{$u->name}} ( {{$u->post->count('user_id')}} Post)</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form> -->
        <div style="height:500px; overflow:auto;">
            <table id="table_id" class="table table-bordered ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Category</th>
                        <th>Pengirim</th>
                        <th><i class="fas fa-eye"></i></th>
                        <th><i class="fas fa-thumbs-up"></i></th>
                        <th><i class="fas fa-comments"></i></th>
                        <th>Dibuat</th>
                        <th>Disunting</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody style="color:black">
                    @php $no = 1 @endphp
                    @foreach($posts as $p)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$p->title}}</td>
                        <td>{{$p->category->category}}</td>
                        <td>{{$p->user->name}}</td>
                        <td>{{$p->total_visit}}</td>
                        <td>{{$p->like->count('post_id')}}</td>
                        <td>{{$p->comment->count('post_id')}}</td>
                        <td>{{$p->created_at}}</td>
                        <td>{{$p->updated_at}}</td>
                        <td>{{$p->status->status}}</td>
                        <td>
                            <a href="/admin/post/{{$p->id}}" class="update-status btn btn-success btn-sm btn-block"><i class="far fa-eye"></i></a>
                        </td>
                        <td>
                            <form action="/admin/post/delete/{{$p->id}}" method="get">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                                <button type="submit" class="update-status btn btn-danger btn-sm btn-block"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @php $no++ @endphp
                    @endforeach
                </tbody>
            </table>  
        </div>    
    </div>
</div>

@endsection

@push('preview_script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#user').select2();
});
</script>

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
   
    Highcharts.chart('post-chart', {
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