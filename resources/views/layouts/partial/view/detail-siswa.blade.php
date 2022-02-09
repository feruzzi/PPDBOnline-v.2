<a id="set_edit_siswa" href="{{url('data-siswa/'.$siswa->id.'/edit')}}" class="text-decoration-none myicon rounded-circle p-1">    
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>

<a id="set_dtl_siswa" href="#modalDetailSiswa-{{$siswa->id_pendaftaran}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a>

<div class="modal fade" id="modalDetailSiswa-{{$siswa->id_pendaftaran}}" tabindex="-1" aria-labelledby="modalDetailSiswaLabel" aria-hidden="true"> <!-- Modal Detail-->
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailSiswaLabel">Detail Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4 class="fw-bold px-2">Data Siswa</h4>
          <p>
            <label class="fw-bold px-2">ID Pendaftaran : </label><span>{{$siswa->id_pendaftaran}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">NISN : </label><span>{{$siswa->nisn}}</span>
          </p>    
          <p>
            <label class="fw-bold px-2">Nama Lengkap : </label><span>{{$siswa->nama_siswa}}</span>
          </p>  
          <p>
            <label class="fw-bold px-2">Jenis Kelamin : </label><span>{{$siswa->j_kelamin}}</span>
          </p>  
          <p>
            <label class="fw-bold px-2">TTL : </label><span>{{$siswa->t_lahir}} / {{$siswa->tgl_lahir}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Agama : </label><span>{{$siswa->agama}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Alamat : </label><span>{{$siswa->alamat}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Nomor HP : </label><span>{{$siswa->no_hp}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Asal Sekolah : </label><span>{{$siswa->asal_sekolah}} | {{$siswa->nama_sekolah}}</span>
          </p>
          <hr>
          <h4 class="fw-bold px-2">Orang Tua</h4>
          <p>
            <label class="fw-bold px-2">Nama Ayah : </label><span>{{$siswa->nama_ayah}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">HP Ayah : </label><span>{{$siswa->hp_ayah}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Pendidikan Ayah : </label><span>{{$siswa->pendidikan_ayah}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Pekerjaan Ayah : </label><span>{{$siswa->pekerjaan_ayah}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Penghasilan Ayah : </label><span>{{$siswa->penghasilan_ayah}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Nama Ibu : </label><span>{{$siswa->nama_ibu}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">HP Ibu : </label><span>{{$siswa->hp_ibu}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Pendidikan Ibu : </label><span>{{$siswa->pendidikan_ibu}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Pekerjaan Ibu : </label><span>{{$siswa->pekerjaan_ibu}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Penghasilan Ibu : </label><span>{{$siswa->penghasilan_ibu}}</span>
          </p>
          <hr>
          <h4 class="fw-bold px-2">Nilai SD</h4>
          <p>
            <label class="fw-bold px-2">Bahasa Indonesia : </label><span>{{$siswa->nilai_bindo}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Matematika : </label><span>{{$siswa->nilai_matematika}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Ilmu Pengetahuan Alam : </label><span>{{$siswa->nilai_ipa}}</span>
          </p>
          <hr>
          <h4 class="fw-bold px-2">Nilai Rapot</h4>
          <p>
            <label class="fw-bold px-2">Bahasa Indonesia : </label><span>{{$siswa->rapot_bindo}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Matematika : </label><span>{{$siswa->rapot_matematika}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Ilmu Pengetahuan Alam : </label><span>{{$siswa->rapot_ipa}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Bahasa Inggris : </label><span>{{$siswa->rapot_bing}}</span>
          </p>
          <hr>
          <h4 class="fw-bold px-2">Pilihan</h4>
          <p>
            <label class="fw-bold px-2">Pilihan 1 : </label><span>{{$siswa->pilihan_1}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Pilihan 2 : </label><span>{{$siswa->pilihan_2}}</span>
          </p>
          <hr>
          <p>
            <label class="fw-bold px-2">Berkas Siswa</label>    
          </p>
          <div class="row">
            @foreach ($siswa->berkas as $berkas)
            <div class="col-sm-6 col-lg-4">
              <div class="container text-center">
                @if(substr($berkas->berkas,-3)=="pdf")
                  <img src="{{asset('assets/icons/pdf-icon.svg')}}" class="d-inline" style="width:200px;height:280px"/>
                  <br>  
                  <a href="{{url($berkas->berkas)}}" target="_blank" class="btn btn-primary">Download File PDF</a>
                @else
                  <img src="{{$berkas->berkas}}" style="width:200px;height:280px"/>  
                @endif                        
                  {{-- <p class="fw-bold">{{$berkas->nama_berkas}}</p>---}}
                  <form action="{{url('siswa/berkas')}}" method="post">
                    @method('put')
                    @csrf
                    <div class="input-group my-3">
                      <span class="input-group-text" id="basic-addon1">{{$berkas->nama_berkas}}</span>
                      <input type="number" class="form-control" placeholder="Nilai Berkas" aria-label="Nilai Berkas" aria-describedby="basic-addon1" name="nilai_berkas[]" value="{{$berkas->nilai_berkas}}">
                    </div>
                    <input type="hidden" name="nama_berkas[]" value="{{$berkas->berkas}}">
                  </div>
                </div>    
            @endforeach
              {{-- @foreach($data_berkas as $berkas)
                @if($berkas->id_pendaftaran_berkas==$siswa->id_pendaftaran)
                <div class="col-sm-6 col-lg-4">
                    <div class="container text-center">
                      @if(substr($berkas->berkas,-3)=="pdf")
                        <img src="{{asset('assets/icons/pdf-icon.svg')}}" class="d-inline" style="width:200px;height:280px"/>
                        <br>  
                        <a href="{{url($berkas->berkas)}}" target="_blank" class="btn btn-primary">Download File PDF</a>
                      @else
                        <img src="{{$berkas->berkas}}" style="width:200px;height:280px"/>  
                      @endif                                                
                        <form action="{{url('siswa/berkas')}}" method="post">
                          @method('put')
                          @csrf
                          <div class="input-group my-3">
                            <span class="input-group-text" id="basic-addon1">{{$berkas->nama_berkas}}</span>
                            <input type="number" class="form-control" placeholder="Nilai Berkas" aria-label="Nilai Berkas" aria-describedby="basic-addon1" name="nilai_berkas[]" value="{{$berkas->nilai_berkas}}">
                          </div>
                          <input type="hidden" name="nama_berkas[]" value="{{$berkas->berkas}}">
                        </div>
                      </div>    
                      @endif
                      @endforeach --}}
                      <input type="hidden" name="id_siswa" value="{{$siswa->id}}">
                        <button type="submit" class="btn btn-primary"><img src="{{asset('assets/icons/save.svg')}}" alt=""> Simpan Nilai Berkas</button>
                        </form>
          </div>       
          {{--<p>
             <label class="fw-bold px-2">Dibuat : </label><span id="dtl_dibuat">{{$pengumuman->created_at}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Diupdate : </label><span id="dtl_diupdate">{{$pengumuman->updated_at}}</span>
          </p> --}}          
        </div>
        <div class="text-start px-2 d-inline">
        
            <span class="badge bg-warning fs-5">{{$siswa->username_admin}}</span>            
        
          @if($siswa->status_seleksi=="Seleksi")          
            <span class="badge bg-info fs-5">{{$siswa->status_seleksi}}</span>                                  
          @elseif($siswa->status_seleksi=="Terverifikasi")          
            <span class="badge bg-primary fs-5">{{$siswa->status_seleksi}}</span>                                 
          @elseif($siswa->status_seleksi=="Diterima")          
            <span class="badge bg-success fs-5">{{$siswa->status_seleksi}}</span>                                  
          @elseif($siswa->status_seleksi=="Gagal")          
            <span class="badge bg-danger fs-5">{{$siswa->status_seleksi}}</span>                                  
          @endif
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{asset('assets/icons/check-circle.svg')}}" alt="">
              Diterima
            </button>
            <ul class="dropdown-menu">
              <li class="text-center">
                <form action="/data-siswa/verify/terima/{{$siswa->id}}/{{auth()->user()->username}}" method="post" class="d-inline">
                  @method('put')
                  @csrf
                  <input type="hidden" name="status_seleksi" value="{{$siswa->pilihan_1}}">
                  <button class="btn btn-link text-decoration-none text-success" onclick="return confirm('Yakin Terima Siswa di {{$siswa->pilihan_1}} ?')">Terima di {{$siswa->pilihan_1}}</button>
              </form>
              </li>
              <li class="text-center">
                <form action="/data-siswa/verify/terima/{{$siswa->id}}/{{auth()->user()->username}}" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <input type="hidden" name="status_seleksi" value="{{$siswa->pilihan_2}}">
                    <button class="btn btn-link text-decoration-none text-success" onclick="return confirm('Yakin Terima Siswa di {{$siswa->pilihan_2}} ?')">Terima di {{$siswa->pilihan_2}}</button>
                </form>
              </li>              
            </ul>
          </div>
          {{-- <form action="/data-siswa/verify/terima/{{$siswa->id}}/{{auth()->user()->username}}" method="post" class="d-inline">
            @method('put')
            @csrf
            <button class="badge btn btn-success border-0" onclick="return confirm('Yakin Terima Siswa ?')"><img src="{{asset('assets/icons/check-circle.svg')}}" alt="">Terima</button>
        </form> --}}
        <form action="/data-siswa/verify/verifikasi/{{$siswa->id}}/{{auth()->user()->username}}" method="post" class="d-inline">
          @method('put')
          @csrf
          <button class="badge btn btn-primary border-0" onclick="return confirm('Yakin Verifikasi Data ?')"><img src="{{asset('assets/icons/star.svg')}}" alt="">Verifikasi</button>
      </form>
      <form action="/data-siswa/verify/gagal/{{$siswa->id}}/{{auth()->user()->username}}" method="post" class="d-inline">
        @method('put')
        @csrf
        <button class="badge btn btn-danger border-0" onclick="return confirm('Yakin Tolak Siswa ?')"><img src="{{asset('assets/icons/x-circle.svg')}}" alt="">Tolak</button>
    </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="modal fade" id="modalEditSiswa-{{$siswa->id_pendaftaran}}" tabindex="-1" aria-labelledby="modalEditSiswaLabel" aria-hidden="true"> <!-- Modal Edit-->
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditSiswaLabel">Edit Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                 
        </div>        
        <div class="modal-footer">         
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> --}}