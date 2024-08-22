@extends('unitkerja.unitkerja_layout')
@section('content')


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Pengajuan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/dashboard-unitkerja">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/auth/pelaporan-rutin">Pengajuan Audit Sistem Informasi
                                    Rutin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="section">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pelaporan-rutin.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_lapor" class="form-label">Tanggal Pengajuan</label>
                                <input type="date" name="tanggal_lapor" id="tanggal_lapor" class="form-control"
                                    placeholder="Tanggal Lapor" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_sistem" class="form-label">Nama Sistem</label>
                                <input type="text" name="nama_sistem" id="nama_sistem" class="form-control"
                                    placeholder="Nama Sistem" required>
                            </div>
                            <div class="form-group">
                                <label for="versi" class="form-label">Versi</label>
                                <input type="text" name="versi" id="versi" class="form-control" placeholder="Versi"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="longText" name="deskripsi" id="deskripsi" class="form-control"
                                    placeholder="deskripsi" required>
                            </div>
                            <div class="form-group">
                                <label for="dokumen" class="form-label">Dokumen</label>
                                <input type="file" name="dokumen[]" id="dokumen" class="form-control"
                                    placeholder="dokumen" required multiple>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>



@endsection
