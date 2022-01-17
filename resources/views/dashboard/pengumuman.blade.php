@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content')
<div class="container-fluid p-3">
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
    <h1 class="text-center">Data Pengumuman</h1>    
    {{-- @php
    $data = str_replace( '&', '&amp;', $data );
    @endphp
    <div><?= $data ?></div> --}}
    <div class="d-flex">
        <button class="ms-auto btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalTambahPengumuman">+ Tambah Data</button>
    </div>
    <div class="table-responsive">
       <table class="table table-sm">
           <thead>
               <th>No</th>
               <th>Kode Pengumuman</th>
               <th>Nama Pengumuman</th>
               <th>Aksi</th>
               <th>Status</th>
           </thead>
           <tbody>
               @foreach($data_pengumuman as $pengumuman)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$pengumuman->kode_pengumuman}}</td>
                   <td>{{$pengumuman->nama_pengumuman}}</td>
                   <td>
                    @if($pengumuman->kode_pengumuman==$data_set_pengumuman)
                    <form action="/set-lepas" method="post" class="d-inline">
                      @method('put')
                      @csrf
                      <button class="badge btn btn-outline-light border-0" onclick="return confirm('Pengumuman {{$pengumuman->kode_pengumuman}} Akan dilepas ?')"><img src="{{asset('assets/icons/volume-x.svg')}}" alt=""></button>
                  </form>
                    @else
                    <form action="/set-tempel/{{$pengumuman->id}}" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <button class="badge btn btn-outline-light border-0" onclick="return confirm('Pengumuman {{$pengumuman->kode_pengumuman}} Akan ditempel ?')"><img src="{{asset('assets/icons/volume-2.svg')}}" alt=""></button>
                    </form>
                    @endif
                    <form action="/data-pengumuman/{{$pengumuman->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge btn btn-outline-light border-0" onclick="return confirm('Yakin Akan Hapus Data Pengumuman ?')"><img src="{{asset('assets/icons/trash.svg')}}" alt=""></button>
                    </form> 
                    @include('layouts.partial.view.detail-pengumuman')
                    @include('layouts.partial.modal-pengumuman')
                   </td>
                   <td>
                    @if($pengumuman->kode_pengumuman==$data_set_pengumuman)
                    <h5><span class="badge bg-success">Sedang Ditempel</span></h5>
                    @endif
                   </td>
               </tr>
               @endforeach
           </tbody>
        </table> 
    </div>
    <div class="modal fade" id="modalTambahPengumuman" tabindex="-1" aria-labelledby="modalTambahPengumumanLabel" aria-hidden="true"> <!-- Modal Tambah-->
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahPengumumanLabel">Tambah Pengumuman</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="/data-pengumuman" method="post">
                @csrf
                <div class="row col-sm-12 col-lg-6">
                  <div class="col-sm-12 col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control @error('kode_pengumuman') is-invalid @enderror" id="kode_pengumuman" name="kode_pengumuman" placeholder="Kode Kelas" value="{{old('kode_pengumuman')}}">
                      <label for="floatingInput">Kode Pengumuman</label>
                      @error('kode_pengumuman')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control @error('nama_pengumuman') is-invalid @enderror" id="nama_pengumuman" name="nama_pengumuman" placeholder="Nama pengumuman" value="{{old('nama_pengumuman')}}">
                      <label for="floatingInput">Nama Pengumuman</label>
                      @error('nama_pengumuman')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                      @enderror
                    </div>
                  </div>              
                </div>
                <div class="mt-3">
                  <hr>             
                  <textarea name="isi" id="editor" cols="30" rows="10"></textarea>         
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><img src="{{asset('assets/icons/save.svg')}}" alt=""> Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
      <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        var x=document.querySelectorAll('.edit_editor');
        var i;
        for (i = 0; i < x.length; i++) {   
    ClassicEditor
    .create(x[i])
    .catch( error => {
        console.error( error );
    } );
}
    </script>
@endsection