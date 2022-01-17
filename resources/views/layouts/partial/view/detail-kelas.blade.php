<a id="set_edit_kelas" href="#modalEditKelas-{{$kelas->kode_kelas}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">    
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>

<a id="set_dtl_kelas" href="#modalDetailKelas-{{$kelas->kode_kelas}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a>

<div class="modal fade" id="modalEditKelas-{{$kelas->kode_kelas}}" tabindex="-1" aria-labelledby="modalEditKelasLabel" aria-hidden="true"> <!-- Modal Edit-->
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditKelasLabel">Edit Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/data-kelas/{{$kelas->id}}" method="post">
            @method('put')
            @csrf
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror" id="edit_kode_kelas" name="kode_kelas" placeholder="Kode Kelas" value="{{old('kode_kelas',$kelas->kode_kelas)}}">
                  <label for="floatingInput">Kode Kelas</label>
                  @error('kode_kelas')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="edit_nama_kelas" name="nama_kelas" placeholder="Nama Kelas" value="{{old('nama_kelas',$kelas->nama_kelas)}}">
                  <label for="floatingInput">Nama Kelas</label>
                  @error('nama_kelas')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror
                </div>
              </div>              
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

  <div class="modal fade" id="modalDetailKelas-{{$kelas->kode_kelas}}" tabindex="-1" aria-labelledby="modalDetailKelasLabel" aria-hidden="true"> <!-- Modal Detail-->
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailKelasLabel">Detail Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            <label class="fw-bold px-2">Kode Kelas : </label><span id="dtl_kode_kelas">{{$kelas->kode_kelas}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Nama Kelas : </label><span id="dtl_nama_kelas">{{$kelas->nama_kelas}}</span>
          </p>         
          <p>
            <label class="fw-bold px-2">Dibuat : </label><span id="dtl_dibuat">{{$kelas->created_at}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Diupdate : </label><span id="dtl_diupdate">{{$kelas->updated_at}}</span>
          </p>
        </div>
      </div>
    </div>
  </div>