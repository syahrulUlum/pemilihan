@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Edit Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('calon/kategori/'.$kategori->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label>Kategori</label>
                                <input type="text" value="{{ $kategori->name }}" name="name" class="form-control" placeholder="Masukan nama kategori">
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
