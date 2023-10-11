@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Tambah Calon</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('calon') }}" method="POST" enctype="multipart/form-data"">
                            @csrf
                            <div class="form-group mb-2">
                                <label>Calon</label>
                                <select name="siswa_id" class="form-control">
                                    <option value="">Pilih Calon</option>
                                    @foreach ($siswas as $siswa)
                                        <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Visi</label>
                                <input type="text" name="visi" class="form-control" placeholder="Masukan visi"
                                    value="{{ old('visi') }}">
                                @error('visi')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Misi</label>
                                <textarea name="misi" class="form-control" rows="10">{{ old('misi') }}</textarea>
                                @error('misi')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control">
                                @error('foto')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <a class="btn btn-primary" href="{{ url('calon') }}">Kembali</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
