@extends('layouts/main-layout')
@section('title',"$title")
@section('content')
<div class="container">  
    <h3 class="text-center my-3">Reset Password</h3>
    <div class="d-flex justify-content-center">
        <div class="card shadow my-3" style="width: 48rem;">
            <div class="card-body px-5">
              <form action="{{url('reset-password/'.$data_user->id)}}" method="post">
                @method('put')
                @csrf
                <h3 class="text-center mb-3">Reset Password</h3>
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
                    <input type="text" class="form-control" id="username" name="username" readonly placeholder="Username" value="{{$data_user->username}}">
                    <label for="username">Username</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru">
                    <label for="password">Password Baru</label>
                  </div>
                  <div class="d-flex mb-2">
                      <button type="submit" class="btn btn-primary ms-auto">Reset</button>
                </div>                
              </form>
            </div>
          </div>
    </div>
</div>
@endsection