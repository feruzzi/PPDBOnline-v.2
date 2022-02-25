<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
    <link rel="stylesheet" href="{{asset('assets/sidebar/sidebars.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mycss.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/trix.css')}}">
    <script type="text/javascript" src="{{asset('assets/js/trix.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('assets/js/ckeditor.js')}}"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script> --}}
    <title>Dashboard | @yield('title')</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">PPDB ONLINE</div>
            <div class="list-group list-group-flush">
                {{-- <a class="list-group-item list-group-item-action list-group-item-light @if($title=='Dashboard') active @endif p-3" href="{{url('/dashboard')}}">Dashboard</a> --}}
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Dashboard")?'active':''}} p-3" href="{{url('/dashboard')}}">Dashboard</a>
                {{-- @if(auth()->user()->is_admin=="1")
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Users")?'active':''}} p-3" href="{{url('/dashboard/users')}}">Data User</a>
                @endif --}}
                @if(auth()->user()->level==0)
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Users")?'active':''}} p-3" href="{{url('/data-users')}}">Data Users</a>
                @endif
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Siswa")?'active':''}} p-3" href="{{url('/data-siswa')}}">Data Siswa</a>
                @if(auth()->user()->level==0)
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Kelas")?'active':''}} p-3" href="{{url('/data-kelas')}}">Data Kelas</a>
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Pendaftaran")?'active':''}} p-3" href="{{url('/data-pendaftaran')}}">Data Pendaftaran</a>
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Pengumuman")?'active':''}} p-3" href="{{url('/data-pengumuman')}}">Data Pengumuman</a>
                @endif
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Seleksi")?'active':''}} p-3" href="{{url('/seleksi')}}">Seleksi</a>
                <a class="list-group-item list-group-item-action list-group-item-light {{($title==="Laporan")?'active':''}} p-3" href="{{url('/data-laporan')}}">Laporan</a>
                {{-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Events</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Profile</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Status</a> --}}
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle"><img src="{{asset('assets/icons/menu.svg')}}" alt=""></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <span>
                                {{-- <img width="32" height="32" src="{{asset(auth()->user()->foto)}}" class="rounded-circle"  alt=""> --}}
                            </span>
                            {{-- <li class="nav-item active"><a class="nav-link" href="#!">Hai, Nama User</a></li>                             --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hai, {{auth()->user()->nama}}</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="#!">Action</a>
                                    <a class="dropdown-item" href="#!">Another action</a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{asset('assets/sidebar/sidebars.js')}}"></script>
<script src="{{asset('assets/js/myjs.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{asset('assets/js/chart.js')}}"></script>
{{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
{{-- <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script> --}}
<script>
    $(document).ready(function() {
    $('#tb_siswa').DataTable();
} );
</script>
<script>
    $(document).ready(function() {
    $('#tb_user_admin').DataTable();
} );
</script>
<script>
    $(document).ready(function() {
    $('#tb_user_siswa').DataTable();
} );
</script>
<script>
    $(document).ready(function() {
    $('#tb_seleksi').DataTable();
} );
</script>
{{-- <script>
    const data = {
  labels: [
    'Red',
    'Blue',
    'Yellow'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [300, 50, 100],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
};

  const config = {
    type: 'doughnut',
    data: data,
    options: {}
  };
  const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
</script>     --}}
       