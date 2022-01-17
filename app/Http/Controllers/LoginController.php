<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //dd($request->all());
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('dashboard');
        }
        return redirect('login-auth')->with('delete', 'Username atau Password Salah');
    }
    public function login_siswa(Request $request)
    {
        //dd($request->all());
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/');
        }
        return redirect('login-siswa')->with('delete', 'Username atau Password Salah');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login-auth');
    }
    public function logout_siswa(Request $request)
    {
        Auth::logout();
        return redirect('login-siswa');
    }
}
