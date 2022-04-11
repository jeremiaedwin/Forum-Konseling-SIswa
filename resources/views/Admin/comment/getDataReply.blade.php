
    
    <div class="row mt-4">
        <div class="col-md-12">
            <center><img src="{{asset('image/'. $r_comments->user->profile->foto_profil)}}" width="150" height="150" style="border-radius:50%" alt=""></center>
        </div>
        <div class="col-md-12 mt-2" style="border-radius:15px; border-top: 2px solid #7D7AAE; border-bottom: 2px solid #7D7AAE">
        <table class="table" style="color: #3A4058; ">
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>{{$r_comments->user->name}}</td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td>:</td>
                <td><p>{{$r_comments->comment}}</p></td>
            </tr>
            <tr>
                <td>Dibuat Pada</td>
                <td>:</td>
                <td>{{$r_comments->created_at}}</td>
            </tr>
            <tr>
                <td>Sebagai Anonymous</td>
                <td>:</td>
                <td>@if($r_comments->anonymous) {{"Ya"}} @else {{"Tidak"}} @endif</td>
            </tr>
        </table>
        </div>
    </div> 