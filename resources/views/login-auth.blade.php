@extends('layouts/main-layout')
@section('title',"$title")
@section('content')
<div class="container">
    <h3 class="text-center my-3">Login Authentication</h3>
    <div class="d-flex justify-content-center">
        <div class="card shadow my-3" style="width: 48rem;">
            <div class="card-body px-5">
              <form action="{{url('auth')}}" method="post">
                @csrf
                <h3 class="text-center mb-3">Login Authentication</h3>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    <label for="username">Username</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <label for="password">Password</label>
                  </div>
                  <div class="d-flex mb-2">
                      <button type="submit" class="btn btn-primary ms-auto">Login</button>
                </div>                
              </form>
            </div>
          </div>
    </div>
</div>
@endsection