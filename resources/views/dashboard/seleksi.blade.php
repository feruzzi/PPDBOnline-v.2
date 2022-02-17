@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content')
@php
@endphp
<div class="container-fluid">
    <h1 class="text-center p-3">Seleksi</h1>
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
            <form action="{{url('seleksi')}}">
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
                    <button class="btn btn-primary d-inline mx-3" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <h1 class="text-center">Seleksi</h1>
        <h2 class="text-center">{{$detail_pendaftaran->nama_pendaftaran}}</h2>
        <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                  <th>No</th>
                  <th>Kode_Kelas</th>
                  <th>Kuota</th>                                
              </thead>
              <tbody>
                  @foreach($data_kelas as $kelas)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$kelas->detail_kode_kelas}}</td>
                      <td>{{$kelas->kuota}}</td>                     
                    </tr>
                    @php
                    $kelas_[$kelas->detail_kode_kelas] =$kelas;
                    @endphp
                    @endforeach
                </tbody>
            </table>                                                    
        </div>
        <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                  <th>No</th>
                  <th>ID Pendaftaran</th>
                  <th>NISN</th>              
                  <th>Nama</th>              
                  <th>Pilihan 1</th>              
                  <th>Pilihan 2</th>              
                  <th>Skor</th>
                  <th>Rekomendasi</th>              
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
                          @php
                          $tmp_pilihan=$siswa->pilihan_1;
                          if($tmp_pilihan==$kelas_[$siswa->pilihan_1]->detail_kode_kelas){
                              if($kelas_[$siswa->pilihan_1]->kuota>0){
                                $kelas_[$siswa->pilihan_1]->kuota--;
                                $tmp_pilihan=$siswa->pilihan_1;
                              }else{
                                  $tmp_pilihan=$siswa->pilihan_2;
                              }
                          }
                          if($tmp_pilihan==$kelas_[$siswa->pilihan_2]->detail_kode_kelas){
                              if($kelas_[$siswa->pilihan_2]->kuota>0){
                                $kelas_[$siswa->pilihan_2]->kuota--;
                                $tmp_pilihan=$siswa->pilihan_2;
                              }else{
                                  $tmp_pilihan="Gagal";
                              }
                          }                            
                          @endphp 
                          @if($tmp_pilihan=="Gagal")
                          <td class="text-danger fw-bold">{{$tmp_pilihan}}</td>
                          @else       
                          <td class="text-success fw-bold">{{$tmp_pilihan}}</td>       
                          @endif        
                      <td>        
                        <form action="/data-siswa/verify/seleksi" method="post" class="d-inline">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id[]" value="{{$siswa->id}}">
                            <select class="form-select @error('hasil_seleksi') is-invalid @enderror" id="hasil_seleksi" name="hasil_seleksi[]" aria-label="hasil_seleksi" value="{{old('hasil_seleksi')}}">
                                <option style="color:red" selected value="{{$tmp_pilihan}}">{{$tmp_pilihan}}</option>
                                <option value="{{old('hasil_seleksi',$siswa->status_seleksi)}}">{{old('hasil_seleksi',$siswa->status_seleksi)}}</option>
                                <option value="{{$siswa->pilihan_1}}">{{$siswa->pilihan_1}}</option>
                                <option value="{{$siswa->pilihan_2}}">{{$siswa->pilihan_2}}</option>                
                                <option value="Gagal">Gagal</option>                
                            </select>
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
            <div class="d-flex justify-content-end">
                {{$data_siswa->links()}}
            </div>
            <button class="badge btn btn-success border-0" onclick="return confirm('Yakin Seleksi ?')"><img src="{{asset('assets/icons/check-circle.svg')}}" alt="">Seleksi</button>
                </form>                                              
        </div> 
    </div>
</div>
@endsection