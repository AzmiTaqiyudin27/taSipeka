@php
    use Carbon\Carbon;
@endphp


@extends('admin.admin_layout')
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
                                    Jumlah Pelaporan Rutin
                                </h5>
                                <p class="card-text">
                                    {{ $jumlahaudit }}
                                </p>
                            </div>
                        </div>
                        <div class="card mx-1 bg-primary text-white col-md-3 col-lg-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Jumlah Pelaporan Insidental
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

        <!-- Konfirmasi user Nonaktif -->
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Konfirmasi Akun</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">

                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>

                                    <th>Aksi</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userNonAktif as $item)
                                    <tr>
                                        <td><input type="checkbox" class="rowCheckbox" value="{{ $item->id }}"></td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>


                                            <button type="button" class="tombolhapus btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $item->id }}"><i
                                                    class="bi bi-trash"></i></button>

                                        </td>
                                        <td>
                                            <select data-id="{{ $item->id }}" class="statusAkun form-control"
                                                name="status">
                                                <option class="form-option" value="">-- Pilih Status Akun --</option>

                                                <option class="form-option" {{ $item->is_active == '0' ? 'selected' : '' }}
                                                    value="0">
                                                    Pending</option>
                                                <option class="form-option" {{ $item->is_active == '1' ? 'selected' : '' }}
                                                    value="1">
                                                    Diterima</option>
                                                <option class="form-option" {{ $item->is_active == '2' ? 'selected' : '' }}
                                                    value="2">
                                                    Ditolak</option>
                                            </select>
                                        </td>


                                        <!-- <button type="button"  class="tombolhapus btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $item->id }}">Hapus</button></td> -->




                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form id="deleteForm" action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- RUTIN --}}
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pengajuan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="/auth/dashboard-admin">Dashboard</a></li> --}}
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
                                    <th>Tanggal Lapor</th>
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
                                    <th>Tanggal Lapor</th>
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

        <!-- modal penolakan -->
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(".tombolhapus").click(function() {
            console.log("kocak");
            var id = $(this).data("id");
            console.log(id);
            var form = $('#deleteForm');
            var action = "{{ route('hapus-user', '') }}/" + id;
            form.attr('action', action);
        });

        // Ubah status
        $(".statusAkun").change(function() {
            var value = $(this).val();
            var id = $(this).data('id');
            var modalTolak = new bootstrap.Modal(document.getElementById('penolakanModal'));
            console.log(id);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            console.log(token);
            if (value == "2") {
                console.log("Ditolak");
                modalTolak.show();
                $("#tombolTolak").click(function() {
                    var alasannya = $('#alasanTolak').val();
                    console.log(alasannya);
                    if (!alasannya) {
                        alert("Perlu Mengisikan Alasan");
                    } else {
                        $.ajax({
                            url: "{{ route('users.changeStatus', '') }}/" + id,
                            method: "PUT",
                            data: {
                                _token: token,
                                status: value,
                                alasan: alasannya
                            },
                            success: function(res) {
                                console.log(res);
                                $("#alasanTolak").val(null);
                                modalTolak.hide();
                                 Swal.fire(
        'Sukses!',
        'Akun ditolak!',
        'success'
    );
    setTimeout(() => {
        window.location.reload();
    }, 500);
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }

                })
            } else {
                $.ajax({
                    url: "{{ route('users.changeStatus', '') }}/" + id,
                    method: "PUT",
                    data: {
                        _token: token,
                        status: value
                    },
                    success: function(response) {
                        console.log(response);
                          Swal.fire(
        'Sukses!',
        'Berhasil mengubah status akun!',
        'success'
    );
    setTimeout(() => {
        window.location.reload();
    }, 500);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }

        })
    </script>
@endsection
