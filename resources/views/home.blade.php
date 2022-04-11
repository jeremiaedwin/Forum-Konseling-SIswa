@if(Auth::user()->tahun_keluar == date("Y"))
<h1>{{"Akun Anda Sudah Kadaluarsa"}}</h1>

@else

@if(Auth::user()->role == "guru")
<script type="text/javascript">
window.location.href = '{{url("guru/dashboard")}}';
</script>

@elseif(Auth::user()->role == "siswa")
<script type="text/javascript">
window.location.href = '{{url("/dashboard/siswa")}}';
</script>

@else(Auth::user()->role == "admin")
<script type="text/javascript">
window.location.href = '{{url("admin/dashboard")}}';
</script>

@endif
@endif

