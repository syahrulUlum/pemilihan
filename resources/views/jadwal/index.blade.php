@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="font-weight-bold text-primary">Data Jadwal</h6>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ url('jadwal/create') }}" class="btn btn-primary">Tambah Jadwal</a>
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
                            <table class="table table-bordered" id="jadwal" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
                                        <th>Kategori</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Status</th>
                                        <th width="18%">Aksi</th>
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
                                            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->mulai)->formatLocalized('%A %d %B %Y pukul %H:%M') }}
                                            </td>
                                            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->selesai)->formatLocalized('%A %d %B %Y pukul %H:%M') }}
                                            </td>
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
                                                <form action="{{ url('jadwal/' . $jadwal->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary"
                                                        href="{{ url('jadwal/' . $jadwal->id . '/edit') }}">Edit</a>
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin hapus jadwal ini ?')"
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
            $('#jadwal').DataTable();
        });
    </script>
@endsection
