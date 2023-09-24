<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // return auth()->user();
        $calon = Calon::count();
        $siswa = Siswa::count() - $calon;
        $staff = Staff::count();
        $pemilih = $siswa + $staff;
        $jadwals = Jadwal::all();
        $jadwal = 0;
        foreach ($jadwals as $value) {
            $waktu_sekarang = Carbon::now();
            $waktu_mulai = Carbon::createFromFormat('Y-m-d H:i:s', $value->mulai);
            $waktu_selesai = Carbon::createFromFormat('Y-m-d H:i:s', $value->selesai);
            if ($waktu_sekarang > $waktu_mulai && $waktu_sekarang < $waktu_selesai) {
                $jadwal++;
            }
        }
        return view('dashboard', compact('calon', 'pemilih', 'jadwal'));
    }
}
