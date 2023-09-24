<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Jadwal;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Kategori::all();
        return view('calon.kategori.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calon.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Kategori::create($request->all());
        return redirect('calon/kategori')->with('berhasil', 'Data berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('calon.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['name' => 'required']);
        $kategori->update($request->all());
        return redirect('calon/kategori')->with('berhasil', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $calon = Calon::where('kategori_id', $kategori->id)->first();
        if ($calon) {
            return back()->with('gagal', 'Data ini masih digunakan');
        }
        $jadwal = Jadwal::where('kategori_id', $kategori->id)->first();
        if ($jadwal) {
            return back()->with('gagal', 'Data ini masih digunakan');
        }
        $kategori->delete();
        return redirect('calon/kategori')->with('berhasil', 'Data berhasil dihapus');
    }
}
