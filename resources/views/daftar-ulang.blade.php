@extends('layouts/main-layout')
@section('title',"$title")
@section('content')
<div class="container p-3">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{$success}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<div class="container">
    <h1 class="text-center">Daftar Ulang</h1>
    <form action="{{url('daftar-ulang/'.$siswa->id.'')}}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <div class="form-floating mb-3">
                    <input readonly type="number" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" placeholder="NISN" value="{{old('nisn',$siswa->nisn)}}">
                    <label for="floatingInput">NISN</label>
                    @error('nisn')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>              
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="form-floating mb-3">
                    <input readonly type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap" value="{{old('nama_siswa',$siswa->nama_siswa)}}">
                    <label for="nama_siswa">Nama Lengkap</label>
                    @error('nama_siswa')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-lg-5">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="NIK" value="{{old('nik')}}">
                    <label for="floatingInput">NIK</label>
                    @error('nik')
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
                    <input readonly type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" placeholder="Asal Sekolah" value="{{old('nama_sekolah',$siswa->nama_sekolah)}}">
                    <label for="floatingInput">Asal Sekolah</label>
                    @error('nama_sekolah')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>              
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" placeholder="NPSN Sekolah" value="{{old('npsn')}}">
                    <label for="npsn">NPSN Sekolah</label>
                    @error('npsn')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="container text-center d-grid">
            <button type="submit" class="btn btn-lg btn-primary">Daftar Ulang</button>
        </div>
    </form>
</div>
@endsection