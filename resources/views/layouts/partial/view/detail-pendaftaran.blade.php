<a id="set_edit_pendaftaran" href="#modalEditPendaftaran-{{$pendaftaran->kode_pendaftaran}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">    
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>

<a id="set_dtl_pendaftaran" href="#modalDetailPendaftaran-{{$pendaftaran->kode_pendaftaran}}" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a>

<div class="modal fade" id="modalDetailPendaftaran-{{$pendaftaran->kode_pendaftaran}}" tabindex="-1" aria-labelledby="modalDetailPendaftaranLabel" aria-hidden="true"> <!-- Modal Detail-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailPendaftaranLabel">Detail Pendaftaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          <label class="fw-bold px-2">Kode Pendaftaran : </label><span id="dtl_kode_pendaftaran">{{$pendaftaran->kode_pendaftaran}}</span>
        </p>
        <p>
          <label class="fw-bold px-2">Nama Pendaftaran : </label><span id="dtl_nama_pendaftaran">{{$pendaftaran->nama_pendaftaran}}</span>
        </p>     
        <p>
          <label class="fw-bold px-2">Jumlah Berkas Dikumpul : </label><span id="dtl_jumlah_berkas">{{$pendaftaran->jumlah_berkas}}</span>
        </p>     
        {{-- <p>
          <label class="fw-bold px-2">Kelas : </label><span id="dtl_kelas">____</span>
        </p>     --}}
        <p>
          <label class="fw-bold px-2">Dibuat : </label><span id="dtl_dibuat">{{$pendaftaran->created_at}}</span>
        </p>
        <p>
          <label class="fw-bold px-2">Diupdate : </label><span id="dtl_diupdate">{{$pendaftaran->updated_at}}</span>
        </p>
        <table class="table table-sm">
          <thead>
            <th>Kelas</th>
            <th>Kuota</th>
          </thead>
          <tbody>            
            @foreach ($data_detail_pendaftaran as $detail_pendaftaran)
            @if($detail_pendaftaran->detail_kode_pendaftaran==$pendaftaran->kode_pendaftaran)
            <tr>
              <td><span id="dtl_kelas-{{$detail_pendaftaran->detail_kode_kelas}}">{{$detail_pendaftaran->kelas->nama_kelas}}</span><br></td>
              <td><span id="dtl_kuota-{{$detail_pendaftaran->detail_kode_kelas}}">{{$detail_pendaftaran->kuota}}</span></td>
            </tr>            
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditPendaftaran-{{$pendaftaran->kode_pendaftaran}}" tabindex="-1" aria-labelledby="modalEditPendaftaranLabel" aria-hidden="true"> <!-- Modal Edit-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditPendaftaranLabel">Edit Pendaftaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('data-pendaftaran/'.$pendaftaran->id)}}" method="post">
          @method('put')
          @csrf
          <div class="row">
            <div class="col-sm-12 col-lg-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('kode_pendaftaran') is-invalid @enderror" id="edit_kode_pendaftaran" name="kode_pendaftaran" placeholder="Kode Pendaftaran" value="{{old('kode_pendaftaran',$pendaftaran->kode_pendaftaran)}}">
                <label for="kode_pendaftaran">Kode Pendaftaran</label>
                @error('kode_pendaftaran')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-8">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('nama_pendaftaran') is-invalid @enderror" id="edit_nama_pendaftaran" name="nama_pendaftaran" placeholder="Nama Pendaftaran" value="{{old('nama_pendaftaran',$pendaftaran->nama_pendaftaran)}}">
                <label for="nama_pendaftaran">Nama Pendaftaran</label>
                @error('nama_pendaftaran')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-8">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('jumlah_berkas') is-invalid @enderror" id="edit_jumlah_berkas" name="jumlah_berkas" placeholder="Jumlah Berkas" value="{{old('jumlah_berkas',$pendaftaran->jumlah_berkas)}}">
                <label for="jumlah_berkas">Jumlah Berkas</label>
                @error('jumlah_berkas')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <label>Informasi Kelas</label>
          <table class="table table-sm">
            <thead>
              <th>Kelas</th>
              <th>Kuota</th>
            </thead>
            <tbody>            
              @foreach ($data_detail_pendaftaran as $detail_pendaftaran)
              @if($detail_pendaftaran->detail_kode_pendaftaran==$pendaftaran->kode_pendaftaran)
              <tr>
                <td><span id="dtl_kelas-{{$detail_pendaftaran->detail_kode_kelas}}">{{$detail_pendaftaran->kelas->nama_kelas}}</span><br></td>
                <td><span id="dtl_kuota-{{$detail_pendaftaran->detail_kode_kelas}}">{{$detail_pendaftaran->kuota}}</span></td>
              </tr>            
              @endif
              @endforeach
            </tbody>
          </table>
          <label for="Kelas">Kelas yang Tersedia </label>
          <div class="row">
            @foreach($data_kelas as $kelas)
            <div class="col-sm-6 col-lg-2">
              <div class="input-group mb-3">
                <div class="input-group-text">
                  <input class="form-check-input mt-0" name="kode-{{str_replace(" ","-", $kelas->kode_kelas)}}" type="checkbox" value="1">
                </div>
                <input type="text" class="form-control" name="kouta-{{str_replace(" ","-", $kelas->nama_kelas)}}" placeholder="Kouta {{$kelas->nama_kelas}}">
              </div>
            </div>
            @endforeach
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