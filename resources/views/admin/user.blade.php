@php
    use Carbon\Carbon;
@endphp

@extends('admin.admin_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Akun</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/dashboard-admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Akun
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
        @if(session()->has('hapusAkun'))
             <div class="alert alert-success" role="alert">
                {{ session('hapusAkun') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Minimal jQuery Datatable end -->
        <!-- Basic Tables start -->
        <section class="section">
            <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah

            </button>

            </a>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>

                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>

                                    <th>Aksi</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>

                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>

                                            <button type="button" class="tomboledit btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{ $item->id }}">Edit</button>
                                            <button type="button" class="tombolhapus btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $item->id }}">Hapus</button>

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
        </section>
        <!-- Basic Tables end -->
        <!-- Edit modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Edit Akun</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" class="editForm" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Email</label>
                                <input type="text" name="email_edit" id="email" class="form-control"
                                    placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_sistem_edit" class="form-label">Nama</label>
                                <input type="text" name="username_edit" id="nama" class="form-control"
                                    placeholder="Nama" required>
                            </div>

                            {{-- <div class="form-group col-4">
                                <label for="dropdownSelect">Role</label>
                                <select class="role form-control" name="role" id="dropdownSelect">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="supervisor">Pimpinan</option>
                                    <option value="audit">Audit</option>
                                    <option value="unitkerja">Unit Kerja</option>
                                </select>
                            </div>

                            <div class="unitkerja d-none form-group">
                                <label for="unitkerja" class="form-label">Unit Kerja</label>
                                <select class="  form-control" name="unitkerja" id="dropdownSelect">
                                    <option value="">-- Pilih Unit Kerja --</option>
                                    @foreach ($unitkerja as $item)
                                        <option value="{{ $item->id }}">{{ $item->username }}</option>
                                    @endforeach
                                </select>
                            </div> --}}


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-info editpassword">Ubah Password</button>
                            </div>
                        </form>

                        <form id="editinPassword" class="editinPassword d-none" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Password Baru</label>
                                <input type="password" name="passwordedit" minlength="8" id="passwordedit"
                                    class="form-control" placeholder="Password Baru" required>
                            </div>
                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="passwordedit_confirmation" id="passwordeditkonfirmasi"
                                    class="form-control" placeholder="Konfirmasi Password" required>
                            </div>
                            <div class="form-group">
                                <button type="button" class="kembaliedit btn btn-warning">Kembali</button>
                                <button type="submit" class="btn btn-success">Ubah Password</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal cetak -->
        <div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cetakModalLabel">Preview</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="preview">

                        </div>
                        <button class="btn btn-info cetakin">Cetak</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- tambah modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Tambah Akun</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm" action="{{ route('tambah-user') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_sistem_edit" class="form-label">Username</label>
                                <input type="text" name="username" id="nama" class="form-control"
                                    placeholder="Nama" required>
                            </div>

                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password" min="8" required>
                            </div>
                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Password" required>
                            </div>



                            <div class="form-group col-4">
                                <label for="dropdownSelect">Role</label>
                                <select class="role form-control" name="role" id="dropdownSelect">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="pimpinan">Pimpinan</option>
                                    <option value="audit">Audit</option>
                                    <option value="unitkerja">Unit Kerja</option>
                                    <option value="rektor">Rektor</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <input type="hidden" name="status" value="1">

                                {{-- <label for="dropdownSelect">Status</label>
                                <select class="form-control" name="status" id="dropdownSelect">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Pending</option>

                                </select> --}}
                            </div>

                            <div class="unitkerja d-none form-group">
                                <label for="unitkerja" class="form-label">Unit Kerja</label>
                                <select class="  form-control" name="unitkerja" id="dropdownSelect">
                                    <option value="">-- Pilih Unit Kerja --</option>
                                    @foreach ($unitkerja as $item)
                                        <option value="{{ $item->id }}">{{ $item->username }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>

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

                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" id="alasanTolak" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="batalBtn" >Batal</button>
                        <form id="" action="" method="POST" style="display:inline;">

                            <button type="button" id="tombolTolak" class="btn btn-danger">Konfirmasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>

                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="batalBtn" >Batal</button>
                        <form id="deleteForm" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
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
          document.getElementById('batalBtn').addEventListener('click', function () {
        // Refresh halaman setelah modal ditutup
        window.location.reload();
    });
        // $(document).ready(function() {

        // Ubah status
        $(".statusAkun").change(function() {
            var value = $(this).val();
            var id = $(this).data('id');
            var modalTolak = new bootstrap.Modal(document.getElementById('penolakanModal'), {
                backdrop : 'static',
                keyboard : false
            });
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
        'Status telah diubah!',
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

        $(".role").change(function() {

            // console.log("data", $(this.val))
            if ($(this).val() == "pimpinan") {
                $(".unitkerja").removeClass("d-none");
            } else {
                $(".unitkerja").addClass("d-none");
            }

        });
        // hapus
        $(".tombolhapus").click(function() {
            console.log("kocak");
            var id = $(this).data("id");
            console.log(id);
            var form = $('#deleteForm');
            var action = "{{ route('hapus-user', '') }}/" + id;
            form.attr('action', action);
            console.log(form.attr);
        });
        // edit
        $(".tomboledit").click(function() {
            var id = $(this).data("id");
            console.log(id);
            var url = "{{ route('getdatauser', '') }}/" + id;
            var form = $('#editForm');
            var action = "{{ route('getdatauser.update', '') }}/" + id;
            var formPassword = $('#editinPassword');
            var actionPassword = "{{ route('ubahPassword', '') }}/" + id;
            form.attr('action', action);
            formPassword.attr('action', actionPassword);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Assuming response is JSON, you can parse and display it as needed
                    console.log(response);
                    $("#email").val(response.email);
                    $("#nama").val(response.username);

                },
                error: function(xhr) {
                    // Handle error
                    alert('Error fetching data');
                }
            });
        });

        $(".editpassword").click(function() {
            $(".editinPassword").toggleClass("d-none");
            $(".editForm").toggleClass("d-none");
        })

        $(".kembaliedit").click(function() {
            $(".editinPassword").toggleClass("d-none");
            $(".editForm").toggleClass("d-none");
        })



        // });
    </script>

@endsection
