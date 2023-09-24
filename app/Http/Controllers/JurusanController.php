<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Jurusan::all();
        return view('pemilih.jurusan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemilih.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Jurusan::create($request->all());
        return redirect('pemilih/jurusan')->with('berhasil', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('pemilih.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate(['name' => 'required']);
        $jurusan->update($request->all());
        return redirect('pemilih/jurusan')->with('berhasil', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $siswa = Siswa::find($jurusan->id);
        if ($siswa) {
            return back()->with('gagal', 'Data ini masih digunakan');
        }
        $jurusan->delete();
        return back()->with('berhasil', 'Data berhasil dihapus');
    }
}
