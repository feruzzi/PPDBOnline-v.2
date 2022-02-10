<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\DetailPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function home()
    {
        return view('home', [
            'title' => 'Home',
        ]);
    }
    public function pendaftaran()
    {
        $cek_pendaftaran = DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran');
        $dtl_kelas = DetailPendaftaran::where('detail_kode_pendaftaran', $cek_pendaftaran)->get();
        $jumlah_berkas = Pendaftaran::where('kode_pendaftaran', $cek_pendaftaran)->first();
        // dd($jumlah_berkas->jumlah_berkas);
        $jumlah_berkas = $jumlah_berkas->jumlah_berkas;
        // dd($dtl_kelas);
        // dd($dtl_kelas->detail_kode_pendaftaran);        
        if (auth()->user()->email_verified_at == null) {
            return redirect('/')->with('delete', 'Silahkan Aktivasi Email !');
        }
        // if (!is_null(Siswa::where('id_pendaftaran', 'like', '%' . $cek_pendaftaran . '%')->where('username_siswa', auth()->user()->username)->first())) {
        //     return redirect('/')->with('delete', 'Anda Sudah Pernah Mendaftar di Pendaftaran ' . $cek_pendaftaran);
        // }
        if (!is_null(Siswa::where('jalur', $cek_pendaftaran)->where('username_siswa', auth()->user()->username)->first())) {
            return redirect('/')->with('delete', 'Anda Sudah Pernah Mendaftar di Pendaftaran ' . $cek_pendaftaran);
        }
        if ($cek_pendaftaran == null) {
            return view('pendaftaran-tutup', [
                'title' => 'Pendaftaran Tutup',
            ]);
        } else {
            return view('pendaftaran', [
                'title' => 'Pendaftaran',
                'data_kelas' => $dtl_kelas,
                'jumlah_berkas' => $jumlah_berkas,
            ]);
        }
    }
    public function pengumuman()
    {
        $set_pengumuman = DB::table('set_pengumuman')->where('id', 1)->value('set_kode_pengumuman');

        return view('pengumuman', [
            'title' => 'Pengumuman',
            'pengumuman' => Pengumuman::where('kode_pengumuman', $set_pengumuman)->pluck('isi'),
            // 'pengumuman' => DB::table('pengumuman')->where('kode_pengumuman', $set_pengumuman)->value('isi'),
        ]);
    }
    public function login_siswa()
    {
        return view('login-siswa', [
            'title' => 'Login',
        ]);
    }
    public function login_auth()
    {
        return view('login-auth', [
            'title' => 'Login Auth',
        ]);
    }
    public function dashboard()
    {
        $cek_pendaftaran = DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran');
        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $cek_pendaftaran)->first();
        if (is_null($cek_pendaftaran)) {
            $pendaftaran = new pendaftaran;
            $pendaftaran->kode_pendaftaran = "TUTUP";
            // dd($pendaftaran->kode_pendaftaran);
            $pendaftaran->nama_pendaftaran = "Pendaftaran Tutup";
        }
        // dd($pendaftaran->nama_pendaftaran);
        $dtl_kelas = DetailPendaftaran::where('detail_kode_pendaftaran', $cek_pendaftaran)->get();
        $kuota = 0;
        foreach ($dtl_kelas as $kelas) {
            $kuota += $kelas->kuota;
        }
        // dd($kuota);
        $set_pengumuman = DB::table('set_pengumuman')->where('id', 1)->value('set_kode_pengumuman');
        $pengumuman = Pengumuman::where('kode_pengumuman', $set_pengumuman)->first();
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'pendaftaran' => $pendaftaran,
            'data_kelas' => $dtl_kelas,
            'pengumuman' => $pengumuman,
            'kuota' => $kuota,
        ]);
    }
    public function data_users()
    {
        return view('dashboard.users', [
            'title' => 'Users',
            'username' => 'Username',
            'users' => User::all(),
        ]);
    }
    public function data_siswa()
    {
        return view('dashboard.siswa', [
            'title' => 'Siswa',
            'username' => 'Username',
        ]);
    }
    public function data_kelas()
    {
        return view('dashboard.kelas', [
            'title' => 'Kelas',
            'username' => 'Username',
        ]);
    }
    public function data_pendaftaran()
    {
        return view('dashboard.pendaftaran', [
            'title' => 'Pendaftaran',
            'username' => 'Username',
        ]);
    }
    public function data_pengumuman()
    {
        return view('dashboard.pengumuman', [
            'title' => 'Pengumuman',
            'username' => 'Username',
        ]);
    }
    public function daftar_ulang()
    {
        return view('daftar-ulang', [
            'title' => 'Daftar Ulang',
            'username' => 'Username',
        ]);
    }
    public function data_laporan()
    {
        // dd(request('cari'));
        $formatid = DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran');
        $formatid = Pendaftaran::where('kode_pendaftaran', $formatid)->first();
        // dd($formatid->nama_pendaftaran);
        // $siswa = Siswa::oldest();
        // $siswa = Siswa::count();
        // dd($siswa);
        $jml_kelas = [];
        if (request('cari')) {
            // $siswa->where('id_pendaftaran', 'like', '%' . request('cari') . '%');
            // $formatid = request('cari');
            $data_kelas = DetailPendaftaran::where('detail_kode_pendaftaran', request('cari'))->get();
            foreach ($data_kelas as $kelas) {
                $jml_kelas[$kelas->kelas->kode_kelas] = Siswa::where('jalur', request('cari'))->where('status_seleksi', $kelas->kelas->kode_kelas)->count();
            }
            // dd($jml_kelas['10-A3']);
            // dd($jml_kelas['10-AG']);
            $formatid = Pendaftaran::where('kode_pendaftaran', request('cari'))->first();
            $pendaftar = Siswa::where('jalur', request('cari'))->count();
            $daftar_ulang = Siswa::where('jalur', request('cari'))->where('status_seleksi', 'Daftar Ulang')->count();
            $diterima = Siswa::where('jalur', request('cari'))->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal')->where('status_seleksi', '!=', 'Daftar Ulang')->where('status_seleksi', '!=', 'Terverifikasi')->count();
            $gagal = Siswa::where('jalur', request('cari'))->where('status_seleksi', 'Gagal')->count();
            $laki = Siswa::where('jalur', request('cari'))->where('j_kelamin', 'Laki-Laki')->where('status_du', 1)->count();
            $perempuan = Siswa::where('jalur', request('cari'))->where('j_kelamin', 'Perempuan')->where('status_du', 1)->count();
            $smp = Siswa::where('jalur', request('cari'))->where('asal_sekolah', 'SMP')->where('status_du', 1)->count();
            $mts = Siswa::where('jalur', request('cari'))->where('asal_sekolah', 'MTs')->where('status_du', 1)->count();
            $lain = Siswa::where('jalur', request('cari'))->where('asal_sekolah', 'Lainnya')->where('status_du', 1)->count();
        } elseif ($formatid != null) {
            // $siswa->where('id_pendaftaran', 'like', '%' . $formatid . '%');
            $data_kelas = DetailPendaftaran::where('detail_kode_pendaftaran', $formatid->kode_pendaftaran)->get();
            foreach ($data_kelas as $kelas) {
                $jml_kelas[$kelas->kelas->kode_kelas] = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', $kelas->kelas->kode_kelas)->count();
            }
            $pendaftar = Siswa::where('jalur', $formatid->kode_pendaftaran)->count();
            $daftar_ulang = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', 'Daftar Ulang')->count();
            $diterima = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal')->where('status_seleksi', '!=', 'Daftar Ulang')->where('status_seleksi', '!=', 'Terverifikasi')->count();
            $gagal = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', 'Gagal')->count();
            $laki = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('j_kelamin', 'Laki-Laki')->where('status_du', 1)->count();
            $perempuan = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('j_kelamin', 'Perempuan')->where('status_du', 1)->count();
            $smp = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'SMP')->where('status_du', 1)->count();
            $mts = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'MTs')->where('status_du', 1)->count();
            $lain = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'Lainnya')->where('status_du', 1)->count();
        }
        // else {
        //     $formatid = Pendaftaran::last();
        //     // $formatid = Pendaftaran::pluck('kode_pendaftaran')->last();
        //     $pendaftar = Siswa::where('jalur', $formatid->kode_pendaftaran)->count();
        //     $daftar_ulang = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', 'Daftar Ulang')->count();
        //     $diterima = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal')->where('status_seleksi', '!=', 'Daftar Ulang')->where('status_seleksi', '!=', 'Terverifikasi')->count();
        //     $gagal = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', 'Gagal')->count();
        //     $laki = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('j_kelamin', 'Laki-Laki')->where('status_seleksi', 'Daftar Ulang')->count();
        //     $perempuan = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('j_kelamin', 'Perempuan')->where('status_seleksi', 'Daftar Ulang')->count();
        //     $smp = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'SMP')->where('status_seleksi', 'Daftar Ulang')->count();
        //     $mts = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'MTs')->where('status_seleksi', 'Daftar Ulang')->count();
        //     $lain = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'Lainnya')->where('status_seleksi', 'Daftar Ulang')->count();
        // }
        return view('dashboard.laporan', [
            'title' => 'Laporan',
            // 'filter' => Pendaftaran::all()->last(),
            'data_pendaftaran' => Pendaftaran::all(),
            'pendaftar' => $pendaftar,
            'daftar_ulang' => $daftar_ulang,
            'diterima' => $diterima,
            'gagal' => $gagal,
            'laki' => $laki,
            'perempuan' => $perempuan,
            'smp' => $smp,
            'mts' => $mts,
            'lain' => $lain,
            'detail_pendaftaran' => $formatid,
            'data_kelas' => $data_kelas,
            'jml_kelas' => $jml_kelas,
            // 'data_siswa' => $siswa->with('berkas')->get(),
        ]);
        // return view('dashboard.laporan', [
        //     'title' => 'Laporan',
        //     'username' => 'Username',
        // ]);
    }
    public function reset_password($email)
    {
        // $user = User::where('remember_token', $email)->first();
        return view('reset-password', [
            'title' => 'Reset Password',
            'data_user' => User::where('remember_token', $email)->first(),
        ]);
    }
    public function cek_daftar_ulang($user)
    {
        // $user = User::where('remember_token', $email)->first();
        $cek_du = Siswa::where('username_siswa', $user)->first();
        // dd($cek_du->jalur);
        $jalur_du = DB::table('set_pendaftaran')->where('id', 2)->value('set_kode_pendaftaran');
        if ($cek_du->status_seleksi != "Seleksi" && $cek_du->status_seleksi != "Gagal" && $cek_du->status_seleksi != "Terverifikasi") {
            $valid_du = "1";
        } else {
            $valid_du = "0";
        }
        // dd($valid_du);
        if ($cek_du->jalur == $jalur_du && $valid_du == "1") {
            // dd("Daftar Ulang");
            // return redirect('/daftar-ulang/' . $cek_du->id_pendaftaran . '')->with('success', 'Selamat Anda dinyatakan LOLOS Seleksi, Silahkan Melakukan Daftar Ulang dengan Mengisi Form Daftar Ulang Berikut !');
            return view('daftar-ulang', [
                'title' => 'Daftar Ulang',
                'siswa' => $cek_du,
                'success' => 'Selamat Anda dinyatakan LOLOS Seleksi (kode: ' . $cek_du->jalur . '), Silahkan Melakukan Daftar Ulang dengan Mengisi Form Daftar Ulang Berikut !'
                // 'data_user' => User::where('remember_token', $email)->first(),
            ]);
        } else if ($cek_du->jalur != $jalur_du && $valid_du == "1") {
            return redirect('/')->with('delete', 'Form Daftar Ulang Pendaftaran (kode: ' . $cek_du->jalur . ') Belum dibuka');
        } else {
            return redirect('/')->with('delete', 'Maaf Anda Tidak/Belum Lolos Seleksi Pendaftaran (kode: ' . $cek_du->jalur . ')');
        }
        return view('daftar-ulang', [
            'title' => 'Daftar Ulang',
            // 'data_user' => User::where('remember_token', $email)->first(),
        ]);
    }
}
