@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="font-weight-bold text-primary">Hasil Pemilihan</h6>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-primary" href="{{ url('/hasil') }}">Kembali</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="hasil" width="100%" cellspacing="0">
                                <thead align="center">
                                    <tr>
                                        <th width="4%">No</th>
                                        <th width="25%">Foto</th>
                                        <th>Nama</th>
                                        <th>Perolehan Suara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calons as $key => $calon)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td align="center"><img
                                                    src="{{ asset('storage') }}/images/calon/{{ $calon->foto }}"
                                                    width="40%"></td>
                                            <td>{{ $calon->siswa->name }}</td>
                                            <td align="center">{{ $calon->suara }}</td>
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
            $('#hasil').DataTable();
        });
    </script>
@endsection
