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
    public function data_laporan()
    {
        // dd(request('cari'));
        $formatid = DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran');
        $formatid = Pendaftaran::where('kode_pendaftaran', $formatid)->first();
        // dd($formatid->nama_pendaftaran);
        // $siswa = Siswa::oldest();
        // $siswa = Siswa::count();
        // dd($siswa);
        if (request('cari')) {
            // $siswa->where('id_pendaftaran', 'like', '%' . request('cari') . '%');
            // $formatid = request('cari');
            $formatid = Pendaftaran::where('kode_pendaftaran', request('cari'))->first();
            $pendaftar = Siswa::where('jalur', request('cari'))->count();
            $daftar_ulang = Siswa::where('jalur', request('cari'))->where('status_seleksi', 'Daftar Ulang')->count();
            $diterima = Siswa::where('jalur', request('cari'))->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal')->where('status_seleksi', '!=', 'Daftar Ulang')->where('status_seleksi', '!=', 'Terverifikasi')->count();
            $gagal = Siswa::where('jalur', request('cari'))->where('status_seleksi', 'Gagal')->count();
            $laki = Siswa::where('jalur', request('cari'))->where('j_kelamin', 'Laki-Laki')->where('status_seleksi', 'Daftar Ulang')->count();
            $perempuan = Siswa::where('jalur', request('cari'))->where('j_kelamin', 'Perempuan')->where('status_seleksi', 'Daftar Ulang')->count();
            $smp = Siswa::where('jalur', request('cari'))->where('asal_sekolah', 'SMP')->where('status_seleksi', 'Daftar Ulang')->count();
            $mts = Siswa::where('jalur', request('cari'))->where('asal_sekolah', 'MTs')->where('status_seleksi', 'Daftar Ulang')->count();
            $lain = Siswa::where('jalur', request('cari'))->where('asal_sekolah', 'Lainnya')->where('status_seleksi', 'Daftar Ulang')->count();
        } elseif ($formatid != null) {
            // $siswa->where('id_pendaftaran', 'like', '%' . $formatid . '%');
            $pendaftar = Siswa::where('jalur', $formatid->kode_pendaftaran)->count();
            $daftar_ulang = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', 'Daftar Ulang')->count();
            $diterima = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', '!=', 'seleksi')->where('status_seleksi', '!=', 'Gagal')->where('status_seleksi', '!=', 'Daftar Ulang')->where('status_seleksi', '!=', 'Terverifikasi')->count();
            $gagal = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('status_seleksi', 'Gagal')->count();
            $laki = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('j_kelamin', 'Laki-Laki')->where('status_seleksi', 'Daftar Ulang')->count();
            $perempuan = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('j_kelamin', 'Perempuan')->where('status_seleksi', 'Daftar Ulang')->count();
            $smp = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'SMP')->where('status_seleksi', 'Daftar Ulang')->count();
            $mts = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'MTs')->where('status_seleksi', 'Daftar Ulang')->count();
            $lain = Siswa::where('jalur', $formatid->kode_pendaftaran)->where('asal_sekolah', 'Lainnya')->where('status_seleksi', 'Daftar Ulang')->count();
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
}
