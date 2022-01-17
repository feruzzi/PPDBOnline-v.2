<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modalTambahPendaftaran" tabindex="-1" aria-labelledby="modalTambahPendaftaranLabel" aria-hidden="true"> <!-- Modal Tambah-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahPendaftaranLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/data-users" method="post">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap">
            <label for="floatingInput">Nama Lengkap</label>
            @error('nama')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="row">
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <label for="floatingInput">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="ms-auto col-sm-12 col-lg-6 order-lg-last">
              <div class="form-floating mb-3">
                <select class="form-select @error('level') is-invalid @enderror" id="level" name="level" aria-label="level">
                  <option value="0">Admin</option>
                  <option value="1">Panitia</option>                                                                                                             
                </select>
                <label for="level">Level</label>
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

<div class="modal fade" id="modalEditPendaftaran" tabindex="-1" aria-labelledby="modalEditPendaftaranLabel" aria-hidden="true"> <!-- Modal Edit-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditPendaftaranLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/data-users" method="post">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap">
            <label for="floatingInput">Nama Lengkap</label>
            @error('nama')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="row">
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <label for="floatingInput">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="ms-auto col-sm-12 col-lg-6 order-lg-last">
              <div class="form-floating mb-3">
                <select class="form-select @error('level') is-invalid @enderror" id="level" name="level" aria-label="level">
                  <option value="0">Admin</option>
                  <option value="1">Panitia</option>                                                                                                             
                </select>
                <label for="level">Level</label>
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

<div class="modal fade" id="modalDetailPendaftaran" tabindex="-1" aria-labelledby="modalDetailPendaftaranLabel" aria-hidden="true"> <!-- Modal Detail-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailPendaftaranLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/data-users" method="post">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap">
            <label for="floatingInput">Nama Lengkap</label>
            @error('nama')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="row">
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <label for="floatingInput">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="ms-auto col-sm-12 col-lg-6 order-lg-last">
              <div class="form-floating mb-3">
                <select class="form-select @error('level') is-invalid @enderror" id="level" name="level" aria-label="level">
                  <option value="0">Admin</option>
                  <option value="1">Panitia</option>                                                                                                             
                </select>
                <label for="level">Level</label>
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
  <script>
    $(document).ready(function(){
      $(document).on('click','#set_dtl_pendaftaran',function(){
        $("span").html("");
        var kode_pendaftaran=$(this).data('kode_pendaftaran');
        var nama_pendaftaran=$(this).data('nama_pendaftaran'); 
        var kelas=$(this).data('kelas'); 
        var dtl_kelas=kelas.split(',');
        const jml_kelas = kelas.split(",").length;
        var kuota=$(this).data('kuota'); 
        var dtl_kuota=kuota.split(',');
        const jml_kuota = kuota.split(",").length;
        var dibuat=$(this).data('dibuat');
        var diupdate=$(this).data('diupdate');      
        $('#dtl_kode_pendaftaran').text(kode_pendaftaran);
        $('#dtl_nama_pendaftaran').text(nama_pendaftaran);  
        for (let i = 0; i < jml_kelas-1; i++) {
  // text += cars[i] + "<br>";
          $('#dtl_kelas-'+[i]).text(dtl_kelas[i]);        
          $('#dtl_kuota-'+[i]).text(dtl_kuota[i]);        
        }
        $('#dtl_dibuat').text(dibuat);
        $('#dtl_diupdate').text(diupdate);
      })
    })
  </script>

<script>
  $(document).ready(function(){
    $(document).on('click','#set_edit_pendaftaran',function(){
      $("span").html("");
      var kode_pendaftaran=$(this).data('kode_pendaftaran');
      var nama_pendaftaran=$(this).data('nama_pendaftaran'); 
      var kelas=$(this).data('kelas'); 
      var dtl_kelas=kelas.split(',');
      const jml_kelas = kelas.split(",").length;
      var kuota=$(this).data('kuota'); 
      var dtl_kuota=kuota.split(',');
      const jml_kuota = kuota.split(",").length;
      var dibuat=$(this).data('dibuat');
      var diupdate=$(this).data('diupdate');      
      $('#edit_kode_pendaftaran').val(kode_pendaftaran);
      $('#edit_nama_pendaftaran').val(nama_pendaftaran);  
      for (let i = 0; i < jml_kelas-1; i++) {
// text += cars[i] + "<br>";
        $('#dtl_kelas-'+[i]).text(dtl_kelas[i]);        
        $('#dtl_kuota-'+[i]).text(dtl_kuota[i]);        
      }
      $('#dtl_dibuat').text(dibuat);
      $('#dtl_diupdate').text(diupdate);
    })
  })
</script>