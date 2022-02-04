@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content')
<div class="container-fluid py-5">
    <div class="col-sm-12 col-lg-4">
        <form action="{{url('data-laporan')}}">
        <div class="form-floating my-3 d-flex">
                <select class="form-select @error('cari') is-invalid @enderror" id="cari" name="cari" aria-label="tahun_pendaftaran">
                    {{-- <option selected>{{$filter->nama_pendaftaran}}</option> --}}
                    @foreach($data_pendaftaran as $pendaftaran)
                    <option {{($detail_pendaftaran->kode_pendaftaran===$pendaftaran->kode_pendaftaran)?'selected':''}} value="{{$pendaftaran->kode_pendaftaran}}">{{$pendaftaran->nama_pendaftaran}}</option>
                    @endforeach                                          
                </select>
                <label for="cari">Tahun</label>
                @error('cari_tahun_pendaftaran')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <button class="btn btn-primary mx-3" type="submit">Cari</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                    Export
                </button>
            </div>
        </form>
    </div>
    <h1 class="text-center">Laporan Pendaftaran</h1>
    <h2 class="text-center">{{$detail_pendaftaran->nama_pendaftaran}}</h2>
    <div class="row">
        <div class="col-sm-12 col-lg-3 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-primary text-center fw-bolder mycard-title">{{$pendaftar}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Total Pendaftar</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-success text-center fw-bolder mycard-title">{{$daftar_ulang}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Total Daftar Ulang</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-info text-center fw-bolder mycard-title">{{$diterima}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Total Diterima</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-3 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-danger text-center fw-bolder mycard-title">{{$gagal}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Total Ditolak</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h1 class="text-center">Laporan Diterima (Sudah Daftar Ulang)</h1>   
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-2 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-secondary text-center fw-bolder mycard-title">{{$smp}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">SMP</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-secondary text-center fw-bolder mycard-title">{{$mts}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">MTS</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-secondary text-center fw-bolder mycard-title">{{$lain}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Lainnya</p>
                </div>
            </div>
        </div>    
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-2 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-secondary text-center fw-bolder mycard-title">{{$laki}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Laki-Laki</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-secondary text-center fw-bolder mycard-title">{{$perempuan}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Perempuan</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exportModalLabel">Export Data Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>    
        <div class="modal-body">
            <p>Export Data Pendaftaran <b>{{$detail_pendaftaran->nama_pendaftaran}} ({{$detail_pendaftaran->kode_pendaftaran}})</b></p>
        </div>    
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection