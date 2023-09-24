<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('pengaturan');
    }

    public function update(Request $request, $pengaturan)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required'
        ]);

        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        } else {
            unset($request['password']);
        }

        if (Auth::guard('web')->check()) {
            $user = User::find($pengaturan);
            $user->update($request->all());
        } else if (Auth::guard('siswa')->check()) {
            $siswa = Siswa::find($pengaturan);
            $siswa->update($request->all());
        } else if (Auth::guard('staff')->check()) {
            $staff = Staff::find($pengaturan);
            $staff->update($request->all());
        }

        return back()->with('berhasil', 'Pengaturan berhasil diperbarui');
    }
}
