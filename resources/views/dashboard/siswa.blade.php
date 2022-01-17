@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content')
@php
@endphp
<div class="container-fluid">
    <div class="container px-5 my-3">
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
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <form action="{{url('data-siswa')}}">
            <div class="form-floating my-3 d-flex">
                    <select class="form-select @error('cari') is-invalid @enderror" id="cari" name="cari" aria-label="tahun_pendaftaran">
                        <option selected>{{$filter->nama_pendaftaran}}</option>
                        @foreach($data_pendaftaran as $pendaftaran)
                        <option value="{{$pendaftaran->kode_pendaftaran}}">{{$pendaftaran->nama_pendaftaran}}</option>
                        @endforeach                                          
                    </select>
                    <label for="cari">Tahun</label>
                    @error('cari_tahun_pendaftaran')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    <button class="btn btn-primary d-inline mx-3" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-sm display nowrap" id="tb_siswa">
              <thead>
                  <th>No</th>
                  <th>ID Pendaftaran</th>
                  <th>NISN</th>              
                  <th>Nama</th>              
                  <th>Pilihan 1</th>              
                  <th>Pilihan 2</th>              
                  <th>Skor</th>              
                  <th>Aksi</th>
                  <th>Status</th>
              </thead>
              <tbody>
                  @foreach($data_siswa as $siswa)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$siswa->id_pendaftaran}}</td>
                      <td>{{$siswa->nisn}}</td>
                      <td>{{$siswa->nama_siswa}}</td>                  
                      <td>{{$siswa->pilihan_1}}</td>
                      <td>{{$siswa->pilihan_2}}</td>                                   
                      <td>{{$siswa->total}}</td>                                        
                      <td>
                        <form action="/data-siswa/{{$siswa->id}}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge btn btn-outline-light border-0" onclick="return confirm('Are you sure you want to delete this ?')"><img src="{{asset('assets/icons/trash.svg')}}" alt=""></button>
                        </form>
                        @include('layouts.partial.view.detail-siswa')
                      </td>
                      <td class="align-middle">
                        @if($siswa->status_seleksi=="Diterima")
                        <h5><span class="badge bg-success">{{$siswa->status_seleksi}}</span></h5>
                        @elseif($siswa->status_seleksi=="Seleksi")
                        <h5><span class="badge bg-secondary">{{$siswa->status_seleksi}}</span></h5>
                        @elseif($siswa->status_seleksi=="Terverifikasi")
                        <h5><span class="badge bg-info">{{$siswa->status_seleksi}}</span></h5>
                        @elseif($siswa->status_seleksi=="Gagal")
                        <h5><span class="badge bg-danger">{{$siswa->status_seleksi}}</span></h5>
                        @else
                        <h5><span class="badge bg-success">Diterima {{$siswa->status_seleksi}}</span></h5>
                        @endif
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
        </div> 
    </div>
</div>
@endsection