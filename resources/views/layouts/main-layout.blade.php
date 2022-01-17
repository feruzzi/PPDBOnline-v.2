<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
    <link rel="stylesheet" href="{{asset('assets/offcanvas/offcanvas.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mycss.css')}}">
    <title>DEMO PPDB ONLINE | @yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light" aria-label="Main navigation">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">PPDB ONLINE</a>
          <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>      
          <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold">
              <li class="nav-item">
                <a class="nav-link {{($title==="Home")?'active':''}}" aria-current="page" href="{{url('/')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{($title==="Pendaftaran")?'active':''}}" href="{{url('/pendaftaran')}}">Pendaftaran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{($title==="Pengumuman")?'active':''}}" href="{{url('/pengumuman')}}">Pengumuman</a>
              </li>
              @if(Auth::check())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Hai, {{auth()->user()->nama}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                  
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/logout-siswa')}}">Logout</a>
                  </li>   
                </ul>
              </li>
              @elseif(!Auth::check())
              <li class="nav-item">
                <a class="nav-link {{($title==="Login")?'active':''}}" href="{{url('/login-siswa')}}">Login</a>
              </li>   
              @endif           
            </ul>            
          </div>
        </div>
      </nav>
    @yield('content')   
    <div class="footer">
      {{-- <p>Footer</p> --}}
      <div class="b-example-divider"></div>               
      <p class="text-muted text-center">© 2021 FRZ | Syntax Error</p>       
    </div>
    
    
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{asset('assets/offcanvas/offcanvas.js')}}"></script>
<script src="{{asset('assets/js/myjs.js')}}"></script>