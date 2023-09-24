@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Tambah Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('calon/kategori') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label>Kategori</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan nama kategori">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <a class="btn btn-primary" href="{{ url('calon/kategori') }}">Kembali</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
