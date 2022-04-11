<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0-10/css/all.css" integrity="sha512-Dj9pt3sZROOuTTs9S89ykGZeu1XQgWKg3DVpu5tZALApsrWdd3tnVjTclUuVONaHM4O8GgCnjSbHlTKXrd2OWg==" crossorigin="anonymous" />

    <title>Login</title>
  </head>
  <body>
  <div class="kotak">
    <div class="kotak-login">
      <div class="row">
        <div class="col-md-6">
          <div class="teks-login">
            <h3>LOGIN</h3>
            <h5>WEB FORUM KONSELING SEBELAS</h5>
            
          </div>
          <div class="kotak-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Masukan Email Mu">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Masukan Password Mu">
              </div>
              <a href="{{ route('register') }}" class="link-register"><p
                >Belum Punya Akun? Daftar Sekarang</p></a>
              <!-- <button class="tombol-sign-in">Sign In</button> -->
                <button type="submit" class="tombol-sign-in">
                                    {{ __('Login') }}
                </button>
            </form>
          </div>
        </div>

        <div class="col-md-6">
          <img src="{{asset('image\bannerLogin.jpg')}}" class="gambar-login" width="385px" height="405px">
        </div>
      </div>
    </div>
  </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).ready(function () {

    if (screen.width < 600) {
        $(".gambar-login").hide();
    }
      });

    </script>
  </body>
</html>