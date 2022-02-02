@extends('layouts/main-layout')
@section('title',"$title")
@section('content')
<div class="container">  
    <h3 class="text-center my-3">Login Siswa</h3>
    <div class="d-flex justify-content-center">
        <div class="card shadow my-3" style="width: 48rem;">
            <div class="card-body px-5">
              <form action="{{url('auth-siswa')}}" method="post">
                @csrf
                <h3 class="text-center mb-3">Login Siswa</h3>
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session()->has('update'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{session('update')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('delete')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    <label for="username">Username</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                  </div>
                  <div class="d-flex mb-2">
                      <button type="submit" class="btn btn-primary ms-auto">Login</button>
                </div>
                <div class="d-flex"> 
                  <a id="lupa-password" data-bs-toggle="modal" href="#modalLupaPassword">Lupa Password</a>                     
                  <a id="daftar-akun" data-bs-toggle="modal" href="#modalDaftarAkun" class="ms-auto">Belum Punya Akun ?</a>                    
                  </div>
              </form>
            </div>
          </div>
    </div>
</div>
<div class="modal fade" id="modalDaftarAkun" tabindex="-1" aria-labelledby="modalDaftarAkunLabel" aria-hidden="true"> <!-- Modal Daftar AKun-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDaftarAkunLabel">Daftar Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/register" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{old('nama')}}">
                <label for="floatingInput">Nama</label>
                @error('nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{old('email')}}">
                <label for="floatingInput">Email <sub class="text-danger">(wajib Email Aktif)</sub></label>
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{old('username')}}">
                <label for="floatingInput">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <label for="floatingInput">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><img src="{{asset('assets/icons/save.svg')}}" alt=""> Daftar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLupaPassword" tabindex="-1" aria-labelledby="modalLupaPasswordLabel" aria-hidden="true"> <!-- Modal Lupa Passowrd-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLupaPasswordLabel">Lupa Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/lupa-password" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-12 col-lg-12">
              <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{old('email')}}">
                <label for="floatingInput">Email <sub class="text-danger">(Email yang didaftarkan)</sub></label>
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><img src="{{asset('assets/icons/save.svg')}}" alt=""> Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection