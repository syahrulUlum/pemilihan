@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Tambah Jadwal</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('jadwal') }}" method="POST">
                            @csrf
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
                                <label>Waktu Mulai</label>
                                <input type="datetime-local" class="form-control" name="mulai">
                                @error('mulai')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Waktu Selesai</label>
                                <input type="datetime-local" class="form-control" name="selesai">
                                @error('selesai')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <a class="btn btn-primary" href="{{ url('jadwal') }}">Kembali</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
