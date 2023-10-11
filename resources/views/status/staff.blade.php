@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="font-weight-bold text-primary">Status Staff</h6>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="{{ url('/status') }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="staff" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
                                        <th>Nama Staff</th>
                                        <th>Posisi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $key => $staff)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $staff->name }}</td>
                                            <td>{{ $staff->position }}</td>
                                            <td>
                                                @if ($staff->status == 0)
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
            $('#staff').DataTable();
        });
    </script>
@endsection
