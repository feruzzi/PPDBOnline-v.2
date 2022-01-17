<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Kelas;
use App\Models\DetailPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pendaftaran', [
            'title' => "Pendaftaran",
            'data_detail_pendaftaran' => DetailPendaftaran::all(),
            'data_pendaftaran' => Pendaftaran::all(),
            'data_kelas' => Kelas::all(),
            'data_kelass' => DetailPendaftaran::with('Kelas')->get(),
            'data_set_daftar' => DB::table('set_pendaftaran')->where('id', 1)->value('set_kode_pendaftaran'),
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
        $data_kelas = Kelas::all();
        $kode = 0;
        $validatedData = $request->validate([
            'kode_pendaftaran' => 'required|max:16|unique:pendaftaran',
            'nama_pendaftaran' => 'required|max:32|min:4',
        ]);
        $validatedData['kode_pendaftaran'] = str_replace(" ", "", $validatedData['kode_pendaftaran']);
        Pendaftaran::create($validatedData);

        foreach ($data_kelas as $kelas) {
            $kode = "kode-" . $kelas->kode_kelas;
            $kouta = "kouta-" . $kelas->nama_kelas;
            // dd($request->$kouta);
            if ($request->$kode == 1) {
                //input ke DB
                $detail = [
                    'detail_kode_pendaftaran' => str_replace(" ", "", $request->kode_pendaftaran),
                    'detail_kode_kelas' => $kelas->kode_kelas,
                    'kuota' => $request->$kouta,
                ];
                DetailPendaftaran::create($detail);
            }
            // continue;
        }
        // dd($detail);
        // dd($validatedData);
        // Kelas::create($validatedData);
        return redirect('/data-pendaftaran')->with('success', 'Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $data_kelas = Kelas::all();
        $kode = 0;
        $rules = [
            'nama_pendaftaran' => 'required|max:32|min:4',
        ];
        if ($request->kode_pendaftaran != $pendaftaran->kode_pendaftaran) {
            $rules['kode_pendaftaran'] = 'required|max:16|min:4|unique:pendaftaran';
        }
        $validatedData = $request->validate($rules);
        $validatedData['kode_pendaftaran'] = str_replace(" ", "", $request->kode_pendaftaran);
        $kode_pendaftaran = Pendaftaran::select(['kode_pendaftaran'])->find($pendaftaran);
        DetailPendaftaran::whereIn('detail_kode_pendaftaran', $kode_pendaftaran)->delete();
        Pendaftaran::where('id', $pendaftaran->id)->update($validatedData);
        // Pendaftaran::create($validatedData);

        foreach ($data_kelas as $kelas) {
            $kode = "kode-" . $kelas->kode_kelas;
            $kouta = "kouta-" . $kelas->nama_kelas;
            // dd($request->$kouta);
            if ($request->$kode == 1) {
                //input ke DB
                $detail = [
                    'detail_kode_pendaftaran' => str_replace(" ", "", $request->kode_pendaftaran),
                    'detail_kode_kelas' => $kelas->kode_kelas,
                    'kuota' => $request->$kouta,
                ];
                DetailPendaftaran::create($detail);
            }
            // continue;
        }
        // dd($detail);
        // dd($validatedData);
        // Kelas::create($validatedData);
        return redirect('/data-pendaftaran')->with('update', 'Data Berhasil Ditambahkan !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        try {
            // $id = Pendaftaran::find($pendaftaran);
            // dd($pendaftaran->id);
            $kode = Pendaftaran::select(['kode_pendaftaran'])->find($pendaftaran);
            // dd($kode);
            // $kode_pendaftaran = DetailPendaftaran::whereIn('detail_kode_pendaftaran', $kode)->get();
            // dd($kode_pendaftaran);
            DetailPendaftaran::whereIn('detail_kode_pendaftaran', $kode)->delete();
            Pendaftaran::destroy($pendaftaran->id);
            return redirect('/data-pendaftaran')->with('delete', 'Data Berhasil Dihapus !');
        } catch (Exception $e) {
            // return redirect('/data-pendaftaran')->with('delete', $e->getMessage());
            return redirect('/data-pendaftaran')->with('delete', 'Terjadi Kesalahan, Gagal Menghapus. Pastikan Data Sedang Tidak Digunakan !');
        }
    }

    public function set_daftar(Pendaftaran $pendaftaran)
    {
        // dd($pendaftaran->kode_pendaftaran);
        DB::table('set_pendaftaran')->where('id', 1)->update(['set_kode_pendaftaran' => $pendaftaran->kode_pendaftaran]);
        return redirect('/data-pendaftaran')->with('success', 'Pendaftaran ' . $pendaftaran->nama_pendaftaran . ' Berhasil dibuka !');
    }
    public function set_tutup(Pendaftaran $pendaftaran)
    {
        // dd($pendaftaran->kode_pendaftaran);
        DB::table('set_pendaftaran')->where('id', 1)->update(['set_kode_pendaftaran' => null]);
        return redirect('/data-pendaftaran')->with('delete', 'Pendaftaran ditutup !');
    }
}
