<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use App\Mail\kirimEmail;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users', [
            'title' => 'Users',
            'username' => 'Username',
            'users' => User::where('level', 1)->orWhere('level', 0)->get(),
            'siswa' => User::where('level', 2)->get(),
        ]);
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
        $validatedData = $request->validate([
            'nama' => 'required|max:64',
            'username' => 'required|max:16|min:4|unique:users',
            'password' => 'required|min:4',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['level'] = $request->level;
        // dd($validatedData);
        User::create($validatedData);
        return redirect('/data-users')->with('success', 'Data Berhasil Ditambahkan !');
    }
    public function store_user_siswa(Request  $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:64',
            'username' => 'required|max:16|min:4|unique:users',
            'password' => 'required|min:4',
            'email' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['remember_token'] = "By_Admin";
        $validatedData['level'] = "2";
        $validatedData['email_verified_at'] = date('Y-m-d H:i:s');
        // dd($validatedData);
        User::create($validatedData);
        return redirect('/data-users')->with('success', 'Data Berhasil Ditambahkan !');
    }

    public function register(Request  $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:64',
            'username' => 'required|max:16|min:4|unique:users',
            'password' => 'required|min:4',
            'email' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['remember_token'] = hash('sha256', $request->email);
        $validatedData['level'] = 2;
        // dd($validatedData);
        User::create($validatedData);
        $details = [
            'title' => 'Aktifasi Akun',
            'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Optio, totam. Dolor repellendus atque quos nihil, ipsa consequatur eos dolore magnam dicta maxime saepe sed debitis accusantium est quia cupiditate qui.
            Laudantium tenetur, aliquam nobis similique numquam dicta eveniet provident. Animi, ipsa libero? Dolorum quo rerum expedita impedit nesciunt quis necessitatibus et dolor doloribus. Nam in eum, quod sunt cumque veritatis.
            Facere porro expedita animi repudiandae asperiores deleniti necessitatibus voluptatum illo quam sint, laborum corrupti aperiam impedit commodi officia maiores laboriosam doloribus vitae harum enim? Ipsum sequi pariatur odit minus ea!
            Saepe voluptate corrupti quidem enim vel quia eos sed excepturi distinctio temporibus quo consectetur officia velit fugiat esse dolorem nobis possimus cumque earum labore sunt, asperiores iure quos error? Illum?',
            'link' => 'http://ppdb.test:8081/verify/' . $validatedData['remember_token'],
        ];
        // $subject = User::where('remember_token', $validatedData['remember_token'])->pluck('username')->first();

        Mail::to($request->email)->send(new kirimEmail($details));
        return redirect('/login-siswa')->with('success', 'Berhasil Melakukan Registrasi Akun Silahkan Cek EMAIL yang didaftarkan !');
    }
    public function verify_by_admin($token)
    {
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        try {
            User::where('remember_token', $token)->update($data);
            return redirect('/data-users')->with('success', 'Berhasil Melakukan Aktivasi Akun !');
        } catch (Exception $e) {
            return redirect('/data-users')->with('delete', 'Gagal Melakukan Aktivasi Akun !');
        }
    }
    public function verify($token)
    {
        // $data_user = User::where('username', $username)->pluck('username')->first();
        // $data_user = User::where('username', $username);
        // User::where('id', $data_user->id)->update($validatedData);
        // dd(date('Y-m-d H:i:s'));
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        // if ($token == $user->remember_token) {
        //     User::where('id', $user->id)->update($data);
        //     return redirect('/login-siswa')->with('success', 'Berhasil Melakukan Aktivasi Akun !');
        // } else {
        //     return redirect('/login-siswa')->with('delete', 'Gagal Melakukan Aktivasi Akun !');
        // }
        try {
            User::where('remember_token', $token)->update($data);
            return redirect('/login-siswa')->with('success', 'Berhasil Melakukan Aktivasi Akun !');
        } catch (Exception $e) {
            return redirect('/login-siswa')->with('delete', 'Gagal Melakukan Aktivasi Akun !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $data_user)
    {
        // dd($data_user->username);
        $rules = [
            'nama' => 'required|max:64',
            'password' => 'required|min:4',
        ];
        if ($request->username != $data_user->username) {
            $rules['username'] = 'required|max:16|min:4|unique:users';
        }
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['level'] = $request->level;
        User::where('id', $data_user->id)->update($validatedData);
        return redirect('/data-users')->with('update', 'Data Berhasil Diupdate !');
    }
    public function update_user_siswa(Request $request, User $data_user)
    {
        // dd($data_user->username);
        $rules = [
            'nama' => 'required|max:64',
            'password' => 'required|min:4',
            'email' => 'required',
        ];
        if ($request->username != $data_user->username) {
            $rules['username'] = 'required|max:16|min:4|unique:users';
        }
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['remember_token'] = $request->token;
        $validatedData['level'] = 2;
        User::where('id', $data_user->id)->update($validatedData);
        return redirect('/data-users')->with('update', 'Data Berhasil Diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     // dd($user);
    //     User::destroy($id);
    //     return redirect('/data-users')->with('success', 'Data Berhasil Dihapus !');
    // }
    public function destroy(User $data_user)
    {
        // dd($data_user->id);
        User::destroy($data_user->id);
        return redirect('/data-users')->with('delete', 'Data Berhasil Dihapus !');
    }
}
