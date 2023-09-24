<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Kelas::all();
        return view('pemilih.kelas.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemilih.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Kelas::create($request->all());
        return redirect('pemilih/kelas')->with('berhasil', 'Data berhasil ditambahkan');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        return view('pemilih.kelas.edit', compact('kela'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate(['name' => 'required']);
        $kela->update($request->all());
        return redirect('pemilih/kelas')->with('berhasil', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $siswa = Siswa::where('kelas_id', $kela->id)->first();
        if ($siswa) {
            return back()->with('gagal', 'Data ini masih digunakan');
        }
        $kela->delete();
        return back()->with('berhasil', 'Data berhasil dihapus');
    }
}
