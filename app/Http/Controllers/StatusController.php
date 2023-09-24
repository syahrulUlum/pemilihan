<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Jadwal;
use App\Models\Pemilihan;
use App\Models\Siswa;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('kategori')->get();
        return view('status.index', compact('jadwals'));
    }

    public function siswa($status)
    {
        $siswas = Siswa::with(['jurusan', 'kelas'])->get();
        $jadwal = Jadwal::find($status);
        $waktuSekarang = Carbon::now();
        if ($waktuSekarang < Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->mulai)) {
            return redirect('/status');
        }
        foreach ($siswas as $siswa) {
            $calon = Calon::where('siswa_id', $siswa->id)->first();
            if ($calon) {
                $siswas = $siswas->reject(function ($item) use ($siswa) {
                    return $item->id == $siswa->id;
                });
            }

            $pemilihan = Pemilihan::where('siswa_id', $siswa->id)->where('jadwal_id', $status)->first();
            if ($pemilihan) {
                $siswa->status = 1;
            } else {
                $siswa->status = 0;
            }
        }
        return view('status.siswa', compact('siswas'));
    }

    public function staff($status)
    {
        $staffs = Staff::all();

        $jadwal = Jadwal::find($status);
        $waktuSekarang = Carbon::now();
        if ($waktuSekarang < Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->mulai)) {
            return redirect('/status');
        }

        foreach ($staffs as $staff) {
            $pemilihan = Pemilihan::where('staff_id', $staff->id)->where('jadwal_id', $status)->first();
            if ($pemilihan) {
                $staff->status = 1;
            } else {
                $staff->status = 0;
            }
        }
        return view('status.staff', compact('staffs'));
    }
}
