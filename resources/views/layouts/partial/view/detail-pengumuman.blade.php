<a id="set_edit_pengumuman" href="#modalEditPengumuman-{{$pengumuman->kode_pengumuman}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">    
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>

<a id="set_dtl_pengumuman" href="#modalDetailPengumuman-{{$pengumuman->kode_pengumuman}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a>

<div class="modal fade" id="modalDetailPengumuman-{{$pengumuman->kode_pengumuman}}" tabindex="-1" aria-labelledby="modalDetailPengumumanLabel" aria-hidden="true"> <!-- Modal Detail-->
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailPengumumanLabel">Detail Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          <label class="fw-bold px-2">Kode Pengumuman : </label><span id="dtl_kode_pengumuman">{{$pengumuman->kode_pengumuman}}</span>
        </p>
        <p>
          <label class="fw-bold px-2">Nama Pengumuman : </label><span id="dtl_nama_pengumuman">{{$pengumuman->nama_pengumuman}}</span>
        </p>     
        {{-- <p>
          <label class="fw-bold px-2">Kelas : </label><span id="dtl_kelas">____</span>
        </p>     --}}
        <p>
          <label class="fw-bold px-2">Dibuat : </label><span id="dtl_dibuat">{{$pengumuman->created_at}}</span>
        </p>
        <p>
          <label class="fw-bold px-2">Diupdate : </label><span id="dtl_diupdate">{{$pengumuman->updated_at}}</span>
        </p>
        <hr class="bg-secondary bg-gradient mt-5" style="height:8px">
        <div>
          <p>
            <label class="fw-bold px-2">Isi Pengumuman</label>
          </p>
          <div class="border border-secondary rounded p-3">
            @php
            $isi = str_replace( '&', '&amp;', $pengumuman->isi );
            @endphp
            {!!$isi!!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditPengumuman-{{$pengumuman->kode_pengumuman}}" tabindex="-1" aria-labelledby="modalEditPengumumanLabel" aria-hidden="true"> <!-- Modal Edit-->
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditPengumumanLabel">Edit Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('data-pengumuman/'.$pengumuman->id)}}" method="post">
          @method('put')
          @csrf
          <div class="row">
            <div class="col-sm-12 col-lg-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('kode_pengumuman') is-invalid @enderror" id="edit_kode_pengumuman" name="kode_pengumuman" placeholder="Kode Pengumuman" value="{{old('kode_pengumuman',$pengumuman->kode_pengumuman)}}">
                <label for="kode_pengumuman">Kode Pengumuman</label>
                @error('kode_pengumuman')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-8">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('nama_pengumuman') is-invalid @enderror" id="edit_nama_pengumuman" name="nama_pengumuman" placeholder="Nama Pengumuman" value="{{old('nama_pengumuman',$pengumuman->nama_pengumuman)}}">
                <label for="nama_pengumuman">Nama Pengumuman</label>
                @error('nama_pengumuman')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div>
            <p>
              <label class="fw-bold px-2">Isi Pengumuman</label>
            </p>
            <div class="border border-secondary rounded p-3">
              @php
              $isi = str_replace( '&', '&amp;', $pengumuman->isi );
              @endphp
              <textarea name="isi" class="edit_editor" cols="30" rows="10">{!!old('isi',$isi)!!}</textarea> 
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