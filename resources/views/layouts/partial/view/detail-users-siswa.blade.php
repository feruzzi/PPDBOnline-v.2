<a id="set_edit_user" href="#modalEditSiswa-{{$user->id}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>

<a id="set_dtl_user" href="#modalDetailSiswa-{{$user->id}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a>
@if($user->email_verified_at == null)
<a id="verify_user" href="verify-by-admin/{{$user->remember_token}}" onclick="return confirm('Yakin Verifikasi User ?')" class="text-decoration-none myicon rounded-circle p-1">
  <img class="img-fluid" src="{{asset('assets/icons/user-check.svg')}}" alt="">
</a>
@endif
{{-- edit siswa --}}
<div class="modal fade" id="modalEditSiswa-{{$user->id}}" tabindex="-1" aria-labelledby="modalEditSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditSiswaLabel">Edit Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/data-users/siswa/{{$user->id}}" method="post">
            @method('put')
            @csrf
            <div class="form-floating mb-3">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit_siswa_nama" name="nama" placeholder="Nama Lengkap" value="{{old('nama',$user->nama)}}">
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
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="edit_siswa_email" name="email" placeholder="email" value="{{old('email',$user->email)}}">
                  <label for="floatingInput">Email</label>
                  @error('email')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('token') is-invalid @enderror" id="edit_siswa_token" name="token" placeholder="token" value="{{old('token',$user->remember_token)}}">
                  <label for="floatingInput">token</label>
                  @error('token')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="edit_siswa_username" name="username" placeholder="Username" value="{{old('username',$user->username)}}">
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
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="edit_siswa_password" name="password" placeholder="Password">
                  <label for="floatingInput">Password</label>
                  @error('password')
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
  {{-- Detail User --}}
  <div class="modal fade" id="modalDetailSiswa-{{$user->id}}" tabindex="-1" aria-labelledby="modalDetailSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailSiswaLabel">Detail User Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
          <p>
            <label class="fw-bold px-2">Username : </label><span id="dtl_siswa_username">{{$user->username}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Nama : </label><span id="dtl_siswa_nama">{{$user->nama}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Email : </label><span id="dtl_siswa_email">{{$user->email}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Verify : </label><span id="dtl_siswa_verify">{{$user->email_verified_at}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Token : </label><span class="text-wrap" id="dtl_siswa_token">{{$user->remember_token}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Level : </label><span id="dtl_siswa_level">{{$user->level}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Dibuat : </label><span id="dtl_siswa_dibuat">{{$user->created_at}}</span>
          </p>
          <p>
            <label class="fw-bold px-2">Diupdate : </label><span id="dtl_siswa_diupdate">{{$user->updated_at}}</span>
          </p>
        </div>
      </div>
    </div>
  </div>