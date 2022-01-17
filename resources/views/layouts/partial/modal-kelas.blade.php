<div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-labelledby="modalTambahKelasLabel" aria-hidden="true"> <!-- Modal Tambah-->
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahKelasLabel">Tambah Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/data-kelas" method="post">
            @csrf
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror" id="kode_kelas" name="kode_kelas" placeholder="Kode Kelas" value="{{old('kode_kelas')}}">
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
                  <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelas" value="{{old('nama_kelas')}}">
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

  {{-- <div class="modal fade" id="modalEditKelas" tabindex="-1" aria-labelledby="modalEditKelasLabel" aria-hidden="true"> <!-- Modal Edit-->
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
                  <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror" id="edit_kode_kelas" name="kode_kelas" placeholder="Kode Kelas" value="{{old('kode_kelas')}}">
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
                  <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="edit_nama_kelas" name="nama_kelas" placeholder="Nama Kelas" value="{{old('nama_kelas')}}">
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

  <div class="modal fade" id="modalDetailKelas" tabindex="-1" aria-labelledby="modalDetailKelasLabel" aria-hidden="true"> <!-- Modal Detail-->
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailKelasLabel">Detail Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            <label class="fw-bold px-2">Kode Kelas : </label><span id="dtl_kode_kelas">____</span>
          </p>
          <p>
            <label class="fw-bold px-2">Nama Kelas : </label><span id="dtl_nama_kelas">____</span>
          </p>         
          <p>
            <label class="fw-bold px-2">Dibuat : </label><span id="dtl_dibuat">____</span>
          </p>
          <p>
            <label class="fw-bold px-2">Diupdate : </label><span id="dtl_diupdate">____</span>
          </p>
        </div>
      </div>
    </div>
  </div> --}}
  {{-- <script>
    $(document).ready(function(){
      $(document).on('click','#set_dtl_kelas',function(){
        var kode_kelas=$(this).data('kode_kelas');
        var nama_kelas=$(this).data('nama_kelas'); 
        var dibuat=$(this).data('dibuat');
        var diupdate=$(this).data('diupdate');      
        $('#dtl_kode_kelas').text(kode_kelas);
        $('#dtl_nama_kelas').text(nama_kelas);        
        $('#dtl_dibuat').text(dibuat);
        $('#dtl_diupdate').text(diupdate);
      })
    })
  </script>
  <script>
    $(document).ready(function(){
      $(document).on('click','#set_edit_kelas',function(){
        var kode_kelas=$(this).data('kode_kelas');
        var nama_kelas=$(this).data('nama_kelas');                  
        $('#edit_kode_kelas').val(kode_kelas);
        $('#edit_nama_kelas').val(nama_kelas);          
      })
    })
  </script> --}}