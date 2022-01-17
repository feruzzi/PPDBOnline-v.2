<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
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
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            // 'username' => 'Username',
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
        return view('dashboard.laporan', [
            'title' => 'Laporan',
            'username' => 'Username',
        ]);
    }
}
