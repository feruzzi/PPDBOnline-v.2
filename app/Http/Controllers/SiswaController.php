<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Berkas;
use App\Models\Pendaftaran;
use App\Models\SetPendaftaran;
use App\Models\DetailPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Exception;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request('cari'));
        $formatid = DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran');
        // $siswa = Siswa::oldest();
        $siswa = Siswa::selectRaw('*, nilai_bindo+nilai_matematika+nilai_ipa+rapot_bindo+rapot_matematika+rapot_ipa+rapot_bing+total_nilai_berkas AS total')->orderBy('total', 'desc');
        if (request('cari')) {
            // $siswa->where('id_pendaftaran', 'like', '%' . request('cari') . '%');
            $siswa->where('jalur', request('cari'));
        } elseif ($formatid != null) {
            // $siswa->where('id_pendaftaran', 'like', '%' . $formatid . '%');
            $siswa->where('jalur', $formatid);
        } else {
            $formatid = Pendaftaran::pluck('kode_pendaftaran')->last();
            $siswa->where('jalur', $formatid);
        }
        return view('dashboard.siswa', [
            'title' => 'Siswa',
            'filter' => Pendaftaran::all()->last(),
            'username' => 'Username',
            'data_pendaftaran' => Pendaftaran::all(),
            // 'data_berkas' => Berkas::all(),
            // 'data_kelas' => DetailPendaftaran::where('detail_kode_pendaftaran', $formatid)->get(),
            'data_kelas' => Kelas::all(),
            // 'data_siswa' => Siswa::search('id_pendaftaran', $formatid)->get(),
            'data_siswa' => $siswa->with('berkas')->get(),
        ]);
    }

    public function seleksi()
    {
        $formatid = DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran');
        $siswa = Siswa::selectRaw('*, nilai_bindo+nilai_matematika+nilai_ipa+rapot_bindo+rapot_matematika+rapot_ipa+rapot_bing+total_nilai_berkas AS total')->orderBy('total', 'desc');
        if (request('cari')) {
            // $siswa->where('id_pendaftaran', 'like', '%' . request('cari') . '%')->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal');
            $siswa->where('jalur', request('cari'))->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal');
            $data_kelas = DetailPendaftaran::where('detail_kode_pendaftaran', 'like', '%' . request('cari') . '%')->get();
        } elseif ($formatid != null) {
            // $siswa->where('id_pendaftaran', 'like', '%' . $formatid . '%')->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal');
            $siswa->where('jalur', $formatid)->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal');
            $data_kelas = DetailPendaftaran::where('detail_kode_pendaftaran', $formatid)->get();
        } else {
            $formatid = Pendaftaran::pluck('kode_pendaftaran')->last();
            // $siswa->where('id_pendaftaran', 'like', '%' . $formatid . '%')->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal');
            $siswa->where('jalur', $formatid)->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal');
            $data_kelas = DetailPendaftaran::where('detail_kode_pendaftaran', $formatid)->get();
        }
        return view('dashboard.seleksi', [
            'title' => 'Seleksi',
            'filter' => Pendaftaran::all()->last(),
            'username' => 'Username',
            'data_pendaftaran' => Pendaftaran::all(),
            // 'data_berkas' => Berkas::all(),
            'data_kelas' => $data_kelas,
            'data_siswa' => $siswa->get(),
        ]);
    }

    public function hasil_seleksi(Request $request)
    {
        // dd($request->id[2]);
        // dd(count($request->id));
        for ($i = 0; $i < count($request->id); $i++) {
            $data['status_seleksi'] = $request->hasil_seleksi[$i];
            Siswa::where('id', $request->id[$i])->update($data);
        }
        return redirect('/seleksi')->with('success', 'Seleksi Berhasil Dilakukan !');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function daftar(Request $request)
    {
        // if ($request->file('berkas_0')) {
        //     $rules_berkas = [
        //         'berkas_0' => 'required|file|mimes:png,jpg,jpeg,pdf|max:1024',
        //         'desc_0' => 'required',
        //     ];
        //     // dd($rules_berkas);
        //     $validatedData_berkas['berkas'] = $request->file('berkas_0')->store('img/berkas_0');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_0'];
        // }
        // for ($i = 0; $i <= $request->jml; $i++) {
        //     if ($request->file('berkas_' . $i)) {
        //         $rules_berkas = [
        //             'berkas_' . $i => 'required|file|mimes:png,jpg,jpeg,pdf|max:1024',
        //             'desc_' . $i => 'required',
        //         ];
        //         // dd($rules_berkas);
        //         // $validatedData_berkas['berkas'] = $request->file('berkas_' . $i)->store('img/berkas_' . $i);
        //         $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_' . $i];
        //     }
        // }
        //!Validasi Berkas Awal
        // if ($request->file('berkas_un')) {
        //     $rules_berkas = [
        //         'desc_berkas_un' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('berkas_un')->store('img/berkas_un');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_un'];
        //     // Berkas::create($validatedData_berkas);
        // }
        // if ($request->file('berkas_rapot')) {
        //     $rules_berkas = [
        //         'desc_berkas_rapot' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('berkas_rapot')->store('img/berkas_rapot');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_rapot'];
        //     // $validatedData_berkas['nama_berkas'] = $request->desc_berkas_rapot;
        //     // Berkas::create($validatedData_berkas);
        // }
        // if ($request->file('sertifikat')) {
        //     $rules_berkas = [
        //         'desc_sertifikat' => 'required',
        //     ];
        //     // $x = $request->validate($rules_berkas);
        //     // dd($x);
        //     $validatedData_berkas['berkas'] = $request->file('sertifikat')->store('img/sertifikat');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_sertifikat'];
        //     // Berkas::create($validatedData_berkas);
        // }
        //!end
        // dd($request->j_kelamin);        
        // $formatid = DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran');        
        $formatid = SetPendaftaran::where('id', 1)->pluck('set_kode_pendaftaran')->first();
        // dd($formatid);
        // dd($validatedData['id_pendaftaran']);
        // dd(auth()->user()->username);
        // foreach ($request->except(['_token', 'nisn', 'nama_siswa', 'foto', 'berkas_un', 'berkas_rapot', 'sertifikat']) as $data => $value) {
        //     $validatedData[$data] = $request->validate([
        //         $data => 'required',
        //         // dd($data),
        //     ]);
        // }
        $validatedData = $request->validate([
            'nisn' => 'required|digits:10',
            'nama_siswa' => 'required|max:64',
            'foto' => 'required|image|file|max:1024',
            // 'berkas_un' => 'required|image|file|max:1024',
            // 'berkas_rapot' => 'required|image|file|max:1024',
            'j_kelamin' => 'required',
            't_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'asal_sekolah' => 'required',
            'nama_sekolah' => 'required',
            'no_hp' => 'required',
            'nama_ayah' => 'required',
            'hp_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'nama_ibu' => 'required',
            'hp_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'nilai_bindo' => 'required',
            'nilai_matematika' => 'required',
            'nilai_ipa' => 'required',
            'rapot_bindo' => 'required',
            'rapot_matematika' => 'required',
            'rapot_ipa' => 'required',
            'rapot_bing' => 'required',
            'pilihan_1' => 'required',
            'pilihan_2' => 'required',
        ]);
        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('img/foto');
        }
        // $validatedData_berkas = $request->validate([
        //     'berkas_un' => 'required|image|file|max:1024',
        //     'berkas_rapot' => 'required|image|file|max:1024',
        //     'sertifikat' => 'image|file|max:1024',
        // ]);
        $validatedData['id_pendaftaran'] = IdGenerator::generate(['table' => 'siswa', 'field' => 'id_pendaftaran', 'length' => strlen($formatid) + 3, 'prefix' => $formatid, 'reset_on_prefix_change' => true]);
        $validatedData['username_siswa'] = auth()->user()->username;
        $jalur = SetPendaftaran::where('id', 1)->first();
        // dd($jalur->dtl_pendaftaran->nama_pendaftaran);
        $validatedData['jalur'] = $jalur->dtl_pendaftaran->kode_pendaftaran;
        $validatedData['status_seleksi'] = "Seleksi";
        for ($i = 0; $i <= $request->jml; $i++) {
            if ($request->file('berkas_' . $i)) {
                $rules_berkas = [
                    'berkas_' . $i => 'required|file|mimes:png,jpg,jpeg,pdf|max:1024',
                    'desc_' . $i => 'required',
                ];
                // dd($rules_berkas);
                $validatedData_berkas['berkas'] = $request->file('berkas_' . $i)->store('img/berkas_' . $i);
                $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_' . $i];
                // Berkas::create($validatedData_berkas);
            }
        }
        Siswa::create($validatedData);
        $validatedData_berkas['id_pendaftaran_berkas'] = $validatedData['id_pendaftaran'];
        for ($i = 0; $i <= $request->jml; $i++) {
            if ($request->file('berkas_' . $i)) {
                $rules_berkas = [
                    'berkas_' . $i => 'required|file|mimes:png,jpg,jpeg,pdf|max:1024',
                    'desc_' . $i => 'required',
                ];
                // dd($rules_berkas);
                $validatedData_berkas['berkas'] = $request->file('berkas_' . $i)->store('img/berkas_' . $i);
                $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_' . $i];
                Berkas::create($validatedData_berkas);
            }
        }
        // if ($request->file('berkas_un')) {
        //     $rules_berkas = [
        //         'desc_berkas_un' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('berkas_un')->store('img/berkas_un');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_un'];
        //     Berkas::create($validatedData_berkas);
        // }
        // if ($request->file('berkas_rapot')) {
        //     $rules_berkas = [
        //         'desc_berkas_rapot' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('berkas_rapot')->store('img/berkas_rapot');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_rapot'];
        //     // $validatedData_berkas['nama_berkas'] = $request->desc_berkas_rapot;
        //     Berkas::create($validatedData_berkas);
        // }
        // if ($request->file('sertifikat')) {
        //     $rules_berkas = [
        //         'desc_sertifikat' => 'required',
        //     ];
        //     // $x = $request->validate($rules_berkas);
        //     // dd($x);
        //     $validatedData_berkas['berkas'] = $request->file('sertifikat')->store('img/sertifikat');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_sertifikat'];
        //     Berkas::create($validatedData_berkas);
        // }
        // $validatedData['id_pendaftaran'] = IdGenerator::generate(['table' => 'siswa', 'field' => 'id_pendaftaran', 'length' => strlen($formatid) + 3, 'prefix' => $formatid, 'reset_on_prefix_change' => true]);
        // $validatedData['username_siswa'] = auth()->user()->username;
        // $validatedData_berkas['username_berkas'] = auth()->user()->username;
        // dd($validatedData);        
        // dd($validatedData['t_lahir']);
        // Siswa::create($validatedData);
        // Berkas::create($validatedData_berkas);
        return redirect('/')->with('success', 'Pendaftaran Telah Berhasil !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        // dd($siswa->jalur);
        $kode_pendaftaran = Pendaftaran::where('kode_pendaftaran', $siswa->jalur)->value('kode_pendaftaran');
        // $data_berkas=Berkas::where('id_pendaftaran_berkas',$siswa->id_pendaftaran)->get();
        return view('dashboard.edit-siswa', [
            'title' => 'Siswa',
            'siswa' => $siswa,
            'data_berkas' => Berkas::where('id_pendaftaran_berkas', $siswa->id_pendaftaran)->get(),
            'data_pendaftaran' => Pendaftaran::all(),
            'data_kelas' => DetailPendaftaran::where('detail_kode_pendaftaran', $kode_pendaftaran)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        // dd($request->tmp_berkas_[2]);
        // $uploaded_berkas = $request->berkas_;
        // $i = $request->jml;
        // dd($i);
        // $berkas = Berkas::where('id_pendaftaran_berkas', $siswa->id_pendaftaran)->pluck('berkas');
        // dd($berkas);
        //!Validasi Berkas Awal
        // if ($request->file('berkas_un')) {
        //     $rules_berkas = [
        //         'desc_berkas_un' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('berkas_un')->store('img/berkas_un');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_un'];
        // }
        // if ($request->file('berkas_rapot')) {
        //     $rules_berkas = [
        //         'desc_berkas_rapot' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('berkas_rapot')->store('img/berkas_rapot');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_rapot'];
        // }
        // if ($request->file('sertifikat')) {
        //     $rules_berkas = [
        //         'desc_sertifikat' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('sertifikat')->store('img/sertifikat');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_sertifikat'];
        // }
        //!end      
        $formatid = Pendaftaran::where('kode_pendaftaran', $request->jalur)->pluck('kode_pendaftaran')->first();
        $validatedData = $request->validate([
            'nisn' => 'required|digits:10',
            'nama_siswa' => 'required|max:64',
            // 'foto' => 'required|image|file|max:1024',           
            'j_kelamin' => 'required',
            't_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'asal_sekolah' => 'required',
            'nama_sekolah' => 'required',
            'no_hp' => 'required',
            'nama_ayah' => 'required',
            'hp_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'nama_ibu' => 'required',
            'hp_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'nilai_bindo' => 'required',
            'nilai_matematika' => 'required',
            'nilai_ipa' => 'required',
            'rapot_bindo' => 'required',
            'rapot_matematika' => 'required',
            'rapot_ipa' => 'required',
            'rapot_bing' => 'required',
            'pilihan_1' => 'required',
            'pilihan_2' => 'required',
        ]);
        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('img/foto');
        }
        // $validatedData_berkas = $request->validate([
        //     'berkas_un' => 'required|image|file|max:1024',
        //     'berkas_rapot' => 'required|image|file|max:1024',
        //     'sertifikat' => 'image|file|max:1024',
        // ]);
        $validatedData['username_admin'] = auth()->user()->username;
        // $jalur = SetPendaftaran::where('id', 1)->first();
        if ($siswa->jalur != $request->jalur) {
            $validatedData['id_pendaftaran'] = IdGenerator::generate(['table' => 'siswa', 'field' => 'id_pendaftaran', 'length' => strlen($formatid) + 3, 'prefix' => $formatid, 'reset_on_prefix_change' => true]);
            $validatedData['jalur'] = $request->jalur;
        }
        for ($i = 0; $i <= $request->jml; $i++) {
            if ($request->file('berkas_' . $i)) {
                $rules_berkas = [
                    'berkas_' . $i => 'required|file|mimes:png,jpg,jpeg,pdf|max:1024',
                    'desc_' . $i => 'required',
                ];
                $validatedData_berkas['berkas'] = $request->file('berkas_' . $i)->store('img/berkas_' . $i);
                $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_' . $i];
            }
        }
        Siswa::where('id', $siswa->id)->update($validatedData);
        $berkas = Berkas::where('id_pendaftaran_berkas', $siswa->id_pendaftaran)->pluck('id_pendaftaran_berkas')->first();
        if ($siswa->jalur != $request->jalur) {
            $validatedData_berkas['id_pendaftaran_berkas'] = $validatedData['id_pendaftaran'];
        }
        $validatedData_berkas['id_pendaftaran_berkas'] = $siswa->id_pendaftaran;
        for ($i = 0; $i <= $request->jml; $i++) {
            if ($request->file('berkas_' . $i)) {
                $rules_berkas = [
                    'berkas_' . $i => 'required|file|mimes:png,jpg,jpeg,pdf|max:1024',
                    'desc_' . $i => 'required',
                ];
                $validatedData_berkas['berkas'] = $request->file('berkas_' . $i)->store('img/berkas_' . $i);
                $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_' . $i];
                // Berkas::create($validatedData_berkas);
                // Berkas::where('berkas', $request->tmp_berkas_[$i])->update($validatedData_berkas);
                Berkas::updateOrCreate(
                    ['berkas' => $request->tmp_berkas_[$i]],
                    $validatedData_berkas
                );
            }
        }
        // foreach ($uploaded_berkas as $i => $data_berkas){

        // }
        // if ($request->file('berkas_un')) {
        //     $rules_berkas = [
        //         'desc_berkas_un' => 'required',
        //     ];
        //     File::delete(public_path($siswa->berkas));
        //     $validatedData['foto'] = $request->file('foto')->store('img/foto');
        //     $validatedData_berkas['berkas'] = $request->file('berkas_un')->store('img/berkas_un');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_un'];
        //     Berkas::create($validatedData_berkas);
        // }
        // if ($request->file('berkas_rapot')) {
        //     $rules_berkas = [
        //         'desc_berkas_rapot' => 'required',
        //     ];
        //     $validatedData_berkas['berkas'] = $request->file('berkas_rapot')->store('img/berkas_rapot');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_berkas_rapot'];
        //     // $validatedData_berkas['nama_berkas'] = $request->desc_berkas_rapot;
        //     Berkas::create($validatedData_berkas);
        // }
        // if ($request->file('sertifikat')) {
        //     $rules_berkas = [
        //         'desc_sertifikat' => 'required',
        //     ];
        //     // $x = $request->validate($rules_berkas);
        //     // dd($x);
        //     $validatedData_berkas['berkas'] = $request->file('sertifikat')->store('img/sertifikat');
        //     $validatedData_berkas['nama_berkas'] = $request->validate($rules_berkas)['desc_sertifikat'];
        //     Berkas::create($validatedData_berkas);
        // }
        // $validatedData['id_pendaftaran'] = IdGenerator::generate(['table' => 'siswa', 'field' => 'id_pendaftaran', 'length' => strlen($formatid) + 3, 'prefix' => $formatid, 'reset_on_prefix_change' => true]);
        // $validatedData['username_siswa'] = auth()->user()->username;
        // $validatedData_berkas['username_berkas'] = auth()->user()->username;
        // dd($validatedData);        
        // dd($validatedData['t_lahir']);
        // Siswa::create($validatedData);
        // Berkas::create($validatedData_berkas);
        return redirect('data-siswa')->with('update', 'Data Siswa Telah diperbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }

    public function set_terima(Siswa $siswa, $admin)
    {
        $data['status_seleksi'] = "Diterima";
        $data['username_admin'] = $admin;
        Siswa::where('id', $siswa->id)->update($data);
        return redirect('/data-siswa')->with('success', $siswa->nama_siswa . ' Telah Diterima !');
    }
    public function set_verifikasi(Siswa $siswa, $admin)
    {
        $data['status_seleksi'] = "Terverifikasi";
        $data['username_admin'] = $admin;
        Siswa::where('id', $siswa->id)->update($data);
        return redirect('/data-siswa')->with('update', $siswa->nama_siswa . ' Telah Diverifikasi !');
    }
    public function set_gagal(Siswa $siswa, $admin)
    {
        $data['status_seleksi'] = "Gagal";
        $data['username_admin'] = $admin;
        Siswa::where('id', $siswa->id)->update($data);
        return redirect('/data-siswa')->with('delete', $siswa->nama_siswa . ' Telah Ditolak !');
    }
    public function nilai_berkas(Request $request)
    {
        // dd($request->id_siswa);
        $total = 0;
        for ($i = 0; $i < count($request->nilai_berkas); $i++) {
            if ($request->nilai_berkas[$i] != null) {
                $data['nilai_berkas'] = $request->nilai_berkas[$i];
                Berkas::where('berkas', $request->nama_berkas[$i])->update($data);
                $total += $request->nilai_berkas[$i];
            }
            Siswa::where('id', $request->id_siswa)->update(['total_nilai_berkas' => $total]);
        }
        return redirect('/data-siswa')->with('success', 'Berhasil Melakukan Skor Berkas !');
    }
}
