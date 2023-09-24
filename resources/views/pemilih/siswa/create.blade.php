@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Tambah Siswa</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('pemilih/siswa') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label>Nama Siswa</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Masukan Nama Siswa">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Kelas</label>
                                <select class="form-control" name="kelas_id">
                                    <option value="" selected>Pilih Kelas</option>
                                    @foreach($kelas as $data_kelas)
                                    <option value="{{ $data_kelas->id }}">{{ $data_kelas->name }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Jurusan</label>
                                <select class="form-control" name="jurusan_id">
                                    <option value="" selected>Pilih Jurusan</option>
                                    @foreach($jurusans as $data_jurusan)
                                    <option value="{{ $data_jurusan->id }}">{{ $data_jurusan->name }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username" value="{{ old('username') }}">
                                @error('username')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Masukan Password" value="{{ old('password') }}">
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <a class="btn btn-primary" href="{{ url('pemilih/siswa') }}">Kembali</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
