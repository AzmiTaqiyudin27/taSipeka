@php
    use Carbon\Carbon;
@endphp

@extends('TimKeamananAudit.keamananaudit_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Penerimaan Pengajuan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pelaporan Audit Sistem Informasi Rutin
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
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive display">
                        <table style="table-layout: auto;" class="table display responsive row-table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Sistem</th>
                                    <th>Versi</th>
                                    <th>Deskripsi</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $item)
                                    <tr>
                                        <td>{{ Carbon::parse($item->tanggal_lapor)->format('d-m-Y') }}</td>
                                        <td>{{ $item->nama_sistem }}</td>
                                        <td>{{ $item->versi }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td style="word-wrap: break-word; width: 30px; overflow-x: hidden;">
                                            @php
                                                $dokumens = explode(',', $item->dokumen);
                                            @endphp
                                            @foreach ($dokumens as $dokumen)
                                                <a href="/dokumen/{{ $dokumen }}">File {{$loop->index + 1}}</a><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <select name="status_approved" data-id="{{ $item->id }}"
                                                id="status_approved" class="form-select status">
                                                <option {{ $item->status_approved == '1' ? 'selected' : '' }}
                                                    class="form-option" value="1">Pending</option>
                                                <option {{ $item->status_approved == '2' ? 'selected' : '' }}
                                                    class="form-option" value="2">Diterima</option>
                                                <option {{ $item->status_approved == '3' ? 'selected' : '' }}
                                                    class="form-option" value="3">Ditolak</option>

                                            </select>
                                        </td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Modal penolakan akun --}}
            <div class="modal fade" id="penolakanModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Alasan Penolakan</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" id="alasanTolak" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form id="deleteForm" action="" method="POST" style="display:inline;">

                                <button type="button" id="tombolTolak" class="btn btn-danger">Konfirmasi</button>
                            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        console.log("lah");
        $(".status").change(function() {
            var modalTolak = new bootstrap.Modal(document.getElementById('penolakanModal'));
            var id = $(this).data("id");
            var status = $(this).val();

            var url = "{{ route('pengajuanRutin.updateStatus') }}";
            if (status == "3") {
                modalTolak.show();
                $("#tombolTolak").click(function() {
                    var alasannya = $('#alasanTolak').val();

                    if (!alasannya) {
                        alert("Perlu Mengisikan Alasan");
                    } else {
                        $.ajax({
                            url: url,
                            method: "PUT",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id,
                                status: status,
                                alasan: alasannya
                            },
                            success: function(res) {
                                console.log(res);
                                $("#alasanTolak").val(null);
                                modalTolak.hide();
                                   Swal.fire(
        'Sukses',
        'Pengajuan telah ditolak!',
        'success'
    );
                                  setTimeout(() => {
        window.location.reload();
    }, 500)
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }

                })
            } else {
                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: status
                    },
                    success: function() {

                          Swal.fire(
        'Sukses',
        'Berhasil Memperbarui Status!',
        'success'
    );
    setTimeout(() => {
        window.location.reload();
    }, 500)

                        console.log("berhasil memperbarui status")
                    },
                    error: function() {
                        alert("Gagal diperbarui");
                    }
                })
            }



        })
    </script>
@endsection
