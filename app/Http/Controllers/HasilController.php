<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Jadwal;
use App\Models\Kategori;
use App\Models\Pemilihan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('kategori')->get();
        return view('hasil.index', compact('jadwals'));
    }

    public function show($hasil)
    {

        $jadwal = Jadwal::find($hasil);
        $waktuSekarang = Carbon::now();
        if ($waktuSekarang < Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->selesai)) {
            return redirect('/hasil');
        }

        $kategori = Kategori::find($jadwal->kategori_id);

        $calons = Calon::with(['kategori', 'siswa'])->where('kategori_id', $kategori->id)->get();
        foreach ($calons as $calon) {
            $suara = Pemilihan::where('calon_id', $calon->id)->where('jadwal_id', $hasil)->count();
            $calon->suara = $suara;
        }

        return view('hasil.show', compact('calons'));
    }
}
