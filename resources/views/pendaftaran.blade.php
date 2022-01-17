@extends('layouts/main-layout')
@section('title',"$title")
@section('content')
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
<div class="container nav-pendaftaran mt-3">
  <ul class="d-flex justify-content-center nav nav-pills mt-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="data-diri-tab" data-bs-toggle="pill" data-bs-target="#data-diri" type="button" role="tab" aria-controls="data-diri" aria-selected="true">Data Diri</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="data-ortu-tab" data-bs-toggle="pill" data-bs-target="#data-ortu" type="button" role="tab" aria-controls="data-ortu" aria-selected="false">Data Orang Tua</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="data-nilai-tab" data-bs-toggle="pill" data-bs-target="#data-nilai" type="button" role="tab" aria-controls="data-nilai" aria-selected="false">Data Nilai</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="data-kelas-tab" data-bs-toggle="pill" data-bs-target="#data-kelas" type="button" role="tab" aria-controls="data-kelas" aria-selected="false">Pilih Kelas</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="data-berkas-tab" data-bs-toggle="pill" data-bs-target="#data-berkas" type="button" role="tab" aria-controls="data-berkas" aria-selected="false">Upload Berkas</button>
    </li>
  </ul>
</div>
<div class="container content-pendaftaran tab-content" id="pills-tabContent">
  {{-- Data Diri --}}
  <div class="tab-pane fade show active" id="data-diri" role="tabpanel" aria-labelledby="data-diri-tab">
    <h3 class="text-start">Data Siswa</h3>
    <hr>
    <form action="{{url('submit/daftar')}}" method="post" enctype="multipart/form-data">
    <div class="row">
      @csrf      
      <div class="col-sm-12 col-lg-3">
        <div class="text-center">
          <label for="foto">
            <img style="width: 128px; height:128px;display:none" for="foto" class="rounded mx-auto d-block img-preview-foto img-fluid border border-primary p-2" alt="Foto" src="{{asset('assets/icons/plus-square.svg')}}">
          </label>
        </div>
        <div class="mb-3 text-center">
          <label for="foto" class="form-label">Foto</label>
          <input class="form-control form-control-sm @error('foto') is-invalid @enderror" id="foto" name="foto" type="file" onchange="previewImage('foto')">
          @error('foto')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
          <span class="form-text">
            Format File (Jpg, Png, Jpeg. Max: 1024Kbps)
          </span>
        </div>
      </div>
      {{-- Start Sisi Kanan Data Diri --}}
      <div class="col-sm-12 col-lg-9">
        <div class="form-floating mb-3">
          <input type="number" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" placeholder="NISN" value="{{old('nisn')}}">
          <label for="floatingInput">NISN</label>
          @error('nisn')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap" value="{{old('nama_siswa')}}">
          <label for="nama_siswa">Nama Lengkap</label>
          @error('nama_siswa')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
        </div>
        <div class="form-group mb-3">
          <label for="j_kelamin">Jenis Kelamin</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="j_kelamin" id="Laki-Laki" value="Laki-Laki" @if(old('j_kelamin')=="Laki-Laki") checked @endif>
            <label class="form-check-label" for="Laki-Laki">
              Laki-Laki
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="j_kelamin" id="Perempuan"  value="Perempuan" @if(old('j_kelamin')=="Perempuan") checked @endif>
            <label class="form-check-label" for="Perempuan">
             Perempuan
            </label>
          </div>
          @error('j_kelamin')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
        </div>
        <div class="row">
          <div class="col-sm-12 col-lg-8">
            <div class="form-floating mb-3">
              <input type="text" class="form-control @error('t_lahir') is-invalid @enderror" id="t_lahir" name="t_lahir" placeholder="Tempat Lahir" value="{{old('t_lahir')}}">
              <label for="t_lahir">Tempat Lahir</label>
              @error('t_lahir')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-sm-12 col-lg-4">
            <div class="form-floating mb-3">
              <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" value="{{old('tgl_lahir')}}">
              <label for="tgl_lahir">Tanggal Lahir</label>
              @error('tgl_lahir')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-floating mb-3">
          <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama" aria-label="Agama" value="{{old('agama')}}">
            <option selected value="{{old('agama',"")}}">{{old('agama',"Pilih")}}</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katholik">Katholik</option>
            <option value="Hindhu">Hindhu</option>
            <option value="Budha">Budha</option>
          </select>
          <label for="agama">Agama</label>
          @error('agama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
        </div>
        <div class="form-floating mb-3">
          <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Lengkap" id="alamat" name="alamat">{{old('alamat')}}</textarea>
          <label for="alamat">Alamat Lengkap</label>
          @error('alamat')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
        </div>
        <div class="form-floating mb-3">
          <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" placeholder="No Hp" value="{{old('no_hp')}}">
          <label for="no_hp">Nomor HP/WA</label>
          @error('no_hp')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
        </div>
        <div class="row">
          <div class="col-sm-12 col-lg-3">
            <div class="form-floating mb-3">
              <select class="form-select @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah" aria-label="asal_sekolah" value="{{old('asal_sekolah')}}">
                <option selected value="{{old('asal_sekolah',"")}}">{{old('asal_sekolah',"Pilih")}}</option>
                <option value="SMP">SMP</option>
                <option value="MTs">MTs</option>                
                <option value="Lainnya">Lainnya</option>                
              </select>
              <label for="asal_sekolah">Asal Sekolah</label>
              @error('asal_sekolah')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror
            </div>
          </div>
          <div class="col-sm-12 col-lg-9">
            <div class="form-floating mb-3">
              <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah" value="{{old('nisn')}}">
              <label for="nama_sekolah">Nama Sekolah</label>
              @error('nama_sekolah')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
      {{-- End Sisi kanan Data Diri --}}
    </div>
  </div>
  <div class="tab-pane fade" id="data-ortu" role="tabpanel" aria-labelledby="data-ortu-tab">
    <div class="container mb-3"> <!--Data Ayah-->
      <h3 class="text-start">Data Ayah</h3>
      <hr>
      <div class="row">
        <div class="col-sm-12 col-lg-6">
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" value="{{old('nama_ayah')}}">
            <label for="floatingInput">Nama Ayah</label>
            @error('nama_ayah')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-6">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('hp_ayah') is-invalid @enderror" id="hp_ayah" name="hp_ayah" placeholder="Nomor HP Ayah" value="{{old('hp_ayah')}}">
            <label for="floatingInput">Nomor HP Ayah</label>
            @error('hp_ayah')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <select class="form-select @error('pendidikan_ayah') is-invalid @enderror" id="pendidikan_ayah" name="pendidikan_ayah" aria-label="Pendidikan Ayah" value="{{old('pendidikan_ayah')}}">
              <option selected value="{{old('pendidikan_ayah',"")}}">{{old('pendidikan_ayah',"Pilih")}}</option>
              <option value="Tidak Sekolah">Tidak Sekolah</option>
              <option value="SD/MI">SD/MI</option>
              <option value="SMP/MTs">SMP/MTs</option>
              <option value="SMA/SMK/MA">SMA/SMK/MA</option>
              <option value="Diploma">Diploma</option>
              <option value="S1">S1</option>
              <option value="S2">S2</option>
              <option value="S3">S3</option>
            </select>
            <label for="pendidikan_ayah">Pendidikan Ayah</label>
            @error('pendidikan_ayah')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <select class="form-select @error('pekerjaan_ayah') is-invalid @enderror" id="pekerjaan_ayah" name="pekerjaan_ayah" aria-label="Pekerjaan Ayah" value="{{old('pekerjaan_ayah')}}">
              <option selected value="{{old('pekerjaan_ayah',"")}}">{{old('pekerjaan_ayah',"Pilih")}}</option>
              <option value="Buruh">Buruh</option>
              <option value="Tani">Tani</option>
              <option value="Wiraswasta">Wiraswasta</option>
              <option value="PNS">PNS</option>
              <option value="TNI/Polri">TNI/Polri</option>
              <option value="Perangkat Desa">Perangkat Desa</option>
              <option value="Nelayan">Nelayan</option>
              <option value="Lainnya">Lainnya</option>
            </select>
            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
            @error('pekerjaan_ayah')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <select class="form-select @error('penghasilan_ayah') is-invalid @enderror" id="penghasilan_ayah" name="penghasilan_ayah" aria-label="Penghasilan Ayah" value="{{old('penghasilan_ayah')}}">
              <option selected value="{{old('penghasilan_ayah',"")}}">{{old('penghasilan_ayah',"Pilih")}}</option>
              <option value="-500rb">-500rb</option>
              <option value="500rb-1jt">500rb-1jt</option>
              <option value="1jt-3jt">1jt-3jt</option>
              <option value="3jt-5jt">3jt-5jt</option>
              <option value="5jt-10jt">5jt-10jt</option>
              <option value="10jt++">10jt++</option>           
            </select>
            <label for="penghasilan_ayah">Penghasilan Ayah</label>
            @error('penghasilan_ayah')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="container"> <!-- Data Ibu -->
      <div class="row">
        <h3 class="text-start">Data Ibu</h3>
        <hr>
        <div class="col-sm-12 col-lg-6">
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" value="{{old('nama_ibu')}}">
            <label for="floatingInput">Nama Ibu</label>
            @error('nama_ibu')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-6">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('hp_ibu') is-invalid @enderror" id="hp_ibu" name="hp_ibu" placeholder="Nomor HP Ibu"value="{{old('hp_ibu')}}">
            <label for="floatingInput">Nomor HP Ibu</label>
            @error('hp_ibu')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <select class="form-select @error('pendidikan_ibu') is-invalid @enderror" id="pendidikan_ibu" name="pendidikan_ibu" aria-label="Pendidikan Ibu" value="{{old('pendidikan_ibu')}}">
              <option selected value="{{old('pendidikan_ibu',"")}}">{{old('pendidikan_ibu',"Pilih")}}</option>
              <option value="Tidak Sekolah">Tidak Sekolah</option>
              <option value="SD/MI">SD/MI</option>
              <option value="SMP/MTs">SMP/MTs</option>
              <option value="SMA/SMK/MA">SMA/SMK/MA</option>
              <option value="Diploma">Diploma</option>
              <option value="S1">S1</option>
              <option value="S2">S2</option>
              <option value="S3">S3</option>
            </select>
            <label for="pendidikan_ibu">Pendidikan Ibu</label>
            @error('pendidikan_ibu')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <select class="form-select @error('pekerjaan_ibu') is-invalid @enderror" id="pekerjaan_ibu" name="pekerjaan_ibu" aria-label="Pekerjaan Ibu" value="{{old('pekerjaan_ibu')}}">
              <option selected value="{{old('pekerjaan_ibu',"")}}">{{old('pekerjaan_ibu',"Pilih")}}</option>
              <option value="Buruh">Buruh</option>
              <option value="Tani">Tani</option>
              <option value="Wiraswasta">Wiraswasta</option>
              <option value="PNS">PNS</option>
              <option value="TNI/Polri">TNI/Polri</option>
              <option value="Perangkat Desa">Perangkat Desa</option>
              <option value="Nelayan">Nelayan</option>
              <option value="Lainnya">Lainnya</option>
            </select>
            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
            @error('pekerjaan_ibu')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <select class="form-select @error('penghasilan_ibu') is-invalid @enderror" id="penghasilan_ibu" name="penghasilan_ibu" aria-label="Penghasilan Ibu" value="{{old('penghasilan_ibu')}}">
              <option selected value="{{old('penghasilan_ibu',"")}}">{{old('penghasilan_ibu',"Pilih")}}</option>
              <option value="-500rb">-500rb</option>
              <option value="500rb-1jt">500rb-1jt</option>
              <option value="1jt-3jt">1jt-3jt</option>
              <option value="3jt-5jt">3jt-5jt</option>
              <option value="5jt-10jt">5jt-10jt</option>
              <option value="10jt++">10jt++</option>           
            </select>
            <label for="penghasilan_ibu">Penghasilan Ibu</label>
            @error('penghasilan_ibu')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="data-nilai" role="tabpanel" aria-labelledby="data-nilai-tab">
    <div class="container mb-3">
      <div class="row">
        <h3 class="text-start">Nilai Ujian Nasional SD</h3>
        <hr>
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('nilai_bindo') is-invalid @enderror" id="nilai_bindo" name="nilai_bindo" placeholder="Nilai Bahasa Indonesia" value="{{old('nilai_bindo')}}">
            <label for="floatingInput">Nilai Bahasa Indonesia</label>
            @error('nilai_bindo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('nilai_matematika') is-invalid @enderror" id="nilai_matematika" name="nilai_matematika" placeholder="Nilai Matematika" value="{{old('nilai_matematika')}}">
            <label for="floatingInput">Nilai Matematika</label>
            @error('nilai_matematika')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-4">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('nilai_ipa') is-invalid @enderror" id="nilai_ipa" name="nilai_ipa" placeholder="Nilai Ilmu Pengetahuan Alam" value="{{old('nilai_ipa')}}">
            <label for="floatingInput">Nilai Ilmu Pengetahuan Alam</label>
            @error('nilai_ipa')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <h3 class="text-start">Rapot SMP/MTs</h3>
        <hr>
        <div class="col-sm-12 col-lg-3">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('rapot_bindo') is-invalid @enderror" id="rapot_bindo" name="rapot_bindo" placeholder="Nilai Bahasa Indonesia" value="{{old('rapot_bindo')}}">
            <label for="floatingInput">Nilai Bahasa Indonesia</label>
            @error('rapot_bindo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-3">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('rapot_matematika') is-invalid @enderror" id="rapot_matematika" name="rapot_matematika" placeholder="Nilai Matematika" value="{{old('rapot_matematika')}}">
            <label for="floatingInput">Nilai Matematika</label>
            @error('rapot_matematika')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-3">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('rapot_ipa') is-invalid @enderror" id="rapot_ipa" name="rapot_ipa" placeholder="Nilai Ilmu Pengetahuan Alam" value="{{old('rapot_ipa')}}">
            <label for="floatingInput">Nilai Ilmu Pengetahuan Alam</label>
            @error('rapot_ipa')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm-12 col-lg-3">
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('rapot_bing') is-invalid @enderror" id="rapot_bing" name="rapot_bing" placeholder="Nilai Bahasa Inggris" value="{{old('rapot_bing')}}">
            <label for="floatingInput">Nilai Bahasa Inggris</label>
            @error('rapot_bing')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="data-kelas" role="tabpanel" aria-labelledby="data-kelas-tab">
    <h3 class="text-start">Pilih Kelas</h3>
    <hr>
    <div class="row">
      <div class="ms-auto col-sm-12 col-lg-3 order-lg-last border border-danger">
        <p class="text-center">Kuota Kelas:</p>
        <ul>
          @foreach($data_kelas as $kelas)            
            <li>{{$kelas->kelas->nama_kelas}} : {{$kelas->kuota}}</li>            
            @endforeach 
        </ul>
        <p>Silahkan Pilih dikelas yang diinginkan</p>
      </div>
      <div class="me-lg-auto col-sm-12 col-lg-8">
        <div class="form-floating mb-3">
          <select class="form-select @error('pilihan_1') is-invalid @enderror" id="pilihan_1" name="pilihan_1" aria-label="pilihan_1" value="{{old('pilihan_1')}}">
            <option selected value="{{old('pilihan_1',"")}}">{{old('pilihan_1',"Pilih")}}</option>
            @foreach($data_kelas as $kelas)
            <option value="{{$kelas->kelas->kode_kelas}}">{{$kelas->kelas->nama_kelas}}</option>
            @endforeach                                           
          </select>
          <label for="pilihan_1">Pilihan 1</label>
          @error('pilihan_1')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
        </div>
        <div class="form-floating mb-3">
          <select class="form-select @error('pilihan_2') is-invalid @enderror" id="pilihan_2" name="pilihan_2" aria-label="pilihan_2" value="{{old('pilihan_2')}}">
            <option selected value="{{old('pilihan_2',"")}}">{{old('pilihan_2',"Pilih")}}</option>
            @foreach($data_kelas as $kelas)
            <option value="{{$kelas->kelas->kode_kelas}}">{{$kelas->kelas->nama_kelas}}</option>
            @endforeach                                             
          </select>
          <label for="pilihan_2">Pilihan 2</label>
          @error('pilihan_2')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="data-berkas" role="tabpanel" aria-labelledby="data-berkas-tab">
    <h3 class="text-start">Upload Berkas</h3>
    <hr>
    <div class="container">
      <div class="row">        
        @for($i=0;$i<=4;$i++)
        <div class="col-sm-12 col-lg-3 m-3">
          <div class="text-center">
            <label for="berkas_{{$i}}">
              <img style="width: 128px; height:128px;display:none" for="berkas_{{$i}}" class="rounded mx-auto d-block img-preview-berkas_{{$i}} img-fluid border border-primary p-2" alt="berkas_{{$i}}" src="{{asset('assets/icons/plus-square.svg')}}">
            </label>
          </div>
          <div class="mb-3 text-center">
            <label for="berkas_{{$i}}" class="form-label">berkas_{{$i}}</label>
            <input class="form-control form-control-sm @error('berkas_{{$i}}') is-invalid @enderror" id="berkas_{{$i}}" name="berkas_{{$i}}" type="file" onchange="previewImage('berkas_{{$i}}')">
            @error('berkas_{{$i}}')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            @if ($errors->has('berkas_'.$i)) <p style="color:red;">{{ $errors->first('berkas_'.$i) }}</p> @endif
            <input type="text" class="form-control my-2 @error('desc_{{$i}}') is-invalid @enderror" id="desc_{{$i}}" name="desc_{{$i}}" placeholder="Keterangan File/Nama Berkas" maxlength="16">
            @error('desc_{{$i}}')
            <div class="invalid-feedback">
            </div>
            @enderror
            @if ($errors->has('desc_'.$i)) <p style="color:red;">{{ $errors->first('desc_'.$i) }}</p> @endif
            <span class="form-text">
              Format File (Jpg, Png, Jpeg. Max: 1024Kbps)
            </span>
          </div>
        </div>
        @endfor
        <input type="hidden" name="jml" value="{{$i}}">
        {{-- <div class="col-sm-12 col-lg-3 m-3">
          <div class="text-center">
            <label for="berkas_un">
              <img style="width: 128px; height:128px;display:none" for="berkas_un" class="rounded mx-auto d-block img-preview-berkas_un img-fluid border border-primary p-2" alt="berkas_un" src="{{asset('assets/icons/plus-square.svg')}}">
            </label>
          </div>
          <div class="mb-3 text-center">
            <label for="berkas_un" class="form-label">berkas_un</label>
            <input class="form-control form-control-sm @error('berkas_un') is-invalid @enderror" id="berkas_un" name="berkas_un" type="file" onchange="previewImage('berkas_un')">
            @error('berkas_un')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <input type="text" class="form-control my-2 @error('desc_berkas_un') is-invalid @enderror" id="desc_berkas_un" name="desc_berkas_un" placeholder="Keterangan File/Nama Berkas" maxlength="16">
            @error('desc_berkas_un')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <span class="form-text">
              Format File (Jpg, Png, Jpeg. Max: 1024Kbps)
            </span>
          </div>
        </div>
        <div class="col-sm-12 col-lg-3 m-3">
          <div class="text-center">
            <label for="berkas_rapot">
              <img style="width: 128px; height:128px;display:none" for="berkas_rapot" class="rounded mx-auto d-block img-preview-berkas_rapot img-fluid border border-primary p-2" alt="berkas_rapot" src="{{asset('assets/icons/plus-square.svg')}}">
            </label>
          </div>
          <div class="mb-3 text-center">
            <label for="berkas_rapot" class="form-label">berkas_rapot</label>
            <input class="form-control form-control-sm @error('berkas_rapot') is-invalid @enderror" id="berkas_rapot" name="berkas_rapot" type="file" onchange="previewImage('berkas_rapot')">
            @error('berkas_rapot')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <input type="text" class="form-control my-2 @error('desc_berkas_rapot') is-invalid @enderror" id="desc_berkas_rapot" name="desc_berkas_rapot" placeholder="Keterangan File/Nama Berkas" maxlength="16">            
            @error('desc_berkas_rapot')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <span class="form-text">
              Format File (Jpg, Png, Jpeg. Max: 1024Kbps)
            </span>
          </div>
        </div>
        <div class="col-sm-12 col-lg-3 m-3">
          <div class="text-center">
            <label for="sertifikat">
              <img style="width: 128px; height:128px;display:none" for="sertifikat" class="rounded mx-auto d-block img-preview-sertifikat img-fluid border border-primary p-2" alt="sertifikat" src="{{asset('assets/icons/plus-square.svg')}}">
            </label>
          </div>
          <div class="mb-3 text-center">
            <label for="sertifikat" class="form-label">sertifikat</label>
            <input class="form-control form-control-sm @error('sertifikat') is-invalid @enderror" id="sertifikat" name="sertifikat" type="file" onchange="previewImage('sertifikat')">
            @error('sertifikat')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <input type="text" class="form-control my-2 @error('desc_sertifikat') is-invalid @enderror" id="desc_sertifikat" name="desc_sertifikat" placeholder="Keterangan File/Nama Berkas" maxlength="16">    
            @error('desc_sertifikat')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror                    
            <span class="form-text">
              Format File (Jpg, Png, Jpeg. Max: 1024Kbps)
            </span>
          </div>
        </div> --}}
      </div>
    </div>
    <div class="container text-center d-grid">
      <button type="submit" class="btn btn-lg btn-primary">Daftar</button>
    </div>
  </form>
  </div>
</div>
@endsection