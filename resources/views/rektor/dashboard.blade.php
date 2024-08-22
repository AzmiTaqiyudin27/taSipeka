@php
    use Carbon\Carbon;
@endphp


@extends('rektor.rektor_layout')
@section('content')
    <div class="page-heading">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Selamat Datang {{ $user->username }}</h3>
        </div>
        <hr>
        <section class="section">

            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">

                        <div class="card mx-1 bg-info text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Pelaporan Rutin
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahpelaporanrutin }}
                                </p>
                            </div>
                        </div>
                        <div class="card mx-1 bg-primary text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Pelaporan Insidental
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahpelaporaninsidental }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <hr>

        {{-- RUTIN --}}
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboard</a></li> --}}
                            {{-- <li class="breadcrumb-item active" aria-current="page">Pelaporan Audit Sistem Informasi
                            </li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tanggal Lapor</th>
                                    <th>Nama Sistem</th>
                                    <th>Versi</th>
                                    <th>Deskripsi</th>
                                    <th>Dokumen</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanrutin as $item)
                                    <tr>
                                        <td>{{ Carbon::parse($item->tanggal_lapor)->format('d-m-Y') }}</td>
                                        <td>{{ $item->nama_sistem }}</td>
                                        <td>{{ $item->versi }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            @php
                                                $dokumens = explode(',', $item->dokumen);
                                            @endphp
                                            @foreach ($dokumens as $dokumen)
                                                <a href="/dokumen/{{ $dokumen }}">{{ $dokumen }}</a><br>
                                            @endforeach
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('pelaporan-rutin.edit', $item->id) }}" class="btn btn-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('pelaporan-rutin.delete', $item->id) }}" method="POST" style="display:inline;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        {{-- END RUTIN --}}

        {{-- INSIDENTAL --}}
        <div class="page-title mt-5">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboard</a></li> --}}
                            {{-- <li class="breadcrumb-item active" aria-current="page">Pelaporan Keamanan Sistem Informasi
                            </li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table12">
                            <thead>
                                <tr>
                                    <th>Tanggal Lapor</th>
                                    <th>Nama Sistem</th>
                                    <th>Kendala</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporaninsidental as $item)
                                    <tr>
                                        <td>{{ Carbon::parse($item->tanggal_lapor)->format('d-m-Y') }}</td>
                                        <td>{{ $item->nama_sistem }}</td>
                                        <td>{{ $item->kendala }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            @php
                                                $fotos = explode(',', $item->foto);
                                            @endphp
                                            @foreach ($fotos as $foto)
                                                <a href="/foto/{{ $foto }}">{{ $foto }}</a><br>
                                            @endforeach
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('pelaporan-insidental.edit', $item->id) }}" class="btn btn-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('pelaporan-insidental.delete', $item->id) }}" method="POST" style="display:inline;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>


    </div>
@endsection
