@extends('guru.layout.app')
@section('title', 'Dashboard')
@section('page', 'Dashboard')
@section('content')

<div class="card">
    <div class="row m-2">
        <div class="col-md-12">
            <h2 class="m-2" style="color:black; font-weight:400">Selamat Datang {{Auth::user()->name}}</h2>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold">Pesan</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <center><p class="card-text" style="font-size:64px">{{$messages->count()}}</p></center>    
                        </div>

                        <div class="col-md-6">
                            <center><i class="fas fa-envelope fa-5x" style="margin-top:8px; margin-left:-10px"></i></center>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold">Butuh Konseling</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <center><p class="card-text" style="font-size:64px">{{$reports->count()}}</p></center>    
                        </div>

                        <div class="col-md-6">
                            <center><i class="fas fa-file fa-5x" style="margin-top:8px; margin-left:-10px"></i></center>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold">Laporan Konseling</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <center><p class="card-text" style="font-size:64px">{{$reportKonseling->count()}}</p></center>    
                        </div>

                        <div class="col-md-6">
                            <center><i class="fas fa-envelope fa-5x" style="margin-top:8px; margin-left:-10px"></i></center>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold">Materi BK</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <center><p class="card-text" style="font-size:64px">13</p></center>    
                        </div>

                        <div class="col-md-6">
                            <center><i class="fas fa-pencil-alt fa-5x" style="margin-top:8px; margin-left:-10px"></i></center>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table">
                <thead class="bg-danger text-white">
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Masalah</th>
                        <th>Alasan</th>
                    </tr>
                </thead>
                <tbody>
                    @if($reports2)
                    @php $no = 1 @endphp
                    @foreach($reports2 as $rp)
                    
                    <tr class="" style="color:black" >
                        <td>{{$no}}</td>
                        <td>{{$rp->post->user->name}}</td>
                        <td>{{$rp->klasifikasi_masalah}}</td>
                        <td>{{$rp->alasan_report}}</td>
                    </tr>
                    @php $no++ @endphp
                   
                    @endforeach

                    {{$reports2->links()}}
                    @else
                    <tr>Tidak ada laporan</tr>
                    @endif
                </tbody>
            </table>
            <center><a href="/guru/reportpost" class="text-dark" style="font-size:16px; text-decoration:none">Lihat Selengkapnya</a></center>
        </div>

        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item active">Pesan Terbaru</li>
                
                @foreach($messages2 as $msg)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{asset('image/user.png')}}" alt="" height="64" width="64" style="border-radius:50%; object-fit:cover">
                        </div>
                        <div class="col-md-9">
                            <h5>{{$msg->sender->name}}</h5>
                            {{$msg->message}}
                        </div>
                    </div>
                </li>
                @endforeach
                
                <center><a href="/guru/messages" class="text-dark" style="font-size:16px; text-decoration:none">Lihat Selengkapnya</a></center>
            </ul>
        </div>

    </div>
</div>

@endsection

@push('preview_script')

@endpush
