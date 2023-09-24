@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="font-weight-bold text-primary">Data Calon</h6>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ url('calon/create') }}" class="btn btn-primary">Tambah Calon</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (Session::has('berhasil'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('berhasil') }}
                            </div>
                        @endif
                        @if (Session::has('gagal'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('gagal') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered" id="kategori" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
                                        <th>Nama</th>
                                        <th width="18%">Image</th>
                                        <th>Kategori</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th width="18%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calons as $key => $calon)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $calon->siswa->name }}</td>
                                            <td align="center"><img
                                                    src="{{ asset('storage') }}/images/calon/{{ $calon->foto }}"
                                                    width="40%"></td>
                                            <td align="center">{{ $calon->kategori->name }}</td>
                                            <td>{{ $calon->visi }}</td>
                                            <td>{!! nl2br(e($calon->misi)) !!}</td>
                                            <td align="center">
                                                <form action="{{ url('calon/' . $calon->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ url('calon/' . $calon->id . '/edit') }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <button onclick="return confirm('Yakin hapus data ini ?')"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#kategori').DataTable();
        });
    </script>
@endsection
