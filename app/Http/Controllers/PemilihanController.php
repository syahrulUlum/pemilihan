<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Jadwal;
use App\Models\Pemilihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $check = 0;

        if (Auth::guard('siswa')->check()) {
            $check = 0;
        } else if (Auth::guard('staff')->check()) {
            $check = 1;
        } else {
            return abort(403);
        }

        $kategoris = Jadwal::with('kategori.calon.siswa')->get();
        foreach ($kategoris as $kategori) {
            if ($check == 0) {
                $siswaUser = Auth::guard('siswa')->user();
                $siswa = Pemilihan::where('siswa_id', $siswaUser->id)->where('jadwal_id', $kategori->id)->first();
                if ($siswa) {
                    $kategori->kategori->status = 1;
                } else {
                    $kategori->kategori->status = 0;
                }
            } else if ($check == 1) {
                $staffUser = Auth::guard('staff')->user();
                $staff = Pemilihan::where('staff_id', $staffUser->id)->where('jadwal_id', $kategori->id)->first();
                if ($staff) {
                    $kategori->kategori->status = 1;
                } else {
                    $kategori->kategori->status = 0;
                }
            }
        }
        $cekCalon = Calon::where('siswa_id', auth()->user()->id)->first();
        if($cekCalon){
            $calonMilihDiKategori = $cekCalon->kategori_id;
        }else {
            $calonMilihDiKategori = null;
        }
        return view('pemilihan', compact('kategoris', 'calonMilihDiKategori'));
    }

    public function pilih($jadwal, $calon)
    {
        $check = 0;

        if (Auth::guard('siswa')->check()) {
            $check = 0;
        } else if (Auth::guard('staff')->check()) {
            $check = 1;
        } else {
            return abort(403);
        }

        if (!$jadwal || !$calon) {
            return back()->with('gagal', 'Pemilihan gagal, mohon ulangi');
        } else {
            $data_jadwal = Jadwal::find($jadwal);
            $data_calon = Calon::find($calon);
            if (!$data_jadwal || !$data_calon) {
                return back()->with('gagal', 'Pemilihan gagal, mohon ulangi');
            } else {
                if ($check == 0) {
                    $siswaUser = Auth::guard('siswa')->user();
                    $siswa = Pemilihan::where('siswa_id', $siswaUser->id)->where('jadwal_id', $jadwal)->first();
                    if ($siswa) {
                        return back()->with('gagal', 'Pemilihan gagal, mohon ulangi');
                    }
                } else if ($check == 1) {
                    $staffUser = Auth::guard('staff')->user();
                    $staff = Pemilihan::where('staff_id', $staffUser->id)->where('jadwal_id', $jadwal)->first();
                    if ($staff) {
                        return back()->with('gagal', 'Pemilihan gagal, mohon ulangi');
                    }
                }
            }
        }

        $pemilihan = new Pemilihan();
        $pemilihan->calon_id = $calon;
        $pemilihan->jadwal_id = $jadwal;
        if ($check == 0) {
            $siswaUser = Auth::guard('siswa')->user();
            $pemilihan->siswa_id = $siswaUser->id;
        } else if ($check == 1) {
            $staffUser = Auth::guard('staff')->user();
            $pemilihan->staff_id = $staffUser->id;
        }
        $pemilihan->save();

        return back()->with('berhasil', 'Pemilihan berhasil, terima kasih atas partisipasi anda');
    }
}
