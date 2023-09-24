<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Siswa::with(['jurusan', 'kelas'])->latest()->get();
        return view('pemilih.siswa.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        return view('pemilih.siswa.create', compact('jurusans', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'kelas_id' => 'required',
            'jurusan_id' => 'required',
        ]);
        $request['password'] = Hash::make($request->password);
        Siswa::create($request->all());
        return redirect('pemilih/siswa')->with('berhasil', 'Data berhasil ditambahkan');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        return view('pemilih.siswa.edit', compact('jurusans', 'kelas', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'kelas_id' => 'required',
            'jurusan_id' => 'required',
        ]);
        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        } else {
            unset($request['password']);
        }

        $siswa->update($request->all());
        return redirect('pemilih/siswa')->with('berhasil', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $calon = Calon::where('siswa_id', $siswa->id)->first();
        if ($calon) {
            return redirect('pemilih/siswa')->with('gagal', 'Data ini masih digunakan');
        }
        $siswa->delete();
        return redirect('pemilih/siswa')->with('berhasil', 'Data berhasil dihapus');
    }
}
