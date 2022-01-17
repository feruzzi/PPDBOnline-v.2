<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pengumuman', [
            'title' => 'Pengumuman',
            'username' => 'Username',
            'data_pengumuman' => Pengumuman::all(),
            'data_set_pengumuman' => DB::table('set_pengumuman')->where('id', 1)->value('set_kode_pengumuman'),
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
            'kode_pengumuman' => 'required|max:8|unique:pengumuman',
            'nama_pengumuman' => 'required|max:24|min:4',
            'isi' => 'required',
        ]);
        // $validatedData['kode_pengumuman'] = str_replace(" ", "-", $validatedData['kode_pengumuman']);
        // $validatedData['nama_pengumuman'] = str_replace(" ", "-", $validatedData['nama_pengumuman']);
        // dd($validatedData);
        Pengumuman::create($validatedData);
        return redirect('/data-pengumuman')->with('success', 'Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        try {

            $rules = [
                'nama_pengumuman' => 'required|max:12|min:4',
                'isi' => 'required',
            ];
            if ($request->kode_pengumuman != $pengumuman->kode_pengumuman) {
                $rules['kode_pengumuman'] = 'required|max:8|unique:pengumuman';
            }
            $validatedData = $request->validate($rules);
            // $validatedData['kode_pengumuman'] = str_replace(" ", "-", $request->kode_pengumuman);
            // $validatedData['nama_pengumuman'] = str_replace(" ", "-", $validatedData['nama_pengumuman']);
            $validatedData['isi'] = $request->isi;
            // dd($validatedData);
            Pengumuman::where('id', $pengumuman->id)->update($validatedData);
            return redirect('/data-pengumuman')->with('update', 'Data Berhasil Diupdate !');
        } catch (Exception $e) {
            return redirect('/data-pengumuman')->with('delete', 'Terjadi Kesalahan, Gagal Mengupdate. Pastikan Data Sedang Tidak Digunakan !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        // dd($pengumuman->id);
        try {
            Pengumuman::destroy($pengumuman->id);
            return redirect('/data-pengumuman')->with('delete', 'Data Berhasil Dihapus !');
        } catch (Exception $e) {
            // return redirect('/data-pengumuman')->with('delete', $e->getMessage());
            return redirect('/data-pengumuman')->with('delete', 'Terjadi Kesalahan, Gagal Menghapus. Pastikan Data Sedang Tidak Digunakan !');
        }
    }
    public function set_tempel(Pengumuman $pengumuman)
    {
        // dd($pengumuman->kode_pengumuman);
        DB::table('set_pengumuman')->where('id', 1)->update(['set_kode_pengumuman' => $pengumuman->kode_pengumuman]);
        return redirect('/data-pengumuman')->with('success', 'Pengumuman ' . $pengumuman->nama_pengumuman . ' Berhasil ditempel !');
    }
    public function set_lepas(Pengumuman $pengumuman)
    {
        // dd($pengumuman->kode_pengumuman);
        DB::table('set_pengumuman')->where('id', 1)->update(['set_kode_pengumuman' => null]);
        return redirect('/data-pengumuman')->with('delete', 'Pengumuman dilepas !');
    }
}
