@php
    use Carbon\Carbon;
@endphp


@extends('TimKeamananAudit.keamananaudit_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Penerimaan Pengajuan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penerimaan Pengajuan Audit Sistem Informasi
                                Insidental</li>
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
                    <div class="table-responsive">
                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Sistem</th>
                                    <th>Kendala</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    {{-- <th>Aksi/th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $item)
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

                                        {{-- <td>
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
                                        </td> --}}
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


                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" id="alasanTolak" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="batalBtn" >Batal</button>
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
          document.getElementById('batalBtn').addEventListener('click', function () {
        // Refresh halaman setelah modal ditutup
        window.location.reload();
    });
        $(".status").change(function() {
            var id = $(this).data("id");
            console.log(id);
            var modalTolak = new bootstrap.Modal(document.getElementById('penolakanModal'), {
                backdrop : 'static',
                keyboard : false

        });
            var status = $(this).val();
            var url = "{{ route('pengajuanInsidental.updateStatus') }}";
            if (status == '3') {
                modalTolak.show();
                $("#tombolTolak").click(function() {
                    var alasannya = $('#alasanTolak').val();
                    console.log(alasannya);
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
        'Pengajuan Telah Ditolak!',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });;;


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
                    success: function(response) {
                        console.log("Status berhasil diperbarui");
                        Swal.fire(
        'Sukses',
        'Status telah diperbarui!',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });;;


                    },
                    error: function(error) {
                        console.error(error);
                        alert('Terjadi kesalahan saat memperbarui status');
                    }
                })
            }


        })
    </script>
@endsection
