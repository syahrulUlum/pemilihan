@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Tambah Staff / Guru</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('pemilih/staff') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label>Nama Guru / Staff</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan nama guru atau staff">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Posisi</label>
                                <select name="position" class="form-control">
                                    <option value="">Pilih Posisi</option>
                                    <option value="teacher">Guru</option>
                                    <option value="staff">Staff</option>
                                </select>
                                @error('position')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                                @error('username')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Masukan Password">
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <a class="btn btn-primary" href="{{ url('pemilih/staff') }}">Kembali</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
