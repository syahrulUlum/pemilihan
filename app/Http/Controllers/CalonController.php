<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calons = Calon::with(['siswa', 'kategori'])->latest()->get();
        return view('calon.index', compact('calons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::all();
        $kategoris = Kategori::all();
        return view('calon.create', compact('siswas', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|unique:calons,siswa_id',
            'kategori_id' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'required|min:3',
        ]);

        $calon = Calon::where('siswa_id', $request->siswa_id)->first();
        if ($calon) {
            return redirect('calon')->with('gagal', 'Siswa tersebut sudah menjadi calon');
        }

        $calons = new Calon();
        $calons->siswa_id = $request->siswa_id;
        $calons->kategori_id = $request->kategori_id;
        $calons->visi = $request->visi;
        $calons->misi = $request->misi;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $this->generateRandomString() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = 'images/calon/' . $fotoName;
            $foto->storeAs('public', $fotoPath);
            $calons->foto = $fotoName;
        }
        $calons->save();

        return redirect('calon')->with('berhasil', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calon $calon)
    {
        $siswas = Siswa::all();
        $kategoris = Kategori::all();
        return view('calon.edit', compact('calon', 'siswas', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $calon)
    {
        $request->validate([
            'siswa_id' => 'required',
            'kategori_id' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'image',
        ]);

        $calons = Calon::findOrFail($calon);

        $calons->siswa_id = $request->siswa_id;
        $calons->kategori_id = $request->kategori_id;
        $calons->visi = $request->visi;
        $calons->misi = $request->misi;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $this->generateRandomString() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = 'images/calon/' . $fotoName;
            $foto->storeAs('public', $fotoPath);

            if ($calons->foto) {
                $this->deleteImage($calons->foto);
            }

            $calons->foto = $fotoName;
        }

        $calons->save();
        return redirect('calon')->with('berhasil', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($calon)
    {
        $calons = Calon::findOrFail($calon);
        if ($calons->foto) {
            $this->deleteImage($calons->foto);
        }
        $calons->delete();
        return redirect('calon')->with('berhasil', 'Data berhasil dihapus');
    }

    private function generateRandomString($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    private function deleteImage($imageName)
    {
        if ($imageName && Storage::disk('public')->exists('images/calon/' . $imageName)) {
            Storage::disk('public')->delete('images/calon/' . $imageName);
        }
    }
}
