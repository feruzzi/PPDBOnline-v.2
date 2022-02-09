<div class="modal fade" id="modalTambahPendaftaran" tabindex="-1" aria-labelledby="modalTambahPendaftaranLabel" aria-hidden="true"> <!-- Modal Tambah-->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahPendaftaranLabel">Tambah Pendaftaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('data-pendaftaran')}}" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-12 col-lg-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('kode_pendaftaran') is-invalid @enderror" id="kode_pendaftaran" name="kode_pendaftaran" placeholder="Kode Pendaftaran" value="{{old('kode_pendaftaran')}}">
                <label for="kode_pendaftaran">Kode Pendaftaran</label>
                @error('kode_pendaftaran')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('nama_pendaftaran') is-invalid @enderror" id="nama_pendaftaran" name="nama_pendaftaran" placeholder="Nama Pendaftaran" value="{{old('nama_pendaftaran')}}">
                <label for="nama_pendaftaran">Nama Pendaftaran</label>
                @error('nama_pendaftaran')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-lg-2">
              <div class="form-floating mb-3">
                <input type="number" class="form-control @error('jumlah_berkas') is-invalid @enderror" id="jumlah_berkas" name="jumlah_berkas" placeholder="Jumlah Berkas" value="{{old('jumlah_berkas')}}">
                <label for="jumlah_berkas">Jumlah Berkas</label>
                @error('jumlah_berkas')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <label for="Kelas">Kelas yang dibuka </label>
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

  {{-- <script>
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
</script> --}}