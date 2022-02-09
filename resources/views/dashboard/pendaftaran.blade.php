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
  <h1 class="text-center">Data Pendaftaran</h1>
  <div class="d-flex">
      <button class="ms-auto btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalTambahPendaftaran">+ Tambah Data</button>
  </div>
  <div class="table-responsive">
      <table class="table table-sm">
        <thead>
            <th>No</th>
            <th>Kode Pendaftaran</th>
            <th>Nama Pendaftaran</th>
            <th>Kelas</th>              
            <th>Aksi</th>
            <th>Daftar Ulang</th>
            <th>Status</th>
        </thead>
        <tbody>
          @foreach($data_pendaftaran as $pendaftaran)
            <tr>
                <td class="align-middle">{{$loop->iteration}}</td>
                <td class="align-middle">{{$pendaftaran->kode_pendaftaran}}</td>
                <td class="align-middle">{{$pendaftaran->nama_pendaftaran}}</td>
                <td class="align-middle">
                @foreach($data_detail_pendaftaran as $detail_pendaftaran)
                  @if($detail_pendaftaran->detail_kode_pendaftaran==$pendaftaran->kode_pendaftaran)
                {{$detail_pendaftaran->kelas->nama_kelas}} <br> 
                  @endif
                @endforeach  
                </td>                  
                <td class="align-middle">
                @if($pendaftaran->kode_pendaftaran==$data_set_daftar)
                <form action="/set-tutup" method="post" class="d-inline">
                  @method('put')
                  @csrf
                  <button class="badge btn btn-outline-light border-0" onclick="return confirm('Pendaftaran {{$pendaftaran->kode_pendaftaran}} Akan ditutup ?')"><img src="{{asset('assets/icons/unlock-blue.svg')}}" alt=""></button>
              </form>
                @else
                <form action="/set-daftar/{{$pendaftaran->id}}" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <button class="badge btn btn-outline-light border-0" onclick="return confirm('Pendaftaran {{$pendaftaran->kode_pendaftaran}} Akan dibuka ?')"><img src="{{asset('assets/icons/lock-red.svg')}}" alt=""></button>
                </form>
                @endif
                <form action="/data-pendaftaran/{{$pendaftaran->id}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge btn btn-outline-light border-0" onclick="return confirm('Yakin Akan Hapus Data Pendafataran ?')"><img src="{{asset('assets/icons/trash.svg')}}" alt=""></button>
                </form>                
                  @include('layouts.partial.view.detail-pendaftaran')
                </td>
                {{-- DU option --}}
                <td>
                @if($pendaftaran->kode_pendaftaran==$data_set_du)
                <form action="/set-du-tutup" method="post" class="d-inline">
                  @method('put')
                  @csrf
                  <button class="badge btn btn-outline-light border-0" onclick="return confirm('Daftar Ulang {{$pendaftaran->kode_pendaftaran}} Akan ditutup ?')"><img src="{{asset('assets/icons/toggle-right.svg')}}" alt=""> Buka</button>
              </form>
                @else
                <form action="/set-du-buka/{{$pendaftaran->id}}" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <button class="badge btn btn-outline-light border-0" onclick="return confirm('Daftar Ulang {{$pendaftaran->kode_pendaftaran}} Akan dibuka ?')"><img src="{{asset('assets/icons/toggle-left.svg')}}" alt=""> Tutup</button>
                </form>
                @endif
                </td>
                {{-- DU end  --}}
                <td class="align-middle">
                  @if($pendaftaran->kode_pendaftaran==$data_set_daftar)
                  <h5><span class="badge bg-success">Sedang Dibuka</span></h5>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @include('layouts.partial.modal-pendaftaran')               
  </div>   
  <form action="/set-tutup" method="post" class="d-inline">
  <div class="d-flex">
      @method('put')
      @csrf
      <button class="ms-auto btn btn-danger" onclick="return confirm('Yakin Tutup Pendaftaran ?')"><img src="{{asset('assets/icons/lock.svg')}}" alt=""> Tutup Pendaftaran</button>
    </div>
  </form>
</div>
@endsection