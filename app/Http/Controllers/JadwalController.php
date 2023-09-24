<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::with('kategori')->get();
        return view('jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('jadwal.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        $jadwal = Jadwal::where('kategori_id', $request->kategori_id)->first();

        if ($jadwal) {
            return redirect('jadwal')->with('gagal', 'Jadwal pada kategori ini sudah ada');
        }

        Jadwal::create($request->all());
        return redirect('jadwal')->with('berhasil', 'Jadwal berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $kategoris = Kategori::all();
        return view('jadwal.edit', compact('kategoris', 'jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'kategori_id' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        $jadwals = Jadwal::where('kategori_id', $request->kategori_id)->first();

        if ($jadwals && $jadwals->kategori_id != $request->kategori_id) {
            return redirect('jadwal')->with('gagal', 'Jadwal pada kategori ini sudah ada');
        }

        $jadwal->update($request->all());
        return redirect('jadwal')->with('berhasil', 'Jadwal berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect('jadwal')->with('berhasil', 'Jadwal berhasil dihapus');
    }
}
