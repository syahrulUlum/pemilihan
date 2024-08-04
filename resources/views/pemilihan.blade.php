@extends('layouts.main')
@section('content')
    <div class="container-fluid">
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
        @foreach ($kategoris as $kategori)
            @if ($calonMilihDiKategori != $kategori->id)
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h4>{{ $kategori->kategori->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($kategori->kategori->calon as $calon)
                                        <div class="col d-flex justify-content-center">
                                            <div class="card text-center" style="width: 17rem;">
                                                <img src="{{ asset('storage/images/calon/' . $calon->foto) }}"
                                                    class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $calon->siswa->name }}</h5>
                                                    <button type="button" class="btn btn-block btn-info mb-2"
                                                        data-toggle="modal"
                                                        data-target="{{ '#' . Illuminate\Support\Str::slug($calon->visi) }}">
                                                        Visi dan Misi
                                                    </button>
                                                    @php
                                                        setlocale(LC_ALL, 'IND');
                                                        $waktuSekarang = Carbon\Carbon::now();
                                                    @endphp

                                                    @if ($waktuSekarang < Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $kategori->mulai))
                                                        <button type="button" class="btn btn-block btn-secondary"
                                                            disabled>Belum
                                                            Dimulai</button>
                                                    @elseif ($waktuSekarang > Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $kategori->selesai))
                                                        <button type="button" class="btn btn-block btn-secondary"
                                                            disabled>Pemilihan
                                                            Berakhir</button>
                                                    @else
                                                        @if ($kategori->kategori->status == 0)
                                                            <form
                                                                action="{{ url('/pemilihan/' . $kategori->id . '/' . $calon->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    onclick="return confirm('Yakin memilih kandidat ini ?')"
                                                                    class="btn btn-block btn-primary">Pilih</button>
                                                            </form>
                                                        @else
                                                            <button type="button" class="btn btn-block btn-secondary"
                                                                disabled>Sudah memilih</button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="{{ Illuminate\Support\Str::slug($calon->visi) }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Visi dan Misi
                                                            <b>{{ $calon->siswa->name }}</b>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>Visi</h3>
                                                        <p>{{ $calon->visi }}</p>
                                                        <h3>Misi</h3>
                                                        <p>{!! nl2br(e($calon->misi)) !!}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
@endsection
