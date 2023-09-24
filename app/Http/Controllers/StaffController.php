<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Staff::latest()->get();
        return view('pemilih.staff.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemilih.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
            "password" => "required",
            "position" => "required",
        ]);
        $request['password'] = Hash::make($request->password);
        Staff::create($request->all());
        return redirect('pemilih/staff')->with('berhasil', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return view('pemilih.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
            "position" => "required",
        ]);

        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        } else {
            unset($request['password']);
        }

        $staff->update($request->all());
        return redirect('pemilih/staff')->with('berhasil', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect('pemilih/staff')->with('berhasil', 'Data berhasil dihapus');
    }
}
