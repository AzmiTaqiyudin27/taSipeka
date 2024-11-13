@php
    use Carbon\Carbon;
@endphp


@extends('unitkerja.admin_layout')
@section('content')
    <div class="page-heading">
        {{-- RUTIN --}}
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Rutin</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Pelaporan Audit Sistem Informasi
                            </li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Minimal jQuery Datatable end -->
        <!-- Basic Tables start -->
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
                                    <th></th>
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


                                        <td>
                                            <a href="{{ route('pelaporan-rutin.edit', $item->id) }}"
                                                class="btn btn-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                            <form action="{{ route('pelaporan-rutin.delete', $item->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>


                                        </td>
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
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboard Admin</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Pelaporan Keamanan Sistem Informasi
                            </li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Minimal jQuery Datatable end -->
        <!-- Basic Tables start -->
        <section class="section">

            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tanggal Lapor</th>
                                    <th>Nama Sistem</th>
                                    <th>Kendala</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Aksi/th>
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
                                        <td>
                                            <a href="{{ route('pelaporan-insidental.edit', $item->id) }}"
                                                class="btn btn-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('pelaporan-insidental.delete', $item->id) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
        {{-- END INSIDENTAL --}}


    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('sukses'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("sukses") }}',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endsection
