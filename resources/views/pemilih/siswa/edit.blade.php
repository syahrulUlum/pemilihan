@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Edit Siswa</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('pemilih/siswa/' . $siswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label>Nama Siswa</label>
                                <input type="text" name="name" value="{{ $siswa->name }}" class="form-control"
                                    placeholder="Masukan Nama Siswa">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Kelas</label>
                                <select class="form-control" name="kelas_id">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $data_kelas)
                                        <option @if ($data_kelas->id == $siswa->kelas_id) selected @endif
                                            value="{{ $data_kelas->id }}">{{ $data_kelas->name }}</option>
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
                                    @foreach ($jurusans as $data_jurusan)
                                        <option @if ($data_jurusan->id == $siswa->jurusan_id) selected @endif
                                            value="{{ $data_jurusan->id }}">{{ $data_jurusan->name }}</option>
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
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username"
                                    value="{{ $siswa->username }}">
                                @error('username')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Masukan Password"
                                    value="">
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
