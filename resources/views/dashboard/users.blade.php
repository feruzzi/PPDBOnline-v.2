@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-center my-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="user-admin-tab" data-bs-toggle="pill" data-bs-target="#user-admin" type="button" role="tab" aria-controls="user-admin" aria-selected="true">Admin</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="user-siswa-tab" data-bs-toggle="pill" data-bs-target="#user-siswa" type="button" role="tab" aria-controls="user-siswa" aria-selected="false">Siswa</button>
            </li>        
          </ul>
    </div>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="user-admin" role="tabpanel" aria-labelledby="user-admin-tab">
            <div class="container-fluid my-3 px-5">
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
                <div class="d-flex">
                    <button class="ms-auto btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahUser">+ Tambah Data</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm display" id="tb_user_admin">
                      <thead>
                          <th>No</th>
                          <th>Nama User</th>
                          <th>Username</th>
                          <th>Last Edited</th>
                          <th>Aksi</th>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$user->nama}}</td>
                              <td>{{$user->username}}</td>
                              <td>{{$user->updated_at}}</td>
                              <td class="text-center">
                                {{-- <a href="/data-dataUsers/{{$user->id}}" class="text-decoration-none myicon rounded-circle p-1">
                                <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
                              </a> --}}
                              <form action="/data-users/{{$user->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge btn btn-outline-light border-0" onclick="return confirm('Are you sure you want to delete this ?')"><img src="{{asset('assets/icons/trash.svg')}}" alt=""></button>
                            </form>
                              @include('layouts.partial.view.detail-users')
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>   
                {{-- @include('layouts.partial.modal-user')                --}}
            </div>
        </div>
        <div class="tab-pane fade" id="user-siswa" role="tabpanel" aria-labelledby="user-siswa-tab">
          <div class="container-fluid my-3 px-5">
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
                <div class="d-flex">
                    <button class="ms-auto btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahUserSiswa">+ Tambah Data</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm display" id="tb_user_siswa">
                      <thead>
                          <th>No</th>
                          <th>Nama User</th>
                          <th>Username</th>
                          <th>Last Edited</th>
                          <th>Aksi</th>
                          <th>Status</th>
                      </thead>
                      <tbody>
                        @foreach ($siswa as $user)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$user->nama}}</td>
                              <td>{{$user->username}}</td>
                              <td>{{$user->updated_at}}</td>
                              <td class="text-start">
                                {{-- <a href="/data-dataUsers/{{$user->id}}" class="text-decoration-none myicon rounded-circle p-1">
                                <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
                              </a> --}}
                              <form action="/data-users/{{$user->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge btn btn-outline-light border-0" onclick="return confirm('Are you sure you want to delete this ?')"><img src="{{asset('assets/icons/trash.svg')}}" alt=""></button>
                            </form>
                              @include('layouts.partial.view.detail-users-siswa')
                              </td>
                              <td class="align-middle">
                                @if($user->email_verified_at)
                                <h5><span class="badge bg-success">Verified</span></h5>
                                @endif
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>   
              </div>  
            </div>        
          </div>
        </div>
        @include('layouts.partial.modal-user')               
@endsection