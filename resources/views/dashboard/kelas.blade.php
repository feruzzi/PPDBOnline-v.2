@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content')
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
    <h1 class="text-center">Data Kelas</h1>
    <div class="d-flex">
        <button class="ms-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKelas">+ Tambah Kelas</button>
    </div>
    <div class="table-responsive">
        <table class="table table-sm">
          <thead>
              <th>No</th>
              <th>ID Kelas</th>
              <th>Nama Kelas</th>              
              <th>Aksi</th>
          </thead>
          <tbody>
              @foreach($data_kelas as $kelas)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$kelas->kode_kelas}}</td>
                  <td>{{$kelas->nama_kelas}}</td>                  
                  <td>
                    <form action="/data-kelas/{{$kelas->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge btn btn-outline-light border-0" onclick="return confirm('Are you sure you want to delete this ?')"><img src="{{asset('assets/icons/trash.svg')}}" alt=""></button>
                    </form>
                    @include('layouts.partial.view.detail-kelas')
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
    </div>   
    @include('layouts.partial.modal-kelas')               
</div>
@endsection