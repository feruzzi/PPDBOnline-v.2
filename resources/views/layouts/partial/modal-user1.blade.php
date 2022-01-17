<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true"> <!-- Modal Tambah-->
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahUserLabel">Tambah User</h5>
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
  {{-- edit user --}}
  <div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditUserLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/data-users/{{$user->id}}" method="post">
            @method('put')
            @csrf
            <div class="form-floating mb-3">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit_nama" name="nama" placeholder="Nama Lengkap">
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
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="edit_username" name="username" placeholder="Username">
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
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="edit_password" name="password" placeholder="Password">
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
                  <select class="form-select @error('level') is-invalid @enderror" id="edit_level" name="level" aria-label="level">
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
  {{-- Detail User --}}
  <div class="modal fade" id="modalDetailUser" tabindex="-1" aria-labelledby="modalDetailUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailUserLabel">Detail User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            <label class="fw-bold px-2">Username : </label><span id="dtl_username">____</span>
          </p>
          <p>
            <label class="fw-bold px-2">Nama : </label><span id="dtl_nama">____</span>
          </p>
          <p>
            <label class="fw-bold px-2">Email : </label><span id="dtl_email">____</span>
          </p>
          <p>
            <label class="fw-bold px-2">Verify : </label><span id="dtl_verify">____</span>
          </p>
          <p>
            <label class="fw-bold px-2">Loken : </label><span id="dtl_token">____</span>
          </p>
          <p>
            <label class="fw-bold px-2">Level : </label><span id="dtl_level">____</span>
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
  </div>
  {{-- Delete Confirm --}}
  <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
  <script>
    $(document).ready(function(){
      $(document).on('click','#set_dtl_user',function(){
        var username=$(this).data('username');
        var nama=$(this).data('nama');
        var email=$(this).data('email');
        var verify=$(this).data('verify');
        var token=$(this).data('token');
        var level=$(this).data('level');
        var dibuat=$(this).data('dibuat');
        var diupdate=$(this).data('diupdate');
        $('#dtl_username').text(username);
        $('#dtl_nama').text(nama);
        $('#dtl_email').text(email);
        $('#dtl_verify').text(verify);
        $('#dtl_token').text(token);
        $('#dtl_level').text(level);
        $('#dtl_dibuat').text(dibuat);
        $('#dtl_diupdate').text(diupdate);
      })
    })
  </script>
  <script>
    $(document).ready(function(){
      $(document).on('click','#set_edit_user',function(){
        var username=$(this).data('username');
        var nama=$(this).data('nama');        
        var level=$(this).data('level');        
        $('#edit_username').val(username);
        $('#edit_nama').val(nama);        
        $('#edit_level').val(level).change();        
      })
    })
  </script>