@php
    use Carbon\Carbon;
@endphp


@extends('unitkerja.unitkerja_layout')
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
                                    Jumlah Pengajuan Rutin
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahpelaporanrutin }}
                                </p>
                            </div>
                        </div>
                        <div class="card mx-1 bg-primary text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Pengajuan Insidental
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
                    <h3>Pengajuan Audit Sistem Informasi Rutin</h3>
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
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Sistem</th>
                                    <th>Versi</th>
                                    <th>Deskripsi</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                                $dokumenArray = json_decode($item->dokumen, true);
                                            @endphp
                                            <ul>
                                                @foreach ($dokumenArray as $dokumen)
                                                <li>
                                                    <a href="/dokumen/{{ $dokumen }}">{{ $dokumen }}</a><br>
                                                </li>
                                                @endforeach
                                            </ul>


                                        </td>
                                        <td>
                                            @if ($item->status_approved == '1')
                                                Pending
                                            @elseif($item->status_approved == '2')
                                                Diterima
                                            @else
                                                <a data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-id="{{ $item->id }}" type="button"
                                                    class="detailDitolakRutin text-primary cursor-pointer">
                                                    Ditolak
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_approved == '1')
                                                <a href="/auth/pelaporan-rutin/edit/{{ $item->id }}"
                                                    class="tbledit btn btn-warning" data-id="{{ $item->id }}"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <button class="tblhapusrutin btn btn-danger"
                                                    data-id="{{ $item->id }}"><i
                                                        class="bi text-white bi-trash-fill"></i></button>
                                            @elseif($item->status_approved == '2')
                                                -
                                            @else
                                                <button class="tblhapusrutin btn btn-danger"
                                                    data-id="{{ $item->id }}"><i
                                                        class="bi text-white bi-trash-fill"></i></button>
                                            @endif
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
                    <h3>Pengajuan Audit Sistem Informasi Insidental</h3>
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

            {{-- <a href="{{ route('pelaporan-insidental.printPDF') }}" class="btn btn-info float-lg-end">
                <i class="bi bi-printer"></i> Cetak PDF
            </a> --}}

            {{-- <a href="/pelaporan-insidental/create" class="btn btn-secondary mt-4 float-lg-end">
                Search
            </a> --}}
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table12">
                            <thead>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Sistem</th>
                                    <th>Kendala</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                         <td   @php
        // Jika foto disimpan sebagai JSON atau string yang dipisahkan koma
        $fotos = json_decode($item->foto, true) ?? explode(',', $item->foto);
    @endphp
                                            <ul>
                                                @foreach ($fotos as $foto)
                                                <li>
                                                    <a href="/foto/{{ $foto }}">{{ $foto }}</a><br>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td>
                                            @if ($item->status_approved == '1')
                                                Pending
                                            @elseif($item->status_approved == '2')
                                                Diterima
                                            @else
                                                <a data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-id="{{ $item->id }}" type="button"
                                                    class="detailDitolakInsidental text-primary cursor-pointer">
                                                    Ditolak
                                                </a>
                                            @endif
                                        </td>
                                        <td>

                                            @if ($item->status_approved == '1')
                                                <a href="/auth/pelaporan-insidental/edit/{{ $item->id }}"
                                                    class="tbledit btn btn-warning" data-id="{{ $item->id }}"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <button class="tblhapusinsidental btn btn-danger"
                                                    data-id="{{ $item->id }}"><i
                                                        class="bi text-white bi-trash-fill"></i></button>
                                            @elseif($item->status_approved == '2')
                                                -
                                            @else
                                                <button class="tblhapusrutin btn btn-danger"
                                                    data-id="{{ $item->id }}"><i
                                                        class="bi text-white bi-trash-fill"></i></button>
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Alasan Penolakan</h5>
                            <button type="button" onclick="resetIsi()" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="alasanditolak">
                                Tunggu Sebentar...
                            </p>
                        </div>
                    </div>
                </div>
            </div>


        </section>


    </div>

    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function resetIsi() {
            $(".alasanditolak").html("Tunggu Sebentar...");
        }
        $(".detailDitolakRutin").click(function() {
            var id = $(this).data('id');
            var url = "{{ route('pengajuanRutin.alasantolak') }}";
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log(response)
                    $(".alasanditolak").html(response);
                },
                error: function(error) {
                    console.log(error);

                }
            })
            console.log(id);

        });
        $(".detailDitolakInsidental").click(function() {
            var id = $(this).data('id');
            var url = "{{ route('pengajuanInsidental.alasantolak') }}";
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log(response)
                    $(".alasanditolak").html(response);
                },
                error: function(error) {
                    console.log(error);

                }
            })
            console.log(id);

        })
        $(".tblhapusinsidental").click(function() {
            console.log("OK")
            var id = $(this).data("id");
            var url = "{{ route('pengajuanInsidental.hapus') }}";
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                           Swal.fire(
        'Sukses!',
        'Pengajuan dihapus!',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });
                },
                error: function(error) {
                    console.log(error);
                    console.log("gagal menghapus data");
                }
            })
        })
        $(".tblhapusrutin").click(function() {
            var id = $(this).data("id");
            var url = "{{ route('pengajuanRutin.hapus') }}";
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                       Swal.fire(
        'Sukses!',
        'Pengajuan dihapus!',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });
                },
                error: function(error) {
                    console.log(error);
                    console.log("gagal menghapus data");
                }
            })
        })
    </script>
@endsection
