@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="font-weight-bold text-primary">Data Siswa</h6>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="{{ url('pemilih/siswa/create') }}" class="btn btn-primary">Tambah Siswa</a>
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
                            <table class="table table-bordered" id="siswa" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th width="28%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->kelas->name }}</td>
                                            <td>{{ $data->jurusan->name }}</td>
                                            <td>
                                                <form action="{{ url('pemilih/siswa/' . $data->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary"
                                                        href="{{ url('pemilih/siswa/' . $data->id . '/edit') }}">Edit</a>
                                                    <button class="btn btn-danger" type="submit"
                                                        onclick="return confirm('Yakin hapus data ini ?')">Hapus</button>
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
            $('#siswa').DataTable();
        });
    </script>
@endsection
