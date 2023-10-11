@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="font-weight-bold text-primary">Hasil Pemilihan</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-warning" role="alert">
                            Hasil bisa dilihat jika jadwal pemilihan sudah selesai
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="hasil" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        setlocale(LC_ALL, 'IND');
                                        $waktuSekarang = Carbon\Carbon::now();
                                    @endphp
                                    @foreach ($jadwals as $key => $jadwal)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $jadwal->kategori->name }}</td>
                                            <td>
                                                @php
                                                    if ($waktuSekarang < Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->mulai)) {
                                                        echo '<p class="text-danger">Belum dimulai</p>';
                                                    } elseif ($waktuSekarang > Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->selesai)) {
                                                        echo '<p class="text-success">Selesai</p>';
                                                    } else {
                                                        echo '<p class="text-primary">Sedang Berlangsung</p>';
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    if ($waktuSekarang > Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->selesai)) {
                                                        echo '<a href="' . url('/hasil/' . $jadwal->id) . '" class="btn btn-primary mr-2">Hasil</a>';
                                                    } else {
                                                        echo '<button class="btn btn-primary mr-2" disabled>Hasil</button>';
                                                    }
                                                @endphp
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
            $('#hasil').DataTable();
        });
    </script>
@endsection
