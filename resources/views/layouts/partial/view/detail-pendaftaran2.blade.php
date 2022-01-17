{{-- <a id="set_edit_pendaftaran" href="#modalEditPendaftaran" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal"
    data-kode_pendaftaran="{{$pendaftaran->kode_pendaftaran}}"
    data-nama_pendaftaran="{{$pendaftaran->nama_pendaftaran}}"
    data-kelas="
    @foreach($data_detail_pendaftaran as $detail_pendaftaran)
        @if($detail_pendaftaran->detail_kode_pendaftaran==$pendaftaran->kode_pendaftaran)
        {{$detail_pendaftaran->kelas->nama_kelas}},
        @endif
  @endforeach"
  data-kuota="
    @foreach($data_detail_pendaftaran as $detail_pendaftaran)
        @if($detail_pendaftaran->detail_kode_pendaftaran==$pendaftaran->kode_pendaftaran)
        {{$detail_pendaftaran->kuota}},
        @endif
  @endforeach"
    data-dibuat="{{$pendaftaran->created_at}}"
    data-diupdate="{{$pendaftaran->updated_at}}">    
    <img class="img-fluid" src="{{asset('assets/icons/edit-2.svg')}}" alt="">
</a>

<a id="set_dtl_pendaftaran" href="#modalDetailPendaftaran" class="text-decoration-none myicon rounded-circle p-1"
    data-bs-toggle="modal"
    data-kode_pendaftaran="{{$pendaftaran->kode_pendaftaran}}"
    data-nama_pendaftaran="{{$pendaftaran->nama_pendaftaran}}"
    data-kelas="
    @foreach($data_detail_pendaftaran as $detail_pendaftaran)
        @if($detail_pendaftaran->detail_kode_pendaftaran==$pendaftaran->kode_pendaftaran)
        {{$detail_pendaftaran->kelas->nama_kelas}},
        @endif
  @endforeach"
  data-kuota="
    @foreach($data_detail_pendaftaran as $detail_pendaftaran)
        @if($detail_pendaftaran->detail_kode_pendaftaran==$pendaftaran->kode_pendaftaran)
        {{$detail_pendaftaran->kuota}},
        @endif
  @endforeach"
    data-dibuat="{{$pendaftaran->created_at}}"
    data-diupdate="{{$pendaftaran->updated_at}}">
    <img class="img-fluid" src="{{asset('assets/icons/eye.svg')}}" alt="">
</a> --}}