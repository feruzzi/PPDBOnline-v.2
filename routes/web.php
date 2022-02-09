<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [PagesController::class, 'home'])->name('home');
// Route::get('/pendaftaran', [PagesController::class, 'pendaftaran']);
Route::get('/pengumuman', [PagesController::class, 'pengumuman']);
Route::get('/login-siswa', [PagesController::class, 'login_siswa']);
Route::get('/login-auth', [PagesController::class, 'login_auth']);
Route::post('/auth', [LoginController::class, 'login']);
Route::post('/auth-siswa', [LoginController::class, 'login_siswa']);
Route::post('/register', [UsersController::class, 'register']);
Route::post('/lupa-password', [UsersController::class, 'lupa_password']);
Route::get('/lupa-password/{email}', [PagesController::class, 'reset_password']);
Route::put('/reset-password/{id}', [UsersController::class, 'reset_password']);
Route::get('/verify/{token}', [UsersController::class, 'verify']);

Route::middleware(['auth', 'ceklevel:0,1'])->group(function () {
    Route::resource('/data-users', UsersController::class);
    Route::put('/data-users/siswa/{data_user}', [UsersController::class, 'update_user_siswa']);
    Route::post('/data-users/siswa', [UsersController::class, 'store_user_siswa']);
    Route::get('/verify-by-admin/{token}', [UsersController::class, 'verify_by_admin']);

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::resource('/data-kelas', KelasController::class)->parameters([
        'data-kelas' => 'kelas'
    ]);
    Route::resource('/data-pendaftaran', PendaftaranController::class)->parameters([
        'data-pendaftaran' => 'pendaftaran'
    ]);
    Route::resource('/data-pengumuman', PengumumanController::class)->parameters([
        'data-pengumuman' => 'pengumuman'
    ]);
    Route::resource('/data-siswa', SiswaController::class)->parameters([
        'data-siswa' => 'siswa'
    ]);
    Route::put('/siswa/berkas', [SiswaController::class, 'nilai_berkas']);
    Route::get('/seleksi', [SiswaController::class, 'seleksi']);
    Route::put('/data-siswa/verify/seleksi', [SiswaController::class, 'hasil_seleksi']);
    Route::put('/data-siswa/verify/terima/{siswa}/{admin}', [SiswaController::class, 'set_terima']);
    Route::put('/data-siswa/verify/verifikasi/{siswa}/{admin}', [SiswaController::class, 'set_verifikasi']);
    Route::put('/data-siswa/verify/gagal/{siswa}/{admin}', [SiswaController::class, 'set_gagal']);
    Route::put('/set-daftar/{pendaftaran}', [PendaftaranController::class, 'set_daftar']);
    Route::put('/set-tutup', [PendaftaranController::class, 'set_tutup']);
    Route::put('/set-du-buka/{pendaftaran}', [PendaftaranController::class, 'set_du_buka']);
    Route::put('/set-du-tutup', [PendaftaranController::class, 'set_du_tutup']);
    Route::put('/set-tempel/{pengumuman}', [PengumumanController::class, 'set_tempel']);
    Route::put('/set-lepas', [PengumumanController::class, 'set_lepas']);

    Route::get('/dashboard', [PagesController::class, 'dashboard']);
    // Route::get('/data-users', [PagesController::class, 'data_users']);
    // Route::get('/data-siswa', [PagesController::class, 'data_siswa']);
    // Route::get('/data-kelas', [PagesController::class, 'data_kelas']);
    // Route::get('/data-pendaftaran', [PagesController::class, 'data_pendaftaran']);
    // Route::get('/data-pengumuman', [PagesController::class, 'data_pengumuman']);
    Route::get('/data-laporan', [PagesController::class, 'data_laporan']);
    Route::get('/data-laporan/export/', [SiswaController::class, 'export_siswa']);
});

Route::middleware(['auth', 'ceklevel:2'])->group(function () {
    Route::get('/pendaftaran', [PagesController::class, 'pendaftaran']);
    Route::get('/cek-daftar-ulang/{user}', [PagesController::class, 'cek_daftar_ulang']);
    Route::put('/daftar-ulang/{id}', [SiswaController::class, 'daftar_ulang']);
    // Route::get('/daftar-ulang/{id_pendaftaran}', [PagesController::class, 'daftar_ulang']);
    Route::get('/logout-siswa', [LoginController::class, 'logout_siswa']);
    Route::post('/submit/daftar', [SiswaController::class, 'daftar']);
});
