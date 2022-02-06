@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content') 
<body onload="myDonut('myChart');myDonut('myChart1')">
    
    <div class="container-fluid">
        {{-- Grafik  --}}
        {{-- <canvas id="myChart" style="width:100%;max-width:512px;height:100%;max-height:512px"></canvas> --}}
        {{-- <button class="btn btn-primary" onload="myDonut('myChart')">Klik</button> --}}
        {{-- <canvas id="myChart1" style="width:100%;max-width:512px;height:100%;max-height:512px"></canvas> --}}
        {{-- grafik end  --}}
        <h1 class="text-center py-3">Dashboard</h1>
        <div class="row">
            <div class="col-sm-12 col-lg-6 py-3">
                <div class="card shadow border border-5">
                    <h1 class="text-{{($pendaftaran->kode_pendaftaran=="TUTUP")?'danger':'primary'}} text-center fw-bolder">{{$pendaftaran->kode_pendaftaran}}</h1>
                    <h5 class="text-center text-{{($pendaftaran->kode_pendaftaran=="TUTUP")?'danger':'primary'}}">{{$pendaftaran->nama_pendaftaran}}</h5>
                    <div class="card-body">
                      <p class="card-text text-center fw-bolder fs-3">Status Sistem PPDB</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 py-3">
                <div class="card shadow border border-5">
                    <h1 class="text-warning text-center fw-bolder">{{$pengumuman->kode_pengumuman}}</h1>
                    <h5 class="text-warning text-center"> {{$pengumuman->nama_pengumuman}}</h5>
                    <div class="card-body">
                      <p class="card-text text-center fw-bolder fs-3">Status Pengumuman PPDB</p>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-sm-12 col-lg-12 py-3">
            <div class="card shadow border border-5">
                <h1 class="text-info text-center fw-bolder mycard-title">{{$kuota}}</h1>
                <div class="card-body">
                  <p class="card-text text-center fw-bolder fs-3">Jumlah Kouta Dibuka</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <h1>Ketersediaan Kelas</h1>
            @foreach($data_kelas as $kelas)
            <div class="col-sm-12 col-lg-3 py-3">
                <div class="card shadow border border-5">
                    <h1 class="text-info text-center fw-bolder">{{$kelas->kelas->kode_kelas}}</h1>                    
                    <h1 class="text-info text-center fw-bolder">{{$kelas->kuota}}</h1>                    
                    <div class="card-body">
                      <p class="card-text text-center fw-bolder fs-3">{{$kelas->kelas->nama_kelas}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
@endsection