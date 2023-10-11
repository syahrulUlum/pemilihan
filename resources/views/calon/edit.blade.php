@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Edit Calon</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('calon/' . $calon->id) }}" method="POST" enctype="multipart/form-data"">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label>Calon</label>
                                <select name="siswa_id" class="form-control">
                                    <option value="">Pilih Calon</option>
                                    @foreach ($siswas as $siswa)
                                        <option @if ($calon->siswa_id == $siswa->id) selected @endif
                                            value="{{ $siswa->id }}">{{ $siswa->name }}</option>
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
                                        <option @if ($calon->kategori_id == $kategori->id) selected @endif
                                            value="{{ $kategori->id }}">{{ $kategori->name }}</option>
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
                                    value="{{ $calon->visi }}">
                                @error('visi')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Misi</label>
                                <textarea name="misi" class="form-control" rows="10">{{ $calon->misi }}</textarea>
                                @error('misi')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-2">
                                        <label>Foto</label>
                                        <input type="file" name="foto" class="form-control">
                                        @error('foto')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-2">
                                        <label>Foto Lama</label>
                                        <img src="{{ asset('storage') }}/images/calon/{{ $calon->foto }}" width="220px">
                                    </div>
                                </div>
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
