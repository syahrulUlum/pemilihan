@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Edit Jadwal</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('jadwal/' . $jadwal->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option @if ($jadwal->kategori_id == $kategori->id) selected @endif
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
                                <label>Waktu Mulai</label>
                                <input type="datetime-local" class="form-control" name="mulai"
                                    value="{{ $jadwal->mulai }}">
                                @error('mulai')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Waktu Selesai</label>
                                <input type="datetime-local" class="form-control" name="selesai"
                                    value="{{ $jadwal->selesai }}">
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
