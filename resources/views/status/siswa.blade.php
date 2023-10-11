@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="font-weight-bold text-primary">Status Siswa</h6>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="{{ url('/status') }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="siswa" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $key => $siswa)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $siswa->name }}</td>
                                            <td>{{ $siswa->kelas->name }}</td>
                                            <td>{{ $siswa->jurusan->name }}</td>
                                            <td>
                                                @if ($siswa->status == 0)
                                                    <p class="text-danger">Belum Memilih</p>
                                                @else
                                                    <p class="text-success">Sudah Memilih</p>
                                                @endif
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
