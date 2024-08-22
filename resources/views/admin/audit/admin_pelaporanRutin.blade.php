@php
    use Carbon\Carbon;
@endphp

@extends('admin.admin_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pengajuan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/dashboard-unitkerja">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengajuan Audit Sistem Informasi Rutin
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session()->has('suksestambah'))
            <div class="alert alert-success" role="alert">
                {{ session('suksestambah') }}
            </div>
        @endif
        @if (session()->has('sukseshapus'))
            <div class="alert alert-danger" role="alert">
                {{ session('sukseshapus') }}
                {{-- Coba lagi setelah ini. --}}
            </div>
        @endif
        @if (session()->has('suksesubah'))
            <div class="alert alert-success" role="alert">
                {{ session('suksesubah') }}
            </div>
        @endif

        <!-- Minimal jQuery Datatable end -->
        <!-- Basic Tables start -->
        <section class="section">
            <!-- <a href="{{ route('pelaporan-rutin.create') }}" class="btn btn-success mt-4">
                Tambah
            </a> -->
            {{-- <a href="{{ route('pelaporan-rutin.printPDF') }}" class="btn btn-info float-lg-end">
                <i class="bi bi-printer"></i> Cetak PDF
            </a> --}}
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
                                    <th>Status</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datarutin as $item)
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
                                            @if ($item->status_approved == '1')
                                                Pending
                                            @elseif($item->status_approved == '2')
                                                Diterima
                                            @else
                                                <a data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-id="{{ $item->id }}" type="button"
                                                    class="detailDitolak text-primary cursor-pointer">
                                                    Ditolak
                                                </a>
                                            @endif
                                        </td>
                                        <!-- <td>
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
                                        </td> -->



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
        <!-- Basic Tables end -->

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function resetIsi() {
            $(".alasanditolak").html("Tunggu Sebentar...");
        }
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
                    alert("Berhasil menghapus pengajuan ditolak");
                    window.location.reload();
                },
                error: function(error) {
                    console.log(error);
                    console.log("gagal menghapus data");
                }
            })
        })

        $(".detailDitolak").click(function() {
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

        })
    </script>
@endsection
