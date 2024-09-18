@php
    use Carbon\Carbon;
@endphp

@extends('TimKeamananAudit.keamananaudit_layout')
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
                        <div class="card mx-1 bg-primary text-white col-lg-2 col-md-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Sistem
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahsistem }}
                                </p>
                            </div>
                        </div>
                        <div class="card mx-1 bg-info text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Penlaporan Audit Rutin
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahaudit }}
                                </p>
                            </div>
                        </div>
                        <div class="card mx-1 bg-primary text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Pelaporan Audit Insidental
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahinsidental }}
                                </p>
                            </div>
                        </div>
                        <div class="card mx-1 bg-info text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Pengajuan Rutin
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahpengajuanrutin }}
                                </p>
                            </div>
                        </div>
                        <div class="card mx-1 bg-primary text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Pengajuan Insidental
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahpengajuaninsidental }}
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
                    <h3>Konfirmasi Pengajuan Audit Rutin</h3>
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
                    <h3>Konfirmasi Pengajuan Audit Insidental</h3>
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
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Sistem</th>
                                    <th>Kendala</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>
                                        Status
                                    </th>
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
                                            <select name="status_approved" data-id="{{ $item->id }}"
                                                id="status_approved" class="form-select statusInsidental">
                                                <option {{ $item->status_approved == '1' ? 'selected' : '' }}
                                                    class="form-option" value="1">Pending</option>
                                                <option {{ $item->status_approved == '2' ? 'selected' : '' }}
                                                    class="form-option" value="2">Diterima</option>
                                                <option {{ $item->status_approved == '3' ? 'selected' : '' }}
                                                    class="form-option" value="3">Ditolak</option>

                                            </select>
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

        {{-- Modal Penolakan --}}
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="batalBtn" >Batal</button>
                        <form id="deleteForm" action="" method="POST" style="display:inline;">

                            <button type="button" id="tombolTolak" class="btn btn-danger">Konfirmasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- END INSIDENTAL --}}



        <!-- Penindakan Audit Rutin -->
        <div class="page-title mt-5">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                </div>
            </div>
        </div>


        <section class="section">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table13">
                            <thead>
                                <tr>
                                    <th>Tanggal Audit</th>
                                    <th>Nama Sistem</th>
                                    <th>Judul</th>
                                    <th>Versi</th>
                                    <th>Unit Kerja</th>
                                    <th>Status</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($auditrutin as $item)
                                    <tr>
                                        <td>{{ Carbon::parse($item->tanggal_audit)->format('d-m-Y') }}</td>
                                        <td>{{ $item->kodeaudit->nama_sistem }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->versi }}</td>
                                        <td>{{ $item->unitkerja->username }}</td>
                                        <td>
                                            {{ $item->status }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <div class="page-title mt-5">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                </div>
            </div>
        </div>

        <section class="section">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table14">
                            <thead>
                                <tr>
                                    <th>Tanggal Audit</th>
                                    <th>Nama Sistem</th>
                                    <th>Judul</th>
                                    <th>Versi</th>
                                    <th>Unit Kerja</th>
                                    <th>Status</th>

                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($auditinsidental as $item)
                                    <tr>
                                        <td>{{ Carbon::parse($item->tanggal_audit)->format('d-m-Y') }}</td>
                                        <td>{{ $item->kodeaudit->nama_sistem }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->versi }}</td>
                                        <td>{{ $item->unitkerja->username }}</td>
                                        <td>{{ $item->status }}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
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
                                // console.log("Pengajuan ditolak");
                                 Swal.fire(
        'Sukses!',
        'Pengajuan telah ditolak!',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });;


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
                        console.log("Status telah diperbarui")
                         Swal.fire(
        'Sukses!',
        'Status berhasil diperbarui',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });;

                    },
                    error: function() {
                        alert("Gagal diperbarui");
                    }
                })
            }



        })
        $(".statusInsidental").change(function() {
            var id = $(this).data("id");
            console.log(id);
            var modalTolak = new bootstrap.Modal(document.getElementById('penolakanModal'));
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
                                console.log("Pengajuan ditolak")
                                Swal.fire(
        'Sukses!',
        'Pengajuan telah ditolak!',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });;

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
        'Sukses!',
        'Status berhasil diperbarui!',
        'success'
    ).then((result) => {
        if(result.isConfirmed || result.isDismissed){
            window.location.reload();
        }
    });;

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
