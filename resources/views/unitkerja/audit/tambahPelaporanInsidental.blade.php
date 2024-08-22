@extends('unitkerja.unitkerja_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Pelaporan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="pelaporanInsidental.html">Pelaporan Audit Sistem Informasi
                                    Insidental</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
               @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal_lapor" class="form-label">Tanggal Lapor</label>
                            <input type="date" name="tanggal_lapor" id="tanggal_lapor" class="form-control"
                                placeholder="Tanggal Lapor" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_sistem" class="form-label">Nama Sistem</label>
                            <input type="text" name="nama_sistem" id="nama_sistem" class="form-control"
                                placeholder="Nama Sistem" required>
                        </div>
                        <div class="form-group">
                            <label for="kendala" class="form-label">Kendala</label>
                            <input type="text" name="kendala" id="kendala" class="form-control" placeholder="kendala"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="longText" name="keterangan" id="keterangan" class="form-control"
                                placeholder="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" name="foto[]" id="foto" class="form-control" placeholder="foto"
                                required multiple>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
