<a id="set_edit_user" href="#modalEditUser-{{$user->id}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>
<a id="set_dtl_user" href="#modalDetailUser-{{$user->id}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a>
{{-- edit user --}}
<div class="modal fade" id="modalEditUser-{{$user->id}}" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditUserLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
          <form action="/data-users/{{$user->id}}" method="post">
            @method('put')
            @csrf
            <div class="form-floating mb-3">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit_nama" name="nama" placeholder="Nama Lengkap" value="{{old('nama',$user->nama)}}">
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
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="edit_username" name="username" placeholder="Username" value="{{old('username',$user->username)}}">
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
                    {{-- <option value="0" {{$user->level == 0  ? 'selected' : ''}}>Admin</option>
                    <option value="1" {{$user->level == 1  ? 'selected' : ''}}>Panitia</option> --}}
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
  <div class="modal fade" id="modalDetailUser-{{$user->id}}" tabindex="-1" aria-labelledby="modalDetailUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailUserLabel">Detail User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
          <p>
            <label class="fw-bold px-2">Username : </label><span id="dtl_username">{{$user->username}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Nama : </label><span id="dtl_nama">{{$user->nama}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Email : </label><span id="dtl_email">{{$user->email}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Verify : </label><span id="dtl_verify">{{$user->email_verified_at}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Token : </label><span class="text-wrap" id="dtl_token">{{$user->remember_token}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Level : </label><span id="dtl_level">{{$user->level}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Dibuat : </label><span id="dtl_dibuat">{{$user->created_at}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Diupdate : </label><span id="dtl_diupdate">{{$user->updated_at}}</span>
          </p>
        </div>
      </div>
    </div>
  </div>