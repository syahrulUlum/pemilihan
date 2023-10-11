@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Edit Staff / Guru</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('pemilih/staff/' . $staff->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label>Nama Guru / Staff</label>
                                <input type="text" name="name" value="{{ $staff->name }}" class="form-control" placeholder="Masukan nama guru atau staff">
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
                                    <option @if($staff->position == "teacher") selected @endif value="teacher">Guru</option>
                                    <option @if($staff->position == "staff") selected @endif value="staff">Staff</option>
                                </select>
                                @error('position')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ $staff->username }}" class="form-control" placeholder="Masukan Username">
                                @error('username')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Masukan Password">
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
