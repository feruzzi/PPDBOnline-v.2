<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kelas', [
            'title' => "Kelas",
            'data_kelas' => Kelas::all(),
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
            'kode_kelas' => 'required|max:8|unique:kelas',
            'nama_kelas' => 'required|max:12|min:4',
        ]);
        $validatedData['kode_kelas'] = str_replace(" ", "-", $validatedData['kode_kelas']);
        $validatedData['nama_kelas'] = str_replace(" ", "-", $validatedData['nama_kelas']);
        // dd($validatedData);
        Kelas::create($validatedData);
        return redirect('/data-kelas')->with('success', 'Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        // dd($request->kode_kelas);
        $rules = [
            'nama_kelas' => 'required|max:12|min:4',
        ];
        if ($request->kode_kelas != $kelas->kode_kelas) {
            $rules['kode_kelas'] = 'required|max:8|unique:kelas';
        }
        $validatedData = $request->validate($rules);
        $validatedData['kode_kelas'] = str_replace(" ", "-", $request->kode_kelas);
        $validatedData['nama_kelas'] = str_replace(" ", "-", $validatedData['nama_kelas']);
        // dd($validatedData);
        Kelas::where('id', $kelas->id)->update($validatedData);
        return redirect('/data-kelas')->with('update', 'Data Berhasil Diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {

        // dd($kelas->id);
        Kelas::destroy($kelas->id);
        return redirect('/data-kelas')->with('delete', 'Data Berhasil Dihapus !');
    }
}
